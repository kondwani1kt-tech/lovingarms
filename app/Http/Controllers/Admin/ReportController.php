<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\StaffNotification;
use App\Services\ReportBuilder;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private function range(Request $r): array
    {
        $from = $r->query('from') ?: $r->input('from');
        $to = $r->query('to') ?: $r->input('to');

        try {
            return [
                $from ? Carbon::parse($from)->startOfDay() : now()->subDays(29)->startOfDay(),
                $to ? Carbon::parse($to)->endOfDay() : now()->endOfDay(),
            ];
        } catch (\Throwable) {
            return [now()->subDays(29)->startOfDay(), now()->endOfDay()];
        }
    }

    public function index(Request $r)
    {
        [$from, $to] = $this->range($r);

        return view('admin.reports.index', ['s' => ReportBuilder::summary($from, $to), 'from' => $from, 'to' => $to]);
    }

    public function email(Request $r)
    {
        [$from, $to] = $this->range($r);

        StaffNotification::notify('Loving Arms activity report', ReportBuilder::rows(ReportBuilder::summary($from, $to)), route('admin.dashboard'));

        return back()->with('success', 'Report emailed to '.config('loving.notify_to').'.');
    }
}
