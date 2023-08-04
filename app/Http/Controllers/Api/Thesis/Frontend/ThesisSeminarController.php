<?php

namespace App\Http\Controllers\Api\Thesis\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThesisSeminarController extends Controller
{
    public function index($thesis_id)
    {

        $seminar = ThesisSeminar::with('reviewers')
            ->where('thesis_id', $thesis_id)
            ->first();

        if($seminar != null)
        {
            $peserta = ThesisSeminarAudience::where('thesis_seminar_id', $seminar->id)
                ->get();
            $seminar->peserta = $peserta;
            return response()->json($seminar);
        }
        $seminar = new ThesisSeminar();
        $seminar->thesis_id = $thesis_id;
        return response()->json($seminar);
    }

    public function store(Request $request, $thesis_id)
    {
//        $thesis = Thesis::where('student_id', auth()->id())
//            ->where('id', request('thesis_id'))
//            ->first();

        $seminar = new ThesisSeminar();
        $seminar->thesis_id = $thesis_id;
        $seminar->registered_at = Carbon::now();
        $seminar->status = ThesisSeminar::STATUS_SUBMITTED;
        if ($seminar->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengajukan permintaan seminar hasil',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengajukan permintaan seminar hasil',
            ]);
        }
    }
}
