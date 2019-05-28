<?php

namespace App\Http\Controllers\WarmMessage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function admin()
    {
        return view('warmmessage.dashboard');
    }

    public function privacy()
    {
        return view('warmmessage.privacy');
    }
}
