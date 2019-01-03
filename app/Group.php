<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/14
 * Time: 14:22
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'v1_auth_group';

    protected static $instance;

    public static function getInstance(){
        if (!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function getRulesByGid($gid){
        $data = $this->find($gid)->rules;
        return $data;
    }

    public function getList($wh){
        $data = $this->where($wh)
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();
        return $data;
    }
}
