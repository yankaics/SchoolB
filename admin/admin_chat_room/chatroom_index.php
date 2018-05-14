<!--
/**
 * This file is part of online_chat_room.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    AmosHuKe<amoshuke@qq.com>
 * @copyright AmosHuKe<amoshuke@qq.com>
 * @link      https://github.com/AmosHuKe/Hi/tree/master/Online_Chat_Room
 * @license   http://www.opensource.org/licenses/mit-license.php (MIT License)
 */
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="../../layui/css/layui.css">
	<link rel="stylesheet" href="../../INDEX/online_chat_room/css/chat_main.css">
	<script src="../../layui/layui.js"></script>
	<link rel="shortcut icon" href="../../favicon.ico" />
	<title>聊天室</title>
</head>
<body bgcolor="#393D49" onload="Javascript:document.chatf.nr.focus();">
<?php
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
?>
<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src=""></div>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item "> 
        <a href="javascript:;" onclick="return dclose();"><div class="xz-index">关闭</div></a>
      </li>
    </ul>
  </div>
</div>

<!--main-->
<script type="text/javascript">
//关闭当前iframe
function dclose()
{
	layui.use('layer', function(){
  		var layer = layui.layer;
		parent.layer.closeAll();
	});
}
</script>
<?php
	include("chat_class.php");//加载聊天处理
	include("chatroom_config.php");//聊天室配置文件
	
	//房间号处理
	if(isset($_GET["room"]))
	{
		$croom=$_GET["room"];
		//只能是字母和数字
		if(!preg_match("/^\d*$/",$croom) && !preg_match("/^[a-z]*$/i",$croom))
		{
			?>
			<script type="text/javascript">dclose();</script>
			<?
			die();
		}
		else if(strlen($croom)>30)
		{
			?>
			<script type="text/javascript">dclose();</script>
			<?
			die();
		}
	}
	else
	{
		?>
		<script type="text/javascript">dclose();</script>
		<?
		die();
	}

	//实例化聊天
	$chats=new chat_class($croom,$_SESSION['name'],$_SESSION['id']); //房间，姓名，账号
	//内容
	if(isset($_POST['nr']))
	{
		$nr=$_POST['nr'];
		//写入内容
		$chats->chat_fwtie($nr);
		//提交后刷新网页
		header("Location: chatroom_index.php?room=".$croom);
	}
	
?>

<div class="chats">
	<p style="padding-left: 20px; padding-top: 20px;">已进入：<?=$croom?>房间</p>
	<?php
		//在chats内局部刷新
		//如果没有文件则创建
		if(!file_exists($chatroom_location.$croom.'.xml'))
		{
			$chats->chat_say("name",0);
		}
		//循环输出
		for($i=$chats->count_p()-1;$i>0;$i--)
		{
			$cname=$chats->chat_say("name",$i); //姓名
			$ctime=$chats->chat_say("chattime",$i); //时间
			$cnr=$chats->chat_say("chatnr",$i); //内容
			echo '<div class="main "> <div class="ctime">'.$ctime.'</div> <div class="cname">'.$cname.'<a onclick="return delnode('.$croom.','.$i.');"class="layui-btn layui-btn-sm layui-btn-danger">删除</a>：</div> <div class="cnr">'.$cnr.'</div> </div>';
		}
		
	?>
</div>

<!--JSQ-->
<script src="../../JSQ/jquery-2.1.1.min.js"></script>
<script>
//确认删除？(房间号,节点位置)
function delnode(croom,cnode)
{

	layer.confirm('真的删除么', function(index){
		location.href="chatroom_admin_class.php?nroom="+croom+"&cnode="+cnode+"";
      });
	return false;
}
//弹出输出
$(document).ready(function(e) {
	layui.use('layer', function(){
	var layer = layui.layer;
	layer.msg('<form name="chatf" class="layui-form" action="" method="post"> <div class="layui-input-inline tnr"> <input type="text" name="nr" required lay-verify="required" placeholder="说说话~最多30字" autocomplete="off" class="layui-input"> </div> <button type="submit" class="layui-btn">发送</button> </form>', {
	title: false, //title
	closeBtn: 0, //关闭按钮
	time:0, //自动关闭时间
	anim: 2, //动画样式
	shadeClose :false, //是否点击遮罩关闭
	offset: 'b', //坐标位置
	area: ['100%', '60px'] //长,宽	
		});	
	});

});
$(function(){
	//局部刷新
	setInterval(aa,1000);
	function aa(){
		$(".chats").load(location.href+" .chats");
	}
});
//顶部阴影
$(function(){
	$(window).scroll(function(){
	//获取滚动条的滑动距离
	  	var scroH = $(this).scrollTop();
		if(scroH>=50){
			$(".layui-header").css({"box-shadow":"0px 1px 6px #333745"});
		}else if(scroH<50){
		    $(".layui-header").css({"box-shadow":"0px 0px 0px"});
		}
	});

	//点击输入框跳回顶部
	$(".tnr").click(function () { 
      	$("html,body").animate({scrollTop:0}, 500);
  	});
});

</script>
</body>
</html>