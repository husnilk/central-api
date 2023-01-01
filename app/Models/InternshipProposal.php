<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipProposal extends Model
{
    use HasFactory;

    protected $table = 'internship_proposals';
    protected $guarded = [];

    const STATUS_DRAFT = 0;
    const STATUS_SUBMITTED = 1;
    const STATUS_APPROVED = 2;
    const STATUS_REVISION = 3;
    const STATUS_ACCEPTED = 4;
    const STATUS_REJECTED = 5;
    const STATUS_CANCELLED = 6;

    const STATUSES = [
        self::STATUS_DRAFT => 'Draft',
        self::STATUS_SUBMITTED => 'Submitted',
        self::STATUS_APPROVED => 'Disetujui',
        self::STATUS_REVISION => 'Revisi',
        self::STATUS_ACCEPTED => 'Diterima',
        self::STATUS_REJECTED => 'Ditolak',
        self::STATUS_CANCELLED => 'Dibatalkan',
    ];

    public function internships()
    {
        return $this->hasMany(Internship::class, 'id', 'internship_id');
    }

    public function agency()
    {
        return $this->belongsTo(InternshipAgency::class, 'id', 'agency_id');
    }
}
