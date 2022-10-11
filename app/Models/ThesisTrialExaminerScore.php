<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThesisTrialExaminerScore extends Model
{
    protected $table = 'thesis_trial_examiner_scores';

    public function examiner()
    {
        return $this->belongsTo(ThesisTrialExaminer::score, 'thesis_trial_examiner_scores', 'id');
    }

    public function detail()
    {
        return $this->belongsTo(ThesisRubricDetail::class, 'thesis_rubric_detail_id', 'id');
    }
}
