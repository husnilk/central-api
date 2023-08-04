<?php

namespace App\Http\Controllers\Api\Thesis\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ThesisTrial;
use Illuminate\Support\Facades\Request;

class ThesisTrialSubmissionController extends Controller
{
    public function update(Request $request, ThesisTrial $trial_submission)
    {
        $trial = $trial_submission;
        $trial->status = ThesisTrial::STATUS_ACCEPTED;

        if ($trial->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Anda telah menerima permintaan menguji sidang TA'
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal menyetujui permintaan menguji.'
        ]);
    }

    public function destroy(Request $request, ThesisTrial $trial_submission)
    {
        $trial = $trial_submission;
        $trial->status = ThesisTrial::STATUS_REJECTED;

        if ($trial->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Anda telah menolak permintaan menguji sidang TA'
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal menolak permintaan menguji.'
        ]);
    }
}
