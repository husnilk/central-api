<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSchedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'class_id',
        'room_id',
        'weekday',
        'start_at',
        'end_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'class_id' => 'integer',
        'room_id' => 'integer',
    ];

    public function classcourse()
    {
        return $this->belongsTo(ClassCourse::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
