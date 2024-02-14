<?php


namespace App\Helper;


use App\Models\Admin\Slide\Slide;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Banner\Banner;

class getDataBase
{
    public static function getCategories()
    {
        return DB::table('categories')->select('id', 'parent_id', 'title')->get();
    }

    public static function getUser()
    {
        return DB::table('users')->select('id', 'name')->get();
    }

    public static function getOrderBanner(){
        return Banner::pluck('order')->toArray();
    }

    public static function getOrderSlide(){
        return Slide::pluck('order')->toArray();
    }
}