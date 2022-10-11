<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    const validation_rules = [
        'name' => 'required',
        'faculty_id' => 'required',
    ];

    protected $table = 'departments';

    protected $guarded = [];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
