<?php
/**
 ***************  **************************  ********************************************  **************  ******  **************
 ***************  ****************************    **************************  ************  **************  ******  **  **********
 *************  **  ****************************  ******************            **********  **************  ******  ****  ********
 ***********  ******  **************************************  ******  ******  ************  ************  ********  ****  ********
 *********  **********  **********                              ****  ******                    ********  ********  ********  ****
 *******  **************  ******************  **********************  ******  ************  **********    ********              **
 *****  **              **      ************  **********  **********  ******  ************  ********  **            **************
 *    **********  **********  **************                ********          ****  ******  ******  ****  **********  ************
 ***************  **************************  **********  **********  ******  ******  ****  ************  **********  ************
 *******                  ******************  **********  **********  ******  ******  ****  ************  **********  ************
 ***************  **************************  **********  **********  ******  ************  ************  ************  **********
 *******  ******  ******  ****************  ************  **********  ******  ************  ************  ************  **********
 *********  ****  ****  ******************  ************  **********          ************  ************  **************  ****  **
 ***********  **  **  ******************  **************  **********  ******  ******  ****  ************  **************  ****  **
 ***                          ********  **********  **  ******************************  **  ************  ****************  **  **
 ***********************************  **************  **********************************  **************  ******************    **
 */
namespace Fenxiao\Model;
use Think\Model;
class UserModel extends Model {
    /**
     * 获取佣金明细
     * @param  [type]  $uid  用户uid
     * @param  integer $type 查询类型
     * @return [type]        [description]
     */
    public function getMoneyLog($uid, $type = 0) {
        $FxMoneyLog =D('FxMoneyLog');
        $map = array('uid' => $uid);
        switch ($type) {
            case 1:
                $map['title'] = '佣金返现';
                break;

            default:

                break;
        }
        $lists = $FxMoneyLog->where($map)->order('id desc')->select();
        return $lists;
    }

    /**
     * 获取积分明细
     * @param  [type]  $uid  用户uid
     * @param  integer $type 查询类型
     * @return [type]        [description]
     */
    public function getInterLog($uid, $type = 0) {
        $FxInterLog =D('FxInterLog');
        $map = array('uid' => $uid);
        switch ($type) {
            case 1:
                $map['title'] = '佣金返积分';
                break;

            default:

                break;
        }
        $lists = $FxInterLog->where($map)->order('id desc')->select();
        return $lists;
    }

    /**
     * 获取各级分销人数
     * @param  [type]  $uid   [description]
     * @param  integer $level [description]
     * @return [type]         [description]
     */
    public function getFenxiaoNum($uid, $level = 1) {
        static $count = array();
        if ($uid > 0) {
            $map = array('fx_sup' => $uid);
            $lists = $this->field('user_id, user_name, user_avatar, fx_group')->where($map)->select();
            if ($level <= 3 && $lists) {
                $temp = $level + 1;
                foreach ($lists as $key => $value) {
                    $count[$level]['items'][] = $value;
                    $count[$level]['count'] ++;
                    $this->getFenxiaoNum($value['user_id'], $temp);
                }
                return $count;
            } else {
                return $count;
            }
        }
    }

    /**
     * 转资金处理
     * @param  int $from_uid    从这个用户
     * @param  int $to_uid      到这个用户
     * @param  foot $money      流动多少钱
     * @return bool
     */
    public function zhuanMoney($from_uid, $to_uid, $money) {
        $FxMoneyLog = M('FxMoneyLog');
        $from_map = array('user_id' => $from_uid);
        $from_user_money = $this->where($from_map)->getField('fx_money');
        if ($from_user_money < $money) {
            return false;
        }
        if($this->where($from_map)->setDec('fx_money', $money)) {
            $from_data = array(
                'uid' => $from_uid,
                'title' => '资金转出',
                'money' => -$money,
                'at_money' => $from_user_money,
                'content' => '给' . $to_uid . '用户转出' . $money,
                'create_time' => time(),
                'update_time' => time(),
                'status' => 1
            );
            $FxMoneyLog->add($from_data);
            $to_map = array('user_id' => $to_uid);
            $to_user_money = $this->where($to_map)->getField('fx_money');
            if ($this->where($to_map)->setInc('fx_money', $money)) {
                $this->where($to_map)->setInc('fx_count', $money);
                $to_data = array(
                    'uid' => $to_uid,
                    'title' => '资金转入',
                    'money' => $money,
                    'at_money' => $to_user_money,
                    'content' => '用户' . $from_uid . '给' . '转入' . $money,
                    'create_time' => time(),
                    'update_time' => time(),
                    'status' => 1
                );
                $FxMoneyLog->add($to_data);
                return true;
            }
        }
        return false;
    }

    /**
     * 转积分处理
     * @param  int $from_uid    从这个用户
     * @param  int $to_uid      到这个用户
     * @param  foot $inter      流动多少积分
     * @return bool
     */
    public function zhuanInter($from_uid, $to_uid, $inter) {
        $FxInterLog = M('FxInterLog');
        $from_map = array('user_id' => $from_uid);
        $from_user_inter = $this->where($from_map)->getField('fx_inter');
        if ($from_user_inter < $inter) {
            return false;
        }
        if($this->where($from_map)->setDec('fx_inter', $inter)) {
            $from_data = array(
                'uid' => $from_uid,
                'title' => '积分转出',
                'inter' => -$inter,
                'at_inter' => $from_user_inter,
                'content' => '给' . $to_uid . '用户转出' . $inter,
                'create_time' => time(),
                'update_time' => time(),
                'status' => 1
            );
            $FxInterLog->add($from_data);
            $to_map = array('user_id' => $to_uid);
            $to_user_inter = $this->where($to_map)->getField('fx_inter');
            if ($this->where($to_map)->setInc('fx_inter', $inter)) {
                $this->where($to_map)->setInc('fx_inter_lj', $inter);
                $to_data = array(
                    'uid' => $to_uid,
                    'title' => '积分转入',
                    'inter' => $inter,
                    'at_inter' => $to_user_inter,
                    'content' => '用户' . $from_uid . '给' . '转入' . $inter,
                    'create_time' => time(),
                    'update_time' => time(),
                    'status' => 1
                );
                $FxInterLog->add($to_data);
                return true;
            }
        }
        return false;
    }

    /**
     * 余额支付
     * @param  string $order_id         订单号
     */
    public function pay($order_id) {
        $order = M('FxOrder')->field('user_id, price')->where(array('order_id'=>$order_id))->find();
        $map = array('user_id' => $order['user_id']);
        $FxMoneyLog = M('FxMoneyLog');
        $user_money = $this->where($map)->getField('fx_money');
        if ($user_money >= $order['price']) {
            $result = $this->where($map)->setDec('fx_money', $order['price']);
            if ($result) {
                $data = array(
                    'uid' => $order['user_id'],
                    'title' => '购买消费',
                    'order' => $order_id,
                    'money' => -$order['price'],
                    'at_money' => $user_money,
                    'content' => '余额支付消费',
                    'create_time' => time(),
                    'update_time' => time(),
                    'status' => 1
                );
                return $FxMoneyLog->add($data);
            } else {
                return $result;
            }
        } else {
            $this->error = '可用余额有限';
            return false;
        }
    }

    /**
     * 分销总处理
     * @param  int $uid                 用户
     * @param  string $order_id         订单号
     */
    public function fenxiao($order_id) {
        $order = M('FxOrder')->field('user_id, price')->where(array('order_id'=>$order_id))->find();
        if ($order) {
            $this->order_id = $order['order_id'];
            $this->_fenxiaoMoney($order['user_id'], $order['price']);
            $this->_fenxiaoInter($order['user_id'], $order['price']);
            $this->_hongbaoMoney($order['user_id'], $order['price']);
            return true;
        } else {
            return $order;
        }
    }

    /**
     * 提现处理
     * @param  int  $uid        用户Uid
     * @param  fool $money      提现金额
     * @return bool
     */
    public function tixian($uid, $money) {
        $map = array('user_id' => $uid);
        $user = $this->field('openid,fx_group,fx_money')->where($map)->find();
        if ($user['fx_money'] < $money) {
            $this->error = '可提现金额有限';
            return false;
        }
        if ($user['fx_group'] < 2) {
            $this->error = '正式会员才有提现功能';
            return false;
        }
        // 事务开启
        $this->startTrans();
        $result = $this->where($map)->setDec('fx_money', $money);
        if($result) {
            $data = array(
                'uid' => $uid,
                'title' => '佣金提现',
                'money' => -$money,
                'at_money' => $user['fx_money'],
                'content' => '手动提现' . $money,
                'create_time' => time(),
                'update_time' => time(),
                'status' => 1
            );
            M('FxMoneyLog')->add($data);
            // 对接微信企业转账
            $result =  $this->_transfer($user['openid'], $money, '佣金提现');
            if ($result) {
                // 事务提交
                $this->commit();
            } else {
                // 事务回滚
                $this->rollback();
            }
            return $result;
        } else {
            return $result;
        }
    }

    /**
     * 强红包
     * @param int $uid      用户uid
     * @return bool
     */
    public function hongbao($uid) {
        $map = array('user_id' => $uid);
        $user = $this->field('openid, fx_group, fx_hb')->where($map)->find();
        $fx_group = get_fx_group($user['fx_group']);
        if ($user['fx_group'] < 3) {
            $this->error = 'VIP会员才有抢红包功能';
            return false;
        }
        if ($fx_group['lqshu'] >= M('FxHongbaoLog')->where(array('uid' => $uid,'create_time'=>array('gt',strtotime(date('Ymd')))))->count()) {
            $this->error = '每天最多可以领取'. $fx_group['lqshu'] . '个红包';
            return false;
        }
        if ($user['fx_hb'] < 1) {
            $this->error = '可领红包数量小于1';
            return false;
        }
        $this->where($map)->setDec('fx_hb');
        $money = mt_rand($fx_group['min_price'], $fx_group['max_price']);
        M('FxHongbaoLog')->add(array(
            'uid' => $uid,
            'title' => '领取红包',
            'num' => -$num,
            'money' => $money,
            'content' => $fx_group['name'] . '会员等级，随机金额' . $fx_group['min_price'] . ' - ' . $fx_group['max_price'],
            'create_time' => time(),
            'update_time' => time(),
            'status' => 1
        ));
        //减少红包数量
        if ($this->_andhongbao($uid, 1, 0)) {
            // 对接微信企业转账
            return $this->_transfer($user['openid'], $money, '返利红包');
        }
    }

    /**
     * 企业付款测试
     */
    private function _transfer($openid, $money, $title) {
        vendor('WxPayPubHelper.WxPayPubHelper');
        $mchPay = new \WxMchPay();
        // 用户openid
        $mchPay->setParameter('openid', $openid);
        // 商户订单号
        $mchPay->setParameter('partner_trade_no', 'YB-' . time() . mt_rand(1000, 9999));
        // 校验用户姓名选项
        $mchPay->setParameter('check_name', 'NO_CHECK');
        // 企业付款金额  单位为分
        $mchPay->setParameter('amount', $money * 100);
        // 企业付款描述信息
        $mchPay->setParameter('desc', $title);
        // 调用接口的机器IP地址  自定义
        $mchPay->setParameter('spbill_create_ip', '127.0.0.1'); # getClientIp()
        // 收款用户姓名
        // $mchPay->setParameter('re_user_name', 'Max wen');
        // 设备信息
        // $mchPay->setParameter('device_info', 'dev_server');

        $response = $mchPay->postXmlSSL();
        if( !empty($response) ) {
            $data = \Common_util_pub::xmlToArray($response);
            if ($data['return_code'] == 'SUCCESS') {
                return true;
            } else {
                $this->error = $data['return_msg'];
                return false;
            }
        }else{
            $this->error = 'transfers_接口出错';
            return false;
        }
    }

    /**
     * 基础分销金额处理
     * @param  int $uid             用户
     * @param  fool $price          金额
     * @return bool
     */
    private function _fenxiaoMoney($uid, $price, $level = 0) {
        if ($level) {
            $fx_bili = C('FEIXIAO_BILI');
            if (C('FENXIAO_JIFEN_ALLOW')) {
                $money = $price * $fx_bili[$level] * (1 - C('FEIXIAO_JIFEN_BILI'));
            } else {
                $money = $price * $fx_bili[$level];
            }
            $map = array('user_id' => $uid);
            $FxMoneyLog = M('FxMoneyLog');
            $user_money = $this->where($map)->getField('fx_money');
            if ($this->where($map)->setInc('fx_money', $money)) {
                $this->where($map)->setInc('fx_count', $money);
                $data = array(
                    'uid' => $uid,
                    'title' => '佣金返现',
                    'order' => $this->order_id,
                    'money' => $money,
                    'at_money' => $user_money,
                    'content' => '第'.$level.'层粉丝获得佣金',
                    'create_time' => time(),
                    'update_time' => time(),
                    'status' => 1
                );
                $FxMoneyLog->add($data);
            }
        }
        // 三级分销递归处理
        $user = $this->field('fx_sup')->where($map)->find();
        if ($user['fx_sup'] > 0 && $level < 3) {
            $this->_fenxiaoMoney($user['fx_sup'], $price, ++$level);
        } else {
            return false;
        }
    }

    /**
     * 基础分销积分处理
     * @param  int $uid            用户
     * @param  fool $price         金额
     * @return bool
     */
    private function _fenxiaoInter($uid, $price, $level = 0) {
        if (!C('FENXIAO_JIFEN_ALLOW')) {
            return false;
        }
        if ($level) {
            $fx_bili = C('FEIXIAO_BILI');
            if (C('FENXIAO_JIFEN_ALLOW')) {
                $inter = $price * $fx_bili[$level] * C('FEIXIAO_JIFEN_BILI');
            } else {
                $inter = $price * $fx_bili[$level];
            }
            $map = array('user_id' => $uid);
            $FxInterLog = M('FxInterLog');
            $user_inter = $this->where($map)->getField('fx_inter');
            if ($this->where($map)->setInc('fx_inter', $inter)) {
                $this->where($map)->setInc('fx_inter_lj', $inter);
                $data = array(
                    'uid' => $uid,
                    'title' => '佣金返积分',
                    'order' => $this->order_id,
                    'inter' => $inter,
                    'at_inter' => $user_inter,
                    'content' => '第'.$level.'层粉丝获得积分',
                    'create_time' => time(),
                    'update_time' => time(),
                    'status' => 1
                );
                $FxInterLog->add($data);
            }
        }
        // 三级分销递归处理
        $user = $this->field('fx_sup')->where($map)->find();
        if ($user['fx_sup'] > 0 && $level < 3) {
            $this->_fenxiaoInter($user['fx_sup'], $price, ++$level);
        } else {
            return false;
        }
    }

    /**
     * 红包分销处理
     * @param  int $uid         用户
     * @param  font $money      金额
     * @return bool
     */
    private function _hongbaoMoney($uid, $money, $level = 0) {
        $base = C('HONG_BAO_BASE');
        $fx_group_list = get_fx_group();
        $map = array('user_id' => $uid);
        $this->where($map)->setInc('fx_hb_zxf_lj', $money);
        $user = $this->field('fx_sup,fx_group,fx_hb_zxf_lj,fx_hb_wlqxf_lj')->where($map)->find();

        //处理是否符合增加红包条件
        $hb_wlqxf_lj = $user['fx_hb_wlqxf_lj'] + $money;
        if ($hb_wlqxf_lj >= ($base * 2)) {
            $hb_shu = floor($hb_wlqxf_lj / ($base * 2));
            $this->_andhongbao($uid, $hb_shu);                                      // +红包
            $shu = $base * 2 * $hb_shu;
            $this->where($map)->setInc('fx_hb_ylqxf_lj', $shu);      // +已领取消费
            $this->where($map)->setField('fx_hb_wlqxf_lj', $hb_wlqxf_lj - $shu);  // -未领取消费
        } else {
            $this->where($map)->setInc('fx_hb_wlqxf_lj', $money);               // +未领取消费
        }
        // 自消费2个399, 升级为vip1；
        if ($level === 0 && $money >= ($base * 2) && $user['fx_group'] == 1) {
            $this->where($map)->setField('fx_group', 3);
            $this->_andhongbao($uid, 20);   //送20个红包
        }
        // 自消费1个399, 升级为正式会员；
        if ($level === 0 && $money >= $base && $user['fx_group'] == 1) {
            $this->where($map)->setField('fx_group', 2);
        }
        // 是否符合升级条件
        $zhituishu = $this->where(array('fx_sup'=>$uid))->count();
        foreach (get_fx_group() as $key => $value) {
            //是否达到总分销记录和直推数， 并防止等级倒退, 必须是普通会员以上才可以升级
            if ($user['fx_group'] > 1 && $key > $user['fx_group'] && $user['fx_hb_zxf_lj'] >= ($value['beishu'] * $base) &&  $zhituishu >= $value['zhituishu']) {
                $this->where($map)->setField('fx_group', $key);
                if ($key == 3) {
                    $this->_andhongbao($uid, 20);   //送20个红包
                }
            }
        }
        // 三级分销递归处理
        if ($user['fx_sup'] > 0 && $level < 3) {
            $this->_hongbaoMoney($user['fx_sup'], $money, ++$level);
        } else {
            return false;
        }
    }

    /**
     * 红包操作
     * @param int  $uid     用户uid
     * @param int  $num     红包梳理
     * @param int  $act     1增， 0减
     */
    private function _andhongbao($uid, $num, $act = 1) {
        $map = array('user_id' => $uid);
        if ($act) {
            if ($result = $this->where($map)->setInc('fx_hb', $num)) {
                $this->where($map)->setInc('fx_hb_lj', $num);
                //红包明细记录
                return M('FxHongbaoLog')->add(array(
                    'uid' => $uid,
                    'title' => '获得红包',
                    'num' => $num,
                    'content' => '获得红包' . $num . '个',
                    'create_time' => time(),
                    'update_time' => time(),
                    'status' => 1
                ));
            } else {
                return $result;
            }
        } else {
            if ($result = $this->where($map)->setDec('fx_hb', $num)) {
                //红包明细记录
                return M('FxHongbaoLog')->add(array(
                    'uid' => $uid,
                    'title' => '领取红包',
                    'num' => -$num,
                    'content' => '领取' . $num . '个红包，红包数量减少',
                    'create_time' => time(),
                    'update_time' => time(),
                    'status' => 1
                ));
            } else {
                return $result;
            }
        }
    }


}

/**
**************  ************************************  ******************************  **********
******  ******  ****************                ****  **********                ****  **********
******  ******  ******  ********************  ******  **********************  ******  **********
******                    ********        **  ****  ******  ******        **  ****  ******  ****
****  ********  ******************  ****  **  ****            ****  ****  **  ****            **
****  ********  ******************  ****  **  **  ********  ******  ****  **  **  ********  ****
**  **********  ******************        **    ****  **  ********        **    ****  **  ******
**************  **********  ****************  ******  **********************  ******  **********
                              **                ****  **********                ****  **********
**************  ****************************  ******  **********************  ******  **********
**************  ******************        **  ******  ************        **  ******  **********
**************  ******************  ****  **  ****  **  **********  ****  **  ****  **  ********
**************  ******************  ****  **  ****  **  **********  ****  **  ****  **  ********
**************  ******************        **  **  ******  ********        **  **  ******  ******
**************  ****************************  **  ********    **************  **  ********    **
**************  ************************    **  **********  ************    **  **********  ****
*/
