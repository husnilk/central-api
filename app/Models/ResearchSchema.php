<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSchema extends Model
{
    use HasFactory;

    const VALIDATION_RULES = [
        'name' => 'required'
    ];

    protected $guarded = [];
    protected $perPage = 30;

    public function research()
    {
        return $this->hasMany(Research::class, 'research_schema_id', 'id');
    }
}
