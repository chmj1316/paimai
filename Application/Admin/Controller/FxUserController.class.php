<?php
/**
 * 后台分销用户控制器
 */
namespace Admin\Controller;
use Admin\Common\AController;
class FxUserController extends AController {
    private $db;
    private $title;

    /**
     * 初始化
     * @param  integer $type 商品类型 1、分销商品， 2、积分商品
     * @return  模版输出
     */
    public function _init () {
        $this->title = '分销用户';
        //获取类名称
        $class_name = str_replace('Controller', '', substr(strrchr(__CLASS__, '\\'), 1));
        $this->assign('__ACT__', strtolower(MODULE_NAME.'/'.CONTROLLER_NAME.'/index'));
        $this->meta_head = '<a href="'.U($class_name . '/index').'">'. $this->title .'管理</a>';
        $this->db = D('User');
        $this->assign('class_name', $class_name);
    }

    /* 列表 */
    public function index(){
        $map = $search = array(
            'status' => 1
        );
        $user_name = I('user_name');
        if (!empty($user_name)) {
            $map['user_name'] = array('like', '%'. $user_name .'%');
            $search['user_name'] = $user_name;
        }
        $fx_group = I('fx_group');
        if (!empty($fx_group)) {
            $map['fx_group'] = $fx_group;
            $search['fx_group'] = $fx_group;
        }
        $list = $this->lists('User', $map, 'update_time desc');
        $this->assign('list', $list);
        $this->assign('search', $search);
        $this->meta_title = $this->title . '列表';
        $this->display();
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
            $user_id = I('user_id',0,'intval');
            $info = $this->db->find($user_id);
            if (!$info) {
                $this->error('不存在！');
            } else {
                $this->assign('info', $info);
            }
            $this->meta_title = '更新' . $this->title;
            $this->display();
        }
    }

    /*  删除 */
    public function del() {
        $user_id = array_unique((array)I('user_id',0));
        //print_r($user_id); exit;
        if ( empty($user_id) ) {
            $this->error('请选择要操作的数据!');
        }
        $map = array('user_id' => array('in', $user_id) );
        if($this->db->where($map)->setField('status', 0)){
            action_log();
            $this->success('成功');
        } else {
            $this->error('失败！');
        }
    }

    /* 分销等级 */
    public function fxList(){
        $list = $this->lists('FxGroup', $map, 'id asc');
        $this->assign('list', $list);
        $this->meta_title = '分销等级';
        $this->display();
    }

    /* 分销等级修改 */
    public function fxEdit() {
        $FxGroup = D('FxGroup');
        if (IS_POST) {
            if (!$FxGroup->update()) {
                $this->error($FxGroup->getError());
            } else {
                action_log();
                $this->updateCache();
                $this->success('更新成功', U('fxList'));
            }
        } else {
            $id = I('id',0,'intval');
            $info = $FxGroup->find($id);
            if (!$info || !$id) {
                $this->error('不存在！');
            } else {
                $this->assign('info', $info);
            }
            $this->meta_title = '更新分销等级';
            $this->display();
        }
    }


    /* 更新缓存 */
    protected function updateCache() {
        S('FX_GROUP_LISTS', null);
    }
}
