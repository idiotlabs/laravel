<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CelebsPush extends Model
{
    protected $fillable = ['send_date', 'send_number', 'send_message'];
}
