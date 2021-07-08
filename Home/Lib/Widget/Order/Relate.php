<style>
.fav-list{display:inline-block;width:100%;}
.fav-list li{float:left;margin:10px;width:30%;overflow:hidden;text-align: center;border-radius: 4px 4px; box-shadow: 0 0 5px rgba(0,0,0,0.1);}
.fav-list li  a{display:block;}
.fav-list li .image{max-height: 240px;overflow: hidden;}
.fav-list li .price{padding-top:10px;color:#f60;}
.fav-list li .title{height: 6em;overflow:hidden;}
@media(max-width:660px){
.fav-list li{width:25%;font-size: 12px;}
.fav-list li .image{height:65px;}
}
</style>
<div class="box akmall-detail-content">
	<h2><?php echo lang('RelateItem');?></h2>
	<ul class="fav-list clearfix">
		<?php
			foreach($list as $vo){
				switch(MODULE_NAME){
					case 'Index': $url = U('Index/order',array('id'=>$vo['sn']));break;
					case 'Item': $url = U('Item/order',array('id'=>$vo['sn']));break;
					case 'Wap': $url = U('Wap/order',array('id'=>$vo['sn']));break;
					case 'Order': $url = U('Order/index',array('id'=>$vo['sn'],'tpl'=>'detail'));break;
				}
				echo '<li><a href="'.$url.'" title="'.$vo['name'].'"></a><p class="image"><a href="'.$url.'" title="'.$vo['name'].'"><img src="'.imageUrl($vo['image']).'"></a></p><p class="price">'.L('symbol').$vo['price'].'</p><p class="title">'.$vo['name'].'</p></li>';
			}
		?>
		
		
	</ul>
</div>