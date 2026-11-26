<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caregiver;
use App\Models\Client;
use Illuminate\Http\Request;

/** Simple add / edit / list screens for clients and caregivers, driven by the field map below. */
class ResourceController extends Controller
{
    private const RESOURCES = [
        'clients' => [
            'model' => Client::class, 'title' => 'Clients', 'singular' => 'client',
            'fields' => [
                'name' => ['Name', 'text', 'required|string|max:150'],
                'phone' => ['Phone', 'text', 'nullable|string|max:40'],
                'address' => ['Address', 'text', 'nullable|string|max:255'],
                'city' => ['City', 'text', 'nullable|string|max:100'],
                'county' => ['County', 'select', 'nullable|in:King,Pierce,Other', ['King' => 'King', 'Pierce' => 'Pierce', 'Other' => 'Other']],
                'care_notes' => ['Scheduling notes (keep to what is needed to schedule care)', 'textarea', 'nullable|string|max:3000'],
                'is_active' => ['Active', 'checkbox', ''],
            ],
            'cols' => ['name', 'phone', 'city', 'county', 'is_active'],
        ],
        'caregivers' => [
            'model' => Caregiver::class, 'title' => 'Caregivers', 'singular' => 'caregiver',
            'fields' => [
                'name' => ['Name', 'text', 'required|string|max:150'],
                'role' => ['Role', 'select', 'required|in:CNA,Caregiver,Other', ['CNA' => 'CNA', 'Caregiver' => 'Caregiver', 'Other' => 'Other']],
                'phone' => ['Phone', 'text', 'nullable|string|max:40'],
                'email' => ['Email', 'text', 'nullable|email|max:190'],
                'is_active' => ['Active (can be assigned to shifts)', 'checkbox', ''],
            ],
            'cols' => ['name', 'role', 'phone', 'email', 'is_active'],
        ],
    ];

    private function cfg(string $resource): array
    {
        return self::RESOURCES[$resource] ?? abort(404);
    }

    public function index(Request $r, string $resource)
    {
        $c = $this->cfg($resource);
        $q = $c['model']::query()->orderBy('name');

        if ($term = trim((string) $r->query('q'))) {
            $q->where('name', 'like', "%{$term}%");
        }

        return view('admin.resource.index', ['resource' => $resource, 'c' => $c, 'rows' => $q->paginate(25)->withQueryString()]);
    }

    public function create(string $resource)
    {
        return view('admin.resource.form', ['resource' => $resource, 'c' => $this->cfg($resource), 'item' => null]);
    }

    public function store(Request $r, string $resource)
    {
        $c = $this->cfg($resource);
        $item = $c['model']::create($this->data($r, $c));

        return redirect()->route('admin.resource.index', ['resource' => $resource])->with('success', ucfirst($c['singular']).' added.');
    }

    public function edit(string $resource, int $id)
    {
        $c = $this->cfg($resource);

        return view('admin.resource.form', ['resource' => $resource, 'c' => $c, 'item' => $c['model']::findOrFail($id)]);
    }

    public function update(Request $r, string $resource, int $id)
    {
        $c = $this->cfg($resource);
        $c['model']::findOrFail($id)->update($this->data($r, $c));

        return redirect()->route('admin.resource.index', ['resource' => $resource])->with('success', ucfirst($c['singular']).' updated.');
    }

    public function destroy(Request $r, string $resource, int $id)
    {
        abort_unless($r->user()->isAdmin(), 403);

        $c = $this->cfg($resource);
        $c['model']::findOrFail($id)->delete();

        return redirect()->route('admin.resource.index', ['resource' => $resource])->with('success', ucfirst($c['singular']).' deleted. Their past shifts are kept without a name.');
    }

    private function data(Request $r, array $c): array
    {
        $rules = [];
        foreach ($c['fields'] as $name => $f) {
            if ($f[1] !== 'checkbox') {
                $rules[$name] = $f[2];
            }
        }
        $data = $r->validate($rules);

        foreach ($c['fields'] as $name => $f) {
            if ($f[1] === 'checkbox') {
                $data[$name] = $r->boolean($name);
            }
        }

        return $data;
    }
}
