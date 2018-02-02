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

console.log('看代码的小伙伴你好呀！');
console.log('有机会一起进步呀,QQ604660039');