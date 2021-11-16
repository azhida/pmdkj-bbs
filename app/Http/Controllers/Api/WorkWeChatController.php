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

    // 拉取聊天数据
    public function getChatData($seq = 0, $limit = 100)
    {
        $log_data = [
            '$seq' => $seq,
            '$limit' => $limit,
        ];
        logger('企业微信 => 拉取聊天数据 => start', $log_data);

        $config = config('wechat.work.msg_save');
        $corpId = $config['corp_id'];
        $secret = $config['secret'];
        $options = [ // 可选参数
            'proxy_host' => '',
            'proxy_password' => '',
            'timeout' => 10, // 默认超时时间为10s
        ];

        \WxworkFinanceSdk::__construct($corpId, $secret, $options);
        $res = \WxworkFinanceSdk::getChatData($seq, $limit);
        logger('企业微信 => 拉取聊天数据 => $res', $res);
    }
}
