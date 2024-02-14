<?php

namespace App\Models\Admin\GroupPost;

use App\Models\User;
use App\Models\Admin\Post\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupPost extends Model
{
    use HasFactory;

    protected $table = 'group_post';

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'order',
        'slug'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function postss()
    {
        return $this->belongsToMany(Post::class);
    }
}
