<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, HasRoles;

    const STUDENT = 1;
    const LECTURER = 2;
    const STAFF = 3;

    protected $fillable = [
        'username', 'name', 'email', 'password', 'type', 'active'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function logins()
    {
        return $this->hasMany(UserLogin::class, 'user_id', 'id');
    }

    public function civitas()
    {
        switch ($this->type) {
            case self::STUDENT:
                return $this->hasOne(Student::class, 'id');
            case self::LECTURER:
                return $this->hasOne(Lecturer::class, 'id');
            case self::STAFF:
                return $this->hasOne(Staff::class, 'id');
        }
        return null;
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'id');
    }

    public function lecturer()
    {
        return $this->hasOne(Lecturer::class, 'id');
    }

    public function staff()
    {
        return $this->hasOne(Staff::class, 'id');
    }

//
//    public function families()
//    {
//        return $this->hasMany(FamilyMember::class, 'id', 'user_id');
//    }
//
//    public function educations()
//    {
//        return $this->hasMany(UserEducation::class, 'id', 'user_id');
//    }
//
//

    /** Getter & Setter */

    /** Extended Attribute */

    public function getIdNameAttribute($value)
    {
        return $this->username. ' - ' . $this->name;
    }

    public function getTypeTextAttribute($value)
    {
        if ($this->type == self::STUDENT) {
            return 'Mahasiswa';
        } elseif ($this->type == self::LECTURER) {
            return 'Dosen';
        } else {
            return 'Tendik';
        }
    }

    public function getAvatarUrlAttribute($value)
    {
        if (!empty($this->avatar)) {
            return Storage::url(config('central.path.avatar') . '/' . $this->avatar);
        }
        return 'img/default-user.png';
    }
}
