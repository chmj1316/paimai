<?php
namespace Fenxiao\Model;
class FlowModel {

    /**
     * 获取购物车信息
     * @return [type] [description]
     */
    public function get() {
        $cart = cookie('cart');
        $count_price = $count_num = 0;
        foreach ($cart as $key => $value) {
            if ($value > 0) {
                $cart[$key] = M('FxProduct')->field('product_id, product_name, thumb, xian_price')->where(array('product_id'=>$key))->find();
                $cart[$key]['num'] = $value;
                $count_price += $value * $cart[$key]['xian_price'];
                $count_num += $value;
            } else {
                unset($cart[$key]);
            }
        }
        return array(
            'cart' => $cart,
            'count_price' => $count_price,
            'count_num' => $count_num
        );
    }

    /**
     * 清空购物车
     */
    public function clear() {
        cookie('cart', null);
        return true;
    }

    /**
     * 更新购物车
     * @param  [type] $product_id 产品id
     * @param  [type] $num        更新数量
     * @return [type]             [description]
     */
    public function update($product_id, $num) {
        if ($product_id) {
            $cart = cookie('cart');
            $cart[$product_id] += $num;
            if ($cart[$product_id] <= 0) {
                $cart[$product_id] = 1;
            }
            cookie('cart', $cart);
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除购物车产品
     * @param  [type] $product_id 产品id
     * @return [type]             [description]
     */
    public function del($product_id) {
        if ($product_id) {
            $cart = cookie('cart');
            unset($cart[$product_id]);
            cookie('cart', $cart);
            return true;
        } else {
            return false;
        }
    }

}
