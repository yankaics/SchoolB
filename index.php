<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta name="renderer" content="webkit">
	<link rel="shortcut icon" href="favicon.ico" />
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="layui/css/layui.css">
	<script src="layui/layui.js"></script>
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
	<div class="wrapper layui-anim layui-anim-fadein">
		<div class="container">
			<span>
				<h1 class="layui-anim layui-anim-fadein">
					<a href="copy.php" style="color:#FFF;font-weight: 100;">校园宝</a>
				</h1>
			</span>
			<form class="form zdlogin layui-anim layui-anim-fadein" name="admin" method="post" onsubmit="return check()" action="PHP/loginok.php">
				<input type="text" name="user" class="user" placeholder="学号 工号 账号" value="<? if(isset($_GET['sname'])) echo $_GET['sname'];?>">
				<input type="password" name="upass" class="upass" placeholder="出生日期八位">
                <select name="utype" class="utype" size="1">
                  <option value="学生">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;学生</option>
                  <option value="教师">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;教师</option>
                  <option value="管理员">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;管理</option>
                </select>
			  <p><button type="submit" name="button" >登 陆</button></p>
                
		  	</form>
			<p>
				<a href="SchoolB.mobile.apk" download="校园宝.apk"><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"><span class="layui-badge-dot"></span> 安卓下载 </span></a>
          		<a href="copy.php" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"> | <span class="layui-badge-dot"></span> 关于 </span></a>
          		<a href="INDEX/regstu/index.php" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"> | 注册 </span></a>
          		<a href="copy.php" ><span style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"> | &copy;<? if($rqY>2017) echo "2017-".$rqY; else echo "2017"; ?> </span></a>
          		
          		<p>建议使用主流浏览器·极速模式</p>
          	</p>

		</div>
		
		
	</div>
    
</div>

<script src="jsq/jquery-2.1.1.min.js" type="text/javascript"></script>
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
				layer.msg('未找到账号', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:140,
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