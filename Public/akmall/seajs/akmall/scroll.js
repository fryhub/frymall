/*
 * 标题：AK单页订单管理系统企业版
 * 作者：123456（微信号）
 * 官方网址：123456
 * *
 * 警示信息：您可以复制使用本站静态文件（html/css/js/images），但请保留原创作者（微信号：123456）信息，谢谢。
 */
define(function(require, exports, module) {
(function($){$.fn.akmallScroll=function(options){var defaults={speed:40,rowHeight:24};var opts=$.extend({},defaults,options),intId=[];function marquee(obj,step){obj.find("ul").animate({marginTop:"-=1"},0,function(){var s=Math.abs(parseInt($(this).css("margin-top")));if(s>=step){$(this).find("li").slice(0,1).appendTo($(this));$(this).css("margin-top",0)}})}this.each(function(i){var sh=opts["rowHeight"],speed=opts["speed"],_this=$(this);intId[i]=setInterval(function(){if(_this.find("ul").height()<=_this.height()){clearInterval(intId[i])}else{marquee(_this,sh)}},speed);_this.hover(function(){clearInterval(intId[i])},function(){intId[i]=setInterval(function(){if(_this.find("ul").height()<=_this.height()){clearInterval(intId[i])}else{marquee(_this,sh)}},speed)})})}})(jQuery);
})