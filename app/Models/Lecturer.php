<?php

namespace App\Models;

use App\Traits\UploadFileTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Lecturer extends Model
{
    use HasFactory;

    public static $validation_rules = [
        'email' => 'required|email',
        'nidn' => 'required',
        'name' => 'required',
        'nik' => 'required',
        'birthday' => 'required',
        'birthplace' => 'required',
        'photo' => 'nullable|file|image|dimensions:min_width=500'
    ];

    /** CONST */
    const TETAP_PNS = 1;
    const TETAP_NON_PNS = 2;
    const LUAR_BIASA = 3;

    const ASSOCIATION_SELECT = [
        self::TETAP_PNS => 'Dosen Tetap PNS',
        self::TETAP_NON_PNS => 'Dosen Tetap Non PNS',
        self::LUAR_BIASA => 'Dosen Luar Biasa',
    ];

    const ACTIVE = 1;
    const PENSION = 2;
    const ON_DUTY = 3;
    const INACTIVE = 4;

    const STATUS_SELECT = [
        self::ACTIVE => 'Aktif',
        self::PENSION => 'Pensiun',
        self::ON_DUTY => 'Tugas Belajar',
        self::INACTIVE => 'KELUAR'
    ];

    protected $guarded = [];
    protected $casts = ['birthday'];
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

    /** Extendted Attribute */

    public function getEmailAttribute($value)
    {
        return optional($this->user)->email;
    }

    public function getPhotoUrlAttribute()
    {
        if ($this->photo != null) {
            return Storage::url(config('central.path.lecturer_photo') . '/' . $this->photo);
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

    public function getAssociationTypeTextAttribute($value)
    {
        if (empty($this->association_type)) {
            return null;
        }
        return data_get(self::ASSOCIATION_SELECT, $this->association_type, null);
    }

    public function getNipNameAttribute($value)
    {
        return $this->nip . ' - ' . $this->name;
    }

    /** Function */

    public function getPhotoUrl($key)
    {
        $size = config('central.photo_size')[$key];
        $folder = config('central.path.lecturer_photo');
        if ($this->photo != null) {
            $path = $folder . '/' . $size . '/' . $this->photo;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return 'img/default_user_' . $key . '.png';
    }



//    public function thesisTrial()
//    {
//        return $this->belongsToMany(ThesisTrial::class, 'thesis_examiners', 'lecturer_id', 'thesis_trial_id');
//    }
//
//
//    public function thesis()
//    {
//        return $this->belongsToMany(Thesis::class, 'thesis_supervisors', 'lecturer_id', 'thesis_id');
//    }

}
