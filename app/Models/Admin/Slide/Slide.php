<?php

namespace App\Models\Admin\Slide;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Categories\Categories;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slide extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'slug',
        'user_id',
        'categories_id',
        'status',
        'type',
        'thumbnail',
        'order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
