<?php

return [
    'alipay' => [
        // 支付宝分配的 APPID
        'app_id' => env('ALIPAY_APP_ID'),

        // 支付宝异步通知地址
        'notify_url' => env('ALIPAY_NOTIFY_URL'),

        // 支付成功后同步通知地址
        'return_url' => env('ALIPAY_RETURN_URL'),

        // 阿里公共密钥，验证签名时使用
        'ali_public_key' => env('ALIPAY_PUBLIC_KEY'),

        // 自己的私钥，签名时使用
        'private_key' => env('ALIPAY_PRIVATE_KEY'),
    ],

    'wechat' => [
        // 公众号APPID
        'app_id' => env('WXPAY_APP_ID'),

        // 小程序APPID
        'miniapp_id' => '',

        // APP 引用的 appid
        'appid' => '',

        // 微信支付分配的微信商户号
        'mch_id' => env('WXPAY_MCH_ID'),

        // 微信支付异步通知地址
        'notify_url' => env('WXPAY_NOTIFY_URL'),

        // 微信支付签名秘钥
        'key' => env('WXPAY_KEY'),

        // 客户端证书路径，退款时需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_client' => '',

        // 客户端秘钥路径，退款时需要用到。请填写绝对路径，linux 请确保权限问题。pem 格式。
        'cert_key' => '',
    ],
];
