<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use DB;
use App\User;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\SendNewCodeSMS::class,
        Commands\UpdatePushes::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $users = User::all();

            foreach ($users as $user) {
                DB::table('request_log')->insert([
                    'user_id' => $user->id,
                    'request_count' => 0,
                    'log_date' => Carbon::now()->startOfDay()
                ]);
            }
        })->daily();
    }
}
