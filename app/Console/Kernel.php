<?php

namespace App\Console;

use App\Http\Controllers\Pages\WBAnalyticsController;
use App\Http\Controllers\Pages\WBUndersortController;
use App\Site\WBParser\WBBaseParser;
use App\Site\WBParser\WBImport;
use App\Site\WBParser\WBRivalParser;
use Cache;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Log;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
//        $schedule->command('queue:work')->everyMinute();

        try {
            $schedule->call(function () {

                $job = Cache::get('undersort_xml_job', false);

                if ($job) {

                    Cache::forget('undersort_xml_job');

                    (new WBUndersortController())->dispatch_job($job);

                }

            })->everyMinute();

        } catch (\Exception $ex) {

            Log::channel('cron')->alert('Ошибка планировщика undersort_xml - ' . $ex->getMessage());
        }

        try {
            $schedule->call(function () {

                $job = Cache::get('undersort_main_job', false);

                if ($job) {

                    Cache::forget('undersort_main_job');

                    (new WBUndersortController())->dispatch_job($job);

                }

            })->everyMinute();

        } catch (\Exception $ex) {

            Log::channel('cron')->alert('Ошибка планировщика undersort_main - ' . $ex->getMessage());
        }

        try {
            $schedule->call(function () {
                Log::channel('cron')->alert('Старт планировщика Laravel(WB)');
                (new WBImport())->import();
            })->dailyAt('18:00')
                ->when(function () {
                    return true;
                })->withoutOverlapping();

        } catch (\Exception $ex) {
            Log::channel('cron')->alert('Ошибка планировщика Laravel(WB) - ' . $ex->getMessage());
        }

        try {
            $schedule->call(function () {
                Log::channel('cron')->alert('Старт планировщика Laravel(WB - PARSER)');
                new WBBaseParser();
            })->dailyAt('20:00')
                ->when(function () {
                    return true;
                })->withoutOverlapping();

        } catch (\Exception $ex) {
            Log::channel('cron')->alert('Ошибка планировщика Laravel(WB - PARSER) - ' . $ex->getMessage());
        }

        try {
            $schedule->call(function () {
                Log::channel('cron')->alert('Старт планировщика Laravel(WBRivalParser - PARSER)');
                new WBRivalParser();
            })->dailyAt('22:00')
                ->when(function () {
                    return true;
                })->withoutOverlapping();

        } catch (\Exception $ex) {
            Log::channel('cron')->alert('Ошибка планировщика Laravel(WBRivalParser - PARSER) - ' . $ex->getMessage());
        }
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
