<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipLogbook extends Model
{
    use HasFactory;

    protected $table = 'internship_logbooks';
    protected $guarded = [];

    public function internship()
    {
        return $this->belongsTo(Internship::class, 'id', 'internship_id');
    }
}
