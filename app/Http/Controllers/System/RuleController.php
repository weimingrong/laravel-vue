<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/14
 * Time: 15:36
 */

namespace App\Http\Controllers\System;


use App\Http\Controllers\AuthController;
use App\Rule;

class RuleController extends AuthController
{
    public function getPathInfo(){
//        $path = $this->request->input('path');
//        $list = Rule::getInstance()->getList();
//
//        $newList = $curRow = [];
//        foreach ($list as $row){
//            $newList[$row['id']] = $row;
//            if ($path === $row['name']){
//                $curRow = $row;
//            }
//        }
//
//        $data[] = $curRow;
//        while (isset($newList[$curRow['pid']])){
//            array_push($data, $newList[$curRow['pid']]);
//            $curRow = $newList[$curRow['pid']];
//        }
//
//        $data = array_reverse($data);
//
//        return $this->sendJson($data);


    }
}
