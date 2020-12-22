<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $limit = 20;

    public function getOffset()
    {
        return (int) (request()->offset ?? 0);
    }

    public function getLimit()
    {
        return (int) (request()->limit ?? 20);
    }

    // 操作成功返回结果
    public function success($msg = '', $data = [], $meta = [])
    {
        $msg = $msg ? $msg : '操作成功';
        return $this->showJson(0, $msg, $data, $meta);
    }

    // 操作失败返回结果
    public function fail($msg = '', $data = [], $meta = [], $code = 1)
    {
        $msg = $msg ? $msg : '操作失败';
        return $this->showJson($code, $msg, $data, $meta);
    }

    public function showJson($code, $msg, $data = [], $meta = [])
    {
        $headers = [];
        $authorization = session('Authorization');
        if ($authorization) {
            // 此处实现的是无痛刷新
            $headers['Access-Control-Expose-Headers'] = 'Authorization';
            $headers['Cache-Control'] = 'no-store';
            $headers['Authorization'] = $authorization;
            session()->forget('Authorization');
        }

        return response()->json(['code' => $code, 'msg' => $msg, 'meta' => $meta, 'data' => $data], 200, $headers);
    }

}
