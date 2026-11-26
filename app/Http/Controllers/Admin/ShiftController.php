<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Caregiver;
use App\Models\Client;
use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ShiftController extends Controller
{
    public function index(Request $r)
    {
        $from = $r->query('from') ?: now()->toDateString();
        $q = Shift::with(['client', 'caregiver'])->where('starts_at', '>=', Carbon::parse($from)->startOfDay())->orderBy('starts_at');

        if ($to = $r->query('to')) {
            $q->where('starts_at', '<=', Carbon::parse($to)->endOfDay());
        }
        if ($s = $r->query('status')) {
            $q->where('status', $s);
        }
        if ($r->boolean('unassigned')) {
            $q->whereNull('caregiver_id');
        }

        return view('admin.shifts.index', ['rows' => $q->paginate(25)->withQueryString(), 'from' => $from]);
    }

    public function calendar(Request $r)
    {
        try {
            $month = Carbon::createFromFormat('Y-m-d', ($r->query('month') ?: now()->format('Y-m')).'-01')->startOfMonth();
        } catch (\Throwable) {
            $month = now()->startOfMonth();
        }

        $start = $month->copy()->startOfWeek(Carbon::SUNDAY);
        $end = $month->copy()->endOfMonth()->endOfWeek(Carbon::SATURDAY);

        $shifts = Shift::with(['client', 'caregiver'])
            ->whereBetween('starts_at', [$start, $end])->orderBy('starts_at')->get()
            ->groupBy(fn ($s) => $s->starts_at->toDateString());

        $days = [];
        for ($d = $start->copy(); $d <= $end; $d->addDay()) {
            $days[] = $d->copy();
        }

        return view('admin.shifts.calendar', compact('month', 'days', 'shifts'));
    }

    public function create(Request $r)
    {
        $date = $r->query('date');
        $shift = new Shift([
            'starts_at' => $date ? Carbon::parse($date)->setTime(9, 0) : now()->addDay()->setTime(9, 0),
            'ends_at' => $date ? Carbon::parse($date)->setTime(17, 0) : now()->addDay()->setTime(17, 0),
            'status' => 'scheduled',
        ]);

        return view('admin.shifts.form', $this->formData($shift));
    }

    public function store(Request $r)
    {
        Shift::create($this->validated($r));

        return redirect()->route('admin.shifts.calendar')->with('success', 'Shift created.');
    }

    public function edit(Shift $shift)
    {
        return view('admin.shifts.form', $this->formData($shift));
    }

    public function update(Request $r, Shift $shift)
    {
        $shift->update($this->validated($r, $shift));

        return redirect()->route('admin.shifts.index')->with('success', 'Shift updated.');
    }

    public function destroy(Request $r, Shift $shift)
    {
        abort_unless($r->user()->isAdmin(), 403);
        $shift->delete();

        return redirect()->route('admin.shifts.index')->with('success', 'Shift deleted.');
    }

    private function formData(Shift $shift): array
    {
        return [
            'shift' => $shift,
            'clients' => Client::where('is_active', true)->orderBy('name')->pluck('name', 'id')->all(),
            'caregivers' => Caregiver::where('is_active', true)->orderBy('name')->get()->mapWithKeys(fn ($c) => [$c->id => $c->name.' ('.$c->role.')'])->all(),
        ];
    }

    private function validated(Request $r, ?Shift $shift = null): array
    {
        $d = $r->validate([
            'client_id' => 'nullable|exists:clients,id',
            'caregiver_id' => 'nullable|exists:caregivers,id',
            'location' => 'nullable|string|max:255',
            'starts_at' => 'required|date',
            'ends_at' => 'required|date|after:starts_at',
            'status' => ['required', Rule::in(array_keys(Shift::STATUSES))],
            'notes' => 'nullable|string|max:2000',
        ]);

        if (! empty($d['caregiver_id']) && $d['status'] !== 'cancelled'
            && ($clash = Shift::conflictFor((int) $d['caregiver_id'], Carbon::parse($d['starts_at']), Carbon::parse($d['ends_at']), $shift?->id))) {
            throw ValidationException::withMessages([
                'caregiver_id' => 'This caregiver already has a shift from '.$clash->starts_at->format('M j, g:i A').' to '.$clash->ends_at->format('g:i A').'.',
            ]);
        }

        return $d;
    }
}
