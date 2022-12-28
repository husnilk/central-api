<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\ThesisTrialExaminer;
use Illuminate\Support\Facades\Request;

class ThesisTrialExaminerAssignmentController extends Controller
{
    //
public function store(Request $request, $trial_id)
    {
        $examiner = new ThesisTrialExaminer();
        $examiner->thesis_trial_id = $trial_id;
        $examiner->examiner_id = $request->user_id;
        $examiner->status = ThesisTrialExaminer::ACCEPTED;
        if($examiner->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan dosen menguji',
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal menambahkan dosen menguji'
        ]);
    }
}
