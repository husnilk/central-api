<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseLo;
use \stdClass;
use Carbon\Carbon;

class CourseLoController extends Controller
{
    public function getData($rpsId)
    {
        $courselos = CourseLo::select('id', 'code', 'name as lo_name')->get();

        $data = new stdClass;
        $data->count = $courselos->count();
        $data->datetime = Carbon::now();
        $data->cpmk = $courselos;

        return response()->json($data);
    }

    public function store(Request $request,$rpsId)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        foreach($request->clo_ids as $clo_ids){
            $courselo = new CourseLo;
            $courselo->name = $request->name;
            $courselo->code = $request->code;
            $courselo->parent_id = $request->clo_ids;
            $courselo->course_plan_id = $rpsId;
            $courselo->save();
        }

        $data = new stdClass;
        $data->status = '200';
        $data->message = 'Success';
        $data->id = $courselo->id;
        $data->datetime = Carbon::now();

        return response()->json($data);
    }
}
