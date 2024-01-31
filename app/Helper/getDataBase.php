<?php


namespace App\Helper;


use Illuminate\Support\Facades\DB;

class getDataBase
{
    public static function getCategories(){
        return DB::table('categories')->select('id','parent_id','title')->get();
    }
}
