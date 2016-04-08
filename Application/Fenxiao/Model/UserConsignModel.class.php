<?php
namespace Fenxiao\Model;
use Think\Model;
class UserConsignModel extends Model {

    // protected $fields = array('id', 'title', 'email', 'tel', 'content', 'create_time', 'update_time', 'status', 'extend');

    /* 自动验证 */
    protected $_validate = array(
        array('consign_name', 'require', '收货人姓名必填!'),
        array('mobile', 'require', '收货人联系方式必填!'),
        array('province', 'require', '省必填!'),
        array('city', 'require', '城市必填!'),
        array('area', 'require', '区县必填!'),
        array('zipcode', 'require', '邮编必填'),
        array('address', 'require', '详情地址必填'),
    );

    /* 自动完成 */
    protected $_auto = array(
        array('area', '_callbackArea', 3, 'callback'),
        array('create_time', NOW_TIME, 1),
        array('update_time', NOW_TIME, 2),
        array('status', 1)
    );

    public function _callbackArea() {
        $data = array(
            'province' => I('province'),
            'city' => I('city'),
            'area' => I('area')
        );
        if(empty($data)){
            return '';
        } else {
            return json_encode($data);
        }
    }

    public function update($uid){
        $data = $this->create();
        if(!$data){ //数据对象创建错误
            return false;
        }
        /* 添加或更新数据 */
        $data['user_id'] = $uid;
        if(empty($data['address_id'])){
            if ($this->where(array('user_id'=>$uid))->count()) {
                $data['is_default'] = 0;
            } else {
                $data['is_default'] = 1;
            }
            $res = $this->add($data);
        }else{
            $res = $this->save($data);
        }
        return $res;
    }

    public function getList($uid) {
        $lists = M('UserConsign')->where(array('user_id'=>$uid))->select();
        foreach ($lists as $key => $value) {
            $lists[$key] = array_merge($value, json_decode($value['area'], true));
        }
        return $lists;
    }

    public function get($address_id) {
        if (empty($address_id)) {
            return;
        }
        $info = M('UserConsign')->find($address_id);
        return array_merge($info, json_decode($info['area'], true));
    }
}
