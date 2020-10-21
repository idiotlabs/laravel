<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CrawlingYoutubeTrend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawling:youtube';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawling Youtube Trend';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = config('url.crawling.youtube_trend', null);

        if (is_null($url)) {
            return false;
        }

        // crwaling using curl
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = json_decode($response, true);

        // record
        $count = \App\Models\CrawlingYoutubeTrend::max('count') + 1 ?? 1;
        $rank =  0;

        foreach ($response as $item) {
            $item['count'] = $count;
            $item['rank'] = ++$rank;

            \App\Models\CrawlingYoutubeTrend::create($item);
        }

        return 0;
    }
}
