<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
<link rel="stylesheet" href="../../layui/css/layui.css">
<script src="../../layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<link rel="shortcut icon" href="../../favicon.ico" />
<!--JSQ-->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../../JSQ/index.js"></script>

<!---以往的CSS
<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
-->
<title>评论专区</title>
</head>

<body  bgcolor="#F0F0F0">

<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/呕吐-1.png"></div>
	<?
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
	?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item ">
		  <?
          if($_SESSION['utype']=="教师")
          {
          ?>
          <a href="../../tea_i.php">
          <div class="xz-index">菜单</div></a>
          <?
          }
          else
          {
          ?>
          <a href="../../stu_i.php">
          <div class="xz-index">菜单</div></a>
          <?
          }
          ?>
      </li>
    </ul>
  </div>
</div>

<!--main-->
<div class="layui-row">
  <div class="layui-col-md4 layui-col-md-offset4 layui-col-xs-12">
    <blockquote class="layui-elem-quote">
      <p>评论专区</p>
      <p>反映学院不足处，闲言碎语，自由评论</p>
    </blockquote>
    <!-- 来必力City版安装代码 -->
    <!--嘿嘿-->
    <!-- City版安装代码已完成 -->
  </div>
</div>
</body>
</html>
