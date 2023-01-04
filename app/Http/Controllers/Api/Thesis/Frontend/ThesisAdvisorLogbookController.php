<?php

namespace App\Http\Controllers\Api\Thesis\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use Illuminate\Http\Client\Request;

class ThesisAdvisorLogbookController extends Controller
{
    public function index($thesis_id)
    {
        $thesis = Thesis::find($thesis_id);
        $logbooks = ThesisLogbook::where('thesis_id', $thesis_id)
            ->get();

        $thesis->put('logbooks', $logbooks);

        return response()->json($thesis);
    }

    public function show(ThesisLogbook $logbook)
    {
        return response()->json($logbook);
    }

    public function accept(Request $request, ThesisLogbook $logbook)
    {
        $logbook->status = ThesisLogbook::OK;
        if ($logbook->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah status logbook. Logbook diterima'
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal mengubah status logbook'
        ]);
    }

    public function reject(Request $request, ThesisLogbook $logbook)
    {
        $logbook->status = ThesisLogbook::NOT_OK;
        if ($logbook->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah status logbook. Logbook tidak diterima'
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal mengubah status logbook'
        ]);
    }
}
