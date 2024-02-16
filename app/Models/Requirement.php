<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requirement extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    // public function games()
    // {
    //     return $this->belongsToMany(Game::class);
    // }

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
            $gpuPower = $this->gpus()->orderByDesc('power')->first()->power;
        }
        if ($this->cpus()->count() > 0) {
            $cpuPower = $this->cpus()->orderByDesc('power')->first()->power;
        }

        $query->whereHas('gpu', function ($query) use ($gpuPower) {
            $query->where('power', '>=', $gpuPower);
        })->whereHas('cpu', function ($query) use ($cpuPower) {
            $query->where('power', '>=', $cpuPower);
        });

        if ($limit)
            $query->limit($limit);

        return $query->get();
    }
}
