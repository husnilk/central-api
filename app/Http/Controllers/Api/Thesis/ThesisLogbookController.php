<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use Illuminate\Http\Request;

class ThesisLogbookController extends Controller
{
    public function index($thesis_id){
        $logbooks = ThesisLogbook::where('thesis_id', $thesis_id)
            ->get();

        return response()->json([
            'status'=> 'success',
            'count'=> $logbooks->count(),
            'logbooks'=> $logbooks
        ]);
    }

    public function store(Request $request, $thesis_id){
        $logbook = new ThesisLogbook();
        $logbook->thesis_id = $thesis_id;
        $logbook->supervisor_id = request('supervisor_id');
        $logbook->date = request('date');
        $logbook->status = ThesisLogbook::SUBMITTED;
        $logbook->progress = request('progress');
        $logbook->problem = request('problem');
        if($logbook->save()){
            $res = new \stdClass();
            $res->status = 'success';
            $res->message = 'Berhasil menambah logbook TA';
            $res->logbook = $logbook;
            return response()->json($res);

        }
        $res = new \stdClass();
        $res->status = 'failed';
        $res->message = 'Gagal menambah logbook TA TA';
        return response()->json($res);
    }

    public function show($thesis_id, $id){
        $logbook = ThesisLogbook::find($id);

        return response()->json($logbook);
    }

    public function update($thesis_id, $id){
        $logbook = ThesisLogbook::find($id);

        $logbook->date = request('date');
        $logbook->progress = request('progress');
        $logbook->problem = request('problem');

        if($logbook->save()){
            $res = new \stdClass();
            $res->status = 'success';
            $res->message = 'Berhasil mengupdate logbook TA';
            $res->logbook = $logbook;
            return response()->json($res);
        }
        $res = new \stdClass();
        $res->status = 'failed';
        $res->message = 'Gagal mengupdate logbook TA';
        return response()->json($res);
    }

}
