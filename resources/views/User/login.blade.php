@extends('layout.app', ["page" => "login"])
@section('title')
{{ '登录' }}
@endsection
@section("content")
<div class="flex-1 w-full h-screen-80 bg-theme-color relative ">
    <div class="w-full h-screen-80 flex flex-row items-center ">
        <div id="left" class="w-1/2 lg:flex hidden  flex-col gap-12 font-bold pr-10 z-30">
            <div class="text-4xl text-right">图片工具 </div>
            <div class="flex flex-col gap-2">
                <!-- <div class="text-xl text-right">Bringing Stories to Life with Sound</div> -->
                <div class=" text-right text-5xl">改图片从未如此简单
                </div>
            </div>
        </div>

        <div class="flex-1 flex flex-col justify-center items-center gap-1 relative z-30">
            <h1 class="text-3xl my-4 text-white">用户登录</h1>
            <div class="border rounded-md p-4 bg-white">
                <h2 class="text-center text-theme-color">请使用飞书移动端扫描二维码</h2>
                <div id="erweima"></div>
            </div>
            <a class="inline-block border w-[370px] rounded-md p-4 my-8 cursor-pointer text-blue-500 text-center bg-white" href="https://passport.feishu.cn/suite/passport/oauth/authorize?client_id={{ env('FEISHU_APP_ID') }}&redirect_uri={{ env('FEISHU_REDIRECT_URI', '') }}&response_type=code">飞书手动授权登录</a>
        </div>
    </div>


    <img src="/images/bg.jpg" alt="" class="absolute  inset-0 w-full h-full object-cover z-0">
</div>
@endsection
@section("script")
<script type="text/javascript" src="/js/min.jquery.js"></script>
<script src="https://sf3-cn.feishucdn.com/obj/feishu-static/lark/passport/qrcode/LarkSSOSDKWebQRCode-1.0.2.js"></script>
<script>
    let gotoUrl = "https://passport.feishu.cn/suite/passport/oauth/authorize?client_id={{ env('FEISHU_APP_ID') }}&redirect_uri={{  env('FEISHU_REDIRECT_URI', '') }}&response_type=code&state=STATE";
    var QRLoginObj = QRLogin({
        id: "erweima",
        goto: gotoUrl,
        width: "350",
        height: "350",
        style: "width:350px;height:350px" //可选的，二维码html标签的style属性
    });

    var handleMessage = function(event) {
        var origin = event.origin;
        // 使用 matchOrigin 方法来判断 message 来自页面的url是否合法
        if (QRLoginObj.matchOrigin(origin)) {
            var loginTmpCode = event.data;
            // 在授权页面地址上拼接上参数 tmp_code，并跳转
            window.location.href = `${gotoUrl}&tmp_code=${loginTmpCode}`;
        }
    };
    if (typeof window.addEventListener != 'undefined') {
        window.addEventListener('message', handleMessage, false);
    } else if (typeof window.attachEvent != 'undefined') {
        window.attachEvent('onmessage', handleMessage);
    }
</script>
@endsection