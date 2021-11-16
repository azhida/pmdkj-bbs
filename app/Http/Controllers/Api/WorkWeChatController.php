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
        $private_key_file_path = $config['private_key_file_path'];
        $options = [ // 可选参数
            'proxy_host' => '',
            'proxy_password' => '',
            'timeout' => 10, // 默认超时时间为10s
        ];

        try {
            $obj = new \WxworkFinanceSdk($corpId, $secret, $options);

            // 私钥地址
            $privateKey = file_get_contents($private_key_file_path);

            $chats = json_decode($obj->getChatData(0, 100), true);
            logger('企业微信 => 拉取聊天数据 => $chats', $chats);
            value($chats);

//            foreach ($chats['chatdata'] as $val) {
//                $decryptRandKey = null;
//                openssl_private_decrypt(base64_decode($val['encrypt_random_key']), $decryptRandKey, $privateKey, OPENSSL_PKCS1_PADDING);
//                $obj->downloadMedia($sdkFileId, "/tmp/download/文件新名称.后缀");
//                logger('企业微信 => 拉取聊天数据 => $chats', $chats);
//            }


        }catch(\WxworkFinanceSdkException $e) {
            $arr = [
                'getMessage' => $e->getMessage(),
                'getCode' => $e->getCode(),
            ];
            logger('企业微信 => 拉取聊天数据 => WxworkFinanceSdkException', $arr);
            var_dump($e->getMessage(), $e->getCode());
        }
    }
}
