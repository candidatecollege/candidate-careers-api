<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function careers()
    {
        return $this->hasMany(Career::class, 'divisionID');
    }

    public function application()
    {
        return $this->hasMany(Application::class, 'divisionID');
    }
}
