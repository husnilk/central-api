<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    public function index()
    {
        $theses = Thesis::where('student_id', auth()->id())
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $theses->count();
        $res->theses = $theses;
        return response()->json($res);

    }


    public function show($id)
    {
        $thesis = Thesis::with(['student', 'seminars', 'trials', 'supervisors'])
            ->find($id);

        return response()->json($thesis);
    }

    public function store(Request $request)
    {
        $thesis = new Thesis();
        $thesis->topic_id = 1;
        $thesis->student_id = auth()->id();
        $thesis->title = $request->title;
        $thesis->abstract = $request->abstract;
        $thesis->created_by = auth()->id();
        $thesis->status = Thesis::PENGAJUAN_PEMBIMBING;

        if ($thesis->save()) {
            $supervisor = new ThesisSupervisor();
            $supervisor->thesis_id = $thesis->id;
            $supervisor->lecturer_id = $request->lecturer_id;
            $supervisor->position = $request->position;
            $supervisor->save();

            $res = new \stdClass();
            $res->status = 'success';
            $res->message = 'Berhasil mengajukan permintaan TA';
            return response()->json($res);
        }
        $res = new \stdClass();
        $res->status = 'failed';
        $res->message = 'Gagal mengajukan permintaan TA';
        return response()->json($res);

    }

    public function showmahasiswa($id){
        $mahasiswa = Student::find($id);

        return response()->json($mahasiswa);
    }
}
