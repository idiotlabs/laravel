<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrawlingYoutubeTrend extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'labelWithoutTitle',
        'length',
        'owner',
        'publishedTime',
        'shortViewCount',
        'title',
        'videoId',
        'count',
        'rank',
    ];
}
