CREATE TABLE IF NOT EXISTS `jfsd_fx_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL DEFAULT '' COMMENT '等级名称',
  `lqshu` int(10) NOT NULL DEFAULT '0' COMMENT '每天领取红包数',
  `beishu` int(10) NOT NULL DEFAULT '0' COMMENT '升级倍数',
  `zhituishu` int(10) NOT NULL DEFAULT '0' COMMENT '升级直推数',
  `min_price` double(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '最好红包金额',
  `max_price` double(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '最大红包金额',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分销等级表';

CREATE TABLE IF NOT EXISTS `jfsd_fx_hongbao_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '收支名称',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '支出红包数',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '记录描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分销红包明细表';

CREATE TABLE IF NOT EXISTS `jfsd_fx_inter_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '收支名称',
  `order_id` char(20) NOT NULL DEFAULT '' COMMENT '订单uid',
  `inter` double(9,2) NOT NULL DEFAULT '0.00' COMMENT '支出积分',
  `at_inter` double(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '当前积分',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '记录描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分销积分明细表';

CREATE TABLE IF NOT EXISTS `jfsd_fx_money_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户id',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '收支名称',
  `order_id` char(20) NOT NULL DEFAULT '' COMMENT '订单uid',
  `money` double(9,2) NOT NULL DEFAULT '0.00' COMMENT '支出金额',
  `at_money` double(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '当前余额',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '记录描述',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分销佣金明细表';

CREATE TABLE IF NOT EXISTS `jfsd_fx_order` (
  `order_id` char(20) NOT NULL DEFAULT '' COMMENT '订单编号',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '用户',
  `address_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收货地址',
  `price` double(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '价格',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `order_info` text NOT NULL COMMENT '订单信息',
  `pay_status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '支付状态',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='分销订单表';

CREATE TABLE IF NOT EXISTS `jfsd_fx_product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '产品自增id',
  `product_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '产品类型1：普通商品 2：积分商品',
  `product_cate` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '产品分类',
  `product_name` varchar(100) NOT NULL DEFAULT '' COMMENT '产品名称',
  `product_desc` varchar(600) NOT NULL DEFAULT '' COMMENT '产品描述',
  `thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '产品封面图片',
  `images` varchar(999) NOT NULL DEFAULT '' COMMENT '产品图片',
  `content` text COMMENT '产品内容',
  `jifen_price` double(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '积分价',
  `xian_price` double(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '起拍价',
  `yuan_price` double(9,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '最低加价幅度',
  `view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '展示数量',
  `product_num` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '商品数量',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态 0：未知， 1：正常，2：隐藏',
  `position_1` tinyint(4) NOT NULL DEFAULT '0' COMMENT '推荐位',
  `sort` tinyint(4) NOT NULL DEFAULT '0' COMMENT '排序',
  PRIMARY KEY (`product_id`),
  KEY `product_type` (`product_type`),
  KEY `product_cate` (`product_cate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='分销产品';

CREATE TABLE IF NOT EXISTS `jfsd_fx_product_collect` (
  `collect_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '是谁操作',
  `product` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '收藏的产品',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`collect_id`),
  KEY `user_id` (`user_id`),
  KEY `product` (`product`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='产品收藏记录表';

ALTER TABLE `jfsd_user`
ADD `fx_sup` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT '上级用户' AFTER `shop_group`,
ADD `fx_group` TINYINT UNSIGNED NOT NULL DEFAULT '1' COMMENT '分销等级' AFTER `fx_sup`,
ADD `fx_inter` DOUBLE(9,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '分销积分' AFTER `fx_group`,
ADD `fx_inter_lj` DOUBLE(9,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '分销积分累计' AFTER `fx_group`,
ADD `fx_money` DOUBLE(9,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '分销资金' AFTER `fx_inter`,
ADD `fx_count` DOUBLE(9,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '分销总累计' AFTER `fx_money`,
ADD `fx_hb_lj` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '红包累计数' AFTER `fx_count`,
ADD `fx_hb` int UNSIGNED NOT NULL DEFAULT '0' COMMENT '红包数' AFTER `fx_hb_lj`,
ADD `fx_hb_zxf_lj` DOUBLE(9,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '总消费累计' AFTER `fx_hb`,
ADD `fx_hb_ylqxf_lj` DOUBLE(9,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '已领取红包消费累计' AFTER `fx_hb_zxf_lj`,
ADD `fx_hb_wlqxf_lj` DOUBLE(9,2) UNSIGNED NOT NULL DEFAULT '0.00' COMMENT '未领取红包消费累计' AFTER `fx_hb_ylqxf_lj`,
ADD INDEX (`fx_sup`, `fx_group`);
