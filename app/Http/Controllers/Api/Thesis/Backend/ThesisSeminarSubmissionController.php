<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminar;

class ThesisSeminarSubmissionController extends Controller
{
    public function index()
    {
        $seminars = ThesisSeminar::with('thesis')->whereIn('status', [
            ThesisSeminar::STATUS_SUBMITTED,
            ThesisSeminar::STATUS_SCHEDULED
            ])->get();

        return response()->json([
            'status' => 'success',
            'count' => $seminars->count(),
            'seminars' => $seminars
        ]);
    }
}
