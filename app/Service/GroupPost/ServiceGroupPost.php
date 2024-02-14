<?php


namespace App\Service\GroupPost;

use App\Helper\Message;
use App\Helper\formatData;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin\GroupPost\GroupPost;
use App\Models\Admin\Post\Post;
use Illuminate\Support\Facades\Validator;

class ServiceGroupPost
{
    public function getData($request)
    {
        $searchInput = $request->input('searchInput');
        $statusSelect = $request->input('statusSelect');
        $searchUsert = $request->input('searchUser');
        $filer = [];


        $groupPost = GroupPost::query();
        $groupPost->with(['user']);

        if ($request->has('searchInput') && !empty($searchInput)) {
            $groupPost->where(function ($query) use ($searchInput) {
                $query->where('title', 'like', '%' . $searchInput . '%');
            });
        }

        if ($request->has('statusSelect') && !empty($statusSelect)) {
            if ($statusSelect == 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            $filer[] = ['status', '=', $status];
        }


        if ($request->has('searchUser') && !empty($searchUsert)) {
            $filer[] = ['user_id', '=', $searchUsert];
        }

        if (!empty($filer)) {
            $groupPost = $groupPost->where($filer);
        }

        return DataTables::of($groupPost)

            ->editColumn('title', function ($data) {
                return formatTite($data->title, true);
            })
            ->editColumn('addPost', function ($data) {
                return '<a href="' . route('groupPost.listPost', $data->id) . '" class="badge badge-primary">Thêm tin tức</a>';
            })
            ->editColumn('user_id', function ($data) {
                return $data->user->name;
            })
            ->editColumn('status', function ($data) {
                return formatStatus($data->status);
            })
            ->editColumn('date', function ($data) {
                return formatDate($data->created_at, $data->updated_at);
            })
            ->editColumn('work', function ($data) {
                return formatWork($data->id, 'groupPost');
            })
            ->rawColumns(['title', 'status', 'date', 'work', 'addPost'])
            ->make(true);
    }

    public function store($request)
    {
        // Lấy dữ liệu trước khi thêm
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'order' => $request->order,
            'status' => formatData::formatStatus($request->status),
            'user_id' => Auth::id(),
            'created_at' => date("Y-m-d H:i:s")
        ];

        // Xử lý thêm dữ liệu
        $dataStatus = GroupPost::create($data);

        if ($dataStatus) {
            // Hiện thông báo thêm thành công
            Message::NotificationStatus('add');

            return Message::RedirectRoute('groupPost.index');
        } else {
            // Hiện thông báo lỗi
            Message::NotificationStatus('error');
            return Message::RedirectRoute();
        }
    }

    public function getTitle($id)
    {
        //   Lấy một dữ liệu
        $getTitle = GroupPost::findOrFail($id);
        if ($getTitle) {
            //  Thông báo thành công
            return response()->json(['data' => $getTitle]);
        } else {
            //  Thông báo thất bại
            return response()->json(['errors' => 'Lỗi hệ thống vui lòng thử lại sau']);
        }
    }

    public function updateTitle($request, $id)
    {
        // Lấy dữ liệu Ajax gửi lên
        $valueTitle = $request->title;

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|string|unique:group_post,title,' . $id,
        ], [
            'title.required' => ':attribute không được để trống',
            'title.string' => ':attribute phải là kiểu chuỗi',
            'title.max' => ':attribute không được quá :max ký tự',
            'title.unique' => ':attribute đã tồn tại trong hệ thống',
        ], [
            'title' => 'Nhóm tin tức',
        ]);

        if ($validator->passes()) {
            $dataStatus = GroupPost::findOrFail($id)->update(['title' => $valueTitle]);
            if ($dataStatus) {
                return response()->json(['success' => 'Cập nhật thành công.'], 200);
            }
            return response()->json(['success' => 'Lỗi hệ thống vui lòng tử lại sau.'], 500);
        }

        return response()->json(['errors' => $validator->errors()]);
    }

    public function changeStatus($request, $id)
    {
        // Lấy dữ liệu Ajax gửi lên
        $valueChange = $request->value;

        $data = [
            'status' => $valueChange,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        //  Xử lý update dữ liệu
        $dataStatus = GroupPost::findOrFail($id)->update($data);

        if ($dataStatus) {
            //  Thông báo thành công
            return response()->json([
                'message' => 'Cập nhật thành công!'
            ], 200);
        } else {
            //  Thông báo thất bại
            return response()->json([
                'message' => 'Lỗi hệ thống vui lòng thử lại sau!'
            ], 500);
        }
    }

    public function getFind($id)
    {
        return GroupPost::findOrFail($id);
    }

    public function update($request, $id)
    {
        // Lấy dữ liệu trước khi thêm
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'order' => $request->order,
            'status' => formatData::formatStatus($request->status),
            'user_id' => Auth::id(),
            'updated_at' => date("Y-m-d H:i:s")
        ];

        // Xử lý thêm dữ liệu
        $dataStatus = GroupPost::findOrFail($id)->update($data);

        if ($dataStatus) {
            // Hiện thông báo thêm thành công
            Message::NotificationStatus('edit');

            return Message::RedirectRoute('groupPost.index');
        } else {
            // Hiện thông báo lỗi
            Message::NotificationStatus('error');
            return Message::RedirectRoute();
        }
    }

    public function destroy($id)
    {
        $dataStatus = GroupPost::findOrFail($id)->delete();

        if ($dataStatus) {
            return response()->json([
                'message' => 'Xóa dữ liệu thành công!'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Lỗi hệ thống vui lòng thử lại sau!'
            ], 500);
        }
    }

    public function listPostData($request)
    {
        $searchInput = $request->input('searchInput');

        $groupPost = Post::query();
        $groupPost->with(['user']);

        if ($request->has('searchInput') && !empty($searchInput)) {
            $groupPost->where(function ($query) use ($searchInput) {
                $query->where('title', 'like', '%' . $searchInput . '%');
            });
        }

        return DataTables::of($groupPost)
            ->editColumn('thumbnail', function ($data) {
                return formatImageAndVideo($data->thumbnail, $data->type);
            })
            ->editColumn('title', function ($data) {
                return formatTite($data->title);
            })
            ->editColumn('addPost', function ($data) {
                return $data->categories->title;
            })
            ->editColumn('user_id', function ($data) {
                return $data->user->name;
            })
            ->editColumn('date', function ($data) {
                return formatDate($data->created_at, $data->updated_at);
            })
            ->editColumn('work', function ($data) {
                return '<button type="button" class="btn btn-warning btn-sm addListPost" data-id="' . $data->id . '">Thêm tin tức</button>';
            })
            ->rawColumns(['title', 'status', 'date', 'work', 'addPost', 'thumbnail'])
            ->make(true);
    }

    public function addListPostData($request)
    {
        $id = $request->idListGroup;
        $idListGroup = $request->id;

        $dataStatus = GroupPost::find($id);

        if ($dataStatus) {
            $dataStatus->postss()->syncWithoutDetaching($idListGroup);
            return response()->json([
                'status' => 200,
                'message' => 'Cập nhật thành công!'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Lỗi hệ thống vui lòng thử lại sau!'
            ], 500);
        }
    }

    public function getListPost($request, $id)
    {
        $getFind = GroupPost::findOrFail($id);

        $optionCss = [
            'max-width' => '400px',
        ];

        return DataTables::of($getFind->postss)
            ->editColumn('thumbnail', function ($data) {
                return formatImageAndVideo($data->thumbnail, $data->type);
            })
            ->editColumn('title', function ($data) use ($optionCss) {
                return formatTite($data->title, false, $optionCss);
            })
            ->editColumn('categories_id', function ($data) {
                return $data->categories->title;
            })
            ->editColumn('user_id', function ($data) {
                return $data->user->name;
            })

            ->editColumn('date', function ($data) {
                return formatDate($data->created_at, $data->updated_at);
            })
            ->editColumn('work', function ($data) {
                return '<button class="btn btn-danger btn-sm btnDestroy" data-id="' . $data->id . '"><i class="fas fa-backspace"></i></button>';
            })
            ->rawColumns(['title', 'thumbnail', 'date', 'work'])
            ->make(true);
    }

    public function destroyListPost($request, $id)
    {
        $getIDGroup = $request->idListGroup;
        $getFind = GroupPost::findOrFail($getIDGroup);
        $dataStatus =  $getFind->postss()->detach($id);
        if ($dataStatus) {
            return response()->json([
                'status' => 200,
                'message' => 'Xóa thành công!'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Lỗi hệ thống vui lòng thử lại sau!'
            ], 500);
        }
    }

    public function getCountPostList($request)
    {
        $id = $request->id;
        $getFind = GroupPost::findOrFail($id);
        $data = $getFind->postss()->pluck('group_post_id')->count();
        return $data;
    }
}
