<?php

namespace App\Http\Controllers\Api\Internship;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipLogbook;
use App\Models\InternshipProposal;

class KaprodiInternshipController extends Controller
{
    public function listusulankp()
    {
        $proposals = InternshipProposal::select('internship_proposals.id', 'internship_agencies.name', 'internship_proposals.start_at', 'internship_proposals.end_at', DB::raw("'count'('internships.id') as num"))
            ->leftJoin('internships', 'internship_proposals.id', '=', 'internships.proposal_id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->where('internship_proposals.status', InternshipProposal::STATUS_SUBMITTED)
            ->groupBy('internship_proposals.id')
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $proposals->count();
        $res->proposals = $proposals;
        return response()->json($res);
    }

    public function listmahasiswakp()
    {
        $internships = Internship::select('internships.id as id', 'students.name as name', 'students.nim as nim', 'internship_agencies.name as agency', 'internships.report_title as title', 'internships.start_at as start_at', 'internships.end_at as end_at', 'internships.status as status', 'internships.supervisor_id as supervisor_id', 'lecturers.name as supervisor')
            ->leftJoin('internship_proposals', 'internships.proposal_id', '=', 'internship_proposals.id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->leftJoin('lecturers', 'lecturers.id', '=', 'internships.supervisor_id')
            ->leftJoin('students', 'internships.student_id', '=', 'students.id')
            ->whereIn('internships.status', [Internship::STATUS_ON_FIELD, Internship::STATUS_SUPERVISING])
            ->orderBy('internships.start_at', 'asc')
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $internships->count();
        $res->internships = $internships;
        return response()->json($res);
    }

    public function detailusulan($proposal_id)
    {
        $proposals = DB::table('internship_proposals')
            ->select('internship_proposals.id', 'internship_agencies.name', 'internship_proposals.status', 'internship_proposals.start_at', 'internship_proposals.end_at', DB::raw("'count'('internships.id') as jumlah"))
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->leftJoin('internships', 'internship_proposals.id', '=', 'internships.proposal_id')
            ->groupBy('internship_proposals.id')
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $proposals->count();
        $res->internships = $proposals;
        return response()->json($res);
    }

    public function listdailylogbook()
    {
        $logbooks = InternshipLogbook::select('students.name', 'students.nim', 'internship_agencies.name', 'internships.start_at', 'internships.end_at', 'internship_logbooks.activities')
            ->leftJoin('internships', 'internship_logbooks.internship_id', '=', 'internships.id')
            ->leftJoin('students', 'internships.student_id', '=', 'students.id')
            ->leftJoin('internship_proposals', 'internships.proposal_id', '=', 'internship_proposals.id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->where('internship_logbooks.date', '=', DB::raw('date'(now())))
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $logbooks->count();
        $res->logbooks = $logbooks;

        return response()->json($res);

    }

    public function listmahasiswaselesaikp()
    {
        $internships = Internship::select('internships.id as id', 'students.name as name', 'students.nim as nim', 'internship_agencies.name as agency', 'internships.report_title as title', 'internships.start_at as start_at', 'internships.end_at as end_at', 'internships.status as status', 'internships.supervisor_id as supervisor_id', 'lecturers.name as supervisor')
            ->leftJoin('internship_proposals', 'internships.proposal_id', '=', 'internship_proposals.id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->leftJoin('lecturers', 'lecturers.id', '=', 'internships.supervisor_id')
            ->leftJoin('students', 'internships.student_id', '=', 'students.id')
            ->where('internships.status', Internship::STATUS_FINISHED)
            ->orderBy('internships.start_at', 'asc')
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $internships->count();
        $res->internships = $internships;
    }

    public function pembatalankp(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        $internship->status = Internship::STATUS_CANCELLED;

        $res = new \stdClass();
        if ($internship->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil membatalkan KP';
        } else {
            $res->status = 'failed';
            $res->message = 'Gagal membatalkan KP';
        }
        return response()->json($res);
    }

    public function penunjukanpembimbing(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        $internship->supervisor_id = $request->supervisor_id;

        $res = new \stdClass();
        if ($internship->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil menentukan pembimbing KP';
        } else {
            $res->status = 'failed';
            $res->message = 'Gagal menentukan pembimbing KP';
        }
        return response()->json($res);
    }

    public function persetujuannilaikp(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        $internship->status = Internship::STATUS_FINISHED;

        $res = new \stdClass();
        if ($internship->save()) {
            $res->status = 'success';
            $res->message = 'KP dinyatakan selesai';
        } else {
            $res->status = 'failed';
            $res->message = 'Gagal mengubah status nilai KP';
        }
        return response()->json($res);
    }

}
