<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
<link rel="stylesheet" href="../../layui/css/layui.css">
<script src="../../layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<!---
<meta name="viewport" content="width=device-width,initial-scale=1.0" />-->
<link rel="shortcut icon" href="../../favicon.ico" />
<!--JSQ-->
<script src="../../JSQ/jquery-2.1.1.min.js"></script>
<script src="../../JSQ/index.js"></script>
<!---以往的CSS
<link media="(max-width:769px)" href="../../CSS/mobile-main.css" rel="stylesheet" type="text/css" />
<link media="(max-width:769px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:769px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
<link media="(min-width:769px)" href="../../CSS/main-index.css" rel="stylesheet" type="text/css" />-->

<title>修改密码</title>
</head>

<body bgcolor="#F0F0F0">
<?
include"../../PHP/riqi.php";
include"../../SQL/db/db.php";
include"../../PHP/adminse.php";
include("../adminse/admin_se.php");
?>
<!--导航
<div class="layui-header header header-doc">
    <ul class="layui-nav layui-icon" lay-filter="">
        <div class="layui-container">  
        	<li class="layui-nav-item logo layui-icon" style="z-index:1;"><a class="logo" href="index.php"><img class="layui-icon" src="../../UI/logo/呕吐-1.png"></a></li>
        </div> 
    </ul>
    <ul class="layui-nav layui-layout-right" style="text-align:center;">
    	<div class="layui-container ">
            <li class="layui-nav-item ">
			<?
			//if($_SESSION['utype']=="教师")
			//{
			?>
			<a href="../../tea_i.php"><div class="dh-cx">返回</div></a>
			<?
			//}
			//else
			//{
			?>
			<a href="../../stu_i.php"><div class="dh-cx">返回</div></a>
			<?
			//}
			?> 
        	</li>
        </div>
    </ul>
</div><br></br>-->
<!--main-->
<div class="school_i">
<div class="layui-container">
  <div class="layui-row">
  	<div class="layui-col-md4 layui-col-md-offset3">
    	<form class="layui-form" name="form1" onSubmit="return checke()" role="form" method="post" action="admin_upoklogin.php">
          <div class="layui-form-item">
            <label class="layui-form-label">旧密码</label>
            <div class="layui-input-block">
              <input type="password" name="toldpass" required  lay-verify="required" placeholder="旧密码" autocomplete="off" class="layui-input">
            </div>
          </div>   
          <div class="layui-form-item">
            <label class="layui-form-label">新密码</label>
            <div class="layui-input-block">
              <input type="password" name="tnewpass" required  lay-verify="required" placeholder="新密码" autocomplete="off" class="layui-input">
            </div>
          </div>  
          <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
              <input type="password" name="rnewpass" required  lay-verify="required|number" placeholder="确认密码" autocomplete="off" class="layui-input">
            </div>
          </div> 
           <div class="layui-form-item">
            <div class="layui-input-block">
              <button class="layui-btn" lay-submit lay-filter="formssb">立即提交</button>
            </div>
          </div>
        </form>
  	</div>
  </div>
</div>
  
<script>
layui.use('element','form', function(){
	  var element = layui.element;
	  var form =layui.form;

	});//模块使用
	
	function checke()
	  {
		  //如被绕过将不能登陆
		  	var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");//特殊字符判断
			var patrn=/^\w{6,20}$/;//纯数字字母6-20位 符号：下划线
			var newpass=form1.tnewpass.value;
			var qnewpass=form1.rnewpass.value;
			var oldpass=form1.toldpass.value;
			
			if(pattern.test(oldpass))
			{
				$(document).ready(function(e) {
				layui.use('layer', function(){
  				var layer = layui.layer;
				parent.layer.msg('不能含有特殊字符', {
				  title: false,
				  closeBtn: 0,
					
						});
					});
				});
				 return false;
			}
			if(!patrn.exec(newpass))
			{
				$(document).ready(function(e) {
				layui.use('layer', function(){
  				var layer = layui.layer;
				parent.layer.msg('密码只能字母数字<br>下划线6-20位', {
				  title: false,
				  closeBtn: 0,
					
						});
					});
				});
				 return false;
			}
		  	if(newpass!=qnewpass)
		  	{
			  $(document).ready(function(e) {
				layui.use('layer', function(){
  				var layer = layui.layer;
				parent.layer.msg('两次密码不同', {
				  title: false,
				  closeBtn: 0,
					
						});
					});
				});
				return false;
			}
			if(newpass.length>20 || newpass.length<6)
			{
				$(document).ready(function(e) {
				layui.use('layer', function(){
  				var layer = layui.layer;
				parent.layer.msg('密码不能小于6位<br>且大于20位', {
				  title: false,
				  closeBtn: 0,
					
						});
					});
				});
				return false;
			}
	  }
</script>
</div>

</body>
</html>