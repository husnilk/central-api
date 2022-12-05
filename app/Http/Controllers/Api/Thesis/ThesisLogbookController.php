<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use Illuminate\Http\Request;

class ThesisLogbookController extends Controller
{
    public function index($thesis_id){
        $student_id = auth()->id();
        $logbooks = ThesisLogbook::where('student_id', $student_id)
            ->where('thesis_id', $thesis_id)
            ->get();

        return response()->json([
            'status'=> 'success',
            'count'=> $logbooks->count(),
            'logbooks'=> $logbooks
        ]);
    }

    public function store(Request $request){
        $logbook = new ThesisLogbook();
        $logbook->thesis_id = request('thesis_id');
        $logbook->supervisor_id = request('supervisor_id');
        $logbook->date = request('date');
        $logbook->status = ThesisLogbook::SUBMITTED;
        $logbook->progress = request('progress');
        $logbook->problem = request('problem');
        if($logbook->save()){
            return response()->json([
                'status'=>'success',
                'message'=> 'Berhasil menambahkan logbook',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message'=> 'Gagal menambahkan logbook',
            ]);
        }
    }

    public function show($id){
        $theses = Thesis::where('student_id', auth()->id())
            ->get();
        $logbook = ThesisLogbook::where('id', $id)
            ->whereIn('thesis_id', $theses->toArray())
            ->get();

        return response()->json($logbook);
    }

    public function update($id){
        $theses = Thesis::where('student_id', auth()->id())
            ->get();
        $logbook = ThesisLogbook::where('id', $id)
            ->whereIn('thesis_id', $theses->toArray())
            ->get();

        $logbook->thesis_id = request('thesis_id');
        $logbook->supervisor_id = request('supervisor_id');
        $logbook->date = request('date');
        $logbook->progress = request('progress');
        $logbook->problem = request('problem');

        if($logbook->save()){
            return response()->json([
                'status'=>'success',
                'message'=> 'Berhasil mengupdate logbook',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message'=> 'Gagal mengupdate logbook',
            ]);
        }
    }

}
