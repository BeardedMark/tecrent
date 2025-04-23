<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Http\Request;

class Offer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'price', 'code', 'unit', 'stock', 'min', 'step', 'max', 'sale',
        'name', 'description', 'content', 'comment', 'tags', 'type', 'group',
        'template', 'rating', 'data',
        'image', 'wallpaper', 'gallery', 'video', 'link',
        'meta_title', 'meta_description', 'meta_keywords', 'meta_favicon',
        'published_at', 'archived_at', 'main_at', 'favorited_at'
    ];

    protected $casts = [
        'data' => 'json',
        'gallery' => 'array',
        'published_at' => 'datetime',
        'archived_at' => 'datetime',
        'main_at' => 'datetime',
        'favorited_at' => 'datetime',
    ];

    public static function search(Request $request)
    {
        $query = self::query();
        $columns = (new self)->getFillable();
        $hasConditions = false;

        foreach ($request->all() as $field => $value) {
            if (in_array($field, $columns) && !empty($value)) {
                $hasConditions = true;

                if (is_string($value) && str_starts_with($value, '!')) {
                    $excludedValue = substr($value, 1);
                    $query->where($field, 'NOT LIKE', "%{$excludedValue}%");
                } else {
                    $query->where($field, 'LIKE', "%{$value}%");
                }
            }
        }

        // Поиск по всему тексту (параметр "substring")
        if ($request->filled('substring')) {
            $substring = $request->input('substring');
            $query->where(function ($subQuery) use ($columns, $substring) {
                foreach ($columns as $column) {
                    $subQuery->orWhere($column, 'LIKE', "%{$substring}%");
                }
            });
            $hasConditions = true;
        }

        $query->orderBy('updated_at', 'desc');

        return $hasConditions ? $query->get() : null;
    }



    public static function getUniqueTypes()
    {
        return self::whereNotNull('type')->distinct()->pluck('type')->sort()->values()->toArray();
    }

    public static function getUniqueGroups()
    {
        return self::whereNotNull('group')->distinct()->pluck('group')->sort()->values()->toArray();
    }

    public static function getUniqueTags()
    {
        return self::whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(function ($tags) {
                return array_map('trim', explode(',', $tags));
            })
            ->unique()
            ->sort()
            ->values()
            ->toArray();
    }

    public function incrementViews(): void
    {
        $this->increment('stat_views');
    }

    public static function getByType(string $type)
    {
        return self::where('type', $type);
    }

    public static function getFavorited()
    {
        return self::whereNotNull('favorited_at');
    }

    public static function getSale()
    {
        return self::whereNotNull('sale');
    }

    public static function getLatestMain()
    {
        return self::whereNotNull('main_at')->orderByDesc('main_at')->first();
    }

    public function getName(): string
    {
        return $this->name ?? $this->id;
    }

    public function getTags(): array
    {
        return explode(',', $this->tags);
    }

    public function getData(): array
    {
        return $this->data ? json_decode($this->data, true) : [];
    }

    public function scopeFilterByTags($query, $tagsString)
    {
        if (!$tagsString) {
            return $query; // Если тегов нет, возвращаем весь запрос без фильтрации
        }

        $tags = explode(',', $tagsString);

        return $query->where(function ($query) use ($tags) {
            foreach ($tags as $tag) {
                $query->where('tags', 'like', "%{$tag}%");
            }
        });
    }

    public function getRandomOffers(int $count = 6)
    {
        return self::where('id', '!=', $this->id)
            ->inRandomOrder()
            ->limit($count)
            ->get();
    }
}
