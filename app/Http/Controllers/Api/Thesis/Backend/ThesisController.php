<?php

namespace App\Http\Controllers\Api\Thesis\Backend;

use App\Http\Controllers\Controller;
use App\Models\ThesisLogbook;
use App\Models\ThesisSeminar;
use App\Models\ThesisTrial;

class ThesisController extends Controller
{
    public function show(Thesis $thesis){
        $seminars = ThesisSeminar::with('audiences')->where('thesis_id', $thesis->id)->get();
        $trials = ThesisTrial::where('thesis_id', $thesis->id)->get();
        $logbooks = ThesisLogbook::where('thesis_id',$thesis->id)->get();

        $thesis->put('seminars' , $seminars);
        $thesis->put('trials', $trials);
        $thesis->put('logbooks', $logbooks);

        return $thesis;
    }
}
