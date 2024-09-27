<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
    use HasFactory;
    protected $fillable = ['news_id', 'tag_id'];
    protected $table = 'news_tag';
    public $timestamp = false;
}
