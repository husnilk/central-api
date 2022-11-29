<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursePlan;
use \stdClass;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class ListCoursePlanController extends Controller
{
    public function index()
    {
        $coursePlans = CoursePlan::select('id', 'code', 'name', 'credit', 'semester', 'rev', 'created_at')->get();

        foreach($coursePlans as $coursePlan){
            $coursePlan->editable = false;
        }

        $data = new stdClass;
        $data->count = $coursePlans->count();
        $data->datetime = Carbon::now();
        $data->rps = $coursePlans;

        return response()->json($data);
    }

    public function search(Request $request)
    {
        $coursePlans = CoursePlan::select('id', 'code', 'name', 'credit', 'semester', 'rev', 'created_at')
        ->where('name', 'LIKE', "%{$request->keyword}%")
        ->get();

        foreach($coursePlans as $coursePlan){
            $coursePlan->editable = false;
        }

        $data = new stdClass;
        $data->count = $coursePlans->count();
        $data->datetime = Carbon::now();
        $data->rps = $coursePlans;

        return response()->json($data);
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

    public function export($rpsId)
    {
        $data = CoursePlan::find($rpsId);
        $coursePlans = CoursePlan::select('id', 'code', 'name', 'credit', 'semester', 'rev', 'created_at')
                                    ->where('id', $rpsId)->first();

        foreach($coursePlans as $coursePlan){
            $coursePlan->editable = false;
        }

        $data = new stdClass;
        $data->count = $coursePlans->count();
        $data->datetime = Carbon::now();
        $data->rps = $coursePlans;

        $pdf = Pdf::loadView('rps.pdf', $data);
        return $pdf->download('rps.pdf');
    }
}
