/*
 * ���⣺AK��ҳ��������ϵͳ��ҵ��
 * ���ߣ�123456��΢�źţ�
 * �ٷ���ַ��123456
 * *
 * ��ʾ��Ϣ�������Ը���ʹ�ñ�վ��̬�ļ���html/css/js/images�������뱣��ԭ�����ߣ�΢�źţ�123456����Ϣ��лл��
 */
define(function(require, exports, module) {
(function($){$.fn.akmallScroll=function(options){var defaults={speed:40,rowHeight:24};var opts=$.extend({},defaults,options),intId=[];function marquee(obj,step){obj.find("ul").animate({marginTop:"-=1"},0,function(){var s=Math.abs(parseInt($(this).css("margin-top")));if(s>=step){$(this).find("li").slice(0,1).appendTo($(this));$(this).css("margin-top",0)}})}this.each(function(i){var sh=opts["rowHeight"],speed=opts["speed"],_this=$(this);intId[i]=setInterval(function(){if(_this.find("ul").height()<=_this.height()){clearInterval(intId[i])}else{marquee(_this,sh)}},speed);_this.hover(function(){clearInterval(intId[i])},function(){intId[i]=setInterval(function(){if(_this.find("ul").height()<=_this.height()){clearInterval(intId[i])}else{marquee(_this,sh)}},speed)})})}})(jQuery);
})