<?php

namespace App\Http\Resources;

use App\Models\Department;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\Resources\Json\JsonResource;

class CareerResource extends JsonResource
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
            'division' => $this->getDivsion($this->divisionID),
            'department' => $this->getDepartment($this->departmentID),
            'position' => $this->getPosition($this->positionID),
            'name' => $this->name,
            'type' => $this->type,
            'is_urgently_needed' => $this->getUrgentlyNeeded($this->is_urgently_needed),
            'responsibilities' => $this->responsibilities,
            'skill_qualifications' => $this->skill_qualifications,
            'benefits' => $this->benefits,
            'descriptions' => $this->descriptions,

        ];
    }

    public function getDivsion($id)
    {
        $division = Division::find($id);

        return $division ? $division->name : null;
    }

    public function getDepartment($id)
    {
        $department = Department::find($id);

        return $department ? $department->name : null;
    }

    public function getPosition($id)
    {
        $position = Position::find($id);

        return $position ? $position->name : null;
    }

    public function getUrgentlyNeeded($urgent)
    {
        return $urgent ? "Yes" : "No";
    }
}
