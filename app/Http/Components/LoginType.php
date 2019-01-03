<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/18
 * Time: 17:30
 */

namespace App\Http\Components;


class LoginType
{
    const NORMAL = 1;
    const PROHIBIT = 2;

    public static function all(){
        return [
            self::NORMAL,
            self::PROHIBIT
        ];
    }
}
