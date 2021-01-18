<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Models\QrCode;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Zxing\QrReader;
use function EasyWeChat\Kernel\Support\str_random;

class QrCodesController extends Controller
{
    public function makeQrCode(Request $request)
    {
        $qr_code_content = $request->qr_code_content ?? '';
        if (!$qr_code_content) return $this->fail('二维码内容不能为空');

        // 客户端请求生成二维码
        $res = (new QrCodeService())->makeQrCode('images/request_make_codes', $qr_code_content);

        if ($res['code'] == 1) {
            return $this->fail('生成失败');
        } else {
            // 数据入库

            $short_code = str_random(10);
            $flag = true;
            $i = 0;
            while ($flag) {
                $i++;
                if (!QrCode::query()->where('short_code', $short_code)->exists()) {
                    $flag = false;
                } else {
                    $short_code = str_random(10);
                }
            }

            QrCode::query()->create([
                'short_code' => $short_code,
                'qr_code_content' => $qr_code_content,
                'file_url' => $res['file_url'],
            ]);

            return $this->success('', ['short_code' => $short_code, 'file_url' => $res['file_url']]);
        }
    }
}
