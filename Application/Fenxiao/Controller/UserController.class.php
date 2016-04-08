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

        // print_r($lists);
        $this->assign('lists', $lists);
        $this->assign('lists2', $lists2);
        $this->display();
    }

    /**
     * 积分明细
     */
    public function interLog(){
        $User = D('User');
        $lists = $User->getInterLog($this->user_info['user_id'], 1);
        $lists2 = $User->getInterLog($this->user_info['user_id'], 2);

        // print_r($lists);
        $this->assign('lists', $lists);
        $this->assign('lists2', $lists2);
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
     * 分销列表
     * @param  integer $level 等级
     */
    public function fenxiaoShow($level = 0){
        if (empty($level)) {
            $this->redirect('index');
        }
        $fenxiao = D('User')->getFenxiaoNum($this->user_info['user_id']);
        // print_r($fenxiao);
        $this->assign('fenxiao', $fenxiao);
        $this->assign('level', $level);
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
        // $result = $User->tixian($this->user_info['user_id'], $this->user_info['fx_money']);
        $result = $User->tixian($this->user_info['user_id'], 1);
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

    /**
     * 同步微信信息
     */
    public function syncUserInfo(){
        $wx_info = $this->WX->getUserInfo($this->user_info['openid']);
        $data = array(
            'user_id' => $this->user_info['user_id'],
            'user_name' => remove_emoji($wx_info['nickname']),
            'user_avatar' => $wx_info['headimgurl'],
            'update_time' => NOW_TIME
        );
        M('User')->save($data);
        $this->redirect('index');
    }

    /**
     * 收藏
     */
    public function collect($type = 0, $product_id = 0){
        $FxProductCollect = D('FxProductCollect');
        switch ($type) {
            case '1':   //添加
                $result = $FxProductCollect->input($this->user_info['user_id'], $product_id);
                if ($result) {
                    $this->success('成功', U('collect'));
                } else {
                    $this->error($FxProductCollect->getError());
                }
                break;
            case '2':   //删除
                if (empty($product_id)) {
                    $this->error('非法参数...');
                }
                $result = $FxProductCollect->del($this->user_info['user_id'], $product_id);
                if ($result) {
                    $this->success('成功', U('collect'));
                } else {
                    $this->error($FxProductCollect->getError());
                }
                break;
            default:
                $lists = $FxProductCollect->getLists($this->user_info['user_id']);
                $this->assign('lists', $lists);
                $this->display();
                break;
        }
    }

    /**
     * 收货地址管理
     */
    public function address($type = 0, $address_id = 0){
        $UserConsign = D('UserConsign');
        switch ($type) {
            case '1':   //新增
                if (IS_POST) {
                    $result = $UserConsign->update($this->user_info['user_id']);
                    if ($result) {
                        $redirct_url = cookie('redirct_url');
                        cookie('redirct_url', null);
                        $this->success('成功', $redirct_url ? $redirct_url : U('address'));
                    } else {
                        $this->error($UserConsign->getError());
                    }
                } else {
                    if ($redirct_url = I('redirct_url')) {
                        cookie('redirct_url', U(base64_decode($redirct_url)));
                    }
                    $this->display('addressAdd');
                }
                break;
            case '2':   //修改
                if (empty($address_id)) {
                    $this->error('非法参数...');
                }
                if (IS_POST) {
                    $result = $UserConsign->update($this->user_info['user_id']);
                    if ($result) {
                        $this->success('成功', U('address'));
                    } else {
                        $this->error($UserConsign->getError());
                    }
                } else {
                    $address_info = $UserConsign->where(array('address_id'=>$address_id))->find();
                    $address_info['area'] = json_decode($address_info['area'], true);
                    $this->assign('address_info', $address_info);
                    $this->display('addressAdd');
                }
                break;
            case '3':   //删除
                if (empty($address_id)) {
                    $this->error('非法参数...');
                }
                $result = $UserConsign->where(array('address_id'=>$address_id))->delete();
                if ($result) {
                    $this->success('成功', U('address'));
                } else {
                    $this->error('失败');
                }
                break;
            case '4':   //设置默认
                if (empty($address_id)) {
                    $this->error('非法参数...');
                }
                $UserConsign->where(array('user_id'=>$this->user_info['user_id']))->setField('is_default', 0);
                $result = $UserConsign->where(array('address_id'=>$address_id))->setField('is_default', 1);
                if ($result) {
                    $this->success('成功', U('address'));
                } else {
                    $this->error('失败');
                }
                break;
            default:
                $map = array(
                    'user_id' => $this->user_info['user_id'],
                    'status' => 1
                );
                $lists = $UserConsign->where($map)->select();
                $this->assign('lists', $lists);
                $this->display();
                break;
        }
    }


}
