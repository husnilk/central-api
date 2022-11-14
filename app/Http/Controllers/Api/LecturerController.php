<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursePlan;
use App\Models\CoursePlanLecturer;
use \stdClass;
use Carbon\Carbon;


class LecturerController extends Controller
{
    public function index($rpsId)
    {
        $data = CoursePlan::select('lecturers.id', 'lecturers.name', 'lecturers.reg_id as regno')
                        ->join('course_plan_lecturers', 'course_plans.id', 'course_plan_lecturers.course_plan_id')
                        ->join('lecturers', 'lecturers.id', 'course_plan_lecturers.lecturer_id')
                        ->where('course_plans.id', $rpsId)
                        ->get();

        return response()->json($data);
    }

    public function store(Request $request, $rpsId)
    {
        $request->validate([
            'lecturer_id' => ['required'],
        ]);
        
        $lecturer = new CoursePlanLecturer;
        $lecturer->course_plan_id = $rpsId;
        $lecturer->lecturer_id = $request->lecturer_id;
        $lecturer->creator = $request->creator;
        $lecturer->save();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Dosen berhasil ditambahkan';
        $response->id = $lecturer->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }

    public function destroy($rpsId, $lecturerId)
    {
        $lecturer = CoursePlanLecturer::where('course_plan_id', $rpsId)
                                        ->where('lecturer_id', $lecturerId)
                                        ->first();
        $lecturer->delete();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Dosen berhasil dihapus';
        $response->id = $lecturer->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }
}
