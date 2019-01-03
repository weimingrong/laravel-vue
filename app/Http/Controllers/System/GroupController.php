<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/18
 * Time: 17:39
 */

namespace App\Http\Controllers\System;

use App\Group;
use App\Http\Controllers\AuthController;

class GroupController extends AuthController
{
    /**
     * 获取管理组列表
     * @return GroupController|\Illuminate\Http\JsonResponse
     */
    public function getList(){
        $status = $this->request->status;
        $wh = [];
        if (!empty($status)){
            $wh['status'] = $status;
        }
        $res = Group::getInstance()->getList($wh);
        return $this->sendJson([
            'list' => $res,
            'auth' => [
                'canAdd'  => $this->canAdd(),
                'canEdit' => $this->canEdit()
            ]
        ]

        );
    }
}
