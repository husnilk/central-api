<?php

namespace App\Http\Controllers\Api\Internship;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipProposal;
use App\Models\InternshipSeminarAudience;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyInternshipStatementController extends Controller
{
    public function store(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        if ($internship != null) {
            $internship->status = Internship::STATUS_SUPERVISING;
            $internship->end_at = $request->end_date;
            if ($internship->save()) {
                $res = new \stdClass();
                $res->status = 'success';
                $res->message = 'Berhasil melaporkan KP telah selesai';
                return response()->json($res);
            }
            $res = new \stdClass();
            $res->status = 'failed';
            $res->message = 'Gagal melaporkan KP telah selesai';
            return response()->json($res);

        }
    }

    public function balasankp(Request $request, $proposal_id)
    {
        $proposal = InternshipProposal::findOrFail($proposal_id);
        $proposal->status = $request->status;
        if ($proposal->save()) {
            foreach ($proposal->internships as $internship) {
                $internship->status = Internship::STATUS_ON_FIELD;
                $internship->start_at = $request->start_date;
                $internship->end_at = $request->end_date;
                $internship->save();
            }
        }

        $res = new \stdClass();
        $res->status = 'success';
        $res->message = 'Proposal telah diperbaharui';
        return response()->json($res);

    }

    public function uploadlapkp(Request $request, $internship_id)
    {

    }

    public function inputseminar(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);

        $internship->report_title = $request->title;
        $internship->seminar_date = $request->seminar_date;
        $internship->seminar_room_id = $request->seminar_room_id;
        $internship->save();

        $res = new \stdClass();
        $res->status = 'success';
        $res->message = 'Seminar KP telah diperbaharui';
        return response()->json($res);
    }

   public function infoseminar()
    {
        $internships = Internship::select('internships.id as id', 'students.name as name', 'students.nim as nim', 'internship_agencies.name as agency', 'internships.report_title as title', 'internships.start_at as start_at', 'internships.end_at as end_at', 'internships.status as status', 'internships.supervisor_id as supervisor_id', 'lecturers.name as supervisor')
            ->leftJoin('internship_proposals', 'internships.proposal_id', '=', 'internship_proposals.id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->leftJoin('lecturers', 'lecturers.id', '=', 'internships.supervisor_id')
            ->leftJoin('students', 'internships.student_id', '=', 'students.id')
            ->where('internships.seminar_date', Carbon::now()->toDateString())
            ->orderBy('internships.start_at', 'asc')
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $internships->count();
        $res->internships = $internships;

        return response()->json($res);
    }

    public function inputabsenseminar(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        if ($internship != null) {
            $audience = new InternshipSeminarAudience();
            $audience->internship_id = $internship_id;
            $audience->student_id = auth()->id();
            $audience->role = 1;
            $audience->save();

            $res = new \stdClass();
            $res->status = 'success';
            $res->message = 'Berhasil isi absensi';
            $res->data = $audience;

            return response()->json($res);
        }
        $res = new \stdClass();
        $res->status = 'failed';
        $res->message = 'KP tidak ditemukan';

        return response()->json($res);
    }
}
