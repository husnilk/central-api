<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ThesisProposal extends Model
{
    use HasFactory;

    const VALIDATION_RULES = [
        'grade' => 'required',
        'file_proposal' => 'required|mimes:pdf',
        'status' => 'required',
    ];

    protected $table = 'thesis_proposals';
    protected $dates = ['datetime'];

    protected $guarded = [];

    const SUBMITTED = 0;
    const APPROVED = 1;
    const REJECTED = 2;

    public const STATUSES = [
        self::SUBMITTED => 'Pengajuan',
        self::APPROVED => 'Diterima',
        self::REJECTED => 'Ditolak',
    ];

    /** RELATIONSHIP */

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function audiences()
    {
        return $this->belongsToMany(Student::class, 'thesis_proposal_audiences', 'thesis_proposal_id', 'student_id')
            ->withPivot('id');
    }

    public function grader()
    {
        return $this->belongsTo(User::class, 'graded_by', 'id');
    }

    /** EXTENDED ATTRIBUTE */

    public function getProposalDateAttribute($value)
    {
        return $this->datetime->toDateString();
    }

    public function getProposalTimeAttribute($value)
    {
        return $this->datetime->toTimeString();
    }

    public function getProposalUrlAttribute($value)
    {
        return $this->getProposalUrl();
    }

    public function getStatusTypeAttribute($value)
    {
        return 'info';
    }

    public function getStatusTextAttribute($value)
    {
        if (isset($this->status)) {
            return data_get(self::STATUSES, $this->status, '-');
        }
    }

    /** FUNCTION */
    public function getProposalUrl()
    {
        $folder = config('central.path.thesis.proposal');
        if ($this->file_proposal != null) {
            $path = $folder . '/' . $this->file_proposal;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
    }

}
