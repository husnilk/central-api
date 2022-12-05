<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;
use App\Models\ThesisTrial;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThesisTrialController extends Controller
{
    public function show($id)
    {
        $theses = Thesis::where('student_id', auth()->id())
            ->get()
            ->pluck('id')
            ->toArray();

        $trial = ThesisTrial::where('id', $id)
            ->whereIn('thesis_id', $theses)
            ->first();

        return response()->json($trial);
    }

    public function store(Request $request)
    {
        $thesis = Thesis::where('student_id', auth()->id())
            ->where('id', request('thesis_id'))
            ->first();

        $trial = new ThesisTrial();
        $trial->thesis_id = $thesis->id;
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
