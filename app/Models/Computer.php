<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Computer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function gpu()
    {
        return $this->belongsTo(Gpu::class);
    }
    public function cpu()
    {
        return $this->belongsTo(Cpu::class);
    }
    public function ram()
    {
        return $this->belongsTo(Ram::class);
    }

    public function getRamTitle()
    {
        $result = $this->ram->getTitle() . (($this->ram_count > 1) ? ' x' . $this->ram_count : null);

        if (Auth::user() && Auth::user()->is_admin) {
            $result = $result . " [🗲" . $this->ramPower() . "]";
        }
        return $result;
    }

    public function drive()
    {
        return $this->belongsTo(Drive::class);
    }
    public function ramPower()
    {
        return $this->ram->capacity * $this->ram_count;
    }


    public function imageUrl()
    {
        return asset('storage/img/computers/' . $this->image);
    }

    public function requirements($limit = null)
    {
        $query = Requirement::query();

        $gpuPower = $this->gpu ? $this->gpu->power : 0;
        $cpuPower = $this->cpu ? $this->cpu->power : 0;

        $query->where(function ($query) use ($gpuPower, $cpuPower) {

            $query->whereHas('gpus', function ($query) use ($gpuPower) {
                $query->where('power', '<=', $gpuPower);
            });

            $query->whereHas('cpus', function ($query) use ($cpuPower) {
                $query->where('power', '<=', $cpuPower);
            });

            // $query->where(function ($query) use ($gpuPower) {
            //     $query->whereHas('gpus', function ($query) use ($gpuPower) {
            //         $query->where('power', '<=', $gpuPower);
            //     })->doesntHave('gpus');
            // })->orWhere(function ($query) use ($gpuPower) {
            //     $query->whereDoesntHave('gpus');
            // });

            // $query->where(function ($query) use ($cpuPower) {
            //     $query->whereHas('cpus', function ($query) use ($cpuPower) {
            //         $query->where('power', '<=', $cpuPower);
            //     });
            // })->orWhere(function ($query) use ($cpuPower) {
            //     $query->doesntHave('cpus');
            // });
        });

        $driveRequire = $this->drive ? $this->drive->capacity : 0;
        $ramRequire = ($this->ram ? $this->ram->capacity : 0) * $this->ram_count;

        // $query->where(function ($query) use ($driveRequire, $ramRequire) {

        //     $query->where(function ($query) use ($driveRequire) {
        //         $query->where('drive_require', '<=', $driveRequire);
        //     });

        //     $query->where(function ($query) use ($ramRequire) {
        //         $query->where('ram_require', '<=', $ramRequire);
        //     });
        // });

        $query->when($limit, function ($query, $limit) {
            return $query->limit($limit);
        });

        return $query->get();
    }


    public function games($limit = null)
    {
        $gamesId = [];
        foreach ($this->requirements() as $requirement) {
            $gamesId[] = $requirement->game->id;
        }
        $gamesId = array_unique($gamesId);
        $games =  Game::whereIn('id', $gamesId);

        $games->when($limit, function ($query, $limit) {
            return $query->limit($limit);
        });

        return $games->inRandomOrder()->get();
    }
}
