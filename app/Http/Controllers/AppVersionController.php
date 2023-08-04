<?php

namespace App\Http\Controllers;

use App\Models\AppVersion;
use Illuminate\Http\Request;

class AppVersionController extends Controller
{
    public function show($app_id)
    {
        $app = AppVersion::where('app_id', $app_id)
            ->where('active', 1)
            ->first();


    }
}
