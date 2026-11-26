<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AnalyticsController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'event' => ['required', 'string', 'regex:/^[a-z_]{1,40}$/'],
            'path' => ['required', 'string', 'max:255'],
        ]);

        Log::info('site_analytics', [
            'event' => $data['event'],
            'path' => $data['path'],
        ]);

        return response()->json(['ok' => true]);
    }
}
