<?php
namespace Fenxiao\Controller;
class WxJsApiController extends \Think\Controller {


    public function index($order_id = ''){
        vendor('WxPayPubHelper.WxPayPubHelper');
        //使用jsapi接口
        $jsApi = new \JsApi_pub();
        //=========步骤1：网页授权获取用户openid============
        //通过code获得openid
        if (!isset($_GET['code'])){
            //触发微信返回code码
            $url = $jsApi->createOauthUrlForCode(\WxPayConf_pub::JS_API_CALL_URL . __SELF__);
            Header("Location: $url");
        }else{
            //获取code码，以获取openid
            $code = $_GET['code'];
            $jsApi->setCode($code);
            $openid = $jsApi->getOpenId();
        }

        $unifiedOrder = new \UnifiedOrder_pub();

        $order_info = M('FxOrder')->find($order_id);
        $order_info['product_name'] = '中华聚宝分销商城';
        $unifiedOrder->setParameter("openid", $openid);//商品描述
        $unifiedOrder->setParameter("body", '中华聚宝分销商城共消费￥' . $order_info['price']);//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $out_trade_no = \WxPayConf_pub::APPID.$timeStamp;
        $unifiedOrder->setParameter("out_trade_no", $order_id . '_' . mt_rand(100,999));//商户订单号
        if ($openid == 'olEDawig2ZbRO2v2zBNoyxXB32SE' || $openid == 'olEDawtGeisOHSSa539SCY68xqNc') {
            $unifiedOrder->setParameter("total_fee", $order_info['price']);//总金额
        } else {
            $unifiedOrder->setParameter("total_fee", $order_info['price']*100);//总金额
        }
        $unifiedOrder->setParameter("notify_url", \WxPayConf_pub::NOTIFY_URL_FX);//通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        //非必填参数，商户可根据实际情况选填
        // $unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
        // $unifiedOrder->setParameter("device_info","XXXX");//设备号
        // $unifiedOrder->setParameter("attach","附加数据");//附加数据
        // $unifiedOrder->setParameter("time_start","交易起始时间");//交易起始时间
        // $unifiedOrder->setParameter("time_expire","交易结束时间");//交易结束时间
        // $unifiedOrder->setParameter("goods_tag","商品标记");//商品标记
        $unifiedOrder->setParameter("product_id", $order_id);//商品ID

        $prepay_id = $unifiedOrder->getPrepayId();
        // print_r($unifiedOrder);
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);

        $jsApiParameters = $jsApi->getParameters();

        $this->assign('jsApiParameters',$jsApiParameters);
        $this->assign('order_id', $order_id);
        $this->display();
    }

    public function test($order_id = ''){
        vendor('WxPayPubHelper.WxPayPubHelper');
        //使用jsapi接口
        $jsApi = new \JsApi_pub();
        //=========步骤1：网页授权获取用户openid============
        //通过code获得openid
        if (!isset($_GET['code'])){
            //触发微信返回code码
            $url = $jsApi->createOauthUrlForCode(\WxPayConf_pub::JS_API_CALL_URL . __SELF__);
            Header("Location: $url");
        }else{
            //获取code码，以获取openid
            $code = $_GET['code'];
            $jsApi->setCode($code);
            $openid = $jsApi->getOpenId();
        }

        $unifiedOrder = new \UnifiedOrder_pub();

        $order_info = M('FxOrder')->find($order_id);
        $order_info['product_name'] = '中华聚宝分销商城';
        $unifiedOrder->setParameter("openid", $openid);//商品描述
        $unifiedOrder->setParameter("body", '中华聚宝分销商城共消费￥' . $order_info['price']);//商品描述
        //自定义订单号，此处仅作举例
        $timeStamp = time();
        $out_trade_no = \WxPayConf_pub::APPID.$timeStamp;
        $unifiedOrder->setParameter("out_trade_no", $order_id . '_' . mt_rand(100,999));//商户订单号
        if ($openid == 'olEDawig2ZbRO2v2zBNoyxXB32SE' || $openid == 'olEDawtGeisOHSSa539SCY68xqNc') {
            $unifiedOrder->setParameter("total_fee", $order_info['price']);//总金额
        } else {
            $unifiedOrder->setParameter("total_fee", $order_info['price']*100);//总金额
        }
        $unifiedOrder->setParameter("notify_url", \WxPayConf_pub::NOTIFY_URL_FX);//通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        //非必填参数，商户可根据实际情况选填
        // $unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
        // $unifiedOrder->setParameter("device_info","XXXX");//设备号
        // $unifiedOrder->setParameter("attach","附加数据");//附加数据
        // $unifiedOrder->setParameter("time_start","交易起始时间");//交易起始时间
        // $unifiedOrder->setParameter("time_expire","交易结束时间");//交易结束时间
        // $unifiedOrder->setParameter("goods_tag","商品标记");//商品标记
        $unifiedOrder->setParameter("product_id", $order_id);//商品ID

        $prepay_id = $unifiedOrder->getPrepayId();
        // print_r($unifiedOrder);
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);

        $jsApiParameters = $jsApi->getParameters();

        $this->assign('jsApiParameters',$jsApiParameters);
        $this->assign('order_id', $order_id);
        $this->display();
    }

    public function notify(){
        vendor('WxPayPubHelper.WxPayPubHelper');
        //使用通用通知接口
        $notify = new \Notify_pub();

        //存储微信的回调
        $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $notify->saveData($xml);

        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        if($notify->checkSign() == FALSE){
            $notify->setReturnParameter("return_code","FAIL");//返回状态码
            $notify->setReturnParameter("return_msg","签名失败");//返回信息
        }else{
            $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
        }
        $returnXml = $notify->returnXml();
        echo $returnXml;

        //==商户根据实际情况设置相应的处理流程，此处仅作举例=======

        //以log文件形式记录回调信息
        //         $log_ = new Log_();
        $log_name= 'Public/notify_url.log';//log文件路径
        log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");
        if($notify->checkSign() == TRUE){
            if ($notify->data["return_code"] == "FAIL") {
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【通信出错】:\n".$xml."\n");
            }elseif($notify->data["result_code"] == "FAIL"){
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【业务出错】:\n".$xml."\n");
            }else{
                //此处应该更新一下订单状态，商户自行增删操作
                log_result($log_name,"【支付成功】:\n".$xml."\n");
                list($order_id) = explode('_', $notify->data['out_trade_no']);
                $order_info = M('FxOrder')->where(array('order_id'=>$order_id))->find();
                if ($order_info && $order_info['status'] == 1) {
                    // 更新支付状态
                    $data = array(
                        'pay_status' => 1,
                        'status' => 2,
                        'update_time' => NOW_TIME
                    );
                    M('FxOrder')->where(array('order_id'=>$order_info['order_id']))->save($data);
                }

            }
            //商户自行增加处理流程,
            //例如：更新订单状态
            //例如：数据库操作
            //例如：推送支付完成信息
        }
   }
}
