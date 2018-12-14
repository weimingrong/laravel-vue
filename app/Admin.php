<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'v1_auth_admin';

    protected $primaryKey = 'id';

    public static $instance;

    public static function getInstance(){
        if (!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getRows($conditions){
        return $this->select('id', 'username', 'realname', 'avatar', 'last_login', 'try_time')->where($conditions)->orderBy('id', 'asc')->get()->toArray();
    }


    //用户名和密码是否一致
    public function checkPassword($id, $password){
        if (password_verify($password, $this->find($id)->password)){
            return true;
        }
        return false;
    }

    /**
     * 更新尝试次数
     * @param $uid
     * @param $try_time
     */
    public function updateTryTime($uid, $try_time){
        $this->where(['id' => $uid])->update(['try_time' => $try_time + 1]);
    }

    /**
     * 保留最新登录信息
     * @param $uid
     * @param $client_ip
     */
    public function updateLoginInfo($uid, $client_ip){
        $this->where(['id' => $uid])->update([
            'try_time' => 0,
            'last_login' => microtime(true),
            'last_ip' => $client_ip
        ]);
    }

}