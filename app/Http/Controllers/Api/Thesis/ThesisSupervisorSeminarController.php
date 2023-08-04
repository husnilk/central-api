<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;

class ThesisSupervisorSeminarController extends Controller
{
    public function show($thesis_id)
    {
        $thesis = Thesis::find($thesis_id);
        $seminars = ThesisSeminar::where('thesis_id', $thesis_id)->get();
        foreach($seminars as $i => $seminar){
            $audiences = ThesisSeminarAudience::where('thesis_seminar_id', $seminar->id)
                ->get();
            $seminars[$i]->put('audiences', $audiences);
        }

        $thesis->put('seminars', $seminars);

        return response()->json($thesis);

    }
}
