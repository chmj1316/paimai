<?php
namespace Fenxiao\Controller;
use Fenxiao\Common\IController;
class OrderController extends IController {

    /**
     * 订单
     */
    public function index() {
        $map = array('user_id'=>$this->user_info['user_id']);
        $status = I('status');
        if (!empty($status)) {
            $map['status'] = $status;
            $souso['status'] = $status;
        }
        $lists = M('FxOrder')->where($map)->select();
        foreach ($lists as $key => $value) {
            $order_info = unserialize($value['order_info']);
            $product = array_pop($order_info['cart']);
            $lists[$key]['thumb'] = thumb($product['thumb']);
            $lists[$key]['num'] = $order_info['count_num'];
            $lists[$key]['url'] = U('show', array('order_id'=>$value['order_id']));
            $lists[$key]['status_text'] = get_fx_order_status($value['status']);

        }
        // echo '<pre>';
        // print_r($lists);
        // echo '</pre>';
        $this->assign('lists', $lists);
        $this->assign('souso', $souso);
        $this->display();
    }

    /**
     * 订单详情
     */
    public function show($order_id = 0) {
        if (empty($order_id)) {
            $this->error('非法参数...');
        }
        $map = array('user_id'=>$this->user_info['user_id'], 'order_id'=>$order_id);
        $order_info = M('FxOrder')->where($map)->find();
        $order_info['order_info'] = unserialize($order_info['order_info']);
        $order_info['status_text'] = get_fx_order_status($order_info['status']);
        $order_info['consign'] = D('UserConsign')->get($order_info['address_id']);
        $this->assign('info', $order_info);
        $this->display();
    }

    /**
     * 支付
     */
    public function pay() {



        $this->display();
    }

    /**
     * 签收
     */
    public function sign($order_id = 0) {
        if (empty($order_id)) {
            $this->error('非法参数...');
        }
        $map = array('user_id'=>$this->user_info['user_id'], 'order_id'=>$order_id, 'status'=>3);
        $data = array(
            'status' => 4,
            'update_time' => time()
        );
        $result = M('FxOrder')->where($map)->save($data);
        if ($result) {
            //执行分销逻辑
            D('User')->fenxiao($order_id);
            $this->success('成功');
        } else {
            $this->error('失败');
        }
    }


}
