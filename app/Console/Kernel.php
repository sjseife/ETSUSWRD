<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Flag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Commands\Inspire::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        $schedule->call(function() {
            //AutoArchive Events where endDate is in past
            DB::table('events')->whereDate('endDate', '<', Carbon::today()->toDateString())->update(['archived' => '1']);

            //AutoFlag Resources where updated_at is more than 6 months ago
            $resources = DB::table('resources')->whereDate('updated_at', '<', Carbon::today()->subMonths(6)->toDateString())->get();
            foreach($resources as $resource)
            {
                $flagData = ['level' => 'GA',
                    'comments' => 'Resource has not been updated in 6 months.',
                    'resolved' => '0',
                    'resource_id' => $resource->id,
                    'submitted_by' => '1'];
                $flag = new Flag($flagData);
                $flag->save();
            }

            //AutoDelete Items that have been archived for more than 12 months.
            DB::table('events')
                            ->whereDate('updated_at', '<', Carbon::today()->subYear()->toDateString())
                            ->where('archived', 1)
                            ->delete();
            DB::table('resources')
                            ->whereDate('updated_at', '<', Carbon::today()->subYear()->toDateString())
                            ->where('archived', 1)
                            ->delete();
        })->dailyAt('00:01');
    }
}
