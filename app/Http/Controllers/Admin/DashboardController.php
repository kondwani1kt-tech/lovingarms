<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Inquiry;
use App\Models\Shift;
use App\Models\StaffingRequest;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $live = fn ($q) => $q->where('status', '!=', 'cancelled');

        return view('admin.dashboard', [
            'counts' => [
                'inquiries' => Inquiry::where('status', 'new')->count(),
                'applications' => Application::where('status', 'new')->count(),
                'staffing' => StaffingRequest::where('status', 'new')->count(),
            ],
            'today' => $live(Shift::with(['client', 'caregiver']))->whereDate('starts_at', now()->toDateString())->orderBy('starts_at')->get(),
            'unassigned' => $live(Shift::with('client'))->whereNull('caregiver_id')->where('starts_at', '>=', now())->orderBy('starts_at')->limit(8)->get(),
            'recent' => [
                'inquiries' => Inquiry::latest()->limit(5)->get(),
                'applications' => Application::latest()->limit(5)->get(),
                'staffing' => StaffingRequest::latest()->limit(5)->get(),
            ],
        ]);
    }
}
