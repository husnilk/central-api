<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipAgency extends Model
{
    use HasFactory;

    protected $table = 'internship_agencies';
    protected $guarded = [];

    public function proposals()
    {
        return $this->hasMany(InternshipProposal::class);
    }
}
