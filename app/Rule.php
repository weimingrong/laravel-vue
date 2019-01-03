<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/13
 * Time: 18:04
 */

namespace App;


use App\Http\Components\RbacConst;
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

    public function getMenuItemByRuleArr(){
        $data = $this->where(['status' => 1, 'menu' => 1])->get()->toArray();
        return $data;
    }

    public function getAllRules($status = RbacConst::RULE_STATUS_ON){
        $data = $this->where('status', $status)->get()->toArray();
        return $data;
    }

    public function getRuleInfosByRuleIds($ruleId_arr, $status = RbacConst::RULE_STATUS_ON){
        $data = $this->where('status', $status)->whereIn('id', $ruleId_arr)->get()->toArray();
        return $data;
    }

    public function getList($condition = []){
        return $this->where($condition)->orderBy('id', 'asc')->get()->toArray();
    }
}
