<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ThesisLogbook extends Model
{
    use HasFactory;

    protected $table = 'thesis_logbooks';
    protected $guarded = [];

    const SUBMITTED = 0;
    const OK = 1;
    const NOT_OK = 2;

    const VALIDATION_RULES = [
        'date' => 'required',
        'progress'  => 'required',
        'status' => 'required'
    ];

    const STATUSES = [
        self::SUBMITTED => 'Submitted',
        self::OK => 'OK',
        self::NOT_OK => 'Not OK'
    ];

    protected $dates = ['date'];


    public function thesis(){
        return $this->belongsTo(Thesis::class,'thesis_id','id');
    }

    public function supervisor()
    {
        return $this->belongsTo(ThesisSupervisor::class,'supervisor_id','id');
    }

    /** EXTENDED ATTRIBUTE */

    public function getStatusTypeAttribute($value)
    {
        if($this->status == self::OK)
            return 'success';
        elseif ($this->status == self::NOT_OK)
            return 'success';
        else
            return 'info';
    }

    public function getStatusTextAttribute($value)
    {
        return data_get(self::STATUSES, $this->status, null);
    }

    public function getProgressUrlAttribute($value)
    {
        $folder = config('central.path.thesis.logbook');
        if ($this->file_progress != null) {
            $path = $folder . '/' . $this->file_progress;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
    }

    public static function thesisLogbookList(int $thesis_id,int $count)
    {
        $thesisLogbooks = self::where('thesis_id', $thesis_id)
            ->paginate($count);
        $thesisLogbooks->each(function ($thesisLogbook) {
            return $thesisLogbook->status = self::$status[$thesisLogbook->status];
        });
        return $thesisLogbooks;
    }

    /** FUNCTION */
    public function isOwnedBy($user_id)
    {
        return $this->thesis->student_id == $user_id;
    }

    public function getShortProgress($n=50)
    {
        return Str::limit($this->progress, $n);
    }

}
