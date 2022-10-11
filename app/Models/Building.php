<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    const VALIDATION_RULES = [
        'name' => 'required',
        'floors' => 'nullable|integer',
        'build_at' => 'nullable|integer',
    ];

    protected $table = 'buildings';
    protected $guarded = [];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
