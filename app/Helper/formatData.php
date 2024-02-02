<?php


namespace App\Helper;


class formatData
{
    public static function formatStatus($data)
    {
        if ($data === 'on') {
            return 0;
        } else {
            return 1;
        }
    }

    public static function getHost()
    {
        return config('app.url');
    }

    public static function convertStringToArrayImage($data)
    {

        if (is_array($data)) {
            $stringData = join(',', $data);
            $arrayData = explode(',', $stringData);
            return  $arrayData;
        }

        return $data;
    }

    public static function formatExtension($data)
    {
        $extensionName = pathinfo($data)['extension'];

        $extensionVideo = self::dataVideo();
        $extensionImage = self::dataImage();

        // Kiểm tra định dạng của tệp tin

        if (in_array($extensionName, $extensionVideo)) {
            // Xử lý cho video
            return 1;
        } elseif (in_array($extensionName, $extensionImage)) {
            // Xử lý cho image
            return 0;
        }
    }

    public static function dataVideo()
    {
        $data = [
            'mp4',
            'mov',
            'avi'
        ];

        return $data;
    }

    public static function dataImage()
    {
        $data = [
            'jpeg',
            'png',
            'jpg',
            'gif',
        ];

        return $data;
    }
}
