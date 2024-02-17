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
        $query = Requirement::query()->with('gpus', 'cpus');

        $gpuPower = $this->gpu ? $this->gpu->power : 0;
        $cpuPower = $this->cpus ? $this->cpus->power : 0;

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

        $driveRequire = $this->drive->capacity;
        $ramRequire = $this->ram->capacity;

        $query->where(function ($query) use ($driveRequire, $ramRequire) {

            $query->where(function ($query) use ($driveRequire) {
                $query->where('drive_require', '<=', $driveRequire);
            });

            $query->where(function ($query) use ($ramRequire) {
                $query->where('ram_require', '<=', $ramRequire);
            });
        });

        // $query->where(function ($query) use ($driveRequire) {
        //     $query->whereHas('drive_require')->where('drive_require', '<=', $driveRequire);
        // })->orWhere(function ($query) use ($ramRequire) {
        //     $query->whereHas('drive_require')->where('drive_require', '<=', $driveRequire);
        // });

        $query->when($limit, function ($query, $limit) {
            return $query->limit($limit);
        });

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
