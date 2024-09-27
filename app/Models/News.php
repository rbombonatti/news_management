<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class News extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'content'];
    protected $table = 'news';

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

}
