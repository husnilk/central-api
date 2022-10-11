<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisRubric extends Model
{
    use HasFactory;

    protected $table = 'thesis_rubrics';

    public function details()
    {
        return $this->hasMany(ThesisRubricDetail::class, 'thesis_rubric_id', 'id');
    }

    public function trials()
    {
        return $this->hasMany(ThesisTrial::class, 'thesis_rubric_id', 'id');
    }

    /** SCOPE */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
