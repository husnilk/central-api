<?php

namespace App\Http\Controllers\Api\Internship\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use App\Models\InternshipLogbook;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyInternshipLogbookController extends Controller
{
    public function index($internship_id)
    {
        $internship = Internship::with('logbooks')->find($internship_id);

        return response()->json($internship);
    }

    public function store(Request $request, $internship_id)
    {
        $logbook = new InternshipLogbook();
        $logbook->internship_id = $internship_id;
        $logbook->date = Carbon::now();
        $logbook->activities = $request->activities;
        $logbook->note = null;
        $logbook->status = 0;

        $res = new \stdClass();
        if ($logbook->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil menambahkan data logbook';
            $res->logbook = $logbook;
        } else {
            $res->status = 'failed';
            $res->message = 'Gagal menambahkan data';
        }
        return response()->json($res);
    }

    public function show($internship_id, $logbook_id)
    {
        $internship = Internship::find($internship_id);
        $logbook = InternshipLogbook::find($logbook_id);
        $internship->logbook = $logbook;

        return response()->json($internship);
    }

    public function update(Request $request, $internship_id, $logbook_id)
    {
        $logbook = InternshipLogbook::find($logbook_id);
        $logbook->activities = $request->activities;
        $res = new \stdClass();
        if ($logbook->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil memperbaharui data logbook';
            $res->logbook = $logbook;
        } else {
            $res->status = 'failed';
            $res->message = 'Gagal mengupdate data';
        }
        return response()->json($res);

    }

}
