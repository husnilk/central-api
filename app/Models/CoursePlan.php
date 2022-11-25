<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePlan extends Model
{
    use HasFactory;

    public function coursePlanDetail()
    {
        return $this->hasMany(coursePlanDetail::class);
    }
}
