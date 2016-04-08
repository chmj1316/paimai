<?php
namespace Fenxiao\Model;
use Think\Model;
class FxProductCollectModel extends Model {

    /**
     * 获取收藏列表
     * @param  int $uid 用户uid
     */
    public function getLists($uid) {
        $map = array('user_id' => $uid);
        $lists = $this->where($map)->select();
        $product = array();
        foreach ($lists as $key => $value) {
            $product = M('FxProduct')->field('product_name, thumb')->where(array('product_id'=>$value['product']))->find();
            $lists[$key]['title'] = msubstr($product['product_name'], 0, 15);
            $lists[$key]['thumb'] = thumb($product['thumb']);
            $lists[$key]['url'] = U('Index/product', array('id'=>$value['product']));
            $lists[$key]['del_url'] = U('collect', array('type'=>2, 'product_id'=>$value['product']));
        }
        return $lists;
    }

    /**
     * 加入收藏
     * @param  int   $uid        用户uid
     * @param  int   $product_id 产品id
     * @return [type]             [description]
     */
    public function input($uid, $product_id) {
        if (empty($uid) || empty($product_id)) {
            $this->error = '无效参数';
            return false;
        }
        $map = array(
            'user_id' => $uid,
            'product' => $product_id
        );
        $count = $this->where($map)->count();
        if ($count) {
            $this->error = '已经收藏了';
            return false;
        }
        $data = array(
            'user_id' => $uid,
            'product' => $product_id,
            'create_time' => time(),
            'update_time' => time(),
            'status' => 1
        );
        return $this->add($data);
    }

    /**
     * 删除收藏
     * @param  int   $uid        用户uid
     * @param  int   $address_id 产品id
     * @return [type]             [description]
     */
    public function del($uid, $product_id) {
        if (empty($uid) || empty($product_id)) {
            $this->error = '无效参数';
            return false;
        }
        $map = array(
            'user_id' => $uid,
            'product' => $product_id
        );
        return $this->where($map)->delete();
    }

}
