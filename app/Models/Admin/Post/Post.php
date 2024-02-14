<?php

namespace App\Models\Admin\Post;

use App\Models\User;
use App\Models\Admin\Tag\Tag;
use App\Models\Admin\PostTag\PostTag;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Categories\Categories;
use App\Models\Admin\GroupPost\GroupPost;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'view_count',
        'like_count',
        'thumbnail',
        'status',
        'tags',
        'user_id',
        'description',
        'categories_id'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }

    public function groupposts()
    {
        return $this->belongsToMany(GroupPost::class);
    }
}
