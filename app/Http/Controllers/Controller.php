<?php

namespace App\Http\Controllers;

use App\Http\Components\Code;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function sendError($code = 1, $message = ''){
        $method = $this->request->input('method');
        $callback = $this->request->input('callback');

        if ($method === 'jsonp' && $callback){
            return Response()->jsonp($callback, ['error' => $code, 'msg' => $message ?: Code::getError($code)]);
        }

        $headers = ['content-type' => 'application/json'];
        return Response()->json(['error' => $code, 'msg' => $message ? $message : Code::getError($code)])->withHeaders($headers);
    }


    public function sendJson($data =[]){
        $method = $this->request->input('method');
        $callback = $this->request->input('callback');

        if ($method === 'jsonp' && $callback){
            return Response()->jsonp($callback, ['error' => 0, 'data' => $data, 'msg' => '']);
        }

        $headers = ['content-type' => 'application/json'];
        return Response()->json(['error' => 0, 'data' => $data, 'msg' => ''])->withHeaders($headers);
    }
}
