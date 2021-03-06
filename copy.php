<!--
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
-->
<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" href="layui/css/layui.css">
  <script src="layui/layui.js"></script>

  <style>
    body{
      
    }
    .top{
      padding: 12% 0 0 8%;
      letter-spacing: 1px;
      color: #49496B;
    }
    h1{
      
      font-weight: 600;
      margin-bottom: 20px;
    }
    p{
      margin:6px 6px 0 0;
    }
    .copy_i{
      margin-top: 20px;
    }
    img{
      max-width: 100%;
    }
  </style>
  <title>关于校园宝</title>
</head>

<body>
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="UI/logo/logo-32-t.png"></div>
  <?
  include"PHP/riqi.php";
  include"SQL/db/db.php";
  ?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item ">
        <?
          if(isset($_SESSION['txm']))
          {
            if($_SESSION['utype']=="学生")
            {
              ?>
              <a href="stu_i.php">菜单</a>
              <?
            }
            else
            {
              ?>
              <a href="tea_i.php">菜单</a>
              <?
            }
          }
          else
          {
        ?>
          <a href="index.php">登陆</a>
        <?
          }
        ?>
      </li>
      <li class="layui-nav-item" ><a href="INDEX/User_Helper/index.php">常见问题</a> </li>
      <li class="layui-nav-item" ><a href="INDEX/regstu/index.php">注册</a> </li>
      <li class="layui-nav-item layui-this" ><a href="copy.php">关于</a> </li>
    </ul>
  </div>
</div>

<!-- main -->
<div class="layui-container">  
  <div class="layui-row">
    <div class="layui-col-md4 top">
      <h1>校园宝</h1>
      <p>后勤顾问：罗军</p>
      <p>技术支持：胡珂</p>
      <p>联系邮箱：amoshuke@qq.com</p>
      <p>感谢 _ _ _ ！</p>
      <p class="copy_i">&copy;2017-<?php echo date("Y");?> <br/> 重庆广德学校后勤服务 .</p>
    </div>
    <div class="layui-col-md8">
      <img src="UI/index/launch_dribbble-post.gif"/>
      <p align="right">By Justin Tran - dribbble</p>
    </div>
  </div>
<script>
layui.use('element', function(){
  var element = layui.element;
  
});
</script>

</body>
</html>