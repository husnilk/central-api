<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;
use Illuminate\Http\Request;

class ThesisSeminarAudienceController extends Controller
{
    public function index($seminar_id)
    {
        $seminar = ThesisSeminar::with('audiences')->find($seminar_id);

        return response()->json($seminar);
    }

    public function store(Request $request, $seminar_id){

        $seminar = ThesisSeminar::find($seminar_id);
        $audience = new ThesisSeminarAudience();
        $audience->thesis_seminar_id = $seminar->id;
        $audience->student_id = request('student_id');
        if($audience->save()){
            return response()->json([
                'status'=>'success',
                'message'=> 'Berhasil menambahkan peserta seminar hasil',
            ]);
        }else{
            return response()->json([
                'status' => 'error',
                'message'=> 'Gagal menambahkan peserta seminar hasil',
            ]);
        }
    }
}
