<?php

namespace App\Http\Controllers\Api\Internship;

use App\Http\Controllers\Controller;
use App\Models\Internship;
use Illuminate\Http\Request;

class MyInternshipController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $internship = Internship::where('student_id', $user_id)->get();

        $response = new \stdClass();
        $response->status = 'success';
        $response->count = $internship->count();
        $response->internship = $internship;

        return response()->json($response);
    }

    public function show($id)
    {
        $internship = Internship::with('proposal')->find($id);

        return response()->json($internship);
    }
}
