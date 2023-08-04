<?php

namespace App\Http\Controllers\Api\Thesis\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminar;
use App\Models\ThesisTrial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThesisTrialController extends Controller
{
    public function index($thesis_id)
    {

        $trial = ThesisTrial::with('examiners')
            ->where('thesis_id', $thesis_id)
            ->first();

        if ($trial != null) {
            return response()->json($trial);
        }
        $trial = new ThesisTrial();
        $trial->thesis_id = $thesis_id;
        return response()->json($trial);
    }

    public function store(Request $request, $thesis_id)
    {
        $trial = new ThesisTrial();
        $trial->thesis_id = $thesis_id;
        $trial->thesis_rubric_id = 1;
        $trial->registered_at = Carbon::now();
        $trial->status = ThesisSeminar::STATUS_SUBMITTED;
        if ($trial->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengajukan permintaan sidang',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengajukan permintaan sidang',
            ]);
        }
    }
}
