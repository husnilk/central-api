<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisTopic extends Model
{
    use HasFactory;

    const VALIDATION_RULES = [
        'name' => 'required'
    ];

    protected $table = 'thesis_topics';
    protected $guarded = [];
}
