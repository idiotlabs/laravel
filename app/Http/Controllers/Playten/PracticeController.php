<?php

namespace App\Http\Controllers\Playten;

use App\Http\Controllers\Controller;
use App\Models\PlaytenPracticeScan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function list(Request $request) {
        try {
            $id = $request->input('id');

            $list = PlaytenPracticeScan::where('user_id', $id)
                ->whereNotNull('end_date')
                ->orderByDesc('id')
                ->paginate();

            return response()->json(['code' => 1, 'data' => $list]);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'msg' => $e->getMessage()]);
        }
    }

    public function scan(Request $request) {
        try {
            if ($request->missing('id')) {
                throw new \Exception('no have id');
            }

            $id = $request->input('id');
            $qr = $request->input('qr');
            $now_date = Carbon::now();

            PlaytenPracticeScan::create([
                'user_id' => $id,
                'qr_text' => $qr,
                'start_date' => $now_date,
            ]);

            return response()->json(['code' => 1]);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'msg' => $e->getMessage()]);
        }
    }

    public function scan_finish(Request $request) {
        try {
            if ($request->missing('scan_id')) {
                throw new \Exception('no have scan_id');
            }

            $scan_id = $request->input('scan_id');
            $now_date = Carbon::now();

            PlaytenPracticeScan::where('id', $scan_id)
                ->update(['end_date' => $now_date]);

            return response()->json(['code' => 1]);
        } catch (\Exception $e) {
            return response()->json(['code' => $e->getCode(), 'msg' => $e->getMessage()]);
        }
    }
}
