<?php
namespace app\tools\dao;

class User
{
    /**
     * 注册
     * @date   2017-09-18T13:52:36+0800
     * @author ChenMingjiang
     * @param  array                    $data      [description]
     * @param  string                   $password2 [description]
     * @param  integer                  $isAgree   [description]
     * @param  string                   $code      [description]
     * @return [type]                              [description]
     */
    public function register($data = array(), $password2 = '', $isAgree = 0, $code = '')
    {
        $data['password'] = trim(strtolower($data['password']));
        if (!in_array($data['type'], array(1, 2))) {
            return array('status' => false, 'msg' => '请选择商家/个人注册');
        }

        if (!$data['username']) {
            return array('status' => false, 'msg' => '请输入用户名');
        }

        if (!$data['mobile']) {
            return array('status' => false, 'msg' => '请输入手机号码');
        }

        if (!$data['password']) {
            return array('status' => false, 'msg' => '请输入密码');
        }

        if ($data['password'] !== $password2) {
            return array('status' => false, 'msg' => '两次密码不一致');
        }

        if (!preg_match("/^1[34578]{1}\d{9}$/", $data['mobile'])) {
            return array('请输入正确的电话号码');
        }

        if (!$isAgree) {
            return array('status' => false, 'msg' => '请勾选服务协议');
        }

        $isUser = table('User')->where(array('username' => $data['username']))->field('id')->find('one');
        if ($isUser) {
            return array('status' => false, 'msg' => '用户名已注册请更换用户名');
        }

        $isMobile = table('User')->where(array('mobile' => $data['mobile']))->field('id')->find('one');
        if ($isUser) {
            return array('status' => false, 'msg' => '手机号已注册');
        }

        $data['salt']     = rand(10000, 99999);
        $data['password'] = md5($data['password'] . $data['salt']);
        $data['created']  = TIME;
        $data['ip']       = getIP();

        $reslut = table('User')->add($data);
        if (!$reslut) {
            return array('status' => false, 'msg' => '注册失败');
        }

        if ($data['type'] == 2) {
            table('UserShop')->add(array('uid' => $reslut, 'name' => $data['username']));
        }

        return array('status' => true, 'msg' => '注册成功');
    }

    /**
     * 登录
     * @date   2017-09-18T13:52:44+0800
     * @author ChenMingjiang
     * @param  [type]                   $account  [description]
     * @param  [type]                   $password [description]
     * @return [type]                             [description]
     */
    public function login($account, $password)
    {
        $password = trim(strtolower($password));
        if (!$account) {
            return array('status' => false, 'msg' => '请输入手机号/用户名');
        }

        if (!$password) {
            return array('status' => false, 'msg' => '请输入手机号码');
        }

        $map['mobile']   = array('or', $account);
        $map['username'] = $account;
        $user            = table('User')->where($map)->field('type,password,salt,id')->find();
        if (!$user) {
            return array('status' => false, 'msg' => '该用户不存在');
        }

        if (md5($password . $user['salt']) != $user['password']) {
            return array('status' => false, 'msg' => '密码有误');
        }

        $data['token']    = md5(TIME . $user['salt']);
        $data['time_out'] = TIME + 3600 * 24 * 2;
        $data['type']     = $user['type'];

        $reslut = table('User')->where(array('id' => $user['id']))->save($data);

        if (!$reslut) {
            return array('status' => false, 'msg' => '登录失败');
        }

        return array('status' => true, 'msg' => '登录成功', 'data' => $data);
    }

    /**
     * 检测用户今日可用行为 每日签到/每日分享
     * @date   2017-09-18T13:58:32+0800
     * @author ChenMingjiang
     * @param  integer                  $uid [description]
     * @return boolean                       [true 可用 false 不可用]
     */
    public function todayAvailableBehavior($uid = 0, $content = '每日签到')
    {
        if (!$uid) {
            return array('status' => false, 'msg' => '参数错误', 'data' => false);
        }
        //今日时间戳
        $map['created'] = array('>=', mktime(0, 0, 0, date('m'), date('d'), date('Y')));
        $map['uid']     = $uid;
        $map['content'] = $content;

        $is = table('IntegralLog')->where($map)->field('id')->find();
        //echo table('IntegralLog')->getSql();die;
        if ($is) {
            return array('status' => true, 'msg' => '已操作', 'data' => array('bool' => false));
        }

        return array('status' => true, 'msg' => '可用', 'data' => array('bool' => true));
    }

    /**
     * 获取我的积分
     * @date   2017-09-18T15:34:26+0800
     * @author ChenMingjiang
     * @param  integer                  $uid [description]
     * @return [type]                        [description]
     */
    public function getIntegral($uid = 0)
    {
        if (!$uid) {
            return false;
        }

        $data = (int) table('User')->where(array('id' => $uid))->field('integral')->find('one');

        return $data;
    }
}
