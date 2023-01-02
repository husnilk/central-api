<?php

namespace App\Http\Controllers\Api\Thesis;

use App\Http\Controllers\Controller;
use App\Models\ThesisSupervisor;
use Illuminate\Http\Request;

class ThesisAdvisorCancellationController extends Controller
{
    public function update(Request $request, $thesis_id)
    {
        $user_id = auth()->id();
        $supervisor = ThesisSupervisor::where('lecturer_id', $user_id)
            ->where('thesis_id', $thesis_id)
            ->first();

        if($supervisor != null) {
            $supervisor->status = ThesisSupervisor::CANCELLED;

            if ($supervisor->save()) {
                $message = [
                    'status' => 'success',
                    'message' => 'Berhasil membatalkan status pembimbing TA'
                ];
            } else {
                $message = [
                    'status' => 'gagal',
                    'message' => 'Gagal membatalkan status pembimbing TA'
                ];
            }
        }else{
            $message = [
                'status' => 'failed',
                'message' => 'TA tidak ditemukan'
            ];
        }

        return response()->json($message);
    }
}
