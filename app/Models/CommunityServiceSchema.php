<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityServiceSchema extends Model
{
    use HasFactory;

    const VALIDATION_RULES = [
        'name' => 'required'
    ];

    protected $guarded = [];

    public function research()
    {
        return $this->hasMany(CommunityService::class, 'community_service_schema_id', 'id');
    }
}
