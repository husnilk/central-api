<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSupervisor;
use Illuminate\Support\Facades\DB;

class ThesisSupervisorSubmissionController extends Controller
{
    /** List mahasiswa yang mengajukan bimbingan */
    public function index()
    {
        $sql = 'select
    t.id as thesis_id,
    t.title as title,
    t.abstract as abstract,
    s.nim as nim,
    s.name as name,
    t.created_at as submitted_date
    from thesis_supervisors
left join theses t on thesis_supervisors.thesis_id = t.id
left join students s on t.student_id = s.id
where lecturer_id = ?
and thesis_supervisors.status = ?';

        $proposals = DB::select($sql, [auth()->id(), ThesisSupervisor::SUBMITTED]);

        return response()->json([
            'status' => 'success',
             'count' => $proposals->count,
            'thesis' => $proposals
            ]);
    }

    public function accept(Request $request, Thesis $thesis){
        $supervisor = ThesisSupervisor::where('thesis_id', $thesis->id)
            ->where('lecturer_id', auth()->id())
            ->where('status', ThesisSupervisor::SUBMITTED)
            ->first();

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

    public function reject(Request $request, Thesis $thesis){
        $supervisor = ThesisSupervisor::where('thesis_id', $thesis->id)
            ->where('lecturer_id', auth()->user()->id)
            ->where('status', ThesisSupervisor::SUBMITTED)
            ->first();

        $supervisor->status = ThesisSupervisor::REJECTED;
    }
}
