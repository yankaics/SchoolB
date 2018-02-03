<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="layui/css/layui.css">
	<script src="layui/layui.js"></script>
	<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
	<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
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
<div class="htmleaf-container">
	<div class="wrapper">
		<div class="container ">
			<span><h1 class="layui-anim layui-anim-upbit"><a href="copy.php" style="color:#FFF;">校园宝</a></h1></span>
			<form class="form zdlogin layui-anim layui-anim-upbit" name="admin" method="post" onsubmit="return check()" action="PHP/loginok.php">
				<input type="text" name="user" class="user" placeholder="学号|工号|账号" value="<? if(isset($_GET['sname'])) echo $_GET['sname'];?>">
				<input type="password" name="upass" class="upass" placeholder="身份证8位生日">
                <select name="utype" class="utype" size="1">
                  <option value="学生">&nbsp;&nbsp;学生</option>
                  <option value="教师">&nbsp;&nbsp;教师</option>
                  <option value="管理员">&nbsp;&nbsp;管理员</option>
                </select>
			  <p><button type="submit" name="button" >登陆</button></p>
                
		  	</form>
			<p>
          		<a href="copy.php" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"><span class="layui-badge-dot"></span> 关于</span></a>
          		<a href="INDEX/regstu/index.php" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"> | 注册</span></a>
          		<a href="javascript:;" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"> | &copy;<? if($rqY>2017) echo "2017-".$rqY; else echo "2017"; ?> </span></a>
          	</p>

		</div>
		
		
	</div>
    
</div>

<script src="jsq/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
//Chrome内核更好体验，判断IE浏览器或IE内核
if (!!window.ActiveXObject || "ActiveXObject" in window) {
        $(document).ready(function(e) {
          layui.use('layer', function(){
            var layer = layui.layer;
            parent.layer.confirm('<center style="color:#000;">请使用极速模式（Chrome内核）<br>达到更好体验效果<br><img src="Chrome_re.png"></center>', {
              btn: ['我才不管|·_·)'],
              title: false,
              btnAlign: 'c',
              offset: '140px',
              closeBtn: 0
            }, function(){
            	layer.closeAll();
            });
          });
        });
}

</script>
<?
if(isset($_GET['z']))
{
	?>
    <script>
    $(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('未找到账号', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:120,
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
				layer.msg('密码错误', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:120,
				  anim: 6,
				  offset: '240px',
				});
				
			});
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
            parent.layer.confirm('<center style="color:#000;">你的账号已被停用<br>如有疑问请询问辅导员</center>', {
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