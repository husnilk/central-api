<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoursePlan;
use \stdClass;
use Carbon\Carbon;

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
}
