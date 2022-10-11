<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    public static $validation_rules = [
        'title' => 'required',
        'research_schema_id' => 'required',
        'start_at' => 'required',
        'fund_amount' => 'required|integer',
        'proposal_file' => 'required',
        'report_file' => 'required'
    ];

    public function research_schemas()
    {
        return $this->belongsTo(ResearchSchema::class);
    }

    public function research_members()
    {
        return $this->hasMany(ResearchMember::class, 'research_id', 'id');
    }
}
