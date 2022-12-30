<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    public function proposal()
    {
        $this->belongsTo(InternshipProposal::class, 'proposal_id', 'id');
    }
}
