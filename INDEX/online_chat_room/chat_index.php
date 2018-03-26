<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="../../layui/css/layui.css">
	<link rel="stylesheet" href="css/chat_main.css">
	<script src="../../layui/layui.js"></script>
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<title>聊天室</title>
</head>
<body bgcolor="#393D49" onload="Javascript:document.chatf.nr.focus()">
<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/logo-32-t.png"></div>
	<?
		include("../../SQL/db/db.php");
		include("../../PHP/adminse.php");
	?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item ">
          <a href="../../stu_i.php"><div class="xz-index">菜单</div></a>
      </li>
    </ul>
  </div>
</div>

<!--main-->

<?php
	//聊天处理
	include("chat_class.php");
	//房间号处理
	if(isset($_GET["room"]))
	{
		$croom=$_GET["room"];
		//只能是字母和数字
		if(!preg_match("/^\d*$/",$croom) && !preg_match("/^[a-z]*$/i",$croom))
		{
			header("Location: ../../stu_i.php?roomcw");
			die();
		}
		else if(strlen($croom)>30)
		{
			header("Location: ../../stu_i.php?roomcw");
			die();
		}
	}
	else
	{
		header("Location: ../../stu_i.php?roomcw");
		die();
	}
	//实例化聊天
	$chats=new chat_class($croom,$_SESSION['txm'],$_SESSION['txh']);
	//内容
	if(isset($_POST['nr']))
	{
		$nr=$_POST['nr'];
		//写入内容
		$chats->chat_fwtie($nr);
		//提交后刷新网页
		header("Location: chat_index.php?room=".$croom);
	}
	
?>

<div class="chats">
<p style="padding-left: 20px; padding-top: 20px;">已进入：<?=$croom?>房间</p>
<?php
	//在chats内局部刷新	
	$chats->chat_say();
?>
</div>

<script>
//弹出输出
$(document).ready(function(e) {
	layui.use('layer', function(){
	var layer = layui.layer;
	layer.msg('<form name="chatf" class="layui-form" action="" method="post"> <div class="layui-input-inline tnr"> <input type="text" name="nr" required lay-verify="required" placeholder="说说话~最多30字" autocomplete="off" class="layui-input"> </div> <button type="submit" class="layui-btn">发送</button> </form>', {
	title: false,
	closeBtn: 0,
	time:0,
	anim: 2,
	shadeClose :false,
	offset: 'b',
	area: ['100%', '60px']	
		});	
	});

});
$(function(){
	//局部刷新
	setInterval(aa,1000);
		function aa(){
			$(".chats").load(location.href+" .chats");
		}
	//点击输入框跳回顶部
	$(".tnr").click(function() {
      $("html,body").animate({scrollTop:0}, 500);
  	});
	
});
</script>
</body>
</html>