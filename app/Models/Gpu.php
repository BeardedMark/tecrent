<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gpu extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    
    public function computers()
    {
        return $this->hasMany(Computer::class);
    }
    
    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'requirement_gpu');
    }
    
    public function imageUrl()
    {
        return asset('storage/img/gpus/' . $this->image);
    }

    public function title()
    {
        return "$this->manufacturer $this->name" ;
    }
}
