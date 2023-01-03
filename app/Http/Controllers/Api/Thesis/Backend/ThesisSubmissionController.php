<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\Thesis;

class ThesisSubmissionController extends Controller
{
    public function index()
    {
        $theses = Thesis::with('student')->where('status', Thesis::PENGAJUAN_PEMBIMBING)
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $theses->count(),
            'thesis' => $theses
        ]);
    }
}
