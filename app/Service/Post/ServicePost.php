<?php


namespace App\Service\Post;

use App\Helper\Message;
use App\Helper\formatData;
use App\Helper\getDataBase;
use Illuminate\Support\Str;
use App\Models\Admin\Tag\Tag;
use App\Models\Admin\Post\Post;
use App\Models\Admin\Slide\Slide;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class ServicePost
{

    public function getData($request)
    {
        $getAllCategoris = getDataBase::getCategories();

        $searchInput = $request->input('searchInput');
        $statusSelect = $request->input('statusSelect');
        $searchUsert = $request->input('searchUser');
        $filer = [];


        $post = Post::query();
        $post->with(['user', 'categories']);

        if ($request->has('searchInput') && !empty($searchInput)) {
            $post->where(function ($query) use ($searchInput) {
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
            $post = $post->where($filer);
        }

        return DataTables::of($post)
            ->editColumn('thumbnail', function ($data) {
                return formatImageAndVideo($data->thumbnail, $data->type);
            })
            ->editColumn('title', function ($data) {
                return formatTite($data->title, true);
            })
            ->editColumn('categories_id', function ($data) use ($getAllCategoris) {
                return $data->categories->title;
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
                return formatWork($data->id, 'post');
            })
            ->rawColumns(['thumbnail', 'title', 'categories_id', 'status', 'date', 'work'])
            ->make(true);
    }

    public function store($request)
    {
        // Lấy dữ liệu cần thêm bảng Posts
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
            'tags' => $request->tags,
            'status' => formatData::formatStatus($request->status),
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
            'categories_id'  => $request->categories_id,
            'created_at' => date("Y-m-d H:i:s")
        ];

        // Thêm dữ liệu bảng Post
        $dataStatus = Post::create($data);

        $tags = [];
        if ($dataStatus) {
            // Hiện thông báo thêm thành công
            Message::NotificationStatus('add');

            return Message::RedirectRoute('post.index');
        } else {
            // Hiện thông báo lỗi
            Message::NotificationStatus('error');
            return Message::RedirectRoute();
        }
    }

    public function changeCategories($request, $id)
    {
        // Lấy dữ liệu Ajax gửi lên
        $valueInput = $request->value;

        $data = [
            'categories_id' => $valueInput,
            'updated_at' => date("Y-m-d H:i:s"),
        ];

        // Cập nhật dữ liệu
        $dataStatus = Post::findOrFail($id)->update($data);

        if ($dataStatus) {
            return response()->json([
                'message' => 'Cập nhật thành công!'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Lỗi hệ thống vui lòng thử lại sau!'
            ], 500);
        }
    }

    public function updateTitle($request, $id)
    {
        // Lấy dữ liệu Ajax gửi lên
        $valueTitle = $request->title;

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255|string|unique:posts,title,' . $id,
        ], [
            'title.required' => ':attribute không được để trống',
            'title.string' => ':attribute phải là kiểu chuỗi',
            'title.max' => ':attribute không được quá :max ký tự',
            'title.unique' => ':attribute đã tồn tại trong hệ thống',
        ], [
            'title' => 'Tên tin tức',
        ]);

        if ($validator->passes()) {
            $dataStatus = Post::findOrFail($id)->update(['title' => $valueTitle]);
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
        $dataStatus = Post::findOrFail($id)->update($data);

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

    public function getTitle($id)
    {
        //   Lấy một dữ liệu
        $getTitle = Post::findOrFail($id);
        if ($getTitle) {
            //  Thông báo thành công
            return response()->json(['data' => $getTitle]);
        } else {
            //  Thông báo thất bại
            return response()->json(['errors' => 'Lỗi hệ thống vui lòng thử lại sau']);
        }
    }

    public function getFind($id)
    {
        return Post::findOrFail($id);
    }

    public function update($request, $id)
    {
        //  Lấy dữ liệu cần cập nhật bảng Posts
        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
            'tags' => $request->tags,
            'status' => formatData::formatStatus($request->status),
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
            'categories_id'  => $request->categories_id,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        // cập nhật dữ liệu bảng Post
        $dataStatus = Post::findOrFail($id)->update($data);
        if ($dataStatus) {
            //  Hiện thông báo cập nhật thành công
            Message::NotificationStatus('edit');

            return Message::RedirectRoute('post.index');
        } else {
            //  Hiện thông báo lỗi
            Message::NotificationStatus('error');
            return Message::RedirectRoute();
        }
    }

    public function destroy($id)
    {
        $dataStatus = Post::findOrFail($id)->delete();

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
}