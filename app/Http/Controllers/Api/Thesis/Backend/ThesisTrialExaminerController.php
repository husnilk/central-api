<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\ThesisTrialExaminer;
use Illuminate\Http\Request;

class ThesisTrialExaminerController extends Controller
{
    //
    public function store(Request $request, $trial_id)
    {
        $reviewer = new ThesisTrialExaminer();
        $reviewer->thesis_trial_id = $trial_id;
        $reviewer->examiner_id = $request->lecturer_id;
        $reviewer->status = 0;
        $reviewer->position = $request->position;

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
