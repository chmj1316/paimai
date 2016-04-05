<?php
namespace Fenxiao\Controller;
use Fenxiao\Common\IController;
class IndexController extends IController {
    private $time = 3600;
    // 首页
    public function index(){
        $FxProduct = M('FxProduct');
        $map = array(
            'position_1' => 1,
            'status' => 1,
        );
        $position_list = $FxProduct->where($map)->order('sort asc')->limit(10)->select();
        $this->assign('position_list', $position_list);
        $this->display();
    }
    // 列表页
    public function lists(){
        if (IS_AJAX) {
            $page_size = 6;
            $page = I('page', 1, 'intval');
            $index = I('index', 1, 'intval');
            $start = ($page - 1) * $page_size;
            $map = array('status' => 1);
            $cate = I('get.cate', 0, 'intval');
            if ($cate) {
                $map['product_cate'] = $cate;
            }
            $type = I('type', 1, 'intval');
            if ($type) {
                $map['product_type'] = $type;
            }
            $keyword = I('request.keyword', '', 'trim');
            if ($keyword) {
                $map['product_name'] = array('like', '%' . $keyword . '%');
            }
            $FxProduct = M('FxProduct');
            $list = $FxProduct->where($map)->order('sort asc')->limit($start .','. $page_size)->select();
            $this->assign('list', $list);
            $this->display('listsAjax');
        } else {
            $souso = array();
            $cate = I('cate', 0, 'intval');
            if ($cate) {
                $souso['cate'] = $cate;
            }
            $type = I('type', 1, 'intval');
            if ($type) {
                $souso['type'] = $type;
            }
            $keyword = I('keyword', '', 'trim');
            if ($keyword) {
                $souso['keyword'] = $keyword;
            }
            $this->assign('souso', $souso);
            $this->display();
        }
    }

    /* 产品 */
    public function product($id) {

        $FxProduct = M('FxProduct');
        $map = array('product_id' => $id);
        $product_info = $FxProduct->where($map)->find();
        if (empty($product_info)) {
            exit;
        }

        $product_info['images'] = unserialize($product_info['images']);

        $this->assign('info', $product_info);

        $this->display();
    }

    public function faxian(){
        if (IS_AJAX) {
            $type = I('id', 0, 'intval');
            $FxProduct = M('FxProduct');
            $map = array(
                'status' => 1,
                'begin_time' => array('lt', NOW_TIME + $this->time),
                'end_time' => array('gt', NOW_TIME),
            );
            if ($type) {
                $map['product_type'] = $type;
            }
            $product_infos = $FxProduct->where($map)->select();
            if ($product_infos) {
                $rand_key = array_rand($product_infos);
                $product_info = $product_infos[$rand_key];
                //print_r($product_info);
                $product_info['product_img'] = C('WEB_SITE_URL') . '/' . array_shift(json_decode($product_info['product_images'], true));
                $this->assign('product_info', $product_info);
            } else {
                $this->assign('product_info', array());
            }
            $this->display('ajaxFaxian');
        } else {
            $this->display();
        }
    }

    public function test(){
        $FxProduct = M('FxProduct');
        /* 秒杀 */
        $map = array(
            'product_type'=>3,
            'status' => 1,
            'position_1' => 1,
            'begin_time' => array('lt', NOW_TIME + $this->time),
            'end_time' => array('gt', NOW_TIME),
        );
        $miaosha_list = $FxProduct->where($map)->order('sort asc')->select();
        foreach ($miaosha_list as $key => $value) {
            $miaosha_list[$key]['product_img'] = C('WEB_SITE_URL') . '/' . array_shift(json_decode($value['product_images'], true));
        }
        $this->assign('miaosha_list', $miaosha_list);
        /* 推荐拍品 */
        $map = array(
            'product_type'=> array('lt', 3),
            'status' => 1,
            'position_1' => 1,
            'begin_time' => array('lt', NOW_TIME + $this->time),
            'end_time' => array('gt', NOW_TIME),
        );
        $position_list = $FxProduct->where($map)->order('sort asc')->select();
        foreach ($position_list as $key => $value) {
            $position_list[$key]['product_img'] = C('WEB_SITE_URL') . '/' . array_shift(json_decode($value['product_images'], true));
        }
        $this->assign('position_list', $position_list);
        /* VIP6店铺 */
        $map = array(
            'shop_group'=> 6,
            'status' => 1
        );
        $shop_list = M('User')->where($map)->order('sort asc')->select();
        $this->assign('shop_list', $shop_list);
        $this->display();
    }


}
