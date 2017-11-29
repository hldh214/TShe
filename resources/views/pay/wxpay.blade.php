<script type="text/javascript">
    function onBridgeReady() {
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest', {
                "appId": "{{ $pay['appId'] }}",
                "timeStamp": "{{ $pay['timeStamp'] }}",
                "nonceStr": "{{ $pay['nonceStr'] }}",
                "package": "{{ $pay['package'] }}",
                "signType": "{{ $pay['signType'] }}",
                "paySign": "{{ $pay['paySign'] }}"
            },
            function (res) {
                if (res.err_msg === "get_brand_wcpay_request:ok") {
                    location.href = '{{ route('orders.index') }}';
                }
            }
        );
    }

    if (typeof WeixinJSBridge === "undefined") {
        if (document.addEventListener) {
            document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
        } else if (document.attachEvent) {
            document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
            document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
        }
    } else {
        onBridgeReady();
    }
</script>