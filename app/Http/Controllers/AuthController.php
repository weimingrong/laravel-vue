<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/17
 * Time: 14:24
 */

namespace App\Http\Controllers;


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
}
