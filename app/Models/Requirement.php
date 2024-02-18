<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Requirement extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    // public function games()
    // {
    //     return $this->belongsToMany(Game::class);
    // }

    public function getTitle()
    {
        $result = "$this->name";

        if (Auth::user() && Auth::user()->is_admin) {
            $result = "[id:$this->id] " . $result;
        }
        return $result;
    }

    public function game()
    {
        // return $this->hasOne(Game::class);
        return $this->belongsTo(Game::class);
    }

    public function cpus()
    {
        return $this->belongsToMany(Cpu::class, 'requirement_cpu');
    }

    public function gpus()
    {
        return $this->belongsToMany(Gpu::class, 'requirement_gpu');
    }

    public function computers($limit = null)
    {
        $query = Computer::query();

        $gpuPower = 0;
        $cpuPower = 0;

        if ($this->gpus()->count() > 0) {
            $gpuPower = $this->gpus()->orderBy('power')->first()->power;
        }
        if ($this->cpus()->count() > 0) {
            $cpuPower = $this->cpus()->orderBy('power')->first()->power;
        }

        $driveRequire = $this->drive_require;
        $ramRequire = $this->ram_require;

        $query->where(function ($query) use ($driveRequire, $ramRequire, $gpuPower, $cpuPower) {
            $query->whereHas('gpu', function ($query) use ($gpuPower) {
                $query->where('power', '>=', $gpuPower);
            });

            $query->whereHas('cpu', function ($query) use ($cpuPower) {
                $query->where('power', '>=', $cpuPower);
            });

            $query->whereHas('drive', function ($query) use ($driveRequire) {
                $query->where('capacity', '>=', $driveRequire);
            });

            $query->whereHas('ram', function ($query) use ($ramRequire) {
                $query->whereRaw('capacity * ram_count >= ?', [$ramRequire]);
            });
        });

        if ($limit)
            $query->limit($limit);

        return $query->get();
    }
}
