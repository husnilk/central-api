<?php

namespace App\Http\Controllers\Api\Internship\Frontend;

use App\Http\Controllers\Controller;
use App\Models\InternshipAgency;
use Illuminate\Http\Request;

class InternshipAgencyController extends Controller
{
    public function index()
    {
        $companies = InternshipAgency::all();

        $res = new \stdClass();
        $res->status = 'success';
        $res->count = $companies->count();
        $res->companies = $companies;

        return response()->json($res);
    }

    public function accept(Request $request, $agency_id)
    {
        $company = InternshipAgency::find($agency_id);
        $company->status = $request->status;

        $res = new \stdClass();
        if ($company->save()) {
            $res->status = 'success';
            $res->message = 'Berhasil mengupdate status perusahaan tempat KP';
        }else {
            $res->status = 'failed';
            $res->message = 'Gagal mengupdate statu perusahaan tempat KP';
        }
        return response()->json($res);
    }
}
