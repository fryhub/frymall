<?php if (!defined('THINK_PATH')) exit(); echo w("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME));?>
<div class="layout-main">    
    <div class="layout-block-header box overview-head">
        <h2 class="overview-username"><?php echo ($_SESSION["user"]["username"]); echo lang('comma_hello');?></h2>
        <div id="OverviewOptimizeAdvice" style="line-height:2em;padding-top:10px;">
            <p><?php echo lang('last_login_time_colon'); echo ($_SESSION["user"]["login_time"]); ?></p>
            <p><?php echo lang('last_login_ip_colon'); echo ($_SESSION["user"]["login_ip"]); ?></p>
			<p>当前版本：<?php echo C('AKMALL_VERSION');?><span id="version"></span></p>
			<?php if(($_SESSION['user']['role']) == "admin"): ?><p>短信余额：<b class="alert" id="sms-balance">0</b></p>
			<?php $update = file_exists('./Public/Database/update.lock'); ?>
			<?php if(!empty($update)): ?><p><a class="btn btn-ok" href="<?php echo U('Version/index');?>">系统升级</a></p><?php endif; endif; ?>
        </div>
    </div>
	<!--
	<div class="layout-block-header box overview-head">
        <h2 class="overview-username">akmall声明</h2>
        <div id="OverviewOptimizeAdvice" style="font-size:14px;line-height:1.8em;padding-top:10px;">
            <p>1、AK单页订单管理系统企业版，作者：<b>123456</b>（微信号），
				官方网址：<a href="http://123456/" target="_blank">123456</a>
			</p>
			<p>2、在使用过程中，若发现bug或需要添加功能，请联系作者。</p>
			<p>3、本系统仅供自己使用，禁止传播和倒卖！</p>
        </div>
    </div>
	-->
	
	<div class="box clear-fix">   
        <div class="ui-table">
            <div class="ui-table-body ui-table-body-hover">
                <table cellpadding="0" cellspacing="0" width="100%" >
                    <thead>
                        <tr class="ui-table-head">
                            <th class="ui-table-hcell">今日统计</th>
							<?php if(is_array($today)): $i = 0; $__LIST__ = $today;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th class="ui-table-hcell"><?php echo ($vo["name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>数量</td>
							<?php if(is_array($today)): $i = 0; $__LIST__ = $today;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td><?php echo (intval($vo["quantity"])); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
						<tr>
                            <td>金额</td>
                            <?php if(is_array($today)): $i = 0; $__LIST__ = $today;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td><?php echo (number_format($vo["price"],2)); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div><!--.box-->
	
	<div class="box clear-fix">   
        <div class="ui-table">
            <div class="ui-table-body ui-table-body-hover">
                <table cellpadding="0" cellspacing="0" width="100%" >
                    <thead>
                        <tr class="ui-table-head">
                            <th class="ui-table-hcell">昨日统计</th>
							<?php if(is_array($yesterday)): $i = 0; $__LIST__ = $yesterday;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th class="ui-table-hcell"><?php echo ($vo["name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>数量</td>
							<?php if(is_array($yesterday)): $i = 0; $__LIST__ = $yesterday;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td class="ui-table-hcell"><?php echo (intval($vo["quantity"])); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
						<tr>
                            <td>金额</td>
                            <?php if(is_array($yesterday)): $i = 0; $__LIST__ = $yesterday;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td class="ui-table-hcell"><?php echo (number_format($vo["price"],2)); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div><!--.box-->
	
	<div class="box clear-fix">   
        <div class="ui-table">
            <div class="ui-table-body ui-table-body-hover">
                <table cellpadding="0" cellspacing="0" width="100%" >
                    <thead>
                        <tr class="ui-table-head">
                            <th class="ui-table-hcell">最近七天</th>
							<?php if(is_array($week)): $i = 0; $__LIST__ = $week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th class="ui-table-hcell"><?php echo ($vo["name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>数量</td>
							<?php if(is_array($week)): $i = 0; $__LIST__ = $week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td class="ui-table-hcell"><?php echo (intval($vo["quantity"])); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
						<tr>
                            <td>金额</td>
                            <?php if(is_array($week)): $i = 0; $__LIST__ = $week;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td class="ui-table-hcell"><?php echo (number_format($vo["price"],2)); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div><!--.box-->
	
	<div class="box clear-fix">   
        <div class="ui-table">
            <div class="ui-table-body ui-table-body-hover">
                <table cellpadding="0" cellspacing="0" width="100%" >
                    <thead>
                        <tr class="ui-table-head">
                            <th class="ui-table-hcell">本月统计</th>
							<?php if(is_array($month)): $i = 0; $__LIST__ = $month;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><th class="ui-table-hcell"><?php echo ($vo["name"]); ?></th><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>数量</td>
							<?php if(is_array($month)): $i = 0; $__LIST__ = $month;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td class="ui-table-hcell"><?php echo (intval($vo["quantity"])); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
						<tr>
                            <td>金额</td>
                            <?php if(is_array($month)): $i = 0; $__LIST__ = $month;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><td class="ui-table-hcell"><?php echo (number_format($vo["price"],2)); ?></td><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
	</div><!--.box-->
<script type="text/javascript">
$(function(){
	$.ajax({
	   type: "GET",
	   url: "<?php echo U('Index/smsBalance');?>",
	   dataType: "json",
	   success:function(data){
			$('#sms-balance').html(data.data);
			$('#sms-balance').html(data.balance);
		}
	});
})
</script>
	<?php echo W("Foot");?>