<?php
/**
 * 前台用户管理
 */
namespace app\study\controller\index;

class Pay extends \app\study\controller\Init
{

    public function lession()
    {

        $map['id']      = get('id', 'intval', 0);
        $map['is_show'] = 1;

        $data = dao('Article')->getRowContent($map, 'title,btitle,num,class_time,sale_price,dis_price,thumb', 3);
        if (!$data) {
            \denha\Log::error('信息不存在');
        }

        $this->assign('data', $data);
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    public function saveLession()
    {
        if (!$this->uid) {
            $this->appReturn(array('status' => false, 'msg' => '请登录'));
        }

        $data['nickname'] = post('nickname', 'text', '');
        $data['mobile']   = post('mobile', 'text', '');
        $data['goods_id'] = post('id', 'intval', 0);
        $paymethod        = post('paymethod', 'intval', 0);

        if (!$data['nickname']) {
            $this->appReturn(array('status' => false, 'msg' => '请输入姓名'));
        }

        if (!$data['mobile']) {
            $this->appReturn(array('status' => false, 'msg' => '请输入手机号'));
        }

        if (!$paymethod) {
            $this->appReturn(array('status' => false, 'msg' => '请选择支付方式'));
        }

        $result = dao('Orders', 'study')->add($this->uid, 3, $data);
        $this->appReturn($result);
    }

    /** 购买成功后导入课程表 */
    public function getLession()
    {
        $orderSn = get('order_sn', 'text', '');

        $orders = table('Orders')->where('order_sn', $orderSn)->field('is_pay')->find();
        if (!$orders['is_pay']) {
            return false;
        }

        $ordersData = table('OrdersCourse')->where('order_sn', $orderSn)->field('goods_id,sign,teacher_uid')->find();

        //获取课程
        $list = table('ArticleCourseSchedule')->where('id', $ordersData['goods_id'])->find('array');
        //导入学院课程学习记录
        if ($list) {

            //如果已存在则跳出
            $is = table('UserCourseLog')->where('order_sn', $orderSn)->field('id')->find();
            if ($is) {
                return false;
            }

            foreach ($list as $key => $value) {
                $data                = array();
                $data['order_sn']    = $orderSn;
                $data['uid']         = $this->uid;
                $data['teacher_uid'] = $ordersData['teacher_uid'];
                $data['credit']      = $value['credit'];
                $data['start_time']  = $value['start_time'];
                $data['end_time']    = $value['end_time'];
                $data['goods_id']    = $ordersData['goods_id'];

                table('UserCourseLog')->add($data);
            }
        }

        return true;
    }
}
