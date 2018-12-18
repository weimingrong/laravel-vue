<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/14
 * Time: 14:40
 */

namespace App\Http\Components;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Common
{
    /**
     * 生成菜单树
     * @param $list
     * @param $pid
     */
    public static function generateRuleTree($list, $pid){
        $tree = [];
        foreach ($list as $item) {
            if ($item['pid'] == $pid){
                $item = [
                    'id'    => $item['id'],
                    'label' => $item['title'],
                    'pid'   => $item['pid'],
                    'path'  => $item['name'],
                    'icon'  => $item['icon']
                ];

                $children = self::generateRuleTree($list, $item['id']);

                if (!empty($children)){
                    $item['children'] = $children;
                }

                $tree[] = $item;
            }
        }

        return $tree;
    }


    public static function uploadImgToLocalStorage(Request $request, $key){
        $res = ['error' => 1, 'msg' => ''];
        $file = $request->file($key);

        if (!$file->isValid()){
            $res['msg'] = '上传文件不合法';
            return $res;
        }

        $ext = $file->getClientOriginalExtension();
        if (!in_array($ext, ['jpg', 'png', 'gif'])){
            $res['msg'] = '图片格式不正确';
            return $res;
        }

        $fileSize = $file->getClientSize();
        if ($fileSize > 1024 * 1204 * 2){
            $res['msg'] = '图片大小不能超过2M';
            return $res;
        }

        //存储文件 disk里面的public 总的来说就是调用disk模块里面的public配置
        $path = Storage::disk('public')->put('avatars', $file, 'public');

        $res['error'] = 0;
        $res['img_path'] = Storage::url($path);
        return $res;
    }
}
