<?php

namespace App\Console;

use App\Console\Commands\CrawlingYoutubeTrend;
use App\Jobs\WarmMessagePush;
use App\Jobs\WarmMessageSpread;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

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
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // WM Message spread
//        $schedule->job(new WarmMessageSpread())->hourly()->between('8:00', '22:00');

        // Crawling Naver Realtime Keyword

        // Crawling Youtube trend
        $schedule->job(new CrawlingYoutubeTrend())->everyThreeHours();

        // check sk2 api
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
