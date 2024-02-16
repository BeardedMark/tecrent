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
        return $this->hasMany(Requirement::class);
    }

    public function computers()
    {
        $computersId = [];
        foreach ($this->requirements as $requirement) {
            foreach ($requirement->computers() as $computer) {
                $computersId[] = $computer->id;
            }
        }
        $computersId = array_unique($computersId);
        $computers = Computer::whereIn('id', $computersId)->get();

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

    public static function getTableColumns()
    {
        return (new self())->fillable;
    }
}
