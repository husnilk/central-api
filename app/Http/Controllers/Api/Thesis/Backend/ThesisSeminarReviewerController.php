<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminarReviewer;
use Illuminate\Http\Request;

class ThesisSeminarReviewerController extends Controller
{
    public function store(Request $request, $seminar_id)
    {
        $reviewer = new ThesisSeminarReviewer();
        $reviewer->thesis_seminar_id = $seminar_id;
        $reviewer->reviewer_id = $request->lecturer_id;
        $reviewer->status = 0;
        $reviewer->position = ThesisSeminarReviewer::POS_REVIEWER;

        if($reviewer->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan data penguji',
                'reviewer' => $reviewer
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal menambahkan data penguji'
        ]);
    }
}
