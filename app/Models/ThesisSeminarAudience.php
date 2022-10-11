<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisSeminarAudience extends Model
{
    use HasFactory;

    protected $table = 'thesis_seminar_audiences';
    protected $guarded = [];

    public function seminar()
    {
        return $this->belongsTo(ThesisSeminar::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
