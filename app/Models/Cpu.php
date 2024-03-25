<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Cpu extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    // protected $guarded = [];
    protected $fillable = [
        'name',
        'commentary',
        'description',
        'content',
        'image',

        'manufacturer',
        'model',
        'cache',
        'socket',
        'frequency',
        'cores_count',
        'threads_count',
        'power',
    ];

    public function computers()
    {
        return $this->hasMany(Computer::class);
    }

    public function requirements()
    {
        return $this->belongsToMany(Requirement::class, 'requirement_cpu');
    }

    public function games($limit = null)
    {
        $gamesId = [];
        $requirements = $this->requirements()->get();

        foreach ($requirements as $requirement) {
            $gamesId[] = $requirement->game->id;
        }
        $gamesId = array_unique($gamesId);

        $query = Game::whereIn('id', $gamesId);

        if ($limit) {
            $query->take($limit);
        }

        $games = $query->get();

        return $games;
    }

    public function imageUrl()
    {
        return asset('storage/img/cpus/' . $this->image);
    }
    
    public function getTitle()
    {
        $result = "$this->manufacturer $this->name";

        if (Auth::user() && Auth::user()->is_admin) {
            $result = "[id:$this->id] " . $result;
        }
        return $result . " [🗲$this->power]";
    }
}