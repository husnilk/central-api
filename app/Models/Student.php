<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const GRADUATED = 2;
    const ON_LEAVE = 3;
    const OUT = 4;

    const STATUS_SELECT = [
        self::ACTIVE => 'Aktif',
        self::GRADUATED => 'Lulus',
        self::ON_LEAVE => 'Cuti',
        self::OUT => 'Keluar/D.O'
    ];

    static $validation_rules = [
        'email' => 'required|email',
        'nim' => 'required',
        'name' => 'required',
        'year' => 'required',
        'photo' => 'nullable|file|image|dimensions:min_width=500'
    ];

    protected $table = 'students';
    protected $guarded = [];
    protected $dates = ['birthday'];
    public $incrementing = false;

    /** Relationship */

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function theses()
    {
        return $this->hasMany(Thesis::class);
    }

    /** Extended Attribute */

    public function getEmailAttribute($value)
    {
        return optional($this->user)->email;
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo != null) {
            return Storage::url(config('central.path.student_photo') . '/' . $this->photo);
        }
        return 'img/default-user.png';
    }

    public function getPhotoUrlSAttribute($value)
    {
        return $this->getPhotoUrl('s');
    }

    public function getPhotoUrlMAttribute($value)
    {
        return $this->getPhotoUrl('m');
    }

    public function getPhotoUrlLAttribute($value)
    {
        return $this->getPhotoUrl('l');
    }

    public function getGenderTextAttribute($value)
    {
        if (empty($this->gender)) {
            return null;
        }
        return data_get(config('central.gender'), $this->gender, null);
    }

    public function getMaritalStatusTextAttribute($value)
    {
        if (empty($this->marital_status)) {
            return null;
        }
        return data_get(config('central.marital_status'), $this->marital_status, null);
    }

    public function getReligionTextAttribute($value)
    {
        if (empty($this->religion)) {
            return null;
        }
        return data_get(config('central.religion'), $this->religion, null);
    }

    public function getStatusTextAttribute($value)
    {
        if (empty($this->status)) {
            return null;
        }
        return data_get(self::STATUS_SELECT, $this->status, null);
    }

    public function getNimNameAttribute($value)
    {
        return $this->nim . ' - ' . $this->name;
    }

    public function getNameNimAttribute($value)
    {
        return $this->name . ' - ' . $this->nim;
    }

    /** Function */

    public function getPhotoUrl($key)
    {
        $size = config('central.photo_size')[$key];
        $folder = config('central.path.student_photo');
        if ($this->photo != null) {
            $path = $folder . '/' . $size . '/' . $this->photo;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return 'img/default_user_' . $key . '.png';
    }
}
