<?php

namespace App\Http\Controllers\Api\Thesis\Frontend;

use App\Http\Controllers\Api\Thesis\Request;
use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisLogbook;
use Illuminate\Database\Eloquent\Builder;

class ThesisAdvisorController extends Controller
{
    public function index()
    {
        $theses = Thesis::with('student')
            ->whereHas('supervisors', function (Builder $query) {
                $query->where('lecturers.id', auth()->user()->id);
            })
            ->onGoing()
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $theses->count(),
            'theses' => $theses
        ]);
    }

    public function show(Thesis $advisor)
    {
        if (!$advisor->isSupervisedBy(auth()->id()) || $advisor == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'TA Tidak ditermukan'
            ], 404);
        }
        $logbooks = ThesisLogbook::where('thesis_id', $advisor->id)->get();
        $advisor->logbooks = $logbooks;

        return response()->json([
            $advisor
        ]);
    }

    public function update(Request $request, Thesis $advisor)
    {
        if (!$advisor->isSupervisedBy(auth()->user()->id)) {
            abort(404, 'Tugas Akhir tidak ditemukan');
        }

        $advisor->title = $request->get('title');
        $advisor->topic_id = $request->get('topic_id');

        if ($advisor->save()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diperbaharui',
            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal memperbaharui data'
        ]);
    }
}
