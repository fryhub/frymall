<?php if (!defined('THINK_PATH')) exit();?>
<?php if(!empty($data)): ?><div class="newmain background">
	  <h4 class="newtitle newproducts"><?php echo ($data["title"]); ?> / <span style="font-style: italic;font-weight: normal; font-size: 14px;">New Products</span></h4>
	  <dl>
		<?php if(is_array($data["list"])): $i = 0; $__LIST__ = $data["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $type = $vo['is_hot']==1?'dt':'dd'; ?>
		<<?php echo ($type); ?> class="akmall-item-list"> 
			<a href="<?php echo U('Item/order',array('id'=>$vo['sn']));?>" title="<?php echo ($vo["name"]); ?>" class="info">
				<div class="img"><img src="<?php if(empty($vo["thumb"])): echo (imageurl($vo["image"])); else: echo (imageurl($vo["thumb"])); endif; ?>" class="lazy" /></div>
			</a>
			<div class="clear"></div>
			<div class="newmain_text">
				<h4><?php echo ($vo["name"]); ?></h4>
				<em><?php echo lang('symbol');?><strong><?php echo ($vo["price"]); ?></strong></em>
				<?php if(floatval($vo['original_price']) > 0): ?><del><?php echo ($vo["original_price"]); ?></del><?php endif; ?>
			</div>
		</<?php echo ($type); ?>><?php endforeach; endif; else: echo "" ;endif; ?>
	  </dl>
	  <div class="clear"></div>
	</div><?php endif; ?>