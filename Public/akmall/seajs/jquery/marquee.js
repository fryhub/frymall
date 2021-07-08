;define(function (require, exports, module) {
	var jQuery  = require('jquery');

/**
 * @DOM
 *  	<div id="marquee">
 *  		<ul>
 *   			<li></li>
 *   			<li></li>
 *  		</ul>
 *  	</div>
 * @CSS
 *  	#marquee {overflow:hidden;width:200px;height:50px;}
 * @Usage
 *  	$("#marquee").akmallMarquee(options);
 * @options
 *		isEqual:true,		//���й�����Ԫ�س����Ƿ����,true,false
 *  	loop:0,				//ѭ������������0ʱ����
 *		direction:"left",	//��������"left","right","up","down"
 *		scrollAmount:1,		//����
 *		scrollDelay:20		//ʱ��
 */
(function ($) {
    $.fn.akmallMarquee = function (options) {
        var opts = $.extend({}, $.fn.akmallMarquee.defaults, options);

        return this.each(function () {
            var $marquee = $(this);				//����Ԫ������
            var _scrollObj = $marquee.get(0);		//����Ԫ������DOM
            var scrollW = $marquee.width();		//����Ԫ�������Ŀ���
            var scrollH = $marquee.height();		//����Ԫ�������ĸ߶�
            var $element = $marquee.children();	//����Ԫ��
            var $kids = $element.children();		//������Ԫ��
            var scrollSize = 0;					//����Ԫ�سߴ�

            //�������ͣ�1���ң�0����
            var _type = (opts.direction == "left" || opts.direction == "right") ? 1 : 0;

            //��ֹ������Ԫ�رȹ���Ԫ�ؿ���ȡ����ʵ�ʹ�����Ԫ�ؿ���
            $element.css(_type ? "width" : "height", 10000);

            //��ȡ����Ԫ�صĳߴ�
            if (opts.isEqual) {
                scrollSize = $kids[_type ? "outerWidth" : "outerHeight"]() * $kids.length;
            } else {
                $kids.each(function () {
                    scrollSize += $(this)[_type ? "outerWidth" : "outerHeight"]();
                });
            };

            //����Ԫ���ܳߴ�С�������ߴ磬������
            if (scrollSize < (_type ? scrollW : scrollH)) { return; };

            //��¡������Ԫ�ؽ�����뵽����Ԫ�غ󣬲��趨����Ԫ�ؿ���
            $element.append($kids.clone()).css(_type ? "width" : "height", scrollSize * 2);

            var numMoved = 0;
            function scrollFunc() {
                var _dir = (opts.direction == "left" || opts.direction == "right") ? "scrollLeft" : "scrollTop";
                if (opts.loop > 0) {
                    numMoved += opts.scrollAmount;
                    if (numMoved > scrollSize * opts.loop) {
                        _scrollObj[_dir] = 0;
                        return clearInterval(moveId);
                    };
                };

                if (opts.direction == "left" || opts.direction == "up") {
                    var newPos = _scrollObj[_dir] + opts.scrollAmount;
                    if (newPos >= scrollSize) {
                        newPos -= scrollSize;
                    }
                    _scrollObj[_dir] = newPos;
                } else {
                    var newPos = _scrollObj[_dir] - opts.scrollAmount;
                    if (newPos <= 0) {
                        newPos += scrollSize;
                    };
                    _scrollObj[_dir] = newPos;
                };
            };

            //������ʼ
            var moveId = setInterval(scrollFunc, opts.scrollDelay);

            //��껮��ֹͣ����
            $marquee.hover(function () {
                clearInterval(moveId);
            }, function () {
                clearInterval(moveId);
                moveId = setInterval(scrollFunc, opts.scrollDelay);
            });
            var go = true;
            $marquee.click(function () {
                if (go) {
                    clearInterval(moveId);
                    go = false;
                }
                else {
                    moveId = setInterval(scrollFunc, opts.scrollDelay);
                    go = true;
                }
            })
        });
    };

    $.fn.akmallMarquee.defaults = {
        isEqual: true,		//���й�����Ԫ�س����Ƿ����,true,false
        loop: 0,			//ѭ������������0ʱ����
        direction: "left",	//��������"left","right","up","down"
        scrollAmount: 1,		//����
        scrollDelay: 20		//ʱ��

    };

    $.fn.akmallMarquee.setDefaults = function (settings) {
        $.extend($.fn.akmallMarquee.defaults, settings);
    };
})(jQuery);

});