<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

function formatDate($created_at,$updated_at){
    $timezone = 'Asia/Ho_Chi_Minh';

    $created_at = Carbon::parse($created_at)->setTimezone($timezone)->format('d-m-Y');
    $updated_at = Carbon::parse($updated_at)->setTimezone($timezone)->format('d-m-Y');
    return '<div>
        <div class="timeIndex"><i class="far fa-clock mr-1"></i>'.$created_at.'</div>
         <div class="timeIndex"><i class="far fa-clock mr-1"></i>'.$updated_at.'</div>
    </div>';
}

function formatImage($data){
    if (!empty($data->image->url) && !empty($data->image->title)){
        return '<img src="'.$data->image->url.'" class="prevBox prevImage" alt="'.$data->image->title.'"/>';
    }else{
        return '<img src="/images/noImage.png" class="prevBox prevImage" alt="noImage" height="100px"/>';
    }

}

function formatLinkOrCategories($data){

    if ($data->link != null){
        return '<span class="badge badge-success">'.$data->link.'</span>';
    }else{
        return '<span class="badge badge-primary">'.$data->categories->title.'</span>';
    }
}

function formatWork($id ,$route=''){
    if (Route::has($route.'.edit')){
        return '<div >
                <a href="'.route($route.'.edit',[$id]).'" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                 <button class="btn btn-danger btn-sm btnDelete" data-id="'.$id.'"><i class="fas fa-trash-alt"></i></button>
            </div>';
    }
    return '<div>
                <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                 <button class="btn btn-danger btn-sm btnDelete" data-id="'.$id.'"><i class="fas fa-trash-alt"></i></button>
            </div>';
}

function formatStatus($data){
    $randomNumber = rand(1, 100);

    $idInput = 'customSwitch'.$randomNumber;

    return '
        <div class="d-flex justify-content-center">
            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input statusSelect" id="'.$idInput.'" '.($data === 0 ? "checked":" ").'/>
                <label class="custom-control-label" for="'.$idInput.'"></label>
            </div>
        </div>
        ';
}

function formatTite($data){
    if (!empty($data) && $data != null){
        return '<div class="formatText" data-toggle="tooltip" data-placement="bottom" title="'.$data.'">'.$data.'</div>';
    }
    return  false;
}