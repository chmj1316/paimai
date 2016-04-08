<?php
/**
 * 后台分销订单控制器
 */
namespace Admin\Controller;
use Admin\Common\AController;
class FxOrderController extends AController {
    private $db;
    private $title;

    /**
     * 初始化
     * @return  模版输出
     */
    public function _init () {
        $this->title = '分销订单';
        //获取类名称
        $class_name = str_replace('Controller', '', substr(strrchr(__CLASS__, '\\'), 1));
        $this->assign('__ACT__', strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/index'));
        $this->meta_head = '<a href="'.U($class_name . '/index').'">'. $this->title .'管理</a>';
        $this->db = D('FxOrder');
        $this->assign('class_name', $class_name);
    }

    /* 列表 */
    public function index(){
        $map = $search = array();
        $order_id = I('order_id');
        if (!empty($order_id)) {
            $map['order_id'] = array('like', '%'. $order_id .'%');
            $search['order_id'] = $order_id;
        }
        $status = I('status');
        if (!empty($status)) {
            $map['status'] = $status;
            $search['status'] = $status;
        }
        $list = $this->lists('FxOrder', $map, 'update_time desc');
        foreach ($list as $key => $value) {
            $list[$key]['status_text'] = get_fx_order_status($value['status']);
        }
        $this->assign('list', $list);
        $this->assign('search', $search);
        $this->meta_title = $this->title . '列表';
        $this->display();
    }

    /* 修改 */
    public function edit($order_id = 0) {
        if (empty($order_id)) {
            $this->error('无效参数');
        }
        $info = $this->db->find($order_id);
        if (IS_POST) {
            $status = I('status', '', 'intval');
            $gs = I('gs', '', 'trim');
            $nu = I('nu', '', 'trim');
            $ly = I('ly', '', 'trim');
            $order_info = unserialize($info['order_info']);
            $order_info['kuaidi']['gs'] = $gs;
            $order_info['kuaidi']['nu'] = $nu;
            $order_info['kuaidi']['ly'] = $ly;
            switch ($status) {
                case '3':   //收货操作
                    $map = array(
                        'order_id' => $order_id,
                        'status' => 2,
                        'pay_status' => 1
                    );
                    $data = array(
                        'order_info' => serialize($order_info),
                        'status' => 3,
                        'update_time' => time()
                    );
                    $result = $this->db->where($map)->save($data);
                    break;

                default:    //修改操作
                    $map = array(
                        'order_id' => $order_id
                    );
                    $data = array(
                        'order_info' => serialize($order_info),
                    );
                    $result = $this->db->where($map)->save($data);
                    break;
            }
            if ($result) {
                action_log();
                $this->updateCache();
                $this->success('成功', U('index'));
            } else {
                $this->error($this->db->getError());
            }
        } else {
            if ($info) {
                $info['order_info'] = unserialize($info['order_info']);
                $info['status_text'] = get_fx_order_status($info['status']);
                $info['consign'] = D('Fenxiao/UserConsign')->get($info['address_id']);
                $this->assign('info', $info);
            } else {
                $this->error('不存在！');
            }
            // print_r($info);
            $this->meta_title = '更新' . $this->title;
            $this->display();
        }
    }

    /*  删除 */
    public function del() {
        $order_id = array_unique((array)I('order_id',0));
        //print_r($order_id); exit;
        if ( empty($order_id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('order_id' => array('in', $order_id) );
        if($this->db->where($map)->setField('status', 0)){
            action_log();
            $this->success('成功');
        } else {
            $this->error('失败！');
        }
    }

    /* 更新缓存 */
    protected function updateCache() {

    }
}
