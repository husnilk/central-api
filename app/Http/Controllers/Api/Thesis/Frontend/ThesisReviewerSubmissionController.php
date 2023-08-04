<?php

namespace App\Http\Controllers\Api\Thesis\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminarReviewer;
use Illuminate\Http\Request;

class ThesisReviewerSubmissionController extends Controller
{
    public function index()
    {
        $reviewers = ThesisSeminarReviewer::select('theses.title', 'students.name', 'students.nim', 'thesis_seminars.seminar_at', 'thesis_seminars.method', 'thesis_seminars.room_id')
            ->leftJoin('thesis_seminars', 'thesis_seminar_reviewers.thesis_seminar_id', '=', 'thesis_seminars.id')
            ->leftJoin('theses', 'theses.id', '=', 'thesis_seminars.thesis_id')
            ->leftJoin('students', 'theses.student_id', '=', 'students.id')
            ->where('thesis_seminar_reviewers.reviewer_id', auth()->id())
//            ->where('thesis_seminars.status', ThesisSeminarReviewer::SUBMITTED)
            ->orderBy('thesis_seminars.seminar_at', 'desc')
            ->get();

        return response()->json([
            'status' => 'success',
            'count' => $reviewers->count(),
            'reviewers' => $reviewers
        ]);
    }

    public function update(Request $request, $seminar_id)
    {
        $reviewer = ThesisSeminarReviewer::where('seminar_id', $seminar_id)
            ->where('reviewer_id', auth()->id())
            ->first();
        if ($reviewer == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'TA tidak ditemukan'
            ], 404);
        }
        $reviewer->status = ThesisSeminarReviewer::ACCEPTED;
        $reviewer->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menerima permintaan mereview TA mahasiswa'
        ]);
    }

    public function destroy(Request $request, $seminar_id)
    {

        $reviewer = ThesisSeminarReviewer::where('seminar_id', $seminar_id)
            ->where('reviewer_id', auth()->id())
            ->first();
        if ($reviewer == null) {
            return response()->json([
                'status' => 'failed',
                'message' => 'TA tidak ditemukan'
            ], 404);
        }
        $reviewer->status = ThesisSeminarReviewer::REJECTED;
        $reviewer->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menolak permintaan mereview TA mahasiswa'
        ]);
    }
}
