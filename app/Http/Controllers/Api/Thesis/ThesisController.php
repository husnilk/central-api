<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;

class ThesisController extends Controller
{
    public function show($id)
    {
        $thesis = Thesis::where('student_id', auth()->id())
            ->where('id', $id)
            ->first();

        return response()->json($thesis);
    }
}
