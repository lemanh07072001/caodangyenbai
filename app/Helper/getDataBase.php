<?php


namespace App\Helper;


use Illuminate\Support\Facades\DB;

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
}
