<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use Illuminate\Http\Request;

class WorkWeChatController extends Controller
{
    public function saveMsg(Request  $request)
    {
        $data = $request->all();
        logger('企业微信回调消息', $data);

        $config = config('wechat.work.msg_save');

        $app = Factory::work($config);

        $app->server->push(function($message){
            // $message['FromUserName'] // 消息来源
            // $message['MsgType'] // 消息类型：event ....

            return 'Hello easywechat.';
        });

        $response = $app->server->serve();

        $response->send();
    }
}
