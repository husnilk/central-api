<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\ThesisTrial;

class ThesisTrialSubmissionController extends Controller
{
    //
    public function index()
    {
        $trials = ThesisTrial::with('thesis.student')->whereIn('status', [
            ThesisTrial::STATUS_SUBMITTED,
            ThesisTrial::STATUS_SCHEDULED
            ])->get();

        return response()->json([
            'status' => 'success',
            'count' => $trials->count(),
            'seminars' => $trials
        ]);
    }
}
