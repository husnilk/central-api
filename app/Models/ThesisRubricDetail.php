<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisRubricDetail extends Model
{
    use HasFactory;

    protected $table = 'thesis_rubric_details';

    public function rubric()
    {
        return $this->belongsTo(ThesisRubric::class, 'thesis_rubric_id', 'id');
    }

    public function scores()
    {
        return $this->hasMany(ThesisTrialExaminerScore::class, 'thesis_rubric_detail_id', 'id');
    }
}
