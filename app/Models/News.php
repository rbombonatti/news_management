<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title', 'description', 'category_id'];
    protected $table = 'news';

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWithRelations($query)
    {
        return $query->with([
            'category' => function ($query) {
                $query->withTrashed();
            },
            'tags' => function ($query) {
                $query->withTrashed();
            },
        ]);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%");
        })
            ->orWhereHas('category', function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%");
            })
            ->orWhereHas('tags', function ($query) use ($search) {
                $query->where('slug', 'LIKE', "%{$search}%");
            });
    }

}
