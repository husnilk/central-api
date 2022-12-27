<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarReviewer;

class ThesisReviewerSubmissionController extends Controller
{
    public function update(Request $request, $seminar_id)
    {
        $reviewer = ThesisSeminarReviewer::where('seminar_id', $seminar_id)
            ->where('reviewer_id', auth()->id())
            ->first();
        $reviewer->status = ThesisSeminarReviewer::ACCEPTED;
        $reviewer->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menerima permintaan mereview TA mahasiswa'
        ]);
    }

    public function destroy(Request $request, $seminar_id)
    {

        $reviewer = ThesisSeminarReviewer::where('seminar_id', $seminar_id)
            ->where('reviewer_id', auth()->id())
            ->first();
        $reviewer->status = ThesisSeminarReviewer::REJECTED;
        $reviewer->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menolak permintaan mereview TA mahasiswa'
        ]);
    }
}
