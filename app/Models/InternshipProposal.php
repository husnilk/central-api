<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipProposal extends Model
{
    use HasFactory;

    protected $table = 'internship_proposals';
    protected $guarded = [];

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }

    public function agency()
    {
        return $this->belongsTo(InternshipAgency::class);
    }

}
