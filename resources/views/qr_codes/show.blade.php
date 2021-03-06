<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover" name="viewport" />
    <title>二维码详情</title>
    <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/2.4.1/weui.min.css">
    <style>
        .weui-form__opr-area, .weui-form__opr-area{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="page form_textarea js_show">
    <div class="weui-form">
        <div class="weui-form__text-area">
            <h2 class="weui-form__title">二维码</h2>
            <div class="weui-form__desc" id="qr_code_content">{{ $info->qr_code_content }}</div>
            <div class="weui-form__desc" id="img_show_div"><img style="max-height: 150px;max-width: 150px;" src="{{ $info->file_url }}" alt=""></div>
        </div>
        <div class="weui-form__control-area">
            <div class="weui-cells__group weui-cells__group_form">
                <div class="weui-cells__title">描述：输入你的二维码内容</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell ">
                        <div class="weui-cell__bd">
                            <textarea class="weui-textarea" placeholder="输入你的二维码内容" rows="3">{{ $info->qr_code_content }}</textarea>
                            <div class="weui-textarea-counter"><span>0</span>/200</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weui-form__opr-area">
            <a class="weui-btn weui-btn_primary" href="javascript:" onclick="fnUpdateQrCode();">修改二维码内容</a>
        </div>
        <div class="weui-form__opr-area" style="margin-bottom: 20px;">
            <a class="weui-btn weui-btn_primary" href="javascript:" onclick="fnLoadQrCode();">下载二维码图片</a>
        </div>
    </div>

</div>

<script type="text/javascript" src="{{ url('h5/js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ url('h5/js/common.js') }}"></script>
<script>


    var short_code = '{{ $info->short_code }}';
    function fnUpdateQrCode() {
        $.ajax({
            url: '{{ url('api/updateQrCode') }}',
            type: 'post',
            data: {
                short_code: short_code,
                qr_code_content: $('textarea').val(),
            },
            success: function (res) {
                console.log(res)
                if (res.code == '1') {
                    alert(res.msg);
                    return;
                }

                $('#img_show_div>img').attr('src', res.data.file_url);
                $('#qr_code_content').text(res.data.qr_code_content);

                alert(res.msg);

            }
        })
    }

    function fnLoadQrCode() {
        if (!short_code) return;
        window.location.href = '{{ url('api/downloadQrCode') }}' + '?short_code=' + short_code;
    }
</script>

</body>
</html>
