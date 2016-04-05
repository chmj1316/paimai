<?php if (!defined('THINK_PATH')) exit(); if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><li>
        <p>
            <a href="<?php echo U('product', array('id'=>$val['product_id']));?>" title=""><img src="<?php echo image($val['thumb']);?>" alt=""></a>
        </p>
        <span>
            <a href="<?php echo U('product', array('id'=>$val['product_id']));?>" title="<?php echo ($val['product_name']); ?>"><?php echo ($val['product_name']); ?></a>
            <em class="fix">
                <b>￥<?php echo ($val['xian_price']); ?></b>
                <del>￥<?php echo ($val['yuan_price']); ?></del>
            </em>
        </span>
    </li><?php endforeach; endif; else: echo "" ;endif; ?>