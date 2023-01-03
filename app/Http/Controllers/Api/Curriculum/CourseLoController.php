<?php

namespace App\Http\Controllers\Api\Curriculum;

use App\Http\Controllers\Controller;
use App\Models\CourseLo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

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

        $courselo = new CourseLo;
        $courselo->name = $request->name;
        $courselo->code = $request->code;
        $courselo->parent_id = $request->parent_id;
        $courselo->type = $request->type;
        $courselo->course_plan_id = $rpsId;
        $courselo->save();

        $data = new stdClass;
        $data->status = '200';
        $data->message = 'Success';
        $data->id = $courselo->id;
        $data->datetime = Carbon::now();

        return response()->json($data);
    }

    public function update(Request $request,$rpsId, $cpmkId)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'code' => ['required', 'string'],
        ]);

        $courselo = CourseLo::find($cpmkId);
        $courselo->name = $request->name;
        $courselo->code = $request->code;
        $courselo->parent_id = $request->parent_id;
        $courselo->type = $request->type;
        $courselo->course_plan_id = $rpsId;
        $courselo->save();

        $data = new stdClass;
        $data->status = '200';
        $data->message = 'Success';
        $data->id = $courselo->id;
        $data->datetime = Carbon::now();

        return response()->json($data);
    }

    public function destroy($rpsId, $cpmkId)
    {
        $courselo = CourseLo::find($cpmkId);
        $courselo->delete();

        $data = new stdClass;
        $data->status = '200';
        $data->message = 'Success';
        $data->id = $courselo->id;
        $data->datetime = Carbon::now();

        return response()->json($data);
    }
}
