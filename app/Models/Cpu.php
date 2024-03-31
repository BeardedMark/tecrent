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

    // $query = Computer::query();
    // $cpuPower = $this->power;

    // $query->where(function ($query) use ($cpuPower) {
    //     $query->whereHas('cpu', function ($query) use ($cpuPower) {
    //         $query->where('power', '<=', $cpuPower);
    //     });
    // });

    // if ($limit)
    //     $query->limit($limit);

    // return $query->get();

    public function games($limit = null)
    {
        $cpuPower = $this->power;

        $gamesId = [];
        $requirements = Requirement::whereHas('cpus', function ($query) use ($cpuPower) {
            $query->where('power', '<=', $cpuPower);
        })->get();

        foreach ($requirements as $requirement) {
            if ($requirement->game) {
                $gamesId[] = $requirement->game->id;
            }
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
