<?php
/**
 * 后台分销商品控制器
 */
namespace Admin\Controller;
use Admin\Common\AController;
class FxProductController extends AController {
    private $db;
    private $title;

    /**
     * 初始化
     * @param  integer $type 商品类型 1、分销商品， 2、积分商品
     * @return  模版输出
     */
    public function _init () {
        $this->title = '商品';
        //获取类名称
        $class_name = str_replace('Controller', '', substr(strrchr(__CLASS__, '\\'), 1));
        $this->assign('__ACT__', strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/index'));
        $this->meta_head = '<a href="'.U($class_name . '/index').'">'. $this->title .'管理</a>';
        $this->db = D('FxProduct');
        $this->assign('class_name', $class_name);
    }

    /**
     * 商品列表
     * @return 模版输出
     */
    public function index(){
        $map = $search = array(
            'status' => 1
        );
        $title = I('title');
        if (!empty($title)) {
            $map['product_name'] = array('like', '%'. $title .'%');
            $search['title'] = $title;
        }
        $cate = I('cate');
        if (!empty($cate)) {
            $map['product_cate'] = $cate;
            $search['product_cate'] = $cate;
        }
        $type = I('type');
        if (!empty($type)) {
            $map['product_type'] = $type;
            $search['product_type'] = $type;
        }
        $list = $this->lists('FxProduct', $map, 'update_time desc');
        $this->assign('list', $list);
        $fields = M()->query('SHOW FULL COLUMNS FROM __FX_PRODUCT__');
        $positions = array();
        foreach ($fields as $key => $value) {
            if (strpos($value['field'], 'position_') !== false) {
                $positions[$value['field']] = $value['comment'];
            }
        }
        unset($fields);
        $this->assign('positions', $positions);
        $this->assign('search', $search);
        $this->meta_title = $this->title . '列表';
        $this->display();
    }

    /* 批量推荐 */
    public function position($product_id = 0, $position = '', $status = 0) {
        if (empty($product_id) || empty($position)) {
            $this->error('参数错误');
        }
        if($this->db->where(array('product_id'=>$product_id))->setField($position, $status)){
            action_log();
            $this->success('成功');
        } else {
            $this->error('失败！');
        }
    }

    /**
     * 添加商品
     * @param
     */
    public function add() {
        if (IS_POST) {
            if (!$this->db->input()) {
                $this->error($this->db->getError());
            } else {
                action_log();
                $this->updateCache();
                $this->success('新增成功', U('index'));
            }
        } else {
            $this->assign('info', array('type'=>$this->type,'catid'=>I('catid')));
            $this->meta_title = '新增' . $this->title;
            $this->display();
        }
    }

    /* 修改 */
    public function edit() {
        if (IS_POST) {
            if (!$this->db->update()) {
                $this->error($this->db->getError());
            } else {
                action_log();
                $this->updateCache();
                $this->success('更新成功', U('index'));
            }
        } else {
            $product_id = I('product_id',0,'intval');
            $info = $this->db->find($product_id);
            if (!$info) {
                $this->error('不存在！');
            } else {
                $info['images'] = unserialize($info['images']);
                $this->assign('info', $info);
            }

            $this->meta_title = '更新' . $this->title;
            $this->display('add');
        }
    }
    /* 排序 */
    public function sort($product_id = 0, $sort = 0) {
        if (empty($product_id)) {
            $this->error('参数错误');
        }
        if($this->db->where(array('product_id'=>$product_id))->setField('sort', $sort)){
            action_log();
            $this->success('成功');
        } else {
            $this->error('失败！');
        }
    }

    /*  删除 */
    public function del() {
        $product_id = array_unique((array)I('product_id',0));
        //print_r($product_id); exit;
        if ( empty($product_id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('product_id' => array('in', $product_id) );
        if($this->db->where($map)->setField('status', 0)){
            action_log();
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }

    /* 更新缓存 */
    protected function updateCache() {

    }
}
