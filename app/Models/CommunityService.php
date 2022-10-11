<?php

namespace App\Models;

use App\Traits\UploadModelHandlerTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class CommunityService extends Model
{
    use HasFactory, UploadModelHandlerTrait;

    const VALIDATION_RULES = [
        'title' => 'required',
        'community_service_schema_id' => 'required',
        'partner' => 'required',
        'start_at' => 'required',
        'fund_amount' => 'required|integer',
        'report_file' => 'required'
    ];

    protected $guarded = [];

    public function schema()
    {
        return $this->belongsTo(CommunityServiceSchema::class, 'community_service_schema_id');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'community_service_members')
            ->withPivot('id', 'position')
            ->orderBy('position');
    }

    public function getReportUrlAttribute($value)
    {
        $folder = $this->getFolderPath('report_file');

        if ($this->report_file != null) {
            $path = $folder . '/' . $this->report_file;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
    }

    public function getProposalUrlAttribute($value)
    {
        $folder = $this->getFolderPath('proposal_file');

        if ($this->proposal_file != null) {
            $path = $folder . '/' . $this->proposal_file;
            if (Storage::exists('public/' . $path)) {
                return Storage::url($path);
            }
        }
        return '#';
    }

    /** HELPER FUNCTION */
    private function getFolderPath($fieldname)
    {
        if ($fieldname == 'report_file'){
            return config('central.path.community_services.report_file');
        }
        if($fieldname == 'proposal_file'){
            return config('central.path.community_services.proposal_file');
        }
        return false;
    }
}
