<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisTrial;

class ThesisSupervisorTrialController extends Controller
{
    public function show($thesis_id)
    {
        $thesis = Thesis::find($thesis_id);
        $trials = ThesisTrial::where('thesis_id', $thesis_id)->get();
        $thesis->put('trials', $trials);

        return response()->json($thesis);
    }
}
