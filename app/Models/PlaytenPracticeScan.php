<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaytenPracticeScan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'qr_text',
        'start_date',
        'end_date',
    ];
}
