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

<body>
<div class="htmleaf-container">
	<div class="wrapper">
		<div class="container ">
			<span><h1 class="layui-anim layui-anim-upbit"><a href="copy.php" style="color:#FFF;">校园宝</a></h1></span>
			<form class="form zdlogin layui-anim layui-anim-upbit" name="admin" method="post" onsubmit="return check()" action="PHP/loginok.php">
				<input type="text" name="user" class="user" placeholder="学号|工号|账号">
				<input type="password" name="upass" class="upass" placeholder="密码身份证后6位">
                <select name="utype" class="utype" size="1">
                  <option value="学生">&nbsp;&nbsp;学生</option>
                  <option value="教师">&nbsp;&nbsp;教师</option>
                  <option value="管理员">&nbsp;&nbsp;管理员</option>
                </select>
			  <p><button type="submit" name="button" >登陆</button></p>
                
		  </form>
          <a href="copy.php" ><p style="color:#CCC; z-index:1103;" class="layui-anim layui-anim-fadein"><span class="layui-badge-dot"></span> 关于校园宝</p></a>
		</div>
		
		
	</div>
    
</div>

<script src="jsq/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
$('#login-button').click(function (event) {
	event.preventDefault();
	$('form').fadeOut(500);
	$('.wrapper').addClass('form-success');
});
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
?>
<script>
	function check()
	{
		uuser=admin.user.value;
		upass=admin.upass.value;
		if(upass=="" || uuser=="")
		{
			$(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('填写账号密码', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:160,
				  anim: 6,
				  offset: '240px',
				});
				
			});
		});
			return false;
		}
			var patrn=/^\w{6,20}$/; //数字字母6-20位 符号：下划线 
		  	var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");//特殊字符判断
			if(!patrn.exec(upass) || pattern.test(uuser))
			{
				$(document).ready(function(e) {
				layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('账号·密码<br>格式错误', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:160,
				  anim: 6,
				  offset: '240px',
					
						});
					});
				});
				 return false;
			}
	}

</script>

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
			$(".zdlogin").submit()
		});
	</script>
	<?
}

?>


<h1></h1>
</div>
</body>
</html>