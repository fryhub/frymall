<?php if (!defined('THINK_PATH')) exit(); echo W("Main",array('module'=>MODULE_NAME,'action'=>ACTION_NAME,'do'=>$_GET['do']));?>
<script type="text/javascript">
isupload = false;
function akmallUpload(fileInput){
	if(isupload != false){
		$.alert("其他文件正在上传...请稍后");
	}else{
		$(fileInput).click();
	}
}
function uploadImg(fileInput,target,thumb){
	var filename = $(fileInput).val();
    if(filename != '' && filename != null){
    	isupload = true;
        var pic = $(fileInput)[0].files[0];
		console.log(pic);
        var fd = new FormData();
        fd.append('imgFile', pic);
        $.ajax({
            url:'<?php echo U("Public/upload");?>',
            type:"post",
            dataType:'json',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
			beforeSend:function(){
				$('#ajaxLoading').show().find('span').html('正在上传中...');
			},
            success:function(data){
				$('#ajaxLoading').hide();
                if(data.status=='1'){
					if(thumb==true){
						var img = "<p class='img'><img src='__PUBLIC__/Uploads/"+data.data+"' /><span class='del'  onclick='imgDel($(this),\""+data.data+"\")'>删除</span></p>";
						var imgInput = $('input[name='+target.substr(1)+']');
						var imgArray = imgInput.val().split(';');
						imgArray.push(data.data);
						$(target).append(img);
						imgInput.val(imgArray.toString());
						console.log(imgArray);
					}else{
						$(target).val(data.data);
					}
					$.alert('上传成功',1,'',{time:1500});
                }else{
					$.alert(data.data,0,'',{time:1500});
				}
            },
            error:function (){
				$.alert("上传出错了",0,'',{time:2500});
            }
        });
        isupload = false;
    }
    isupload = false;
}

function imgDel(_this,img){ 
	_this.parent().remove();
	var imgInput = $('input[name=slideshow]');
	var imgArray = imgInput.val().split(',');
	var index = imgArray.indexOf(img);
	imgArray.splice(index, 1);
	imgInput.val(imgArray.toString());
	console.log(imgArray);
}
</script>
<style>
.extends-tr .extends-list{display:none;}
.extends-tr .extends-list:first-child,.show .extends-list{display:block;}
.extends-list .item_params{display:none;}
.show .extends-list .item_params{display:table-row;}
#slideshow .img{float:left;position:relative;width:60px;height:40px;margin-right:5px;overflow:hidden;border:1px solid #888;background:#888;text-align:center;}
#slideshow .img img{width:100%;}
#slideshow .img .del{display:none;width:100%;height:20px;line-height:20px;background:#f00;color:#fff;text-align:center;bottom:0;position:absolute;cursor:pointer;opacity:0.8;}
#slideshow .img:hover .del{display:block;}
.slideshow .button{float:left;display: inline-block;cursor: pointer;background: #00c3af;padding: 13px 20px;color: #fff;text-align: center;border-radius: 3px;overflow: hidden;margin-right:20px;border:none;}
.slideshow .button:hover{opacity:0.8;}
</style>
<div class="layout-main">    
    <div id="breadclumb" class="box">
        <h3><strong><?php echo lang('breadclumb_colon');?></strong><?php echo lang(MODULE_NAME);?><span></span><?php if(empty($_GET["id"])): echo lang('add'); else: echo lang('edit'); endif; ?></h3>
    </div>
    <div class="box clear-fix">
		
        <div class="layout-block-header">
			<h2><?php echo lang('details_info'); if(($_GET['do']) == "copy"): ?><b class="alert">【<?php echo lang('item_copy');?>】</b><?php endif; ?></h2>
		</div>  
        <div id="AccountInfo">
            <div class="info-block">
                <form method="post" action="<?php echo U(MODULE_NAME.'/proccess/');?>" id="ajaxform" enctype="multipart/form-data">
                <table class="info-table">
                    <tbody>
						<tr>
                            <th><b class="verifing">*</b><?php echo lang('item_number_colon');?></th>
                            <td>
								<?php if(!empty($_GET['id']) && $_GET['do'] != 'copy'): ?><input name="sn" type="text" class="ui-text validate[required,minSize[4],custom[onlyLetterNumber]]" size="30" value="<?php echo ($info["sn"]); ?>" readonly>
								<?php else: ?>
								<input name="sn" type="text" class="ui-text validate[required,minSize[4],custom[onlyLetterNumber]]" size="30" value="<?php echo randCode(6,'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0987654321');?>"><?php endif; ?>
								<span class="ui-validityshower-info">（只能填写字母和数字，仅新建商品时可编辑）</span>
							</td>
                        </tr>
                    	<tr>
                            <th><b class="verifing">*</b><?php echo lang('item_name_colon');?></th>
                            <td><input name="name" type="text" class="ui-text validate[required,minSize[2]]" size="100" value="<?php echo ($info["name"]); ?>"><span class="ui-validityshower-info">（标题不要出现引号）</span></td>
                        </tr>
						<tr>
                            <th><b class="verifing"></b><?php echo lang('商品别名_colon');?></th>
                            <td><input name="aliasname" type="text" class="ui-text" size="60" value="<?php echo ($info["aliasname"]); ?>"><span class="ui-validityshower-info">（做不认识语言地区时方便管理员识别商品，前端不显示）</span></td>
                        </tr>
						<tr>
                            <th><b class="verifing">*</b><?php echo lang('item_category_colon');?></th>
                            <td>
								<select name="category_id" class="validate[required]">
									<?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($info["category_id"]) == $vo["id"]): ?>selected='selected'<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</td>
                        </tr>
						<!--<tr>
                            <th><?php echo lang('qrcode_payment_colon');?></th>
                            <td>
								<select name="qrcode_pay" id="qrcode_pay" onchange="qrcodepay(this.value)">
									<option value="0">不使用二维码</option>
									<option value="1" <?php if(($info["qrcode_pay"]) == "1"): ?>selected="selected"<?php endif; ?>>固定金额二维码</option>
									<option value="2" <?php if(($info["qrcode_pay"]) == "2"): ?>selected="selected"<?php endif; ?>>不定金额二维码</option>
								</select>
								<span class="ui-validityshower-info">（可使用个人微信二维码或支付宝二维码收款）</span>
							</td>
                        </tr>
						<tr class="qrcode <?php if(!empty($info["qrcode_pay"])): ?>show<?php endif; ?>">
                            <th><?php echo lang('payment_说明_colon');?></th>
                            <td>
								<input name="qrcode_pay_info" class="ui-text" size="50" id="qrcode_pay_info" type="text" value="<?php echo ($info["qrcode_pay_info"]); ?>" >
								<span class="ui-validityshower-info">（换行请用&lt;br&gt;）</span>
							</td>
                        </tr>-->
						<tr>
                            <th><?php echo lang('item_price_colon');?></th>
                            <td>
								<div class="left" style="margin-right: 20px;">
									<label>原价：</label>
									<input name="original_price" class="ui-text" size="4" type="text" value="<?php echo ($info["original_price"]); ?>">
									<!-- <span class="ui-validityshower-info"><?php echo lang('yuan');?></span> -->
								</div>

								<label class="left"><b class="verifing">*</b>现价：</label>
								<div class="left">
									<input name="price" type="text" class="ui-text validate[required]" value="<?php echo ($info["price"]); ?>" size="4">
									<!-- <span class="ui-validityshower-info"><?php echo lang('yuan');?></span> -->
								</div>
								<!-- <div class="left qrcode <?php if(!empty($info["qrcode_pay"])): ?>show<?php endif; ?>" style="margin-left:20px;">
									<label class="left"><?php echo lang('qrcode_colon');?></label>
									<div class="left">
										<input name="qrcode" type="text" class="ui-text left" value="<?php echo ($info["qrcode"]); ?>" id="qrcode">
										<button type="button" class="button" onclick="akmallUpload('#akmall-qrcode')">上传图片</button>
										<input type="file" class="hidden" id="akmall-qrcode"  onchange="uploadImg('#akmall-qrcode','#qrcode');" />
										<span class="ui-validityshower-info">（收款二维码）</span>
									</div>
								</div> -->
							</td>
                        </tr>

                        <?php if(!empty($akmallConfig["item_quantity"])): ?><tr>
                            <th>商品库存：</th>
                            <td>
                                <input name="quantity" class="ui-text" size="4" type="number" value="<?php echo ($info["quantity"]); ?>"  min="0">
                            </td>
                        </tr><?php endif; ?>
                        <tr>
                            <th>已售数量：</th>
                            <td>
                                <input name="salenum" class="ui-text" size="4" type="number" value="<?php echo (intval($info["salenum"])); ?>" min="0">
                            </td>
                        </tr>
                        <tr>
                            <th>最少订购：</th>
                            <td>
                                <input name="min_num" class="ui-text left" size="3" type="number" value="<?php echo isset($info['min_num'])?intval($info['min_num']):1;?>" min="1">
								<span class="ui-validityshower-info left">件</span>
								
								<label class="left" style="margin-left:30px;">最多订购：</label>
								<div class="left">
									<input name="max_num" type="number" class="ui-text validate[required]" value="<?php echo isset($info['max_num'])?intval($info['max_num']):10;?>" size="3" min="1">
									<span class="ui-validityshower-info">件</span>
								</div>
                            </td>
                        </tr>
						<tr>
                            <th>优惠：</th>
                            <td>
								购买 <input name="buy_num" class="ui-text" size="20" type="text" value="<?php echo ($info["buy_num"]); ?>"> 件，
								优惠 <input name="buy_num_decrease" class="ui-text" size="40" type="text" value="<?php echo ($info["buy_num_decrease"]); ?>">
							</td>
                        </tr>

						<tr>
                            <th><?php echo lang('price_package_colon');?></th>
                            <td>
								<div>
									<input type="button" class="ui-button" value="<?php echo lang('add_package');?>" onclick="itemAdd()" />
									<input type="text" class="ui-text" name="params_name" placeholder="<?php echo lang('package_name');?>" value="<?php echo ($info["params_name"]); ?>" />
									<select name="params_type">
										<option value="radio">单选项</option>
										<option value="checkbox" <?php if(($info["params_type"]) == "checkbox"): ?>selected="selected"<?php endif; ?>>多选项</option>
										<option value="select" <?php if(($info["params_type"]) == "select"): ?>selected="selected"<?php endif; ?>>下拉框</option>
									</select>
									<span class="ui-validityshower-info">（如果图片无法上传请放行浏览器Flash权限）</span>
								</div>
                                <div class="item-list">
                                    <table class="table-detail table-params" width="80%">
                                        <tr><th>名称<span class="ui-validityshower-info">（名称不要用阿拉伯数字开头）</span></th><th style="width:70px">价格</th><th style="width:300px;">图片</th><th class="qrcode <?php if(!empty($info["qrcode_pay"])): ?>show<?php endif; ?>" style="width:200px;">二维码</th><th style="width:50px">操作</th></tr>
                                        <?php if(!empty($info["params"])): if(is_array($info["params"])): $i = 0; $__LIST__ = $info["params"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                                <td><input name="title[]" type="text" class="ui-text" value="<?php echo ($vo["title"]); ?>" style="width:100%"></td>
                                                <td><input name="params_price[]" type="text" class="ui-text validate[required]" value="<?php echo ($vo["price"]); ?>" size="4"></td>
                                                <td><input name="params_image[]" type="text" class="ui-text" value="<?php echo ($vo["image"]); ?>" id="image-<?php echo ($key); ?>" size="25" style="float:left;"><button type="button" class="button" onclick="akmallUpload('#akmall-image-<?php echo ($key); ?>')">上传</button><input type="file" class="hidden" id="akmall-image-<?php echo ($key); ?>"  onchange="uploadImg('#akmall-image-<?php echo ($key); ?>','#image-<?php echo ($key); ?>');" /></td>
                                                <td class="qrcode <?php if(!empty($info["qrcode_pay"])): ?>show<?php endif; ?>"><input name="params_qrcode[]" type="text" class="ui-text validate[required]" value="<?php echo ($vo["qrcode"]); ?>" id="qrcode-<?php echo ($key); ?>" size="15" style="float:left;"><button type="button" class="button" onclick="akmallUpload('#akmall-qrcode-<?php echo ($key); ?>')">上传</button><input type="file" class="hidden" id="akmall-qrcode-<?php echo ($key); ?>"  onchange="uploadImg('#akmall-qrcode-<?php echo ($key); ?>','#qrcode-<?php echo ($key); ?>');" /></td>
                                                <td><input type="button" class="ui-button" value="<?php echo lang('delete');?>" onclick="itemDel($(this))" /></td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </table>
								</div>
                            </td>
                        </tr>
						<tr>
                            <th>商品属性：</th>
                            <td>
                                <p>
									<input type="button" class="ui-button" value="添加属性" onclick="itemForm()" />
									<span class="ui-validityshower-info">（名称框格式：【<span style="color:red;">序号#属性词||扩展词</span>】 <span style="color:red;">序号#</span>：序号对应上面套餐的顺序（如1、2、3）、不填则此属性对应所有套餐；<span style="color:red;">属性词</span>：显示在前端给客户看的内容；<span style="color:red;">||扩展词</span>：做不认识语言地区时方便管理员分辨商品，订单里面显示，前端不显示。注意：属性名称 <span style="color:red;">属性词||扩展词</span> 不能相同，所以请灵活运用扩展词）</span>
								</p>
								<div class="extend-list">
                                    <table class="table-detail table-extends" width="80%">
                                        <tr><th style="width:75px">选择类型</th><th style="width:130px">名称<span class="ui-validityshower-info">(注意名称不能相同)</span></th><th>内容项目<span class="ui-validityshower-info">(提示：任意空格内回车即可保存商品。建议创建完一组属性后立即保存，刷新页面操作框内便会出现复制按钮)</span></th><th style="width:50px">操作</th></tr>
                                        <?php if(!empty($info["extends"])): if(is_array($info["extends"])): $i = 0; $__LIST__ = $info["extends"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; $kk = $key;$show = in_array($vo['type'],array('radio','checkbox','select'))?'show':''; ?>
                                                <tr class="extends-tr">
													<td><select name='extend[<?php echo ($key); ?>][type]' onchange="params( $(this), $(this).val())"><option value='radio' <?php if(($vo["type"]) == "radio"): ?>selected<?php endif; ?>>单选项</option><option value='checkbox' <?php if(($vo["type"]) == "checkbox"): ?>selected<?php endif; ?>>多选项</option><option value='text' <?php if(($vo["type"]) == "text"): ?>selected<?php endif; ?>>文本框</option><option value='select' <?php if(($vo["type"]) == "select"): ?>selected<?php endif; ?>>下拉框</option><option value='password' <?php if(($vo["type"]) == "password"): ?>selected<?php endif; ?>>密码框</option></select></td>
													
                                                    <td><input name="extend[<?php echo ($key); ?>][title]" type="text" class="ui-text" value="<?php echo ($vo["title"]); ?>" size="12"></td>
                                                    <td class="<?php echo ($show); ?>">
														<?php if(is_array($vo["value"])): $k = 0; $__LIST__ = $vo["value"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($k % 2 );++$k; $k2 = $kk.$k; ?>
														<div class="extends-list">
															<input name="extend[<?php echo ($kk); ?>][value][]" value="<?php echo ($li); ?>" type="text" class="ui-text" style="float:left;width:40%"> <p class="item_params"  style="float:left;width:55%"><input name="extend[<?php echo ($kk); ?>][image][]" value="<?php echo ($vo['image'][$k-1]); ?>" type="text" class="ui-text" id="extend_img-<?php echo ($k2); ?>" size="15" style="float:left;"><button type="button" class="button" onclick="akmallUpload('#extend-<?php echo ($k2); ?>')">图片</button><input type="file" class="hidden" id="extend-<?php echo ($k2); ?>" onchange="uploadImg('#extend-<?php echo ($k2); ?>','#extend_img-<?php echo ($k2); ?>');" /> <input type="button" class="ui-button" value="添加" onclick="addParams($(this),<?php echo ($kk); ?>)" /><input type="button" class="ui-button" value="删除" onclick="delParams( $(this))" /></p>
														</div><?php endforeach; endif; else: echo "" ;endif; ?>
													</td>
                                                    
                                                    <td><input type="button" class="ui-button" value="<?php echo lang('delete');?>" onclick="itemDel($(this))" />
													<input type="button" style="font-weight:bold;" class="ui-button" value="<?php echo lang('copy');?>" onclick="itemCopy($(this))" /></td>
                                                </tr><?php endforeach; endif; else: echo "" ;endif; endif; ?>
                                    </table>

								</div>
                            </td>
                        </tr>

						<tr>
							<th>倒计时：</th>
							<td>
								<input name="timer" type="text" class="ui-text" value="<?php echo ($info["timer"]); ?>" size="10">
								<span class="ui-validityshower-info">（ 秒。为空或0则不显示）</span>
							</td>
						</tr>
                        
                        <tr>
                            <th><?php echo lang('status_colon');?></th>
                            <td>
								<select name="status"><?php echo (status($info["status"],"select")); ?></select>
								<span class="ui-validityshower-info">（禁用则前台不显示。使用ipcloak时，若此产品为违规产品请选择禁用）</span>
							</td>
                        </tr>
						
                        <tr>
                            <th><?php echo lang('hot_colon');?></th>
                            <td>
								<select name="is_hot"><?php echo (status($info["is_hot"],"select",array('0'=>lang('禁用'),'1'=>lang('启用')))); ?></select>
								<span class="ui-validityshower-info">（会显示在手机端特别推荐商品栏）</span>
							</td>
                        </tr>
					
						<tr>
                            <th><?php echo lang('brief_colon');?></th>
                            <td>
                                <input name="brief" type="text" class="ui-text" value="<?php echo ($info["brief"]); ?>" size="80">
								<span class="ui-validityshower-info">（一句话的简介）</span>
                            </td>
                        </tr>
						<tr>
                            <th><?php echo lang('关键词_colon');?></th>
                            <td>
                                <input name="tags" type="text" class="ui-text" value="<?php echo ($info["tags"]); ?>" size="80">
								<span class="ui-validityshower-info">（多个关键词请用#分开）</span>
                            </td>
                        </tr>
				
						<tr>
                            <th>电脑略缩图：</th>
                            <td>
                                <input name="image" id="image" type="text" class="ui-text" value="<?php echo ($info["image"]); ?>" size="50" style="float:left">
                                <button type="button" class="button" onclick="akmallUpload('#akmall-image')">上传图片</button>
								<input type="file" class="hidden" id="akmall-image"  onchange="uploadImg('#akmall-image','#image');" />
								<span class="ui-validityshower-info" style="margin-left:15px;">（网站首页显示的小图，推荐250*200，图片无法上传请放行浏览器Flash权限 <a href="http://doc.akmall.cc" target="_blank">帮助</a>）</span>
                            </td>
                        </tr>
						<tr>
                            <th>手机略缩图：</th>
                            <td>
                                <input name="thumb" id="thumb" type="text" class="ui-text" value="<?php echo ($info["thumb"]); ?>" size="50" style="float:left">
                                <button type="button" class="button" onclick="akmallUpload('#akmall-thumb')">上传图片</button>
								<input type="file" class="hidden" id="akmall-thumb"  onchange="uploadImg('#akmall-thumb','#thumb');" />
								<span class="ui-validityshower-info" style="margin-left:15px;">（可同上）</span>
                            </td>
                        </tr>
						<tr>
                            <th>主图幻灯片：</th>
                            <td class="slideshow">
								<button type="button" class="button" onclick="akmallUpload('#akmall-slideshow')">上传图片</button>
								<input type="file" class="hidden" id="akmall-slideshow"  onchange="uploadImg('#akmall-slideshow','#slideshow',true);" />
								<input type="hidden" name="slideshow" value="<?php echo ($info["slideshow"]); ?>" />
                                <div id="slideshow">
									<?php if(!empty($info["slideshow"])): $_result=explode(',',$info['slideshow']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><p class="img" ><img src="<?php echo imageUrl($vo);?>"><span class="del" onclick="imgDel($(this),'<?php echo ($vo); ?>')">删除</span></p><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</div>
								<p class="ui-validityshower-info">请上传2张及以上图片<br />否则部分ios设备可能出现不兼容</p>
                            </td>
                        </tr>
						
                        <tr>
                            <th><?php echo lang('content_colon');?></th>
                            <td>
								<!--div>
									<label class="alert">点击向内容框插入以下标签内容：</label>
									<a href="javascript:;" onclick="setContent('{[akmallOrder]}','【订单标签】添加成功')">【订单标签】</a>
									<a href="javascript:;" onclick="setContent('{[akmallComment-1]}','【评论标签】添加成功')">【评论标签】</a>
									<a href="javascript:;" onclick="setContent('{[akmallScroll-1]}','【滚动标签】添加成功')">【滚动标签】</a>
									<a href="javascript:;" onclick="insertHtml()">【插入代码】</a>
								</div-->
                            	<textarea name="content" id="content" class="input-textarea editor" cols="80" rows="6"><?php if(empty($info["content"])): ?>{[akmallOrder]}<?php else: echo ($info["content"]); endif; ?></textarea>
                            </td>
                        </tr>
						<!--<tr>
                            <th>微信客服</th>
                            <td>
                                <input name="weixin" type="text" class="ui-text" value="<?php echo ($info["weixin"]); ?>" size="100">
								<p class="ui-validityshower-info">格式：微信号|微信二维码图片地址。多个微信号请用英文分号(;)隔开</p>
                            </td>
                        </tr>-->
						
						
						<?php $akmallConfig = S('akmallConfig');$payment = C('PAYMENT');$itemPayment=json_decode($info['payment']); ?>
						<?php if(empty($akmallConfig["payment_global"])): ?><tr>
                            <th><?php echo lang('payment_colon');?></th>
                            <td>
								<?php if(is_array($payment)): $i = 0; $__LIST__ = $payment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><input type="checkbox" name="payment[]" value="<?php echo ($key); ?>" <?php if(in_array($key,$itemPayment)): ?>checked="checked"<?php endif; ?>>
								<label class="ui-group-label"><?php echo ($vo["name"]); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
                            </td>
                        </tr><?php endif; ?>
						
						<tr>
                            <th><?php echo lang('附加内容_colon');?></th>
                            <td>
								<p><span class="ui-validityshower-info">附加内容可以添加JS/CSS</span></p>
                                <textarea name="remark" id="remark" class="input-textarea" cols="125" rows="3"><?php echo ($info["remark"]); ?></textarea>
                            </td>
                        </tr>
						<tr>
                            <th>提交成功后执行：</th>
                            <td>
								<p><span class="ui-validityshower-info">只能添加javascript代码，如推广事件代码，供有代码能力人使用，不设置不影响</span></p>
                                <textarea name="javascript" id="javascript" class="input-textarea" cols="125" rows="2"><?php echo ($info["javascript"]); ?></textarea>
                            </td>
                        </tr>
                            <th>FB像素：</th>
                            <td>
                                <input name="facebook_pixel_id" type="text" class="ui-text" value="<?php echo ($info["facebook_pixel_id"]); ?>" size="100">
								<p class="ui-validityshower-info">多个Pixel ID请用英文逗号隔开；常用Pixel ID请填在后台设置处，此处填写则以这里填写的为准。</p>
                            </td>
                        </tr>
						<tr>
                            <th><?php echo lang('运费模板_colon');?></th>
                            <td>
                                <select name="shipping_id" id="shipping_id">
									<option value="0">卖家承担运费</option>
									<?php if(is_array($shipping)): $i = 0; $__LIST__ = $shipping;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $info["shipping_id"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
								<button type="button" class="btn" onclick="shipping()">添加模板</button>
								<a href="<?php echo U('Setting/shipping');?>">管理运费模板</a>
                            </td>
                        </tr>
						
						<?php $akmallConfig = S('akmallConfig'); ?>
						<tr>
                            <th><?php echo lang('sms_send_colon');?></th>
                            <td>
								<input name="sms_send[0][status]" type="checkbox" value="1" <?php if(!empty($info['sms_send'][0]['status'])): ?>checked="checked"<?php endif; ?> onclick="isShow(this,'.sms_send_0')">
								<span class="ui-validityshower-info">下单通知</span>
								
								<input name="sms_send[1][status]" type="checkbox" value="1" <?php if(!empty($info['sms_send'][1]['status'])): ?>checked="checked"<?php endif; ?> onclick="isShow(this,'.sms_send_1')">
								<span class="ui-validityshower-info">支付通知</span>
								
								<input name="sms_send[3][status]" type="checkbox" value="1" <?php if(!empty($info['sms_send'][3]['status'])): ?>checked="checked"<?php endif; ?> onclick="isShow(this,'.sms_send_3')">
								<span class="ui-validityshower-info">发货通知</span>

                                <style>.tags span{margin:0 5px;color:#06c;}</style>
								<p class="tags">以下标签将替换为实际发送的内容：<br>标题<span>#title#</span>，订单编号<span>#orderNum#</span>，套餐<span>#params#</span>，姓名<span>#name#</span>，手机<span>#mobile#</span>，数量<span>#quantity#</span>，价格<span>#price#</span>，快递名称<span>#express#</span>，快递单号<span>#expressNum#</span>，确认网址<span>#confirmUrl#</span></p>
							</td>
                        </tr>
						<tr class="smsSend sms_send_0 <?php if(!empty($info['sms_send'][0]['status'])): ?>show<?php endif; ?>">
                            <th><?php echo lang('下单通知_colon');?></th>
                            <td>
								<textarea name="sms_send[0][content]"class="input-textarea" cols="125" rows="3"><?php if(!empty($info['sms_send'][0]['content'])): echo ($info['sms_send'][0]['content']); else: ?>#name#，您好！我們已經收到您的訂單，總金額#price#。我們會儘快審核并安排發貨，請您保持手機開機<?php endif; ?></textarea>
							</td>
                        </tr>
						<tr class="smsSend sms_send_1 <?php if(!empty($info['sms_send'][1]['status'])): ?>show<?php endif; ?>">
                            <th><?php echo lang('支付通知_colon');?></th>
                            <td>
								<textarea name="sms_send[1][content]" class="input-textarea" cols="125" rows="3"><?php if(!empty($info['sms_send'][1]['content'])): echo ($info['sms_send'][1]['content']); else: ?>#name#，恭喜您下訂成功，總金額#price#。我們正在安排發貨，請您保持手機開機<?php endif; ?></textarea>
							</td>
                        </tr>
						<tr class="smsSend sms_send_3 <?php if(!empty($info['sms_send'][3]['status'])): ?>show<?php endif; ?>">
                            <th><?php echo lang('发货通知_colon');?></th>
                            <td>
								<textarea name="sms_send[3][content]" class="input-textarea" cols="125" rows="3"><?php if(!empty($info['sms_send'][3]['content'])): echo ($info['sms_send'][3]['content']); else: ?>#name#，您下訂的貨品已經送出，#express#(#expressNum#)，請您保持手機開機，等待宅配員聯繫您<?php endif; ?></textarea>
							</td>
                        </tr>
						
						<!-- <tr>
                            <th>自动发货：</th>
                            <td>
								<input name="is_auto_send" id="is_auto_send" type="checkbox" value="1" <?php if(!empty($info["is_auto_send"])): ?>checked="checked"<?php endif; ?> onclick="isShow(this,'.inform')">
								<span class="ui-validityshower-info">（选择自动发货，则用户支付后将自动发送以下内容到用户邮箱，并显示在支付成功页面）</span>
							</td>
                        </tr> -->
						<tr class="inform <?php if(!empty($info["is_auto_send"])): ?>show<?php endif; ?>">
                            <th><?php echo lang('发送内容_colon');?></th>
                            <td>
								<textarea name="send_content" id="send_content" class="input-textarea" cols="125" rows="3"><?php echo ($info["send_content"]); ?></textarea>
							</td>
                        </tr>
						<tr>
                            <th><?php echo lang('仿品地址_colon');?></th>
                            <td>
                                <input name="ipcloak_url" type="text" class="ui-text" value="<?php echo ($info["ipcloak_url"]); ?>" size="100">
								<p class="ui-validityshower-info">本站的商品编号或完整URL地址（带http://）</p>
                            </td>
                        </tr>
						<tr>
                            <th><?php echo lang('绑定域名_colon');?></th>
                            <td>
                                <input name="domain" type="text" class="ui-text" value="<?php echo ($info["domain"]); ?>" size="100">
								<p class="ui-validityshower-info">绑定域名，不带http:// 如：123456</p>
                            </td>
                        </tr>
						<tr>
                            <th><?php echo lang('采购地址_colon');?></th>
                            <td>
								<textarea name="purchase_url" id="purchase_url" class="input-textarea" cols="125" rows="3"><?php echo ($info["purchase_url"]); ?></textarea>
								<p class="ui-validityshower-info">每行一个地址</p>
                            </td>
                        </tr>
						
                        <tr>
                            <th>&nbsp;</th>
                            <td>
								<?php if(!empty($_GET['id']) && $_GET['do'] != 'copy'): ?><input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" /><?php endif; ?>
								<?php if($_GET['do'] == 'copy'): ?><input type="hidden" name="item_id" value="<?php echo ($info["id"]); ?>" /><?php endif; ?>
                                <!-- <input type="hidden" name="user_id" value="<?php echo ($_SESSION["user"]["id"]); ?>" /> -->
								<!-- 给item添加pid -->
								<?php if(!empty($_GET['id']) && $_GET['do'] != 'copy'): else: ?>
								<input type="hidden" name="user_id" value="<?php echo ($_SESSION["user"]["id"]); ?>" />
									<?php if($_SESSION['user']['role'] == 'member'): ?><input type="hidden" name="user_pid" value="<?php echo ($_SESSION["user"]["pid"]); ?>" />
									<?php else: ?>
									<input type="hidden" name="user_pid" value="<?php echo ($_SESSION["user"]["id"]); ?>" /><?php endif; endif; ?>
								<!-- 给item添加pid -->
                                <input type="submit" class="btn btn-ok" value="<?php echo lang('confirm');?>" />
                                <a class="btn" href="<?php if(empty($_GET["id"])): echo U('Item/index'); else: echo ($_SERVER['HTTP_REFERER']); endif; ?>"><?php echo lang('goback');?></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>  
    </div><!--.box-->
<link href="__PUBLIC__/Assets/js/validation/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__PUBLIC__/Assets/js/validation/jquery.validationEngine.js"></script>
<script type="text/javascript" src="__PUBLIC__/Assets/js/validation/jquery.validationEngine-zh_CN.js"></script>
<script type="text/javascript">
$(function(){
	$("#ajaxform").validationEngine('attach', {promptPosition : "centerRight", autoPositionUpdate : true}); 
    $('#ajaxform').ajaxForm({
        timeout: 15000,
        error:function(){ $('#ajaxLoading').hide();alert("<?php echo lang('ajaxError');?>");},
        beforeSubmit:function(){ $('#ajaxLoading').show();},
        success:function(data){ 
            $('#ajaxLoading').hide();
            if(data.status==1){
                var redirectURL = "<?php if(($_GET["do"]) == "edit"): ?>#<?php else: echo U('Item/index'); endif; ?>";
                $.alert(data.info,data.status,function(){window.location.href=redirectURL});
            }else{
                $.alert(data.info,data.status);
            }
        },
        dataType: 'json'
    });
});

function qrcodepay(id){
	id = parseInt(id);
	if(id>0){$('.qrcode').addClass('show');}else{$('.qrcode').removeClass('show');}
}
function itemAdd(){
	var show = $('#qrcode_pay').val()>0?' show':'';
	var rand = new Date().getTime();
    var item = '<tr></tr><td><input name="title[]" type="text" class="ui-text" value="<?php echo ($vo["title"]); ?>" style="width:100%"></td><td><input name="params_price[]" type="text" class="ui-text validate[required]" value="<?php echo ($vo["price"]); ?>" size="4"></td><td><input name="params_image[]" type="text" class="ui-text" value="<?php echo ($vo["image"]); ?>" id="image-'+rand+'" size="25" style="float:left;"><button type="button" class="button" onclick="akmallUpload(\'#ali-image-'+rand+'\')">上传</button><input type="file" class="hidden" id="ali-image-'+rand+'" onchange="uploadImg(\'#ali-image-'+rand+'\',\'#image-'+rand+'\');" /></td><td class="qrcode '+show+'"><input name="params_qrcode[]" type="text" class="ui-text validate[required]" value="<?php echo ($vo["qrcode"]); ?>" id="qrcode-'+rand+'" size="15" style="float:left;"><button type="button" class="button" onclick="akmallUpload(\'#ali-qrcode-'+rand+'\')">上传</button><input type="file" class="hidden" id="ali-qrcode-'+rand+'" onchange="uploadImg(\'#ali-qrcode-'+rand+'\',\'#qrcode-'+rand+'\');" /></td><td><input type="button" class="ui-button" value="<?php echo lang("delete");?>" onclick="itemDel($(this))" /></td></tr>';

    $('.table-params').append(item);
}
function itemDel(obj){
	obj.parent().parent().remove();
}
function itemCopy(obj){
	var rand = new Date().getTime();
	var tr = obj.parent().parent().clone();//克隆变量
	//alert(tr.html());
	el = tr.appendTo(obj.parent().parent().parent());//追加变量到指定位置
	el.attr("id","items-"+rand);//修改id值为新rand
	var str = el.html();
	var oldrand = str.substring(str.indexOf("extend[")+7,str.indexOf("]"));//获取被复制的rand参数
	//alert(oldrand);
	el.html(el.html().replace(new RegExp(oldrand,'g'), rand));//替换全部旧rand为新rand; RegExp为正则对象
	//alert(el.html());
}
function itemForm(){
	var rand = new Date().getTime();
	var select = '<select name="extend['+rand+'][type]" onchange="params( $(this), $(this).val())"><option value="radio">单选项</option><option value="checkbox">多选项</option><option value="text">文本框</option><option value="select">下拉框</option><option value="password">密码框</option></select>';
	var params = '<div class="extends-list"><input name="extend['+rand+'][value][]" type="text" class="ui-text" style="float:left;width:40%"> <p class="item_params"  style="float:left;width:55%"><input name="extend['+rand+'][image][]" type="text" class="ui-text" id="extend_img-'+rand+'" size="15" style="float:left;"><button type="button" class="button" onclick="akmallUpload(\'#extend-'+rand+'\')">图片</button><input type="file" class="hidden" id="extend-'+rand+'" onchange="uploadImg(\'#extend-'+rand+'\',\'#extend_img-'+rand+'\');" /> <input type="button" class="ui-button" value="添加" onclick="addParams($(this),'+rand+')" /><input type="button" class="ui-button" value="删除" onclick="delParams( $(this))" /></p></div>';
    var item = '<tr id="items-'+rand+'"><td>'+select+'</td><td class="show"><input name="extend['+rand+'][title]" type="text" class="ui-text btn-delete" value="" size="12"></td> <td class="show"> '+params+'</td><td class="show"><input type="button" class="ui-button" value="<?php echo lang("delete");?>" onclick="itemDel($(this))" /></td></tr>';
	$('.table-extends').append(item);
}
function params(_this,val){
	if(val=='radio' || val=='checkbox' || val=='select'){
		_this.parent('td').siblings('td').addClass('show');
	}else{
		_this.parent('td').siblings('td').removeClass('show');
	}
}
function addParams(_this,key){
	var rand = new Date().getTime();
	var params = '<div class="extends-list"><input name="extend['+key+'][value][]" type="text" class="ui-text" style="float:left;width:40%"> <p class="item_params"  style="float:left;width:55%"><input name="extend['+key+'][image][]" type="text" class="ui-text" id="extend_img-'+rand+'" size="15" style="float:left;"><button type="button" class="button" onclick="akmallUpload(\'#extend-'+rand+'\')">图片</button><input type="file" class="hidden" id="extend-'+rand+'" onchange="uploadImg(\'#extend-'+rand+'\',\'#extend_img-'+rand+'\');" /> <input type="button" class="ui-button" value="删除" onclick="delParams( $(this))" /></p></div>';
	_this.parent().parent().parent().append(params);
}
function delParams(_this){
	var li = _this.parent().parent(),len=li.siblings('.extends-list').length;
	if(len>=1){
		li.remove();
	}else{
		alert('删除失败，至少保留一项');
	}
	
}


function isShow(_this,target){
	var target = $(target);
	if(_this.checked==true){
		target.addClass('show');
	}else{
		target.removeClass('show');
	}
}
function shipping(id){
	var url = "?m=Shipping&a=edit&page=2";
	$.open(url,{title:'运费模板',width:680,height:250});
}
</script>
 
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.config.js?v=5.8.12"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.all.js?v=5.8.12"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8" src="__PUBLIC__/Assets/js/ueditor-1.4.3/ueditor.akmall.plugin.js?v=5.8.12"></script>

<script type="text/javascript">
 function setContent(contents,msg) {
     UE.getEditor('content').execCommand('insertHtml', contents);
     $.alert(msg?msg:'添加成功',1);
 }
 function insertHtml() {
     var value = prompt('插入html代码', '');
     UE.getEditor('content').execCommand('insertHtml', value)
 }
var ue = UE.getEditor('content');

</script>
 <?php echo W("Foot");?>