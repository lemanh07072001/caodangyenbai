<?php
function getCategoriesTable($categories,$char='',&$result=[]){
    $getAllCategoris = App\Helper\getDataBase::getCategories();
    if (!empty($categories)){
        foreach ($categories as $key=>$value){
            $row = $value;
            $row['work'] = formatWork($row['id'],'categories');
            $row['status'] = formatStatus($row['status']);
            $row['parent_name'] = selectAllCategoryIndex($getAllCategoris,$row['id'],$row['parent_id']);
            $row['title'] = $char.$row['title'];

            $row['format_date'] = formatDate($row['created_at'],$row['updated_at']);
            unset($row['sub_categories']);
            $result[] = $row;
            if (!empty($value['sub_categories'])){
                getCategoriesTable($value['sub_categories'],$char.'|---',$result);
            }
        }
    }

    return $result;
}

function showCategoriesSelect($categories,$old='', $parent_id = 0, $char = '')
{
    $id = null;
    if (!empty(request()->route()->parameters['id'])){
        $id = request()->route()->parameters['id'];
    }
    foreach ($categories as $key => $item)
    {
        $select = ($old == $item->id) ? 'selected' : '';

        if ($item->parent_id == $parent_id && $id != $item->id)
        {
            echo '<option value="'.$item->id.'"'.$select.'>';
            echo $char . $item->title;
            echo '</option>';

            // Xóa chuyên mục đã lặp
            unset($categories[$key]);


            showCategoriesSelect($categories,$old, $item->id, $char.'|---');
        }
    }
}


