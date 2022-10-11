<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ThesisTrialExaminer extends Pivot
{
    use HasFactory;

    public const POS_CHAIRMAN = 1;
    public const POS_MEMBER = 2;

    public const SUBMITTED = 1;
    public const ACCEPTED = 2;
    public const REJECTED = 3;

    public const POSITIONS = [
        self::POS_CHAIRMAN => 'Ketua Sidang',
        self::POS_MEMBER => 'Anggota Sidang',
    ];
    public const STATUSES = [
        self::SUBMITTED => 'Submitted',
        self::ACCEPTED => 'Bersedia',
        self::REJECTED => 'Tidak Bersedia',
    ];

    protected $table = 'thesis_trial_examiners';
    protected $guarded = [];

    /** RELATIONSHIP */
    public function trial()
    {
        return $this->belongsTo(ThesisTrial::class, 'thesis_trial_id', 'id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'examiner_id', 'id');
    }

    public function scores()
    {
        return $this->belongsToMany(ThesisRubricDetail::class,
            'thesis_trial_examiner_scores',
            'thesis_trial_examiner_id',
            'thesis_rubric_detail_id')
            ->withPivot('score', 'notes');
    }

    /** EXTENDED ATTRIBUTE */
    public function getStatusTextAttribute($value)
    {
        if(isset($this->status)) {
            return data_get(self::STATUSES, $this->status, 'Unknown');
        }
        return "-";
    }

    public function getStatusTypeAttribute($value)
    {
        if(isset($this->status)){
            if($this->status == self::REJECTED ){
                return 'danger';
            }else if($this->status == self::ACCEPTED) {
                return 'success';
            }else if($this->status == self::SUBMITTED){
                return 'info';
            }else{
                return 'primary';
            }
        }
        return 'info';
    }

    /** FUNCTION */
    public function isResponded()
    {
        return in_array($this->status, [self::ACCEPTED, self::REJECTED]);
    }

    public function isAccepted()
    {
        return $this->status == self::ACCEPTED;
    }

    public function isRejected()
    {
        return $this->status == self::REJECTED;
    }
}
