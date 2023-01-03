<?php

namespace App\Http\Controllers\Api\Curriculum;

use App\Http\Controllers\Controller;
use App\Models\CoursePlan;
use App\Models\CoursePlanReference;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class RefController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rpsId)
    {
        $data = CoursePlan::select('course_plan_references.id', 'course_plan_detail_refs.category', 'course_plan_references.title as name')
                                ->join('course_plan_references', 'course_plans.id', 'course_plan_references.course_plan_id')
                                ->join('course_plan_detail_refs', 'course_plan_references.id', 'course_plan_detail_refs.course_plan_reference_id')
                                ->where('course_plans.id', $rpsId)
                                ->get();

        $response = new stdClass;
        $response->count = $data->count();
        $response->datetime = Carbon::now();
        $response->refs = $data;

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
            'title' => ['required'],
            'author' => ['required'],
            'publisher' => ['required'],
            'year' => ['required'],
            'description' => ['required'],
        ]);

        $data = new CoursePlanReference;
        $data->course_plan_id = $rpsId;
        $data->title = $request->title;
        $data->author = $request->author;
        $data->publisher = $request->publisher;
        $data->year = $request->year;
        $data->description = $request->description;
        $data->save();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Referensi berhasil ditambahkan';
        $response->id = $data->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rpsId, $refId)
    {
        $request->validate([
            'title' => ['required'],
            'author' => ['required'],
            'publisher' => ['required'],
            'year' => ['required'],
            'description' => ['required'],
        ]);

        $data = CoursePlanReference::find($refId);
        $data->course_plan_id = $rpsId;
        $data->title = $request->title;
        $data->author = $request->author;
        $data->publisher = $request->publisher;
        $data->year = $request->year;
        $data->description = $request->description;
        $data->save();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Sukses edit data';
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
    public function destroy($rpsId, $refId)
    {
        $data = CoursePlanReference::find($refId);
        $data->delete();

        $response = new stdClass;
        $response->status = '200';
        $response->message = 'Sukses hapus data';
        $response->id = $data->id;
        $response->datetime = Carbon::now();

        return response()->json($response);
    }
}
