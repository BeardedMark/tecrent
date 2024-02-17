<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Game extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'commentary',
        'description',
        'content',
        'image',
        'autor',
        'release',
    ];

    public function requirements()
    {
        if (Auth::user() && Auth::user()->is_admin) {
            return $this->hasMany(Requirement::class)->withTrashed();
        } else {
            return $this->hasMany(Requirement::class);
        }
    }
    

    public function computers($limit = null)
    {
        $computersId = [];
        $requirements = $this->requirements()->whereNull('deleted_at')->get();
        foreach ($requirements as $requirement) {
            foreach ($requirement->computers() as $computer) {
                $computersId[] = $computer->id;
            }
        }
        $computersId = array_unique($computersId);
    
        $query = Computer::whereIn('id', $computersId);
    
        if ($limit) {
            $query->take($limit);
        }
    
        $computers = $query->get();
    
        return $computers;
    }
    

    public function title()
    {
        return "$this->name ($this->release, $this->autor)";
    }

    public function imageUrl()
    {
        return asset('storage/img/games/' . $this->image);
    }
}
