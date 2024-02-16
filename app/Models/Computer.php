<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function drive()
    {
        return $this->belongsTo(Drive::class);
    }

    public function imageUrl()
    {
        return asset('storage/img/computers/' . $this->image);
    }

    public function requirements($limit = null)
    {
        $query = Requirement::query();

        $gpuPower = 0;
        $cpuPower = 0;

        if ($this->gpu) {
            $gpuPower = $this->gpu->power;
        }
        if ($this->cpus) {
            $cpuPower = $this->cpus->power;
        }

        $query->where(function ($query) use ($gpuPower, $cpuPower) {
            $query->where(function ($query) use ($gpuPower) {
                $query->whereHas('gpus', function ($query) use ($gpuPower) {
                    $query->where('power', '<=', $gpuPower);
                });
            })->orWhere(function ($query) use ($gpuPower) {
                $query->doesntHave('gpus');
            });

            $query->where(function ($query) use ($cpuPower) {
                $query->whereHas('cpus', function ($query) use ($cpuPower) {
                    $query->where('power', '<=', $cpuPower);
                });
            })->orWhere(function ($query) use ($cpuPower) {
                $query->doesntHave('cpus');
            });
        });

        if ($limit) {
            $query->limit($limit);
        }

        return $query->get();
    }

    public function games()
    {
        $gamesId = [];
        foreach ($this->requirements() as $requirement) {
            $gamesId[] = $requirement->game->id;
        }
        $gamesId = array_unique($gamesId);
        $games =  Game::whereIn('id', $gamesId)->get();

        return $games;
    }
}
