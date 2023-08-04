<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminarReviewer;
use Illuminate\Support\Facades\Request;

class ThesisSeminarReviewerAssignmentController extends Controller
{
    public function store(Request $request, $seminar_id)
    {
        $reviewer = new ThesisSeminarReviewer();
        $reviewer->thesis_seminar_id = $seminar_id;
        $reviewer->reviewer_id = $request->user_id;
        $reviewer->status = ThesisSeminarReviewer::ACCEPTED;
        if($reviewer->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan dosen reviewer',
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal menambahkan dosen reviewer'
        ]);
    }
}
