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
  <link rel="shortcut icon" href="../../favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" href="../../layui/css/layui.css">
  <script src="../../layui/layui.js"></script>

  <style></style>
  <title>关于校园宝</title>
</head>

<body bgcolor="#F0F0F0">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/logo-32-t.png"></div>

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
      <li class="layui-nav-item layui-this" ><a href="index.php">常见问题</a> </li>
      <li class="layui-nav-item" ><a href="../regstu/index.php">注册</a> </li>
      <li class="layui-nav-item" ><a href="../../copy.php">关于</a> </li>
    </ul>
  </div>
</div>

<!--main-->
<div class="layui-container">
  <div class="layui-row">
    <h2 align="center" style="color: #666;margin-top: 100px">计划中……</h2>
    <p align="center" style="color: #666;margin-top: 40px">春招生账号大部分是报名号，小部分是学号，还请询问辅导员，了解到报名号和学号。</p>
  </div>
</div>  

<script>
layui.use('element', function(){
  var element = layui.element;
});

</script>

</body>
</html>