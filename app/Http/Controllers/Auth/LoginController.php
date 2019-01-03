<?php

namespace App\Http\Controllers\Auth;

use App\Group;
use App\GroupAccess;
use App\Http\Components\Code;
use App\Http\Components\Common;
use App\Http\Components\RbacConst;
use App\Http\Controllers\Controller;
use App\Rule;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Admin;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest')->except('logout');
//    }

    public function login(Request $request)
    {
        $adminModel = new Admin();
        $username = $request->username;

        $userInfo = $adminModel->getRows(['username' => $username])[0] ?? [];

        if (empty($userInfo)){
            return $this->sendError(Code::LOGIN_ERROR);
        }

        if (time() - $userInfo['last_login'] < 60 && $userInfo['try_time'] > 5){
            return $this->sendError(Code::LOGIN_TRY_ERROR);
        }

        $checkPass = $adminModel->checkPassword($userInfo['id'], $request->password);

        if (!$checkPass){
            //密码错误 更新尝试次数
            Admin::getInstance()->updateTryTime($userInfo['id'], $userInfo['try_time']);
            return $this->sendError(Code::LOGIN_ERROR);
        }

        //保留最新登录信息
        Admin::getInstance()->updateLoginInfo($userInfo['id'], $request->getClientIp());

        //获取用户权限
        $rules_arr = $this->getRuleByUid($userInfo['id']);
        //将 uid username rules存入session->loginInfo
        $request->session()->put('loginInfo', [
            'admin_id' => $userInfo['id'],
            'username' => $userInfo['username'],
            'rules' => $rules_arr
        ]);

        //根据权限Ids 获取一级菜单项
        $menu_item = Rule::getInstance()->getMenuItemByRuleArr();

        $menus = [];
        foreach ($menu_item as $row) {
            if(in_array($row['name'], $row)) {
                $menus[] = $row;
            }
        }

        //菜单树
        $userInfo['menus'] = Common::generateRuleTree($menus, 0);

        return $this->sendJson($userInfo);
    }

    /**
     * 获取用户权限 及对应权限菜单
     * @param $id
     */
    public function getRuleByUid($uid){
        //获取用户所在的组
        $groupId = GroupAccess::getInstance()->getGroupByUid($uid);
        if (!$groupId){
            //未绑定组 登录失败
            return $this->sendError(Code::LOGIN_ERROR);
        }

        $data = [];
        //超级管理员拥有所有权限
        if ($groupId == RbacConst::SUPER_ADMIN){
            $allRules = Rule::getInstance()->getAllRules();
            foreach ($allRules as $rule){
                $data[$rule['id']] = $rule['name'];
            }
            return $data;
        }

        //获取组具有的权限id
        $groupRules = Group::getInstance()->getRulesByGid($groupId);
        foreach ($groupRules as $row){
            $rulesId_arr = explode(',', $row['rules']);
            $rules = Rule::getInstance()->getRuleInfosByRuleIds($rulesId_arr);
            foreach ($rules as $rule){
                $data[$rule['id']] = $rule['name'];
            }
        }

        return $data;
    }

    public function logout(Request $request){
        $request->session()->forget('loginInfo');
        return $this->sendJson();
    }
}
