<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/14
 * Time: 11:42
 */

namespace App;


use bar\baz\source_with_namespace;
use Illuminate\Database\Eloquent\Model;

class GroupAccess extends Model
{
    protected $table = 'v1_auth_group_access';

    protected static $instance;

    public static function getInstance(){
        if (!self::$instance instanceof self){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 获取用户所属的组
     * @param $uid
     * @return array
     */
    public function getGroupByUid($uid){
        $data = $this->select('group_id')->where('uid', '=', $uid)->get()->toArray();
        return isset($data[0]) ? $data[0]['group_id'] : null;
    }

    public function deleteGroupByAdminId($adminId){
        $data = $this->where('uid', '=', $adminId)->delete();
        return $data;
    }

}
