<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Event;
use App\Resource;
use App\Flag;
use Carbon\Carbon;
use DB;

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
            $events = DB::table('events')->whereDate('endDate', '<', Carbon::today()->toDateString())->get();
            foreach($events as $event)
            {
                $flagData = ['level' => 'GA',
                    'comments' => 'Event end date in past.',
                    'resolved' => '0',
                    'event_id' => $event->id,
                    'submitted_by' => '1'];
                $flag = new Flag($flagData);
                $flag->save();
            }
        })->dailyAt('00:01');
    }
}
