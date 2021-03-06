<?php
/**
 * 		订单跟踪模型
 *      [Powerlong] Copyright © 2015-2016 Powerlong Real Estate Holdings Limited All rights reserved.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      Author : gaokang
 *      tel:021-51759999
 */
class order_track_table extends table {

	protected $_validate = array(
        /* array(验证字段1,验证规则,错误提示,[验证条件,附加规则,验证时间]), */
        // 订单号
        array('order_sn', 'require', '{ORDER_SN_NOT_NULL}', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
        // 内容
        array('msg', 'require', '{order/msg_require}', self::MUST_VALIDATE, 'regex', self::MODEL_INSERT),
    );

    //自动完成
    protected $_auto = array(
    	// array(完成字段1,完成规则,[完成条件,附加规则]),
        array('add_time','time',1,'function'),          //新增数据时插入系统时间
        array('clientip','get_client_ip',1,'function'), //更新数据时更新修改时间
    );
}