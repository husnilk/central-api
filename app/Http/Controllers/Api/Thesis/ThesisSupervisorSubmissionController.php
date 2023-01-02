<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ThesisSupervisorSubmissionController extends Controller
{
    /** List mahasiswa yang mengajukan bimbingan */
    public function index()
    {
        $proposals = ThesisSupervisor::select('theses.id as thesis_id', 'theses.title as title', 'theses.abstract as abstract', 'students.nim as nim', 'students.name as name', 'theses.created_at as submitted_date')
            ->leftJoin('theses', 'thesis_supervisors.thesis_id', '=', 'theses.id')
            ->leftJoin('students', 'theses.student_id', '=', 'students.id')
            ->where('lecturer_id', auth()->id())
            ->where('thesis_supervisors.status', ThesisSupervisor::SUBMITTED)
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $proposals->count(),
            'thesis' => $proposals
        ]);
    }

    public function accept(Request $request, Thesis $thesis)
    {
        $supervisor = ThesisSupervisor::where('thesis_id', $thesis->id)
            ->where('lecturer_id', auth()->id())
            ->where('status', ThesisSupervisor::SUBMITTED)
            ->first();

        if($supervisor != null) {
            $supervisor->status = ThesisSupervisor::ACCEPTED;
            $supervisor->save();

            $thesis->start_at = Carbon::now();
            if (in_array($supervisor->position, [ThesisSupervisor::PEMBIMBING_TUNGGAL, ThesisSupervisor::PEMBIMBING_UTAMA])) {
                $thesis->status = Thesis::BIMBINGAN_PROPOSAL;
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Anda telah menerima permintaan bimbingan'
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'TA tidak ditemukan'
        ], 404);
    }

    public function reject(Request $request, $thesis_id)
    {
        $supervisor = ThesisSupervisor::where('thesis_id', $thesis_id)
            ->where('lecturer_id', auth()->id())
            ->where('status', ThesisSupervisor::SUBMITTED)
            ->first();

        if($supervisor != null) {
            $supervisor->status = ThesisSupervisor::REJECTED;
            $supervisor->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Anda telah menolak permintaan pembimbing'
            ]);
        }
        return response()->json([
            'status' => 'failed',
            'message' => 'TA tidak ditemukan'
        ], 404);
    }
}
