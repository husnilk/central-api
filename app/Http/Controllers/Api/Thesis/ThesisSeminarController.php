<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThesisSeminarController extends Controller
{
    public function show($id)
    {
        $theses = Thesis::where('student_id', auth()->id())
            ->get()
            ->pluck('id')
            ->toArray();

        $seminar = ThesisSeminar::where('id', $id)
            ->whereIn('thesis_id', $theses)
            ->first();

        $peserta = ThesisSeminarAudience::where('seminar_id', $seminar->id)
            ->get();

        $seminar->put('peserta', $peserta);

        return response()->json($seminar);
    }

    public function store(Request $request)
    {
        $thesis = Thesis::where('student_id', auth()->id())
            ->where('id', request('thesis_id'))
            ->first();

        $seminar = new ThesisSeminar();
        $seminar->thesis_id = $thesis->id;
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
