<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCrawlingYoutubeTrendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crawling_youtube_trends', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('labelWithoutTitle');
            $table->string('length');
            $table->string('owner');
            $table->string('publishedTime');
            $table->string('shortViewCount');
            $table->string('title');
            $table->string('videoId');
            $table->integer('count');
            $table->integer('rank');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crawling_youtube_trends');
    }
}
