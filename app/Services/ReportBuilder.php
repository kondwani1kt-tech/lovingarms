<?php

namespace App\Services;

use App\Models\Application;
use App\Models\Inquiry;
use App\Models\Shift;
use App\Models\StaffingRequest;
use Carbon\CarbonInterface;

class ReportBuilder
{
    public static function summary(CarbonInterface $from, CarbonInterface $to): array
    {
        $counts = function (string $model) use ($from, $to): array {
            $by = $model::whereBetween('created_at', [$from, $to])
                ->selectRaw('status, count(*) as c')->groupBy('status')->pluck('c', 'status')->all();

            return ['total' => array_sum($by), 'by_status' => $by];
        };

        $shifts = Shift::whereBetween('starts_at', [$from, $to])->get();
        $hours = fn ($set) => round($set->sum(fn ($s) => $s->starts_at->diffInMinutes($s->ends_at)) / 60, 1);

        return [
            'from' => $from,
            'to' => $to,
            'inquiries' => $counts(Inquiry::class),
            'applications' => $counts(Application::class),
            'staffing' => $counts(StaffingRequest::class),
            'shifts' => [
                'total' => $shifts->count(),
                'by_status' => $shifts->groupBy('status')->map->count()->all(),
                'unassigned' => $shifts->whereNull('caregiver_id')->where('status', '!=', 'cancelled')->count(),
                'hours_completed' => $hours($shifts->where('status', 'completed')),
                'hours_booked' => $hours($shifts->whereIn('status', ['scheduled', 'confirmed'])),
            ],
        ];
    }

    /** Flat label => value rows for the email version of the report. */
    public static function rows(array $s): array
    {
        $statusText = function (array $by, array $labels): string {
            $parts = [];
            foreach ($by as $k => $n) {
                $parts[] = ($labels[$k] ?? $k).': '.$n;
            }

            return $parts ? implode(', ', $parts) : '-';
        };

        return [
            'Period' => $s['from']->format('M j, Y').' - '.$s['to']->format('M j, Y'),
            'New family & client inquiries' => $s['inquiries']['total'].'  ('.$statusText($s['inquiries']['by_status'], Inquiry::STATUSES).')',
            'Caregiver / CNA applications' => $s['applications']['total'].'  ('.$statusText($s['applications']['by_status'], Application::STATUSES).')',
            'Facility staffing requests' => $s['staffing']['total'].'  ('.$statusText($s['staffing']['by_status'], StaffingRequest::STATUSES).')',
            'Shifts in period' => $s['shifts']['total'].'  ('.$statusText($s['shifts']['by_status'], Shift::STATUSES).')',
            'Shifts without a caregiver' => $s['shifts']['unassigned'],
            'Hours completed' => $s['shifts']['hours_completed'],
            'Hours booked (scheduled / confirmed)' => $s['shifts']['hours_booked'],
        ];
    }
}
