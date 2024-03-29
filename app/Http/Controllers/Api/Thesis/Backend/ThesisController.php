<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use App\Models\ThesisSeminar;
use App\Models\ThesisTrial;

class ThesisController extends Controller
{
    public function index()
    {
        $theses = Thesis::select('theses.title', 'theses.abstract', 'theses.start_at', 'theses.status', 'students.id as student_id', 'students.name as student_name', 'students.nim as student_nim')
            ->leftJoin('students', 'theses.student_id', '=', 'students.id')
//            ->onGoing()
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $theses->count(),
            'theses' => $theses
        ]);
    }

    public function show(Thesis $thesis)
    {
        $seminars = ThesisSeminar::with('audiences')->where('thesis_id', $thesis->id)->get();
        $trials = ThesisTrial::where('thesis_id', $thesis->id)->get();
        $logbooks = ThesisLogbook::where('thesis_id', $thesis->id)->get();

        $thesis->put('seminars', $seminars);
        $thesis->put('trials', $trials);
        $thesis->put('logbooks', $logbooks);

        return response()->json($thesis);
    }
}
