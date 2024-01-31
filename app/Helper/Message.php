<?php


namespace App\Helper;


class Message
{
    public static function MessageSage($name=''){

        $data = [
            'add' => 'Bạn đã thêm dữ liệu thành công!',
            'edit' => 'Bạn cập nhật thành công!',
            'delete' => 'Xóa thành công!',
            'undo' => 'Khôi phục thành công!',
            'checkStatus' => 'Không phải danh mục cha không được kích hoạt',
            'error' => 'Lỗi hệ thống vui lòng thử lại sau',
        ];

        foreach ($data as $key => $item){
            if ($key == $name) {
                return $item;
            }
        }
        return 'Không tìm thấy key';
    }

    public static function RedirectRoute($route=null){

        if (!empty($route)){
            return redirect()->route($route);
        }
        return redirect()->back()->withInput();
    }

    public static function RedirectResponsive($status=null){
        if (!empty($status)&& $status == 200){
            return response()->json([
                'status' => $status,
                'message' => self::MessageSage('delete'),
            ]);
        }else{
            return response()->json([
                'status' => $status,
                'message' => self::MessageSage('error'),
            ]);
        }
    }

    public static function NotificationStatus($name,$status='success',$type='toast'){
        if (!empty($type) && $type== 'alert'){
            if (!empty($name)){
                if ($status == 'success'){
                    return alert('Thành công!',self::MessageSage($name), $status);
                }else if ($status == 'error'){
                    return alert('Thất bại!',self::MessageSage($name), $status);
                }else if ($status == 'warning'){
                    return alert('Cảnh báo!',self::MessageSage($name), $status);
                }
            }
        }else if (!empty($type) && $type== 'toast'){
            return toast(self::MessageSage($name),$status);
        }
    }
}
