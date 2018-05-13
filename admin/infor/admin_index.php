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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" href="../../layui/css/layui.css">
  <script src="../../layui/layui.js"></script>
  <link rel="shortcut icon" href="../../favicon.ico" />
  <!--JSQ-->
  <script src="../../JSQ/jquery-2.1.1.min.js"></script>
  <script src="../../JSQ/index.js"></script>
  <title>校园宝后台</title>
</head>
<body>
<?
	include("../../PHP/riqi.php");
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
?>
    	<div class="layui-container">  
          <div class="layui-row">
          	<div class="layui-col-md8">
            	<blockquote class="layui-elem-quote">校园宝后台<br>欢迎<?=$_SESSION['name']?></blockquote>
                <p><br>
                <fieldset class="layui-elem-field">
                  <legend>菜单及修改密码</legend>
                  <div class="layui-field-box">
                    点击左上角【校园宝后台】呼出菜单<br>点击右上角【姓名】修改密码<br>还没有修改密码的管理员请及时【修改密码】
                  </div>
                </fieldset>
                </p><br>
                <i class="layui-icon" style="font-size: 32px; color: #FF5722;">&#xe60b;</i>目前后台还没有完善更新，有些页面不太好用，望谅解【正在根据使用情况进行更改】~ 
              
          	</div>
          </div>
        </div>
        
</body>
</html>