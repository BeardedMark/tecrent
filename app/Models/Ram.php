<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Ram extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    
    public function computers()
    {
        return $this->hasMany(Computer::class);
    }

    public function imageUrl()
    {
        return asset('storage/img/rams/' . $this->image);
    }
    
    public function getTitle()
    {
        $result = $this->manufacturer . " " . $this->capacity . "Gb";

        if (Auth::user() && Auth::user()->is_admin) {
            $result = "[id:$this->id] " . $result;
        }
        return $result;
    }
}

