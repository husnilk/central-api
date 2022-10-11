<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ThesisSeminarReviewer extends Pivot
{
    use HasFactory;

    public const POS_ADVISOR = 1;
    public const POS_REVIEWER = 2;

    public const SUBMITTED = 1;
    public const ACCEPTED = 2;
    public const REJECTED = 3;

    public const POSITIONS = [
        self::POS_ADVISOR => 'Pembimbing',
        self::POS_REVIEWER => 'Penguji',
    ];
    public const STATUSES = [
        self::SUBMITTED => 'Submitted',
        self::ACCEPTED => 'Bersedia',
        self::REJECTED => 'Tidak Bersedia',
    ];

    protected $table = 'thesis_seminar_reviewers';
    protected $guarded = [];

    public function seminar()
    {
        return $this->belongsTo(ThesisSeminar::class, 'thesis_seminar_id', 'id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'reviewer_id', 'id');
    }

    /** EXTENDED ATTRIBUTE */

    public function getRecomendationTextAttribute($value)
    {
        if(key_exists($this->recomendation, ThesisSeminar::RECOMMENDATIONS)){
            return ThesisSeminar::RECOMMENDATIONS[$this->recomendation];
        }
        return "- Belum ada rekomendasi -";
    }

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

}
