<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\ThesisTrialExaminer;

class ThesisExaminerSubmissionController extends Controller
{
    //
    public function index()
    {
        $examiners = ThesisTrialExaminer::select('theses.title', 'students.name', 'students.nim', 'thesis_trials.trial_at', 'thesis_trials.method', 'thesis_trials.room_id')
            ->leftJoin('thesis_trials', 'thesis_trial_examiners.thesis_trial_id', '=', 'thesis_trials.id')
            ->leftJoin('theses', 'thesis_trials.thesis_id', '=', 'theses.id')
            ->leftJoin('students', 'theses.student_id', '=', 'students.id')
            ->where('thesis_trial_examiners.examiner_id', auth()->id())
//            ->where('thesis_trials.status', '=', 0)
            ->orderBy('thesis_trials.start_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $examiners->count(),
            'reviewers' => $examiners
        ]);
    }
}
