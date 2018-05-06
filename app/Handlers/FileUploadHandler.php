<?php

namespace App\Handlers;


class FIleUploadHandler
{

    public function save($file, $folder, $class_id, $file_prefix)
    {
        // 构建存储的文件夹规则，值如：uploads/images/avatars/201709/21/
        // 切割文件夹让查找效率更高。
        $folder_name = "uploads/$folder/" .$class_id. date("Ym", time());

        // 文件具体存储的物理路径，`public_path()` 获取的是 `public` 文件夹的物理路径。
        // 值如：/home/vagrant/Code/larabbs/public/uploads/file/1/201709
        $upload_path = public_path() . '/' . $folder_name;

        // 获取文件的后缀名
        $extension = strtolower($file->getClientOriginalExtension());

        // 拼接文件名，加前缀是为了增加辨析度，前缀可以是相关数据模型的 ID
        // 值如：1_1493521050_7BVc9v9ujP.png
        $filename = $file_prefix . '_' . time() . '_' . str_random(6) . '.' . $extension;

        // 将图片移动到我们的目标存储路径中
        $file->move($upload_path, $filename);

        return [
            'path' => config('app.url') . "/$folder_name/$filename"
        ];
    }
}