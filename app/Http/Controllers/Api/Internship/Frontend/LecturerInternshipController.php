<?php

namespace App\Http\Controllers\Api\Internship\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipLogbook;
use App\Models\InternshipSeminarAudience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturerInternshipController extends Controller
{
    public function listbimbingan()
    {
        $internships = Internship::select('internships.id as id', 'students.name as name', 'students.nim as nim', 'internship_agencies.name as agency', 'internships.report_title as title', 'internships.start_at as start_at', 'internships.end_at as end_at', 'internships.status as status', 'internships.supervisor_id as supervisor_id', 'lecturers.name as supervisor')
            ->leftJoin('internship_proposals', 'internships.proposal_id', '=', 'internship_proposals.id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->leftJoin('lecturers', 'lecturers.id', '=', 'internships.supervisor_id')
            ->leftJoin('students', 'internships.student_id', '=', 'students.id')
            ->where('internships.supervisor_id', auth()->id())
            ->orderBy('internships.start_at', 'asc')
            ->get();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $internships->count();
        $res->internships = $internships;

        return response()->json($res);
    }

    public function inputnilaikp(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        $internship->grade = $request->grade;
        if ($internship->save()) {
            $res = new \stdClass();
            $res->status = 'success';
            $res->message = 'Berhasil mengupdate nilai KP mahasiswa';
            return response()->json($res);
        }
        $res = new \stdClass();
        $res->status = 'failed';
        $res->message = 'Gagal mengupdate nilai KP mahasiswa';
        return response()->json($res);
    }

    public function batalkp(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        $internship->status = Internship::STATUS_CANCELLED;
        $internship->cancellation_reason = $request->reason;

        if ($internship->save()) {
            $res = new \stdClass();
            $res->status = 'success';
            $res->message = 'Pengajuan pembatalan KP selesai';
            return response()->json($res);
        }
        $res = new \stdClass();
        $res->status = 'failed';
        $res->message = 'Gagal mengajukan pembatalan kp';
        return response()->json($res);
    }

    public function detailseminar($internship_id)
    {
        $internship = DB::table('internships')
            ->select('internships.id as id', 'internship_agencies.name as agency', 'internships.report_title as title', 'internships.start_at as start_at', 'internships.end_at as end_at', 'internships.status as status', 'internships.supervisor_id as supervisor_id', 'lecturers.name as supervisor', 'seminar_date as seminar_date', 'seminar_room_id as seminar_room_id', 'rooms.name as seminar_room_name', 'internships.seminar_deadline', DB::raw("count(internship_seminar_audiences.id) as audiences"), 'internships.grade as grade')
            ->leftJoin('internship_proposals', 'internships.proposal_id', '=', 'internship_proposals.id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->leftJoin('lecturers', 'lecturers.id', '=', 'internships.supervisor_id')
            ->leftJoin('internship_seminar_audiences', 'internships.id', '=', 'internship_seminar_audiences.internship_id')
            ->leftJoin('rooms', 'internships.seminar_room_id', '=', 'rooms.id')
            ->where('internships.id', $internship_id)
            ->groupBy('internships.id', 'internships.start_at')
            ->orderBy('internships.start_at', 'asc')
            ->get();

        return response()->json($internship);
    }

    public function inputbaseminarkp(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);
        $internship->status = Internship::STATUS_SUPERVISING;
        $internship->news_event = $request->news_event;

        $res = new \stdClass();
        if ($internship->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil mengisi Berita Acara Seminar KP';
            return response()->json($res);
        }
        $res->status = 'failed';
        $res->message = 'Gagal mengisi Berita Acara Seminar KP';
        return response()->json($res);
    }

    public function approvepeserta(Request $request, $internship_id)
    {
        $audience = InternshipSeminarAudience::where('internship_id', $internship_id)
            ->where('student_id', $request->student_id)
            ->first();
        $res = new \stdClass();

        if($audience == null){
            $res->status = 'failed';
            $res->message = 'Mahasiswa tidak ditemukan';
            return response()->json($res);
        }

        $audience->attended = InternshipSeminarAudience::STATUS_ATTENDED;

        if ($audience->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil menyetujui kehadiran mahasiswa';
            return response()->json($res);
        }
        $res->status = 'failed';
        $res->message = 'Gagal menyetujui kehadiran mahasiswa';
        return response()->json($res);
    }

    public function rejectpeserta(Request $request, $internship_id)
    {
        $audience = InternshipSeminarAudience::where('internship_id', $internship_id)
            ->where('student_id', $request->student_id)
            ->first();

        $res = new \stdClass();
        if($audience == null){
            $res->status = 'failed';
            $res->message = 'Mahasiswa tidak ditemukan';
            return response()->json($res);
        }

        $audience->attended = InternshipSeminarAudience::STATUS_ATTENDED;

        if ($audience->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil membatalkan kehadiran mahasiswa';
            return response()->json($res);
        }
        $res->status = 'failed';
        $res->message = 'Gagal membatalkan kehadiran mahasiswa';
        return response()->json($res);
    }

    public function updatelogbook(Request $request, $internship_id, $logbook_id)
    {
        $logbook = InternshipLogbook::where('internship_id', $internship_id)
            ->where('id', $logbook_id)
            ->first();

        $logbook->status = $request->status;
        $logbook->note = $request->note;

        $res = new \stdClass();
        if ($logbook->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil mengupdate logbook mahasiswa';
            return response()->json($res);
        }
        $res->status = 'failed';
        $res->message = 'Gagal memberikan catatan logbook mahasiswa';
        return response()->json($res);
    }
}
