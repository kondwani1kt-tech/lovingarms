<?php

namespace App\Console\Commands;

use App\Mail\StaffNotification;
use App\Services\ReportBuilder;
use Illuminate\Console\Command;

class WeeklyReport extends Command
{
    protected $signature = 'report:weekly';

    protected $description = 'Email the last 7 days of activity to the staff inbox.';

    public function handle(): int
    {
        $summary = ReportBuilder::summary(now()->subDays(7)->startOfDay(), now()->endOfDay());

        StaffNotification::notify(
            'Loving Arms weekly summary',
            ReportBuilder::rows($summary),
            route('admin.dashboard'),
            'Here is your summary for the last 7 days.'
        );

        $this->info('Weekly report sent.');

        return self::SUCCESS;
    }
}
