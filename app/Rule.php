<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/13
 * Time: 18:04
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'v1_auth_rule';

    protected static $instance;
    public static function getInstance(){
        if (!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getMenuItemByRuleArr($rule_arr){
        $data = $this->whereIn('id', $rule_arr)->where(['status' => 1, 'menu' => 1])->get()->toArray();
        return $data;
    }
}
