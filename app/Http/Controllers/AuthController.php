<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/17
 * Time: 14:24
 */

namespace App\Http\Controllers;


use App\Http\Components\Common;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $loginInfo;

    public function __construct(Request $request)
    {
        parent::__construct($request);
        //检查权限
//        $this->middleware('admin');
    }

    public function getLoginInfo(){
        $this->loginInfo = session('loginInfo');
    }

    public function canAdd(){
        $path = dirname($this->request->getPathInfo()) . '/save';
        if (Common::checkPermission($path)){
            return true;
        }

        return false;
    }

    public function canEdit(){
        $path = dirname($this->request->getPathInfo()) . '/edit';
        if (Common::checkPermission($path)){
            return true;
        }
        return false;
    }
    public function canDelete(){
        $path = dirname($this->request->getPathInfo()) . 'delete';
        if (Common::checkPermission($path)){
            return true;
        }
        return false;
    }
}
