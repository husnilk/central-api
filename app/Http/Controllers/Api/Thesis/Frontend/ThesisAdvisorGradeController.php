<?php

namespace App\Http\Controllers\Api\Thesis\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use Illuminate\Http\Request;

class ThesisAdvisorGradeController extends Controller
{
    /** Get list of student to be graded */
    public function index()
    {
        $theses = Thesis::whereHas('supervisors', function ($query) {
            $query->where('lecturer_id', auth()->user()->id);
        })->get();

        return response()->json([
            'status' => 'success',
            'count' => $theses->count(),
            'theses' => $theses
        ]);
    }

    /** Update nilai TA mahasiswa */
    public function update(Request $request, $id){
        $thesis = Thesis::find($id);
        $thesis->grade = $request->get('grade');
        $thesis->grade_by = auth()->user()->id;
        if($thesis->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil update nilai TA'
            ]);
        }else{
            return response()->json([
                'status' => 'success',
                'message' => 'Gagal update nilai TA'
            ]);
        }
    }
}
