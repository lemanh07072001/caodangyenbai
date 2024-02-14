<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

function nextPage($nameRoute = '')
{
    if (!empty($nameRoute)) {
        $routeCreate = $nameRoute . '.create';
        $routeIndex = $nameRoute . '.index';
        if (request()->routeIs($routeIndex)) {
            if (Route::has($routeCreate)) {
                return '<a href="' . route($routeCreate) . '" target="_blank" class="btn btn-success btn-sm float-right">Thêm dữ liệu &nbsp <i class="fas fa-plus"></i></a>';
            }
        } else {
            if (Route::has($routeIndex)) {
                return '<a href="' . route($routeIndex) . '" class="btn btn-warning btn-sm float-right" >Quay lại  &nbsp <i class="fas fa-sign-out-alt"></i></a>';
            }
        }


        return false;
    }

    return false;
}


function selectAllCategoryIndex($categories, $ids, $parent_id, $isCheck = true)
{

    $html = '';
    $html .= '<select data-id="' . $ids . '" class="form-control form-control-sm changeCategories">';
    if ($isCheck) {
        $html .= '<option value="">Danh mục cha</option>';
    }
    $html .= showCategoriesSelectIndex($categories, $ids, $parent_id);
    $html .= '</select>';
    return $html;
}

function showCategoriesSelectIndex($categories, $id = null, $old = '', $parent_id = 0, $char = '')
{

    $result = '';

    foreach ($categories as $key => $item) {
        $select = ($old == $item->id) ? 'selected' : '';

        if ($item->parent_id == $parent_id && $id != $item->id) {

            $result .= '<option value="' . $item->id . '"' . $select . '>';
            $result .= $char . $item->title;
            $result .= '</option>';

            // Remove the category that has been iterated


            $result .= showCategoriesSelectIndex($categories, $id, $old, $item->id, $char . '|---');
        }
    }

    return $result;
}

function showOrderBannerList()
{
    $arrayData = [
        'banner_1' => 'Banner Chính 1',
        'banner_2' => 'Banner Chính 2',
        'banner_2_right_1' => '|--Banner Chính 2 Phải 1',
        'banner_3' => 'Banner Chính 3',
        'banner_3_right_1' => '|--Banner Chính 3 Phải 1',
        'banner_3_right_2' => '|--Banner Chính 3 Phải 2',
        'banner_3_right_3' => '|--Banner Chính 3 Phải 3',
    ];

    return $arrayData;
}

function showOrderSlideList()
{
    $arrayData = [
        'slide_1' => 'Slide 1',
        'slide_2' => 'Slide 2',
    ];

    return $arrayData;
}
