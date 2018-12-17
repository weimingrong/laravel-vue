<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/17
 * Time: 14:05
 */

namespace App\Http\Controllers\System;


use App\Http\Components\PageConst;
use App\Http\Controllers\Controller;
use App\SystemLogs;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //获取用户日志列表
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
}
