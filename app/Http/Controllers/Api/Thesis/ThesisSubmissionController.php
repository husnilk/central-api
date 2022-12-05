<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use Illuminate\Http\Request;

class ThesisSubmissionController extends Controller
{
    public function index()
    {
        $student_id = auth()->id();

        $theses = Thesis::where('student_id', $student_id)->get();

        return response()->json([
            'status'=> 'success',
            'count'=> $theses->count(),
            'theses'=> $theses
        ]);

    }

    public function store(Request $request)
    {
        $thesis = new Thesis();
        $thesis->topic_id = request('topic_id');
        $thesis->student_id = auth()->id();
        $thesis->title = request('title');
        $thesis->created_by = auth()->id();
        if($thesis->save()){
            if(request('lecturer_id') != null){
                $supervisor = new ThesisSupervisor();
                $supervisor->thesis_id = $thesis->id;
                $supervisor->lecturer_id = request('lecturer_id');
                $supervisor->status = ThesisSupervisor::SUBMITTED;
                $supervisor->save();
            }
            return response()->json([
                'status'=> 'success',
                'message'=> 'Berhasil submit TA'
            ]);
        }else{
            return response()->json([
                'status'=> 'error',
                'message'=> 'Gagal submit TA'
            ]);
        }
    }

    public function show($id)
    {
        $thesis = Thesis::where('student_id', auth()->id())
            ->where('id', $id)
            ->first();

        return response()->json($thesis);
    }

}
