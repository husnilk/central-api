<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\ThesisSeminar;
use App\Models\ThesisTrial;

class ThesisSeminarController extends Controller
{
    public function show(Thesis $thesis)
    {
        $seminars = ThesisSeminar::with('thesis')
            ->where('thesis_id', $thesis)
            ->first();

        return response() - json($seminars);
    }
}

