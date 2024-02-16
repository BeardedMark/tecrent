<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    
    public function title()
    {
        return "$this->manufacturer $this->capacity" . "Gb" . ($this->count ? " x$this->count" : null);
    }
}

