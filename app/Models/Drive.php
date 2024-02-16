<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function title()
    {
        return  ($this->string ? "$this->string " : null) . $this->capacity . "Gb";
    }
}
