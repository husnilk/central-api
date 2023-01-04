<?php

namespace App\Http\Controllers\Api\Internship\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InternshipProposal;
use Illuminate\Http\Request;

class MyInternshipSubmissionController extends Controller
{
    public function store(Request $request)
    {
        $proposal = new InternshipProposal();
        $proposal->agency_id = $request->agency_id;
        $proposal->start_at = $request->start_at;
        $proposal->end_at = $request->end_at;
        $proposal->purpose = $request->purpose;
        $proposal->title = '';

        $res = new \stdClass();
        if($proposal->save()){
           $res->status = 'success';
           $res->message = 'Berhasil membuat draft propsoal';
           $res->proposal = $proposal;
           return response()->json($res);
        }
        $res->status = 'failed';
        $res->message = 'Gagal membuat draf proposal';
        return response()->json($res);
    }
}
