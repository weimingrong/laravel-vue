<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/17
 * Time: 14:50
 */

namespace App\Http\Components;


class PageConst
{
    const PAGE = 1;
    const PAGESIZE = 20;

    public static function getPage(){
        return [
            'page' => self::PAGE,
            'pageSize' => self::PAGESIZE
        ];
    }
}
