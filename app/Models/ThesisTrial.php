<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ThesisTrial extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_SCHEDULED = 4;
    const STATUS_FINISHED = 5;
    const STATUS_CANCELLED = 6;

    const METHOD_OFFLINE = 1;
    const METHOD_ONLINE = 2;

    public const METHODS = [
        self::METHOD_OFFLINE => 'Sidang Offline',
        self::METHOD_ONLINE => 'Sidang Online'
    ];

    const STATUSES = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_SUBMITTED => 'Submitted',
        self::STATUS_ACCEPTED => 'Accepted',
        self::STATUS_REJECTED => 'Rejected',
        self::STATUS_SCHEDULED => 'Scheduled',
        self::STATUS_FINISHED => 'Finished',
        self::STATUS_CANCELLED => 'Cancelled'
    ];

    protected $table = 'thesis_trials';
    protected $guarded = [];
    protected $dates = ['registered_at', 'trial_at'];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }

    public function examiners()
    {
        return $this->belongsToMany(Lecturer::class, 'thesis_trial_examiners', 'thesis_trial_id', 'examiner_id')
            ->using(ThesisTrialExaminer::class)
            ->withPivot('id', 'position');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function rubric()
    {
        return $this->belongsTo(ThesisRubric::class, 'thesis_rubric_id', 'id');
    }

    /** EXTENDED ATTRIBUTE  */

    public function setScoreAttribute($value)
    {
        $this->score = $value;
        if ($value >= 80) {
            $this->grade = 'A';
        } elseif ($value >= 75) {
            $this->grade = 'A-';
        } elseif ($value >= 70) {
            $this->grade = 'B+';
        } elseif ($value >= 65) {
            $this->grade = 'B';
        } elseif ($value >= 60) {
            $this->grade = 'B-';
        } elseif ($value >= 55) {
            $this->grade = 'C+';
        } else {
            $this->grade = 'C';
        }
    }

    public function getStatusTextAttribute($value)
    {
        if (isset($this->status)) {
            return data_get(self::STATUSES, $this->status, 'Unknown');
        }
        return "-";
    }

    public function getMethodTextAttribute($value)
    {
        if (isset($this->method)) {
            return data_get(self::METHODS, $this->method, 'Unknown');
        }
    }

    public function getReportUrlAttribute($value)
    {
        $folder = config('central.path.thesis.trial_report');
        if ($this->file_report != null) {
            $path = $folder . '/' . $this->file_report;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
    }

    public function getSlideUrlAttribute($value)
    {
        $folder = config('central.path.thesis.trial_slide');
        if ($this->file_slide != null) {
            $path = $folder . '/' . $this->file_slide;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
    }

    public function getJournalUrlAttribute($value)
    {
        $folder = config('central.path.thesis.trial_journal');
        if ($this->file_journal != null) {
            $path = $folder . '/' . $this->file_journal;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
    }

    public function getStatusTypeAttribute($value)
    {
        if (isset($this->status)) {
            if ($this->status == self::STATUS_REJECTED || $this->status == self::STATUS_CANCELLED) {
                return 'danger';
            } else if ($this->status == self::STATUS_FINISHED) {
                return 'success';
            } else if ($this->status == self::STATUS_SUBMITTED) {
                return 'info';
            } else {
                return 'primary';
            }
        }
    }

    /** SCOPE QUERY */
    public function scopeOnGoing($query)
    {
        return $query->whereIn('status', [
            self::STATUS_SUBMITTED,
            self::STATUS_ACCEPTED,
            self::STATUS_SCHEDULED
        ]);
    }

    /** FUNCTION */
    public function isProcessed()
    {
        if ($this->status != self::STATUS_SUBMITTED && $this->status != self::STATUS_DRAFT) {
            return true;
        }
        return false;
    }

    public function isAccepted()
    {
        return $this->status == self::STATUS_ACCEPTED;
    }

    public function isScheduled()
    {
        return $this->status == self::STATUS_SCHEDULED;
    }

    public function isOffline()
    {
        return $this->method == self::METHOD_OFFLINE;
    }

    public function isFinished()
    {
        return in_array($this->status, [self::STATUS_FINISHED, self::STATUS_CANCELLED]);
    }
}
