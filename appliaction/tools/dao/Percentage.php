<?php
/**
 * 手续费模块
 */
namespace app\tools\dao;

class Percentage
{
    public function getOnePercentage($orderSn)
    {
        if (!$orderSn) {
            return 0;
        }

        $map['type']          = 1;
        $map['status']        = 1;
        $map['order_status']  = array('>=', 3);
        $map['is_percentage'] = 0;
        $map['order_sn']      = $orderSn;

        $orders = table('Orders')->where($map)->field('seller_uid,acount')->find();
        if (!$orders) {
            return 0;
        }

        $user = dao('User')->getInfo($orders['seller_uid'], 'type');
        if ($user['type'] == 1) {
            return 0;
        } else {
            $percent = (int) dao('Param')->getValue(1);
            return max($orders['acount'] * $percent / 100, 0);
        }

    }
}
