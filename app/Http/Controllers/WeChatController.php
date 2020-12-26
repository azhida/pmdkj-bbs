<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WeChatController extends Controller
{
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {
        \Log::info('request arrived.'); # 注意：Log 为 Laravel 组件，所以它记的日志去 Laravel 日志看，而不是 EasyWeChat 日志

        $app = app('wechat.official_account');
        $app->server->push(function($message){
            return "欢迎关注 overtrue！";
        });

        return $app->server->serve();
    }

    // 获取自定义菜单
    public function getMenus()
    {
        $app = app('wechat.official_account');
        $list = $app->menu->list();
        dd($list);
    }

    // 获取自定义菜单
    public function createMenus(Request $request)
    {
//        $buttons = [
//            [
//                "type" => "click",
//                "name" => "今日歌曲",
//                "key"  => "V1001_TODAY_MUSIC"
//            ],
//            [
//                "name" => "菜单",
//                "sub_button" => [
//                    [
//                        "type" => "view",
//                        "name" => "搜索",
//                        "url"  => "http://www.soso.com/"
//                    ],
//                    [
//                        "type" => "view",
//                        "name" => "视频",
//                        "url"  => "http://v.qq.com/"
//                    ],
//                    [
//                        "type" => "click",
//                        "name" => "赞一下我们",
//                        "key" => "V1001_GOOD"
//                    ],
//                ],
//            ],
//        ];

        $buttons = $request->all();
        $app = app('wechat.official_account');
        $res = $app->menu->create($buttons);
        dd($res);
        return $res;
    }
}
