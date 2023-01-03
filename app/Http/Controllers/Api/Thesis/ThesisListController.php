<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminar;
use App\Models\ThesisTrial;
use Illuminate\Support\Facades\DB;

class ThesisListController extends Controller
{
    public function seminars()
    {
        $seminars = ThesisSeminar::select('theses.id', 'theses.title', 'theses.start_at', 'students.id as student_id', 'students.name', 'students.nim', 'thesis_seminars.seminar_at', 'thesis_seminars.room_id')
            ->leftJoin('theses','thesis_seminars.thesis_id','=','theses.id')
            ->leftJoin('students','theses.student_id','=','students.id')
            ->where('theses.status','>',0)
            ->where('theses.status','<',35)
            ->where('thesis_seminars.seminar_at','=',DB::raw('date(now())'))
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $seminars->count();
        $res->seminars = $seminars;

        return response()->json($res);
    }

    public function trials()
    {
        $trials = ThesisTrial::select('theses.id', 'theses.title', 'theses.start_at', 'students.id as student_id', 'students.name', 'students.nim', 'thesis_trials.trial_at', 'thesis_trials.room_id')
            ->leftJoin('theses','thesis_trials.thesis_id','=','theses.id')
            ->leftJoin('students','theses.student_id','=','students.id')
            ->where('theses.status','>',0)
            ->where('theses.status','<',35)
            ->where('thesis_trials.trial_at',DB::raw('date(now())'))
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $trials->count();
        $res->seminars = $trials;

        return response()->json($res);
    }
}
