<?php


namespace App\Helper;


class formatData
{
    public static function formatStatus($data){
        if ($data === 'on'){
            return 0;
        }else{
            return 1;
        }
    }

    public static function convertStringToArrayImage($data){

        if (is_array($data)){
            $stringData = join(',',$data);
            $arrayData = explode(',',$stringData);
            return  $arrayData;
        }

        return $data;
    }
}
