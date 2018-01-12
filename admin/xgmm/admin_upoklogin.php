<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../../layui/css/layui.css">
<script src="../../layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<!---
<meta name="viewport" content="width=device-width,initial-scale=1.0" />-->
<link rel="shortcut icon" href="../../favicon.ico" />
<!---JSQ-->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../../JSQ/index.js"></script>
<title>修改密码</title>
</head>

<body>
<?
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
?>
<?
$coldpass=$_POST['toldpass'];
$cnewpass=$_POST['tnewpass'];
if($coldpass==$_SESSION['upass'])
{
	$mysql['cnewpass'] = mysql_real_escape_string($cnewpass);//假如有人绕过特殊字符判断，这句防止SQL注入，也会使他不能再次登陆
$sql="update sch_admin set s_userpass='".$mysql['cnewpass']."' where s_username='".$_SESSION['id']."'";
$rs=mysql_query($sql,$con);
if($rs>0)
{
	?>
    <script>
		$(document).ready(function(e) {
			layui.use('layer', function(){
				var index = parent.layer.getFrameIndex(window.name);
  				var layer = layui.layer;
				
				parent.layer.confirm('修改成功', {
				  btn: ['重新登录'],
				  title: false,
				  closeBtn: 0,
				}, function(){
					parent.location.href="../../index.php";
					parent.layer.close(index);
				});
				
			});
		});
	</script>
    <?
}
}
	else
	{
		?>
		<script>
		$(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				
				parent.layer.msg('旧密码错误', {
				  title: false,
				  closeBtn: 0,
					
				});
				
			});
		});
			location.href="admin_uplogin.php";
		</script>
		<?
	}
?>

</body>
</html>