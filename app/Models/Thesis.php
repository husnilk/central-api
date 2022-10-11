<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;
use const Grpc\STATUS_CANCELLED;

class Thesis extends Model
{
    use HasFactory;

    const PENGAJUAN_PEMBIMBING = 0;
    const BIMBINGAN_PROPOSAL = 5;
    const SEMINAR_PROPOSAL = 10;
    const BIMBINGAN_TA = 15;
    const SEMINAR_HASIL = 20;
    const BIMBINGAN_SIDANG = 25;
    const SIDANG = 30;
    const SELESAI = 35;
    const BATAL = 99;

    const STATUS_SELECT = [
        self::PENGAJUAN_PEMBIMBING => 'Pengajuan Pembimbing',
        self::BIMBINGAN_PROPOSAL => 'Bimbingan Proposal',
        self::SEMINAR_PROPOSAL => 'Seminar Proposal',
        self::BIMBINGAN_TA => 'Bimbingan TA',
        self::SEMINAR_HASIL => 'Seminar Hasil',
        self::BIMBINGAN_SIDANG => 'Persiapan Sidang',
        self::SIDANG => 'Sidang',
        self::SELESAI => 'Selesai',
        self::BATAL => 'Batal'
    ];

    const VALIDATION_RULES = [
        'topic_id' => 'required',
        'student_id' => 'required',
        'title' => 'required',
        'abstract' => 'required',
        'start_at' => 'required',
        'status' => 'required'
    ];

    protected $table = 'theses';
    protected $guarded = [];
    protected $dates = ['start_at'];

    /** RELATIONSHIP */
    public function topic()
    {
        return $this->belongsTo(ThesisTopic::class, 'topic_id', 'id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function supervisors()
    {
        return $this->belongsToMany(Lecturer::class, 'thesis_supervisors')
            ->using(ThesisSupervisor::class)
            ->withPivot('id', 'position', 'status', 'created_by')
            ->withTimestamps()
            ->orderBy('position');
    }

    public function logbooks()
    {
        return $this->hasMany(ThesisLogbook::class);
    }

    public function proposals()
    {
        return $this->hasMany(ThesisProposal::class, 'thesis_id', 'id');
    }

    public function proposal()
    {
        return $this->hasOne(ThesisProposal::class, 'thesis_id', 'id')->orderBy('datetime', 'desc');
    }

    public function seminars()
    {
        return $this->hasMany(ThesisSeminar::class, 'thesis_id', 'id');
    }

    public function seminar()
    {
        return $this->hasOne(ThesisSeminar::class, 'thesis_id', 'id')->orderBy('registered_at', 'desc');
    }

    public function trials()
    {
        return $this->hasMany(ThesisTrial::class, 'thesis_id', 'id');
    }

    public function trial()
    {
        return $this->hasOne(ThesisTrial::class, 'thesis_id', 'id')->orderBy('registered_at', 'desc');
    }

    /** QUERY SCOPE */
    public function scopeOnGoing($query)
    {
        return $query->where('status', '<', Thesis::SELESAI)
            ->where('status', '>', Thesis::PENGAJUAN_PEMBIMBING);
    }

    public function scopeOnFinal($query)
    {
        return $query->whereIn('status', [
            Thesis::SIDANG,
            Thesis::SELESAI
        ]);
    }

    /** EXTENDED ATTRIBUTE */
    public function getTitleTextAttribute()
    {
        if(!empty($this->title)){
            return $this->title;
        }
        return '~~ Belum ada judul 😪 ~~';
    }

    public function getStatusTextAttribute()
    {
        if(isset($this->status)){
            return data_get(self::STATUS_SELECT, $this->status, '-');
        }
    }

    public function getStatusTypeAttribute()
    {
        return 'primary';
    }

    /** FUNCTION */
    public static function thesisList(int $count)
    {
        return self::onGoing()->paginate($count);
    }

    public function isOwnedBy($id){
        return $this->student_id == $id;
    }

    public function isSupervisedBy($id)
    {
        return $this->supervisors->where('id', $id)->count() > 0;
    }

    public function isEditable()
    {
        return $this->status != self::BATAL && $this->status != self::SELESAI;
    }

    public function isProposalEditable()
    {
        return in_array($this->status, [
            self::BIMBINGAN_PROPOSAL,
            self::SEMINAR_PROPOSAL,
            self::BIMBINGAN_TA
        ]);
    }

    public function isSeminarEditable()
    {
        return in_array($this->status, [
            self::BIMBINGAN_TA,
            self::SEMINAR_HASIL,
            self::BIMBINGAN_SIDANG,
        ]);
    }

    public function isTrialEditable()
    {
        return in_array($this->status, [
            self::BIMBINGAN_SIDANG,
            self::SIDANG
        ]);
    }
}
