<?php

namespace App\Http\Resources;

use App\Models\Department;
use App\Models\Division;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'full name' => $this->full_name,
            'university' => $this->university,
            'major' => $this->major,
            'instagram' => $this->instagram,
            'whatsapp' => $this->whatsapp,
            'division' => $this->getDivision($this->divisionID),
            'department' => $this->getDepartment($this->departmentID),
            'reason' => $this->reason,
            'leadership_experiences' => $this->leadership_experience,
            'skill_experiences' => $this->skill_experience,
            'busyness' => $this->busyness,
            'commitment_value' => $this->commitment_value,
            'reason_of_commitment_value' => $this->reason_commitment_value,
            'CV' => $this->cv,
            'portfolio' => $this->portfolio,
            'is_available_for_unpaid' => $this->avaliableForUnpaid($this->is_available_for_unpaid),
            'application time' => date_format($this->created_at, 'Y-m-d H:i:s'),
        ];
    }

    public function getDivision($id)
    {
        $division = Division::find($id);

        return $division ? $division->name : null;
    }

    public function getDepartment($id)
    {
        $department = Department::find($id);

        return $department ? $department->name : null;
    }

    public function avaliableForUnpaid($unpaid)
    {
        return $unpaid ? "Yes" : "No";
    }
}
