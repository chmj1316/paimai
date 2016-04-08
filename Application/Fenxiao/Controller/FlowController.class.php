<?php
namespace Fenxiao\Controller;
use Fenxiao\Common\IController;
class FlowController extends IController {

    public function add($product_id = 0, $num = 1){
        if (D('Flow')->update($product_id, $num)) {
            $this->success('成功');
        } else {
            $this->error('失败');
        }
    }

    public function del($product_id = 0){
        if (D('Flow')->del($product_id)) {
            $this->success('成功');
        } else {
            $this->error('失败');
        }
    }

    // 首页
    public function index(){
        $info = D('Flow')->get();
        if (empty($info['cart']) || empty($info['count_price']) || empty($info['count_num'])) {
            $this->error('购物车空空如也', U('Index/index'));
        }
        $this->assign('count_price', $info['count_price']);
        $this->assign('lists', $info['cart']);
        $this->display();
    }

    // 提交订单
    public function submit() {
        if (IS_POST && IS_AJAX) {
            $address_id = I('address_id', 0, 'intval');
            $pay_mode = I('pay_mode', 0, 'intval');
            $content = I('content', '', 'trim');
            if (empty($address_id)) {
                $this->error('收货地址不能为空');
            }
            if (empty($pay_mode)) {
                $this->error('支付方式不能为空');
            }
            $info = D('Flow')->get();
            if (empty($info['cart']) || empty($info['count_price']) || empty($info['count_num'])) {
                $this->error('购物车空空如也', U('Index/index'));
            }
            $info['content'] = $content;
            $order = array(
                'order_id' => create_order_id('FX'),
                'user_id' => $this->user_info['user_id'],
                'address_id' => $address_id,
                'price' => $info['count_price'],
                'order_info' => serialize($info),
                'create_time' => time(),
                'update_time' => time(),
                'pay_status' => 0,
                'status' => 1
            );
            switch ($pay_mode) {
                case '1':   //微信支付
                    if (M('FxOrder')->add($order)) {
                        $this->success('成功', U('WxJsApi/index', array('order_id'=>$order['order_id'])));
                    } else {
                        $this->error('系统错误');
                    }
                    break;
                case '2':   //余额支付
                    if ($this->user_info['fx_money'] >= $info['count_price']) {
                        $order['pay_status'] = 1;
                        $order['status'] = 2;
                        if (M('FxOrder')->add($order)) {
                            D('User')->pay($order['order_id']);
                            D('Flow')->clear();
                            $this->success('成功', U('User/index'));
                        } else {
                            $this->error('系统错误');
                        }
                    } else {
                        $this->error('余额不足');
                    }
                    break;

                default:
                    $this->error('支付方式不能为空');
                    break;
            }
        } else {
            $info = D('Flow')->get();
            if (empty($info['cart']) || empty($info['count_price']) || empty($info['count_num'])) {
                $this->error('购物车空空如也', U('Index/index'));
            }
            $this->assign('count_num', $info['count_num']);
            $this->assign('count_price', $info['count_price']);
            $consign_lists = D('UserConsign')->getList($this->user_info['user_id']);
            $this->assign('consign_lists', $consign_lists);
            $this->display();
        }

    }


}
