<?php

namespace App\Http\Controllers\Api\Internship;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipSeminarAudience;
use Illuminate\Http\Request;

class MyInternshipAudienceController extends Controller
{
    public function store(Request $request, $internship_id)
    {
        $internship = Internship::find($internship_id);

        $audience = new InternshipSeminarAudience();
        $audience->internship_id = $internship_id;
        $audience->student_id = $request->student_id;
        $audience->role = 1;
        $audience->save();

        $audiences = $internship->audiences;

        $res = new \stdClass();
        $res->status = 'success';
        $res->message = 'Peserta Seminar KP telah ditambahkan';
        $res->audiences = $audiences;

        return response()->json($res);
    }


}
