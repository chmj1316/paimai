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
        $position_list = $FxProduct->where($map)->order('sort asc')->limit(4)->select();
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
            $this->redirect('index');
        }
        $product_info['images'] = unserialize($product_info['images']);
        $product_info['content'] = get_content($product_info['content']);
        // print_r($product_info);
        $this->assign('info', $product_info);
        $this->display();
    }


}
