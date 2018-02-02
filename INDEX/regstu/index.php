<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="../../layui/css/layui.css">
  	<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script src="../../layui/layui.js"></script>
	<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
	<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<script src="../../JSQ/index.js"></script>
	<title>如何进行注册</title>
</head>
<body bgcolor="#F0F0F0">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/呕吐-1.png"></div>
	<?
	include"../../PHP/riqi.php";
 	include"../../SQL/db/db.php";
	?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item ">
        <?
          if(isset($_SESSION['txm']))
          {
            if($_SESSION['utype']=="学生")
            {
              ?>
              <a href="../../stu_i.php">菜单</a>
              <?
            }
            else
            {
              ?>
              <a href="../../tea_i.php">菜单</a>
              <?
            }
          }
          else
          {
        ?>
          <a href="../../index.php">登陆</a>
        <?
          }
        ?>
      </li>
      <li class="layui-nav-item layui-this" ><a href="index.php">注册</a> </li>
      <li class="layui-nav-item" ><a href="../../copy.php">关于</a> </li>
    </ul>
  </div>
</div>

<!--main-->
<div class="container">
  	<div class="layui-container">  
    	<div class="layui-row">
			<blockquote class="layui-elem-quote">
				<p>如何给学生注册</p>
				<p>邮箱：amoshuke@qq.com</p>
				<p>示例文档：<a href="校名+学生年级+辅导员名字.xlsx">下载</a></p>
			</blockquote>
			<p>
				&nbsp;&nbsp;&nbsp;&nbsp;1.辅导员如何给学生进行注册，只需要下载示例文档并按照示例文档的要求进行填写（最好不要有其他格式），一个年级一份文档。<br>
				&nbsp;&nbsp;&nbsp;&nbsp;2.填写并检查好后发送到邮箱，主题名：校园宝+辅导员电话+辅导员姓名+学生年级<br>
				&nbsp;&nbsp;&nbsp;&nbsp;3.是否注册好，我会回信给辅导员，如果有问题互相进行交流。<br>
				&nbsp;&nbsp;&nbsp;&nbsp;4.注册完成后请务必叫学生登陆测试，如有不能登陆的学生，统计后发送邮箱（主题名和第2条一致），内容请说明是什么情况并提供学生学号和姓名。
			</p>

    	</div>
	</div>
</div>


</body>
</html>