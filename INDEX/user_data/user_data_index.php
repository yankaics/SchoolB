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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="../../layui/css/layui.css">
  <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<script src="../../layui/layui.js"></script>
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<script src="../../JSQ/index.js"></script>
	<title>个人资料</title>
</head>
<body>

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

<div class="container">
  <div class="layui-container">  
    <div class="layui-row">
      <!--笑脸-->
      <div class="layui-col-md5">
        <div class="eyebox"><div class="eye EL"><div class="pupil"></div></div>
        <div class="eye ER"><div class="pupil"></div></div>
        </div>
        <div class="smile">
          <div class="teeth"></div>
          <div class="tongue"></div>
        </div>
      </div>
      <!--个人资料-->
      <div class="layui-col-md4" style="padding-top: 50px;">
        <table class="layui-table">
          <colgroup>
            <col width="40">
            <col width="100">
          </colgroup>
          <?
            $sql="select * from sch_stub where tno='".$_SESSION['txh']."'";
            $rs=mysql_query($sql,$con);
            if($row=mysql_fetch_row($rs))
            {
          ?>
            <tr>
              <th>学号或报名号</th>
              <th><?=$row[7]?></th>
            </tr>
            <tr>
              <th>姓名</th>
              <th><?=$row[1]?></th>
            </tr> 
            <tr>
              <th>性别</th>
              <th><?=$row[2]?></th>
            </tr>
            <tr>
              <th>寝室</th>
              <th><?=$row[8]?></th>
            </tr>
            <tr>
              <th>专业</th>
              <th><?=$row[5]?></th>
            </tr>
            <tr>
              <th>辅导员</th>
              <th><?=$row[6]?></th>
            </tr>
          <?
          }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>

<script src="js/index.js"></script>

</body>
</html>