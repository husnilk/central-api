<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursePlan;
use App\Models\CoursePlanLecturer;
use Illuminate\Support\Facades\Auth;
use \stdClass;
use Carbon\Carbon;
use DB;

class CoursePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CoursePlan::select('course_plans.id', 'course_plans.code', 'course_plans.name', 'course_plans.credit', 'course_plans.semester', 'course_plans.rev', 'course_plans.created_at')
                                ->join('course_plan_lecturers', 'course_plans.id', 'course_plan_lecturers.lecturer_id')
                                ->where('course_plan_lecturers.lecturer_id', Auth::user()->id)
                                ->get();

        foreach($data as $include){
            $include->editable = false;
        }

        $response = new stdClass;
        $response->count = $data->count();
        $response->datetime = Carbon::now();
        $response->rps = $data;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => ['required'],
        ]);

        $data = new CoursePlanLecturer;
        $data->course_plan_id = $request->course_id;
        $data->lecturer_id = Auth::user()->id;
        $data->creator = Auth::user()->id;
        $data->save();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Rps berhasil dibuat';
        $response->id = $data->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }

    public function show($rpsId)
    {
        $data = CoursePlan::select('id', 'course_id', 'code as course_code', 'name as course_name', 'credit as course_credit', 'description as course_desc', 'rev as course_rev', 'semester as course_semester', 'material as course_material', 'created_at as course_created_at', 'created_by', 'validated_by', 'validated_at')
                        ->where('id' ,$rpsId)
                        ->first();
        
        $data->course_creator = $data->creator();
        $data->course_validator = $data->validator();
        $data->curriculum_lo = $data->curriculumLo();
        $data->course_lo = $data->courseLo();
        $data->course_references = $data->courseReference();
        $data->course_plans = $data->thisCoursePlanDetail();

        foreach($data->course_plans as $course_plan){
            $course_plan->references = $course_plan->detailReference($course_plan->id);
            $course_plan->assessments = $course_plan->detailAssessment($course_plan->id);
        }
        unset($data->created_by);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rpsId)
    {
        $data = CoursePlan::find($assessmentId);
        $data->rev = $request->rev;
        $data->code = $request->code;
        $data->name = $request->name;
        $data->alias_name = $request->alias_name;
        $data->credit = $request->credit;
        $data->semester = $request->semester;
        $data->description = $request->description;
        $data->material = $request->material;
        $data->save();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Sukses update data';
        $response->id = $data->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rpsId, $assessmentId)
    {
        $data = CoursePlanAssessments::find($assessmentId);
        $data->delete();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Sukses hapus data';
        $response->id = $data->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }
}
