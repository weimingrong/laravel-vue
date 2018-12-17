<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/17
 * Time: 11:37
 */

namespace App\Http\Controllers;


class IndexController extends Controller
{
    public function test(){
        return $this->sendJson();
    }
}
