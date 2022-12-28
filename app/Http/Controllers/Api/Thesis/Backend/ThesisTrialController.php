<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisTrial;

class ThesisTrialController extends Controller
{
    public function show(Thesis $thesis)
    {
        $trial = ThesisTrial::with('thesis')
            ->where('thesis_id', $thesis->id)
            ->first();

        return response()->json($trial);
    }
}
