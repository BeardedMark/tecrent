<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Drive extends Model
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
        return asset('storage/img/drives/' . $this->image);
    }

    public function getTitle()
    {
        $result = ($this->type ? "$this->type " : null) . $this->capacity . "Gb";

        if (Auth::user() && Auth::user()->is_admin) {
            $result = "[id:$this->id] " . $result;
        }
        return $result;
    }
}
