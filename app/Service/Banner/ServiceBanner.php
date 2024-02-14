<?php


namespace App\Service\Banner;

use App\Helper\Message;
use App\Helper\formatData;
use App\Models\Admin\Banner\Banner;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ServiceBanner
{
    public function getData($request)
    {
        $searchInput = $request->input('searchInput');
        $statusSelect = $request->input('statusSelect');
        $searchUsert = $request->input('searchUser');
        $filer = [];

        $banner = Banner::query();
        $banner->with(['user', 'categories']);

        if ($request->has('searchInput') && !empty($searchInput)) {
            $banner->where(function ($query) use ($searchInput) {
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
            $banner->where($filer);
        }

        return DataTables::of($banner)
            ->editColumn('thumbnail', function ($data) {
                return formatImageAndVideo($data->thumbnail, $data->type);
            })
            ->editColumn('title', function ($data) {
                return formatTite($data->title);
            })
            ->addColumn('link_action', function ($data) {
                return formatCategoriesOfLink($data);
            })
            ->editColumn('user_id', function ($data) {
                return $data->user->name;
            })
            ->editColumn('status', function ($data) {
                return formatStatus($data->status);
            })
            ->editColumn('type', function ($data) {
                return formatType($data->type);
            })
            ->editColumn('order', function ($data) {
                return formatOrderBanner($data->order);
            })
            ->editColumn('work', function ($data) {
                return formatWork($data->id, 'banner');
            })
            ->rawColumns(['thumbnail', 'title', 'work', 'link_action', 'status', 'order', 'type'])
            ->make(true);
    }

    public function store($request)
    {
        $dataThumbnail = formatData::formatExtension($request->thumbnail);

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
            'status' => formatData::formatStatus($request->status),
            'type' => $dataThumbnail,
            'thumbnail' => $request->thumbnail,
            'order' => $request->order,
            'created_at' => date("Y-m-d H:i:s")
        ];

        if ($request->link === null) {
            $data['categories_id']  = $request->categories_id;
        } else {
            $data['link'] = $request->link;
        }


        $dataStatus = Banner::create($data);

        if ($dataStatus) {
            Message::NotificationStatus('add');
            return Message::RedirectRoute('banner.index');
        } else {
            Message::NotificationStatus('error');
            return Message::RedirectRoute();
        }
    }

    public function changeStatus($request, $id)
    {

        $valueChange = $request->value;

        $data = [
            'status' => $valueChange,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        $dataStatus = Banner::findOrFail($id)->update($data);

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

    public function getFind($id)
    {
        return Banner::findOrFail($id);
    }

    public function update($request, $id)
    {
        $dataThumbnail = formatData::formatExtension($request->thumbnail);

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'user_id' => Auth::id(),
            'status' => formatData::formatStatus($request->status),
            'type' => $dataThumbnail,
            'thumbnail' => $request->thumbnail,
            'order' => $request->order,
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if ($request->link === null) {
            $data['categories_id']  = $request->categories_id;
            $data['link'] = null;
        } else {
            $data['link'] = $request->link;
            $data['categories_id']  = null;
        }


        $dataStatus = Banner::findOrFail($id)->update($data);

        if ($dataStatus) {
            Message::NotificationStatus('edit');
            return Message::RedirectRoute('banner.index');
        } else {
            Message::NotificationStatus('error');
            return Message::RedirectRoute();
        }
    }

    public function destroy($id)
    {
        $dataStatus = Banner::findOrFail($id)->delete();

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
