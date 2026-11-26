<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Caregiver;
use App\Models\Inquiry;
use App\Models\StaffingRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/** Shared list / detail / status / notes screens for inquiries, applications and facility staffing requests. */
class RecordController extends Controller
{
    private const TYPES = [
        'inquiries' => [
            'model' => Inquiry::class, 'title' => 'Family & client inquiries',
            'cols' => ['name' => 'Name', 'topic' => 'Topic', 'phone' => 'Phone', 'created_at' => 'Received'],
        ],
        'applications' => [
            'model' => Application::class, 'title' => 'Caregiver & CNA applications',
            'cols' => ['name' => 'Name', 'role_applied' => 'Role', 'phone' => 'Phone', 'created_at' => 'Received'],
        ],
        'staffing' => [
            'model' => StaffingRequest::class, 'title' => 'Facility staffing requests',
            'cols' => ['facility_name' => 'Facility', 'contact_name' => 'Contact', 'roles_needed' => 'Roles needed', 'created_at' => 'Received'],
        ],
    ];

    private function cfg(string $type): array
    {
        return self::TYPES[$type] ?? abort(404);
    }

    public function index(Request $r, string $type)
    {
        $c = $this->cfg($type);
        $model = $c['model'];
        $q = $model::query()->latest();

        if ($status = $r->query('status')) {
            $q->where('status', $status);
        }
        if ($term = trim((string) $r->query('q'))) {
            $q->where(function ($w) use ($term, $c) {
                foreach (array_keys($c['cols']) as $col) {
                    if ($col !== 'created_at') {
                        $w->orWhere($col, 'like', "%{$term}%");
                    }
                }
            });
        }

        if ($r->query('export') === 'csv') {
            return $this->csv($type, $q->get());
        }

        return view('admin.records.index', [
            'type' => $type, 'c' => $c, 'statuses' => $model::STATUSES, 'rows' => $q->paginate(20)->withQueryString(),
        ]);
    }

    public function show(string $type, int $id)
    {
        $c = $this->cfg($type);
        $rec = $c['model']::with('notes.user')->findOrFail($id);

        return view('admin.records.show', ['type' => $type, 'c' => $c, 'rec' => $rec, 'statuses' => $c['model']::STATUSES]);
    }

    public function status(Request $r, string $type, int $id)
    {
        $c = $this->cfg($type);
        $rec = $c['model']::findOrFail($id);
        $data = $r->validate(['status' => ['required', Rule::in(array_keys($c['model']::STATUSES))]]);
        $rec->update($data);

        return back()->with('success', 'Status updated.');
    }

    public function note(Request $r, string $type, int $id)
    {
        $rec = $this->cfg($type)['model']::findOrFail($id);
        $data = $r->validate(['body' => 'required|string|max:2000']);
        $rec->notes()->create(['body' => $data['body'], 'user_id' => $r->user()->id]);

        return back()->with('success', 'Note added.');
    }

    public function destroy(Request $r, string $type, int $id)
    {
        abort_unless($r->user()->isAdmin(), 403);

        $rec = $this->cfg($type)['model']::findOrFail($id);
        $rec->notes()->delete();
        $rec->delete();

        return redirect()->route('admin.records.index', ['type' => $type])->with('success', 'Record deleted.');
    }

    /** Turn a hired applicant into a caregiver who can be assigned to shifts. */
    public function roster(int $id)
    {
        $app = Application::findOrFail($id);

        $cg = Caregiver::firstOrCreate(['application_id' => $app->id], [
            'name' => $app->name, 'phone' => $app->phone, 'email' => $app->email,
            'role' => str_contains(strtolower($app->role_applied), 'cna') ? 'CNA' : 'Caregiver',
        ]);

        return redirect()->route('admin.resource.edit', ['resource' => 'caregivers', 'id' => $cg->id])
            ->with('success', $cg->wasRecentlyCreated ? 'Added to the caregiver roster.' : 'This person is already on the roster.');
    }

    private function csv(string $type, $rows)
    {
        // Guard against spreadsheet formula injection from public form input.
        $safe = fn ($v) => is_string($v) && $v !== '' && str_contains('=+-@', $v[0]) ? "'".$v : $v;

        return response()->streamDownload(function () use ($rows, $safe) {
            $out = fopen('php://output', 'w');
            $first = true;
            foreach ($rows as $row) {
                $attrs = $row->getAttributes();
                if ($first) {
                    fputcsv($out, array_keys($attrs), ',', '"', '');
                    $first = false;
                }
                fputcsv($out, array_map($safe, $attrs), ',', '"', '');
            }
            fclose($out);
        }, $type.'-'.now()->format('Y-m-d').'.csv', ['Content-Type' => 'text/csv']);
    }
}
