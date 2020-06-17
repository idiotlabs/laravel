<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dice2Controller extends Controller
{
    public function agreement()
    {
        return view('dice2.agreement');
    }

    public function privacy()
    {
        return view('dice2.agreement');
    }
}
