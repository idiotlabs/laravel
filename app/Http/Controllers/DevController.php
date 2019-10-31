<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DevController extends Controller
{
    public function session()
    {
        return response()->json(session()->all());
    }

    public function test_log() {
        Log::info('test log');
    }
}
