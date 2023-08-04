<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ThesisSeminar extends Model
{
    use HasFactory;

    protected $table = 'thesis_seminars';
    protected $guarded = [];
    protected $casts = ['registered_at', 'seminar_at'];

    const STATUS_DRAFT = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_REJECTED = 3;
    const STATUS_SCHEDULED = 4;
    const STATUS_FINISHED = 5;
    const STATUS_CANCELLED = 6;

    public const REC_TRIALS = 1;
    public const REC_REVISION = 2;
    public const REC_RESEMINAR = 3;

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

    public const RECOMMENDATIONS = [
        self::REC_TRIALS => 'Dapat mengikuti sidang tanpa revisi',
        self::REC_REVISION => 'Dapat mengikuti sidang setelah revisi',
        self::REC_RESEMINAR => 'Mengulang seminar'
    ];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class, 'thesis_id');
    }

    public function reviewers()
    {
        return $this->belongsToMany(Lecturer::class, 'thesis_seminar_reviewers', 'thesis_seminar_id', 'reviewer_id')
            ->using(ThesisSeminarReviewer::class)
            ->withPivot('id', 'position', 'recomendation', 'notes');
    }

    public function audiences()
    {
        return $this->belongsToMany(Student::class, 'thesis_seminar_audiences', 'thesis_seminar_id', 'student_id')
            ->withPivot('id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /** EXTENDED ATTRIBUTE  */

    public function getSeminarDateAttribute($value)
    {
        return optional($this->seminar_at)->toDateString();
    }

    public function getSeminarTimeAttribute($value)
    {
        return optional($this->seminar_at)->toTimeString();
    }

    public function getStatusTextAttribute($value)
    {
        if (isset($this->status)) {
            return data_get(self::STATUSES, $this->status, 'Unknown');
        }
        return "-";
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
        return 'info';
    }

    public function getRecomendationTextAttribute($value)
    {
        if (isset($this->recommendation)) {
            return data_get(self::RECOMMENDATIONS, $this->recommendation, "Unknown");
        }
        return "-";
    }

    public function getReportUrlAttribute($value)
    {
        $folder = config('central.path.thesis.seminar_report');
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
        $folder = config('central.path.thesis.seminar_slide');
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
        $folder = config('central.path.thesis.seminar_journal');
        if ($this->file_journal != null) {
            $path = $folder . '/' . $this->file_journal;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
    }

    public function getAttendanceUrlAttribute($value)
    {
        $folder = config('central.path.thesis.seminar_attendance');
        if ($this->file_attendance != null) {
            $path = $folder . '/' . $this->file_attendance;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
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
    public function isOwnedBy($id)
    {
        return $this->thesis->student_id == $id;
    }

    public function isSubmitted()
    {
        return in_array($this->status, [self::STATUS_DRAFT, self::STATUS_SUBMITTED]);
    }

    public function isProcessed()
    {
        if ($this->status != self::STATUS_SUBMITTED && $this->status != self::STATUS_DRAFT) {
            return true;
        }
        return false;
    }

    public function isAccepted()
    {
        if ($this->status == self::STATUS_ACCEPTED)
            return true;
        return false;
    }

    public function isScheduled()
    {
        return $this->status == self::STATUS_SCHEDULED;
    }

    public function isFinished()
    {
        return in_array($this->status, [self::STATUS_FINISHED, self::STATUS_CANCELLED]);
    }

    public function isOffline()
    {
        return $this->method == self::METHOD_OFFLINE;
    }

    public function isFileAttendanceUploaded()
    {
        if(!empty($this->file_attendance))
            return true;
        return false;
    }
}
