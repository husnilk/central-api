<?php

namespace App\Http\Controllers\Api\Internship;

use App\Http\Controllers\Controller;
use App\Http\Resources\InternshipLogCollection;
use App\Http\Resources\InternshipLogResource;
use App\Models\Internship;
use App\Models\InternshipLogbook;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MyInternshipLogbookController extends Controller
{
    public function index($internship_id)
    {
        $uid = auth()->user()->id;
        $internship = Internship::ownedBy($uid)->where('id', $internship_id)
            ->first();
        $logbooks = $internship->logbooks;

        return InternshipLogResource::collection($logbooks);
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
            $res->data = new InternshipLogResource($logbook);
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
            $res->data = $logbook;
        } else {
            $res->status = 'failed';
            $res->message = 'Gagal mengupdate data';
        }
        return response()->json($res);

    }
}
