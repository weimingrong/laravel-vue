<?php
/**
 * Created by PhpStorm.
 * User: mingrong
 * Date: 2018/12/17
 * Time: 14:33
 */

namespace App;

use App\Http\Components\PageConst;
use Illuminate\Database\Eloquent\Model;

class SystemLogs extends Model
{
    protected $table = "v1_admin_log";

    protected static $instance;

    public static function getInstance(){
        if (!(self::$instance instanceof self)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getList($wh, $pageSize, $page){
        $data = $this->where($wh)
            ->orderBy('create_time', 'desc')
            ->paginate($pageSize, ['*'], 'page', $page)
            ->toArray();

        return $data;

    }
}
