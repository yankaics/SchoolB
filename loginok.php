<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="layui/css/layui.css">
	<script src="layui/layui.js"></script>
	<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
	<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
	<link rel="shortcut icon" href="favicon.ico" />
	<!--JSQ-->
	<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
	<script src="JSQ/index.js"></script>

	<style type="text/css">
		body{
			background: #393D49;
			animation: 4s rainbow;
		}
		.masked{ 
			padding-top: 200px;
			color: #F0F0F0;
		}
		.hi{
			font-size:24px;
		}
		.name{
			font-size:24px;
		}
		@keyframes rainbow {
		  0% { background: #393D49; }
		  50% { background: #393D49; }
		  100% { background: #F0F0F0; }
		}
		
	</style>
	<title>Hi</title>
</head>
<body>
<?
include("SQL/db/db.php");
include("PHP/adminse.php");
?>
<div class="masked">
	<center>
		<p class="hi">Hi!</p>
		<p class="name"><?echo $_SESSION['txm'];?></p>

	</center>
</div>

<?
if($_SESSION['utype']=="学生")
{
	?>
	<script type="text/javascript">
		setTimeout(function(){ 
			location.href="stu_i.php";
		}, 3500);
	</script>
	<?
}
?>

</body>
</html>