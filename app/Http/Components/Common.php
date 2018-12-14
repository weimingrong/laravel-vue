<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/14
 * Time: 14:40
 */

namespace App\Http\Components;


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
}
