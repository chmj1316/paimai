<?php
namespace Fenxiao\Controller;
use Fenxiao\Common\IController;
class UserController extends IController {

    public function index(){

        $this->display();
    }

    /**
     * 佣金明细
     */
    public function moneyLog(){
        $User = D('User');
        $lists = $User->getMoneyLog($this->user_info['user_id'], 1);
        $lists2 = $User->getMoneyLog($this->user_info['user_id'], 2);

        print_r($lists);
        $this->assign('lists', $lists);
        $this->assign('lists2', $lists2);
        $this->display();
    }

    /**
     * 积分明细
     */
    public function interLog(){

        $this->display();
    }

    /**
     * 我的分销
     */
    public function fenxiao(){
        $fenxiao = D('User')->getFenxiaoNum($this->user_info['user_id']);
        // print_r($fenxiao);
        $this->assign('fenxiao', $fenxiao);
        $this->display();
    }

    /**
     * 财富管理
     */
    public function caifu(){
        $this->display();
    }

    /**
     * 拆红包
     */
    public function hongbao(){
        if (IS_POST && IS_AJAX) {
            $User = D('User');
            $result = $User->hongbao($this->user_info['user_id']);
            if ($result) {
                $this->success('拆红包成功', U('index'));
            } else {
                $this->error($User->getError(), U('index'));
            }
        } else {
            $this->display();
        }
    }

    /**
     * 佣金提现
     */
    public function tixian(){
        $User = D('User');
        $result = $User->tixian($this->user_info['user_id'], $this->user_info['fx_money']);
        if ($result) {
            $this->success('提现成功', U('index'));
        } else {
            $this->error($User->getError(), U('index'));
        }
        exit;
        if (IS_POST && IS_AJAX) {
            $money = I('money', 0, 'intval');
            $User = D('User');
            $result = $User->tixian($this->user_info['user_id'], $money);
            if ($result) {
                $this->success('提现成功', U('index'));
            } else {
                $this->error($User->getError(), U('index'));
            }
        } else {
            $this->display();
        }
    }

    /**
     * 转金币管理
     */
    public function zhuanMoney() {
        if (IS_POST && IS_AJAX) {
            $uid = I('uid');
            $money = I('money');
            if (empty($uid) || empty($money)) {
                $this->error('非法参数...');
            }
            if ($this->user_info['fx_group'] <= 1) {
                $this->error('普通会员不可以使用转账功能');
            }
            if ($this->user_info['fx_money'] < $money) {
                $this->error('可用数量小于转出数量...');
            }
            $result = D('User')->zhuanMoney($this->user_info['user_id'], $uid, $money);
            if ($result) {
                $this->success('转账成功');
            } else {
                $this->error('转账失败');
            }
        } else {
            $this->display();
        }
    }

    /**
     * 转积分管理
     */
    public function zhuanInter() {
        if (IS_POST && IS_AJAX) {
            $uid = I('uid');
            $inter = I('inter');
            if (empty($uid) || empty($inter)) {
                $this->error('非法参数...');
            }
            if ($this->user_info['fx_group'] <= 1) {
                $this->error('普通会员不可以使用转账功能');
            }
            if ($this->user_info['fx_inter'] < $inter) {
                $this->error('可用数量小于转出数量...');
            }
            $result = D('User')->zhuanInter($this->user_info['user_id'], $uid, $inter);
            if ($result) {
                $this->success('转账成功');
            } else {
                $this->error('转账失败');
            }
        } else {
            $this->display();
        }
    }

    /**
     * 排行榜
     * @param type var Description
     * @return {11:return type}
     */
    public function ranking() {
        $map = array();
        $list = M('User')->where($map)->limit(100)->order('fx_count desc, user_id asc')->select();
        $this->assign('list', $list);
        $this->display();
    }

    /**
     * 我的推广二维码页面
     * @param type var Description
     * @return {11:return type}
     */
    public function tuiguang() {
        $share_uid = I('share_uid');
        if (empty($share_uid)) {
            $this->assign('share_uid', $this->user_info['user_id']);
        } else {
            $this->assign('share_uid', $share_uid);
        }
        $this->display();
    }

    /**
     * 生成我的推广二维码
     * @param  string $value [description]
     * @return [type]        [description]
     */
    public function ewmSharePng($share_uid = 0) {
        vendor("phpqrcode");
        $data = C('WEB_SITE_URL') .U('index', array('share_uid'=>$share_uid));
        // 纠错级别：L、M、Q、H
        $level = 'L';
        // 点的大小：1到10,用于手机端4就可以了
        $size = 4;
        // 下面注释了把二维码图片保存到本地的代码,如果要保存图片,用$fileName替换第二个参数false
        //$path = "images/";
        // 生成的文件名
        //$fileName = $path.$size.'.png';
        \QRcode::png($data, false, $level, $size);
    }

    /**
     * 传入用户UID返回用户名
     */
    public function checkUser($uid = 0) {
        $info = M('User')->where(array('user_id'=>$uid))->getField('user_name');
        if ($info) {
            $this->success($info);
        } else {
            $this->error('用户名不存在');
        }
    }

    // 同步微信信息
    public function sync(){
        $wx_info = $this->WX->getUserInfo($this->user_info['openid']);
        $data = array(
            'user_id' => $this->user_info['user_id'],
            'user_name' => remove_emoji($wx_info['nickname']),
            'user_avatar' => $wx_info['headimgurl'],
            'update_time' => NOW_TIME
        );
        M('User')->save($data);
        $this->redirect('User/index');
    }

    // 强红包
    public function hongBao2(){
        if (!C('HONG_BAO_ALLOW')) {
            $this->resultError('未开启拆红包功能');
        }
        if (!$this->user_info['is_subscribe']) {
            $this->resultError('请先关注公众平台【'. C('WEB_SITE_TITLE') .'】', '', 'http://mp.weixin.qq.com/s?__biz=MzI2OTA4MzI4NA==&mid=401275684&idx=4&sn=215571f800f39c82095f7dca83728a0e#rd');
        }
        if (!$this->user_info['mobile']) {
            $this->resultError('请先完善个人资料手机号参数必填', '', U('Setting/index'));
        }
		// $this->resultError('end', '', U('Setting/index'));
        $shop_id    = I('shop_id', 0, 'intval');
        if (!$shop_id) {
            $this->resultError('无效店铺参数');
        }
        $Hongbao = M('Hongbao');
        $map = array(
            'shop_id'       => $shop_id,
            'user_id'       => $this->user_info['user_id'],
            'create_time'   => array('gt', strtotime(date('Ymd'))),
            'status'        => 1
        );
        $count = $Hongbao->where($map)->count();
        if ($count) {
            $this->resultError('每天每个店铺只能领取一次');
        }
        $moneys = explode('-', C('HONG_BAO_MONEY'));
        if (count($moneys) == 1) {
            $money = $moneys[0];
        } elseif (count($moneys) == 2) {
            $money = mt_rand($moneys[0], $moneys[1]);
        }
        $data = array(
            'user_id'       => $this->user_info['user_id'],
            'shop_id'       => $shop_id,
            'money'         => $money,
            'create_time'   => NOW_TIME,
            'update_time'   => NOW_TIME,
            'status'        => 1
        );
        $result = $Hongbao->add($data);
        if ($result) {
            fund_inc($this->user_info['user_id'], $money, '拆红包');
            // 给卖家发
            // $data = array(
                // 'first' => '你好，【'. $this->user_info['user_name'] .'】获得￥'. $money,
                // 'product_id' => $result,
                // 'product_name' => '抢红包活动',
                // 'remark' => '抢红包时间：' . date('Y-m-d H:i:s')
            // );
            // $this->sendBid($this->user_info['openid'], U('User/index'), $data);
			$shop_data = array(
				'touser' => $this->user_info['openid'],
				'msgtype' => 'news',
				'news' => array(
					'articles' => array(
						array(
							'title' => '抢购红包成功提示',
							'description' => '你好，【'. $this->user_info['user_name'] .'】获得￥'. $money . PHP_EOL . '抢红包时间：' . date('Y-m-d H:i:s'),
							'url' => C('WEB_SITE_URL') . U('User/index'),
							'picurl' => ''
						)
					)
				)
			);
			$this->WX->sendCustomMessage($shop_data);
            $this->resultSuccess('抢红包获得￥'. $money);
        } else {
            $this->resultError();
        }
    }

    // 留言
    public function message(){
        if (IS_POST) {
            $data = array(
                'user_id' => $this->user_info['user_id'],
                'email' => I('email'),
                'content' => I('content'),
                'create_time' => NOW_TIME,
                'update_time' => NOW_TIME
            );
            if (empty($data['content'])) {
                $this->resultError('内容不能为空');
            }
            $result = M('Message')->add($data);
            if ($result) {
                $this->resultSuccess('成功', '', U('index'));
            } else {
                $this->resultError();
            }
        } else {
            $this->display();
        }
    }


}
