<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminar;
use App\Models\ThesisTrial;

class ThesisListController extends Controller
{
    public function seminars()
    {
        $seminars = ThesisSeminar::onGoing()->get();

        return response()->json([
            'status' => 'success',
            'count' => $seminars->count(),
            'seminars' => $seminars
        ]);


    }

    public function trials()
    {
        $trials = ThesisTrial::onGoing()->get();
        return response()->json([
            'status' => 'success',
            'count' => $trials,
            'trials' => $trials
        ]);
    }
}
