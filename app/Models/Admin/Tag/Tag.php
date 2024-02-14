<?php

namespace App\Models\Admin\Tag;

use App\Models\Admin\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
