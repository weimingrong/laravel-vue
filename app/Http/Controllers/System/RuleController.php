<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/14
 * Time: 15:36
 */

namespace App\Http\Controllers\System;


use App\Http\Components\Code;
use App\Http\Components\Common;
use App\Http\Components\RbacConst;
use App\Http\Controllers\AuthController;
use App\Rule;

class RuleController extends AuthController
{
    public function getPathInfo(){
        $path = $this->request->path;
        $list = Rule::getInstance()->getList();

        $newList = $curRow = [];
        foreach ($list as $row){
            $newList[$row['id']] = $row;
            if ($path === $row['name']){
                $curRow = $row;
            }
        }

        $data[] = $curRow;
        while (isset($newList[$curRow['pid']])){
            array_push($data, $newList[$curRow['pid']]);
            $curRow = $newList[$curRow['pid']];
        }

        $data = array_reverse($data);

        return $this->sendJson($data);


    }

    /**
     * 获取菜单树
     * @return RuleController|\Illuminate\Http\JsonResponse
     */
    public function getTreeList(){
        $list = Rule::getInstance()->getList($this->request->all());
        $tree = Common::generateRuleTree($list, 0);

        return $this->sendJson([
            'list' => $tree,
            'auth' => [
                'canAdd' => $this->canAdd(),
                'canEdit' => $this->canEdit(),
                'canDelete' => $this->canDelete()
            ]
        ]);
    }

    /*
     * 获取web.php 路由
     * 用于搜索框 建议列表
     */
    public function getAllRoutes(){
        $routes = app()->routes->getRoutes();
        $data = [];
        foreach ($routes as $value){
            if (!$value->uri || $value->uri === '/'){
                continue;
            }
            $data[] = $value->uri;
        }
        return $this->sendJson($data);
    }

    /**
     * 获取权限信息
     */
    public function get(){
        $id = $this->request->id;
        $rows = Rule::getInstance()->getList(['id' => $id]);
        $data = $rows[0];
        if ($data){
            $data['pid'] = (int)$rows[0]['pid'];
            $data['status'] = (int)$rows[0]['status'];
            $data['menu'] = (int)$rows[0]['menu'];
            $data['type'] = (int)$rows[0]['type'];
        }else{
            $data = [];
        }
        return $this->sendJson($data);
    }
    /**
     * 保存
     */
    public function save(){
        $id = $this->request->id;
        $name = $this->request->name;//权限名

        if($id){
            $upData = [
                'menu' => $this->request->menu,
                'condition' => $this->request->condition,
                'icon' => $this->request->icon,
                'name' => $this->request->name,
                'pid' => $this->request->pid,
                'remark' => $this->request->remark,
                'status' => $this->request->status ? RbacConst::RULE_STATUS_ON : RbacConst::RULE_STATUS_OFF,
                'title' => $this->request->title,
                'type' => $this->request->type,
                'created_at' => $this->request->created_at,
                'updated_at' => $this->request->updated_at,
            ];

            Rule::getInstance()->where(['id' => $id])->update($upData);
        }else{
            $rows = Rule::getInstance()->getList(['name' => $name]);
            //判断权限名是否存在
            if (!empty($rows)){
                return $this->sendError(Code::RULE_EXIST);
            }
            Rule::getInstance()->saveData($this->request->all());
        }


        return $this->sendJson();
    }

}
