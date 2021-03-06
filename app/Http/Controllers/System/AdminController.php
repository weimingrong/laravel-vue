<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/17
 * Time: 14:05
 */

namespace App\Http\Controllers\System;


use App\Admin;
use App\GroupAccess;
use App\Http\Components\Code;
use App\Http\Components\Common;
use App\Http\Components\LoginType;
use App\Http\Components\PageConst;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\SystemLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    /**
     * 获取管理员列表
     * @return AdminController|\Illuminate\Http\JsonResponse
     */
    public function getList(){
        $page = isset($this->request->page) ? $this->request->page : PageConst::PAGE;
        $pageSize = isset($this->request->pageSize) ? $this->request->pageSize : PageConst::PAGESIZE;

        $username = $this->request->username;
        $realname = $this->request->realname;
        $mobile   = $this->request->mobile;
        $email    = $this->request->email;
        $adminId = $this->request->id;

        $wh = [];

        if (!empty($username)){
            $wh['username'] = $username;
        }
        if (!empty($realname)){
            $wh['realname'] = $realname;
        }
        if (!empty($mobile)){
            $wh['mobile'] = $mobile;
        }
        if (!empty($email)){
            $wh['email'] = $email;
        }
        if (!empty($adminId)){
            $wh['id'] = $adminId;
        }

        $list = [];
        $res = Admin::getInstance()->getList($wh, $pageSize, $page);
        if ($res['total']){
            foreach ($res['data'] as &$row){
                $row['last_login'] = $row['last_login'] == 0 ? '暂未登录' : date('Y-m-d H:i:s', $row['last_login']);
                $row['groups'] = (int)GroupAccess::getInstance()->getGroupByUid($row['id']);
                $row['status'] = (int)$row['status'];
            }
            $list['list'] = $res['data'];
            $list['total'] = $res['total'];
        }

        $list['auth'] = [
           'canAdd'  => $this->canAdd(),
           'canEdit' => $this->canEdit(),
           'canDelete' => $this->canDelete()
        ];

        return $this->sendJson($list);
    }

    public function save(){
        $id = $this->request->id;
        $username = $this->request->username;
        $password = $this->request->password;
        $groups = $this->request->groups;
        $realname = $this->request->realname;
        $mobile = $this->request->mobile;
        $email = $this->request->email;
        $status = $this->request->status ? LoginType::NORMAL : LoginType::PROHIBIT;


        //判断登录名是否已经存在
        if (!$id){
            $row = Admin::getInstance()->getRows(['username' => $username]);
            if ($row){
                return $this->sendError(Code::ADMIN_EXIST);
            }
        }


        if ($id){
            //edit
            //不能编辑超级管理员
            if ($id == 1 ){
                return;
            }
            $adminId = $id;
            $upData = [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]),
                'realname' => $realname,
                'mobile' => $mobile,
                'email' => $email,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ];
            Admin::getInstance()->updateAdminInfo($adminId, $upData);
        }else{
            //add
            $adminId = Admin::getInstance()->insertGetId([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]),
                'realname' => $realname,
                'mobile' => $mobile,
                'email' => $email,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s', time()),
                'updated_at' => date('Y-m-d H:i:s', time()),
            ]);

        }

        //更新用户组
        $this->saveAdminGroup($adminId, $groups);
        return $this->sendJson(null);
    }

    public function saveAdminGroup($adminId, $groupsId){
        GroupAccess::getInstance()->deleteGroupByAdminId($adminId);
        GroupAccess::getInstance()->insertGetId([
            'group_id' => $groupsId,
            'uid'      => $adminId,
            'updated_at' => date('Y-m-d H:i:s', time()),
            'created_at' => date('Y-m-d H:i:s', time()),
        ]);

    }

    //删除管理员
    public function delete(){
        $id = $this->request->id;

        DB::beginTransaction();
        $groupAccessDel = GroupAccess::getInstance()->deleteGroupByAdminId($id);
        if (!$groupAccessDel){
            DB::rollBack();
        }
        $adminDel = Admin::getInstance()->where('id', '=', $id)->delete();
        if (!$adminDel){
            DB::rollBack();
        }

        DB::commit();
        return $this->sendJson(null);
    }
}

