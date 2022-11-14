<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursePlan;
use App\Models\CoursePlanAssessments;
use \stdClass;
use Carbon\Carbon;

class CoursePlanAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rpsId)
    {
        $data = CoursePlan::select('course_plan_assessments.id', 'course_plan_assessments.name', 'course_plan_assessments.percentage')
                                ->join('course_plan_assessments', 'course_plans.id', 'course_plan_assessments.course_plan_id')
                                ->where('course_plans.id', $rpsId)
                                ->get();

        $response = new stdClass;
        $response->count = $data->count();
        $response->datetime = Carbon::now();
        $response->assessments = $data;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $rpsId)
    {
        $request->validate([
            'name' => ['required'],
            'percentage' => ['required'],
        ]);

        $data = new CoursePlanAssessments;
        $data->course_plan_id = $rpsId;
        $data->name = $request->name;
        $data->percentage = $request->percentage;
        $data->save();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Sukses input data';
        $response->id = $data->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rpsId, $assessmentId)
    {
        $request->validate([
            'name' => ['required'],
            'percentage' => ['required'],
        ]);

        $data = CoursePlanAssessments::find($assessmentId);
        $data->course_plan_id = $rpsId;
        $data->name = $request->name;
        $data->percentage = $request->percentage;
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
