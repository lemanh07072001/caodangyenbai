<?php

namespace App\Models\Admin\Categories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Categories extends Model
{
    use HasFactory;


    protected $table = 'categories';

    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'parent_id',
        'status',
        'type',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function children(){
        return $this->hasMany(Categories::class,'parent_id');
    }

    public function subCategories(){
        return $this->children()->with('subCategories');
    }
}
