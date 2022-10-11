<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ThesisSupervisor extends Pivot
{
    use HasFactory;

    const VALIDATION_RULES  = [
        'lecturer_id' => 'required',
        'position' => 'required'
    ];

    public $incrementing = true;
    protected $table = 'thesis_supervisors';
    protected $guarded = [];

    const PEMBIMBING_TUNGGAL = 1;
    const PEMBIMBING_UTAMA = 2;
    const PEMBIMBING_PENDAMPING = 3;

    const SUBMITTED = 0;
    const ACCEPTED = 1;
    const REJECTED = 2;

    const STATUS_SELECT = [
        self::SUBMITTED => 'Submitted',
        self::ACCEPTED => 'Diterima',
        self::REJECTED => 'Ditolak'
    ];

    const POSITION_SELECT = [
        self::PEMBIMBING_TUNGGAL => 'Pembimbing Tunggal',
        self::PEMBIMBING_UTAMA => 'Pembimbing Utama',
        self::PEMBIMBING_PENDAMPING => 'Pembimbing Pendamping'
    ];

    protected $fillable = [
        'thesis_id',
        'lecturer_id',
        'position',
        'status',
    ];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class, 'thesis_id');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id');
    }

    /** SCOPE */
    public function scopeWhereAccepted($query)
    {
        return $query->where('status', self::ACCEPTED);
    }

    /** EXTENDED ATTRIBUTE */
    public function getPositionTextAttribute($value)
    {
        return data_get(self::POSITION_SELECT, $this->position, "-");
    }

    /** FUNCTION */
    public function position_text()
    {
        return data_get(self::POSITION_SELECT, $this->position, "-");
    }

    public function isSubmitted()
    {
        return $this->status == self::SUBMITTED;
    }

    public function isRejected()
    {
        return $this->status == self::REJECTED;
    }

    public function isAccepted()
    {
        return $this->status == self::ACCEPTED;
    }
}
