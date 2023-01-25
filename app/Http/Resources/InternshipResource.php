<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InternshipResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'company' => new CompanyResource($this->proposal->company),
            'title' => $this->title,
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'status' => $this->status,
            'supervisor' => new SupervisorResource($this->supervisor),
            'supervisor_name' => $this->supervisor ? $this->supervisor->name : '-',
            'grade' => $this->grade,
        ];
    }
}
