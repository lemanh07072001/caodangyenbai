<?php


namespace App\Service\Categories;


use App\Helper\formatData;
use App\Helper\Message;
use App\Models\Admin\Categories\Categories;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ServiceCategorises
{
    public function getData($request){
        $searchInput = $request->input('searchInput');
        $statusSelect = $request->input('statusSelect');


        $categories = Categories::query();
        $categories  = $categories->with(['subCategories'])->whereNull('parent_id')->latest();

        if ($request->has('searchInput') && !empty($searchInput)){
            $categories->where(function ($query) use($searchInput){
                $query->where('title','like','%'.$searchInput.'%');
            });
        }

        if ($request->has('statusSelect') && !empty($statusSelect)){
            $categories->where('status','=',$statusSelect);
        }



        $categories =  DataTables::of($categories)
            ->addIndexColumn()
            ->toArray();


        $categories['data'] = getCategoriesTable($categories['data']);

        return $categories;
    }

    public function store($request){

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'status' => formatData::formatStatus($request->status),
            'type' => $request->type,
            'created_at' => date("Y-m-d H:i:s")
        ];

        $dataStatus = Categories::create($data);
        if ($dataStatus){
            Message::NotificationStatus('add');
            return Message::RedirectRoute('categories.index');
        }else{
            Message::NotificationStatus('error');
            return Message::RedirectRoute();
        }
    }

    public function changeCategories($request,$id){
        $valueInput = $request->value;

        $data = [
            'parent_id' => $valueInput,
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        if ($valueInput === null){
            $data['type'] = 0;
        }else{
            $data['type'] = null;
        }


        $dataStatus = Categories::findOrFail($id)->update($data);

        if ($dataStatus){
            return response()->json([
                'message' => 'Cập nhật thành công!'
            ],200);
        }else{
            return response()->json([
                'message' => 'Lỗi hệ thống vui lòng thử lại sau!'
            ],500);
        }
    }

    public function changeStatus($request,$id){

        $valueChange = $request->value;

        $data = [
            'status' => $valueChange,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $dataStatus = Categories::findOrFail($id)->update($data);

        if ($dataStatus){
            return response()->json([
                'message' => 'Cập nhật thành công!'
            ],200);
        }else{
            return response()->json([
                'message' => 'Lỗi hệ thống vui lòng thử lại sau!'
            ],500);
        }
    }

    public function getFind($id){
        return Categories::findOrFail($id);
    }

    public function update($request,$id){
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'status' => formatData::formatStatus($request->status),
            'type' => $request->type,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $dataStatus = Categories::findOrFail($id)->update($data);
        if ($dataStatus){
            Message::NotificationStatus('edit');
            return Message::RedirectRoute('categories.index');
        }else{
            Message::NotificationStatus('error');
            return Message::RedirectRoute();
        }
    }

    public function destroy($id){
        try {
            $dataStatus = Categories::findOrFail($id)->delete();
            if ($dataStatus){
                return Message::RedirectResponsive(200);
            }else{
                return Message::RedirectResponsive(500);
            }
        }catch (\Illuminate\Database\QueryException $e) {

            if ($e->errorInfo[1] == 1451) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Không thể xóa danh mục này vì có dữ liệu liên kết.'
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Lỗi hệ thống vui lòng thử lại sau!'
                ]);
            }
        }
    }
}
