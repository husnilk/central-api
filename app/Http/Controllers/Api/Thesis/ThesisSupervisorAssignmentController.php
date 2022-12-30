<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use Illuminate\Support\Facades\Request;

class ThesisSupervisorAssignmentController extends Controller
{
    public function store(Request $request, Thesis $thesis)
    {
        $supervisor = new ThesisSupervisor();
        $supervisor->thesis_id = $thesis->id;
        $supervisor->lecturer_id = $request->lecturer_id;
        $supervisor->position = $request->position;
        $supervisor->status = ThesisSupervisor::ACCEPTED;
        $supervisor->created_by = auth()->id();
        if($supervisor->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil menambahkan dosen pembimbing'
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Gagal menambahkan dosen pembimbing'
        ], 400);
    }
}
