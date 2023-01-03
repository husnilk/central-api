<?php

namespace App\Http\Controllers\Api\Internship;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipSeminarAudience;
use Illuminate\Http\Request;

class MyInternshipController extends Controller
{
    public function index()
    {
        $internships = Internship::select('internships.id as id', 'internship_agencies.name as agency', 'internships.report_title as title', 'internships.start_at as start_at', 'internships.end_at as end_at', 'internships.status as status', 'internships.supervisor_id as supervisor_id', 'lecturers.name as supervisor', 'internships.grade as grade')
            ->leftJoin('internship_proposals', 'internships.proposal_id', '=', 'internship_proposals.id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->leftJoin('lecturers', 'lecturers.id', '=', 'internships.supervisor_id')
            ->where('internships.student_id', auth()->id())
            ->orderBy('internships.start_at', 'asc')
            ->get();

        $response = new \stdClass();
        $response->status = 'success';
        $response->count = $internships->count();
        $response->internship = $internships;

        return response()->json($response);
    }

    public function show($id)
    {
        $internship = Internship::select('internships.id as id', 'internship_agencies.name as agency', 'internships.report_title as title', 'internships.start_at as start_at', 'internships.end_at as end_at', 'internships.status as status', 'internships.supervisor_id as supervisor_id', 'lecturers.name as supervisor', 'seminar_date as seminar_date', 'seminar_room_id as seminar_room_id', 'rooms.name as seminar_room_name', 'seminar_deadline', 'internships.grade as grade')
            ->leftJoin('internship_proposals', 'internships.proposal_id', '=', 'internship_proposals.id')
            ->leftJoin('internship_agencies', 'internship_proposals.agency_id', '=', 'internship_agencies.id')
            ->leftJoin('lecturers', 'lecturers.id', '=', 'internships.supervisor_id')
            ->leftJoin('rooms', 'internships.seminar_room_id', '=', 'rooms.id')
//            ->where('internships.student_id', auth()->id())
            ->where('internships.id', $id)
            ->orderBy('internships.start_at', 'asc')
            ->first();

        if($internship == null){
            $res = new \stdClass();
            $res->status = 'failed';
            $res->message = 'Resource Not Found';
            return response()->json($res, 404);
        }

        $audiences = InternshipSeminarAudience::select('students.name', 'students.nim')
            ->leftJoin('students', 'internship_seminar_audiences.student_id', '=', 'students.id')
            ->where('internship_seminar_audiences.internship_id', '=', 1)
            ->get();

        $internship->audiences = $audiences;

        return response()->json($internship);
    }
}
