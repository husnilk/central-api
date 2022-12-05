<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\Thesis;
use App\Models\ThesisSeminar;
use App\Models\ThesisSeminarAudience;
use Illuminate\Http\Request;

class ThesisSeminarAudienceController extends Controller
{
    public function store(Request $request){
        $theses = Thesis::where('student_id', auth()->id())
            ->get()
            ->pluck('id')
            ->toArray();
        $seminar = ThesisSeminar::where('id', $id)
            ->whereIn('thesis_id', $theses)
            ->first();
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
