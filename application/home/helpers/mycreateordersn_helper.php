<?php
/**
 * Created by Tim.
 * User: Tim
 * Date: 2015/10/9
 * Time: 11:35
 */

/**
 * 得到新订单号
 * @return  string
 */

if ( ! function_exists('createOrderSn')) {
    function createOrderSn()
    {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);
        return 101 . date('Ymd') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }
}