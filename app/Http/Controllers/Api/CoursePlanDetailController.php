<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursePlanDetail;
use App\Models\CoursePlanAssessment;
use App\Models\CoursePlanReference;
use App\Models\CoursePlanDetailOutcome;
use App\Models\CoursePlanDetailAssessment;
use App\Models\CoursePlanDetailRef;
use \stdClass;
use Carbon\Carbon;
use DB;

class CoursePlanDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rpsId)
    {
        $data = CoursePlanDetail::select('id', 'week as week_no', 'material', 'method', 'student_experience as student_exp')
                                ->where('course_plan_id', $rpsId)
                                ->get();

        foreach($data as $include){
            $include->los = $include->los($include->id);
            $include->assessments = $include->assessments($include->id);
            $include->refs = $include->refs($include->id);
        }

        $response = new stdClass;
        $response->count = $data->count();
        $response->datetime = Carbon::now();
        $response->weekly = $data;

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
        $coursePlanDetail = new CoursePlanDetail;
        $coursePlanDetail->course_plan_id = $rpsId;
        $coursePlanDetail->week = $request->week_no;
        $coursePlanDetail->material = $request->material;
        $coursePlanDetail->method = $request->method;
        $coursePlanDetail->student_experience = $request->student_exp;
        $coursePlanDetail->save();

        foreach($request->los as $lo){
            $coursePlanDetailOutcome = new CoursePlanDetailOutcome;
            $coursePlanDetailOutcome->course_plan_detail_id = $coursePlanDetail->id;
            $coursePlanDetailOutcome->course_lo_id = $lo['id'];
            $coursePlanDetailOutcome->save();
        }

        foreach($request->assessments as $assessment){
            $coursePlanDetailAssessment = new CoursePlanDetailAssessment;
            $coursePlanDetailAssessment->course_plan_detail_id = $coursePlanDetail->id;
            $coursePlanDetailAssessment->course_plan_assessment_id = $assessment['id'];
            $coursePlanDetailAssessment->percentage = $assessment['percentage'];
            $coursePlanDetailAssessment->save();
        }

        foreach($request->refs as $ref){
            $coursePlanDetailRef = new coursePlanDetailRef;
            $coursePlanDetailRef->course_plan_detail_id = $coursePlanDetail->id;
            $coursePlanDetailRef->course_plan_reference_id = $ref['id'];
            $coursePlanDetailRef->category = $ref['category'];
            $coursePlanDetailRef->save();
        }

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Sukses entri data';
        $response->id = $coursePlanDetail->id;
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
    public function update(Request $request, $rpsId, $sessionId)
    {
        $coursePlanDetail = CoursePlanDetail::find($sessionId);
        $coursePlanDetail->course_plan_id = $rpsId;
        $coursePlanDetail->week = $request->week_no;
        $coursePlanDetail->material = $request->material;
        $coursePlanDetail->method = $request->method;
        $coursePlanDetail->student_experience = $request->student_exp;
        $coursePlanDetail->save();

        $coursePlanDetailOutcomes = CoursePlanDetailOutcome::where('course_plan_detail_id', $coursePlanDetail->id)
                                                            ->get();

        foreach($coursePlanDetailOutcomes as $coursePlanDetailOutcome){
            $coursePlanDetailOutcome->delete();
        }

        $coursePlanDetailAssessments = CoursePlanDetailAssessment::where('course_plan_detail_id', $coursePlanDetail->id)
                                                            ->get();

        foreach($coursePlanDetailAssessments as $coursePlanDetailAssessment){
            $coursePlanDetailAssessment->delete();
        }

        $coursePlanDetailRefs = CoursePlanDetailRef::where('course_plan_detail_id', $coursePlanDetail->id)
                                                            ->get();

        foreach($coursePlanDetailRefs as $coursePlanDetailRef){
            $coursePlanDetailRef->delete();
        }

        foreach($request->los as $lo){
            $coursePlanDetailOutcome = new CoursePlanDetailOutcome;
            $coursePlanDetailOutcome->course_plan_detail_id = $coursePlanDetail->id;
            $coursePlanDetailOutcome->course_lo_id = $lo['id'];
            $coursePlanDetailOutcome->save();
        }

        foreach($request->assessments as $assessment){
            $coursePlanDetailAssessment = new CoursePlanDetailAssessment;
            $coursePlanDetailAssessment->course_plan_detail_id = $coursePlanDetail->id;
            $coursePlanDetailAssessment->course_plan_assessment_id = $assessment['id'];
            $coursePlanDetailAssessment->percentage = $assessment['percentage'];
            $coursePlanDetailAssessment->save();
        }

        foreach($request->refs as $ref){
            $coursePlanDetailRef = new CoursePlanDetailRef;
            $coursePlanDetailRef->course_plan_detail_id = $coursePlanDetail->id;
            $coursePlanDetailRef->course_plan_reference_id = $ref['id'];
            $coursePlanDetailRef->category = $ref['category'];
            $coursePlanDetailRef->save();
        }

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Sukses update data';
        $response->id = $coursePlanDetail->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rpsId, $sessionId)
    {
        $data = CoursePlanDetail::find($sessionId);
        $data->delete();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Sukses hapus data';
        $response->id = $data->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }
}
