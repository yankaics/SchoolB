/**
 * This file is part of SchoolB.
 *
 * Licensed under The Apache License, Version 2.0
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    AmosHuKe<amoshuke@qq.com>
 * @copyright AmosHuKe<amoshuke@qq.com>
 * @link      https://github.com/AmosHuKe/SchoolB
 * @license   https://opensource.org/licenses/Apache-2.0 (Apache License, Version 2.0)
 */

function check()
{
	uuser=admin.user.value;
	upass=admin.upass.value;
	if(upass=="" || uuser=="")
	{
		$(document).ready(function(e) {
			layui.use('layer', function(){
				var layer = layui.layer;
				layer.msg('填写账号密码', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:160,
				  anim: 6,
				  offset: '240px',
				});
			});
		});
		return false;
	}
		var patrn=/^\w{6,40}$/; //数字字母6-40位 符号：下划线 
	  	var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");//特殊字符判断
		if(!patrn.exec(upass) || pattern.test(uuser))
		{
			$(document).ready(function(e) {
			layui.use('layer', function(){
				var layer = layui.layer;
			layer.msg('账号·密码<br>格式错误', {
			  title: false,
			  closeBtn: 0,
			  time:2000,
			  maxWidth:160,
			  anim: 6,
			  offset: '240px',
				
					});
				});
			});
			 return false;
		}
}

//背景图片切换
$(function(){
	//消除文本框placeholder
	$('body').on('focus', 'input[placeholder]', function () {
        var valueBak = $(this).attr('xplaceholder');
        if (!valueBak) {
            $(this).attr('xplaceholder', $(this).attr('placeholder'));
        }
        $(this).attr('placeholder', '');
    }).on('blur', 'input[placeholder]', function () {
        $(this).attr('placeholder', $(this).attr('xplaceholder'));
    });
    //获取屏幕宽度
    var _width = $(window).width();
    //获取屏幕高度
    $('.wrapper').height($(window).height());
    var num = Math.floor(5*Math.random());
    if(_width < 769)
    {
     	$(".wrapper").css({
			"background":"url(UI/bg/Mobile/webp/bg-"+num+".jpg) ",
			"-webkit-background-size": "cover",
			"-moz-background-size": "cover",
			"-o-background-size": "cover",
			"background-size": "cover",
			"overflow": "auto",
		    "max-width":"100%",
		  	"opacity": "0.8",
		  	"position": "absolute",
		  	"top": "200px",
		  	"width": "100%",
		  	"min-height": "100%",
		  	"margin-top": "-200px"
		 });
    }
    if(_width>768)
    {
		$(".wrapper").css({
			"background":"url(UI/bg/PC/webp/bg-"+num+".jpg)",
			"-webkit-background-size": "cover",
			"-moz-background-size": "cover",
			"-o-background-size": "cover",
			"background-size": "cover",
			"overflow": "auto",
		    "max-width":"100%",
		  	"opacity": "0.8",
		  	"position": "absolute",
		  	"top": "200px",
		  	"width": "100%",
		  	"min-height": "100%",
		  	"margin-top": "-200px",
		  	"padding-top":"100px"
		 });
    }
});
console.log('看代码的小伙伴你好呀！');
console.log('有机会一起进步呀,QQ604660039');