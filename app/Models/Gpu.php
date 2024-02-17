<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
        $result = "$this->manufacturer $this->name";

        if (Auth::user() && Auth::user()->is_admin) {
            $result = "[id:$this->id] " . $result . " [🗲$this->power]";
        }
        return $result;
    }
}
