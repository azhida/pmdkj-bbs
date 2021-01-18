<?php

namespace App\Services;

use Endroid\QrCode\QrCode;
use function EasyWeChat\Kernel\Support\str_random;

class QrCodeService
{
    /**
     * 生成 二维码
     * @param $save_path string 二维码的保存路径
     * @param $qr_code_content string 二维码的内容
     * @return array
     */
    public function makeQrCode($save_path, $qr_code_content)
    {
        if (!$save_path) return ['code' => 1, 'msg' => '缺少二维码存储路径'];
        if (!$qr_code_content) return ['code' => 1, 'msg' => '缺少二维码内容'];

        $save_path .= '/' . date('Y') . '/' . date('m') . '/' . date('d') . '/';

        $file_name = time() . str_random(10) . '.png';

        $path = public_path() . '/' . $save_path;

        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $full_file = $path . $file_name;
        if (file_exists($full_file)) {
            $file_name = str_random(10) . $file_name;
            $full_file = $path . $file_name;
        }
        $full_file = strtolower($full_file);

        // 把要转换的字符串作为 QrCode 的构造函数参数
        $qrCode = new QrCode($qr_code_content);
        $qrCode->writeFile($full_file);

        $file_url =  strtolower(config('app.url') . '/' . $save_path . $file_name);

        return ['code' => 0, 'msg' => '二维码创建成功', 'file_url' => $file_url];
    }
}
