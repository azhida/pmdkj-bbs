<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkWeChatController extends Controller
{
    public function saveMsg(Request  $request)
    {
        $data = $request->all();
        logger('企业微信回调消息', $data);
    }
}
