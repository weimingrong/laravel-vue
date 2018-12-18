<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/17
 * Time: 14:05
 */

namespace App\Http\Controllers\System;


use App\Admin;
use App\Http\Components\Code;
use App\Http\Components\Common;
use App\Http\Components\PageConst;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\SystemLogs;
use Illuminate\Http\Request;

class AdminController extends AuthController
{
    /**
     * 获取用户日志列表
     * @return AdminController|\Illuminate\Http\JsonResponse
     */
    public function getLogs(){
        $page = isset($this->request->page) ?
            $this->request->page : PageConst::PAGE;
        $pageSize = isset($this->request->pageSize)
            ? $this->request->pageSize : PageConst::PAGESIZE;

        $admin_id = $this->request->admin_id;
        $func = $this->request->func;

        $wh = [];
        if (isset($admin_id)){
            $wh['admin_id'] = $admin_id;
        }
        if (isset($func)){
            $wh['func'] = $func;
        }


        $data = SystemLogs::getInstance()->getList($wh, $pageSize, $page);
        return $this->sendJson($data);
    }

    /**
     * 修改密码
     * @return AdminController|\Illuminate\Http\JsonResponse
     */
    public function changePassword(){
        //从session中获取管理员登录信息
        $this->getLoginInfo();
        $admin_id = $this->loginInfo['admin_id'];
        $old_password = $this->request->old_password;
        $password = $this->request->password;
        //管理员账号 旧密码 是否一致
        if (!(Admin::getInstance()->checkPassword($admin_id, $old_password))){
            return $this->sendError(Code::OLD_PASSWORD_WRONG);
        }
        //保存
        Admin::getInstance()->updatePassword($admin_id, $password);
        return $this->sendJson();
    }

    /**
     * 更新头像
     * @return AdminController|\Illuminate\Http\JsonResponse
     */
    public function saveAvatar(){
        $this->getLoginInfo();
        $admin_id = $this->loginInfo['admin_id'];
        $avatar = $this->request->avatar;

        Admin::getInstance()->updateAvatar($admin_id, $avatar);

        return $this->sendJson();

    }

    /**
     * 上传头像
     * @return AdminController|\Illuminate\Http\JsonResponse
     */
    public function uploadAvatar(){
        $res = Common::uploadImgToLocalStorage($this->request, 'file');
        if ($res['error'] !==0 ){
            return $this->sendError(Code::FAIL, $res['msg']);
        }

        return $this->sendJson(['img_path' => $res['img_path']]);
    }

    /**
     * 获取用户基本信息
     * @return AdminController|\Illuminate\Http\JsonResponse
     */
    public function getUserinfo(){
        $this->getLoginInfo();

        $admin_id = $this->loginInfo['admin_id'];

        $data = Admin::getInstance()->getRows([
           'id' => $admin_id
        ]);

        return $this->sendJson($data[0] ?? []);
    }
}

