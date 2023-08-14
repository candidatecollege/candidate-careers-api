<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function division()
    {
        return $this->belongsTo(Division::class, 'divisionID', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'departmentID', 'id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'positionID', 'id');
    }
}
