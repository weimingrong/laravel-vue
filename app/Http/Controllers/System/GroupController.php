<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/18
 * Time: 17:39
 */

namespace App\Http\Controllers\System;

use App\Http\Controllers\AuthController;

class GroupController extends AuthController
{
    /**
     * 获取管理组列表
     * @return GroupController|\Illuminate\Http\JsonResponse
     */
    public function getList(){
        return $this->sendJson();
    }
}
