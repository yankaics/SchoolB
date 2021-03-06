﻿<!--
/**
 * This file is part of SchoolB.
 *
 * Licensed under The Apache License, Version 2.0
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    AmosHuKe<amoshuke@qq.com>
 * @copyright AmosHuKe<amoshuke@qq.com>
 * @link      
 * @license   https://opensource.org/licenses/Apache-2.0 (Apache License, Version 2.0)
 */
-->
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="renderer" content="webkit"/>
	<meta name="force-rendering" content="webkit"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<link rel="shortcut icon" href="favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<!-- JQuery -->
	<script src="jsq/jquery-2.1.1.min.js" type="text/javascript"></script>
	<!-- Layui -->
	<link rel="stylesheet" href="layui/css/layui.css">
	<script src="layui/layui.js"></script>
	<!-- Main -->
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<!-- 页面加载 -->
	<link rel="stylesheet" href="css/main_loading.css">
	<script src="https://s19.cnzz.com/z_stat.php?id=1273333349&web_id=1273333349" language="JavaScript"></script>

	<title>校园宝 | Hi~</title>
	<system.webServer>
	    <httpProtocol>
	        <customHeaders>
	            <add name="X-Frame-Options" value="SAMEORIGIN" />
	        </customHeaders>
	    </httpProtocol>
	</system.webServer>
</head>
<?
include"PHP/riqi.php";
?>
<body>
	<!--页面加载-->
	<script type="text/javascript">         
	    // 等待所有加载
	    $(window).load(function(){
	        $('body').addClass('loaded');
	        $('#loader-wrapper .load_title').remove();
	    }); 
	</script>    

	<div id="loader-wrapper">
	    <div id="loader"></div>
	    <div class="loader-section section-left"></div>
	    <div class="loader-section section-right"></div>
	    <div class="load_title"></div>
	</div>

<!-- Main -->
<div class="htmleaf-container">
	<div class="wrapper layui-anim layui-anim-fadein">
		<div class="container">
			<span>
				<h1 class="layui-anim layui-anim-fadein">
					<a href="copy.php" style="color:#FFF;font-weight: 400;">校园宝</a>
				</h1>
			</span>
			<form class="form zdlogin layui-anim layui-anim-fadein" name="admin" method="post" onsubmit="return check()" action="PHP/loginok.php">
				<?php
					require_once 'PHP/CSRF.php';
					$c = new CSRF();
					$c->_init('token');
				?>
				<div class="m_input"><i class="layui-icon i_icon">&#xe66f;</i><input type="text" name="user" class="user" placeholder="学号 工号 账号" value="<? if(isset($_GET['sname'])) echo $_GET['sname'];?>"></div>
				<div class="m_input"><i class="layui-icon i_icon">&#xe673;</i><input type="password" name="upass" class="upass" placeholder="出生日期  八位"></div>
                <div class="m_input m_select"><i class="layui-icon i_icon">&#xe672;</i>
                	<select name="utype" class="utype dropdown" >
	                  <option value="学生" class="label">学生</option>
	                  <option value="教师">教师</option>
	                  <option value="管理员">管理</option>
	                </select>
	            </div>
			  <p><button type="submit" name="button" >登 陆</button></p>
                
		  	</form>
			<p>
				
				<a href="copy.php" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"><span class="layui-badge-dot"></span> 关于 </span></a>
          		<a href="copy.php" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"> · 联系 </span></a>
          		<a href="copy.php" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"> · &copy;<? if($rqY>2017) echo "2017-".$rqY; else echo "2017"; ?> </span></a>
          		
          		<p>重庆广德学校后勤服务有限公司</p>
          	</p>

		</div>
		
		
	</div>
    
</div>


<!--placeholder兼容及IE提示-->
<script src="jsq/placeholder_ie.js" type="text/javascript"></script>

<?
if(isset($_GET['z']))
{
	?>
    <script>
    $(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('账号或密码错误', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:160,
				  anim: 6,
				  offset: '240px',
				});
				
			});
		});
    </script>
    <?
}
if(isset($_GET['c']))
{
	?>
    <script>
    $(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('账号或密码错误', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:160,
				  anim: 6,
				  offset: '240px',
				});
				
			});
		});
    </script>
    <?
}
if(isset($_GET['er']))
{
	?>
    <script>
    $(document).ready(function(e) {
			CIE();
		});
    </script>
    <?
}
if(isset($_GET['jg']))
{
	?>
    <script>
    $(document).ready(function(e) {
          layui.use('layer', function(){
            var layer = layui.layer;
            parent.layer.confirm('<center style="color:#000;">你的账号已被停用<br>如有疑问请询问辅导员或主管</center>', {
              btn: ['知道了|·_·)'],
              title: false,
              btnAlign: 'c',
              offset: '140px',
              closeBtn: 0
            }, function(){
            	layer.closeAll();
            });
          });
        });
    </script>
    <?
}
if(isset($_GET['sd5']))
{
	?>
    <script>
    $(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('登陆失败5次<br>已被锁定30分钟', {
				  title: false,
				  closeBtn: 0,
				  time:5000,
				  maxWidth:220,
				  anim: 6,
				  offset: '240px',
				});
				
			});
		});
    </script>
    <?
}
if(isset($_GET['sd4']))
{
	?>
    <script>
    $(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('登陆失败4次<br>最后1次机会', {
				  title: false,
				  closeBtn: 0,
				  time:4000,
				  maxWidth:220,
				  anim: 6,
				  offset: '240px',
				});
				
			});
		});
    </script>
    <?
}
if(isset($_GET['sd3']))
{
	?>
    <script>
    $(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('登陆失败3次<br>还剩2次机会', {
				  title: false,
				  closeBtn: 0,
				  time:4000,
				  maxWidth:220,
				  anim: 6,
				  offset: '240px',
				});
				
			});
		});
    </script>
    <?
}

?>
<script src="JSQ/index_login.js" type="text/javascript"></script>
<?
//自动登录
if(!empty($_COOKIE["schoolb_username"]))
{
	?>
	<script type="text/javascript">
		$(document).ready(function() {
			$(".user").val("<?=$_COOKIE['schoolb_username']?>");
			$(".upass").val("<?=$_COOKIE['schoolb_password']?>");
			$(".utype").val("<?=$_COOKIE['schoolb_type']?>");
			$(".zdlogin").submit();
		});
	</script>
	<?
}

?>

</div>
</body>
</html>