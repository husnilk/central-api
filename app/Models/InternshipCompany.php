<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipCompany extends Model
{
    use HasFactory;

    protected $table = 'internship_companies';
    protected $guarded = [];

    public function proposals()
    {
        return $this->hasMany(InternshipProposal::class, 'id', 'company_id');
    }
}
