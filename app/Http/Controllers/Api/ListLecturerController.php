<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lecturer;

class ListLecturerController extends Controller
{
    public function index(){
        $data = Lecturer::all();

        return response()->json($data);
    }

    public function show($id){
        $data = Lecturer::find($id);

        return response()->json($data);
    }
}
