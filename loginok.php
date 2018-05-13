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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="layui/css/layui.css">
	<script src="layui/layui.js"></script>
	<link rel="shortcut icon" href="favicon.ico" />
	<!--JSQ-->
	<script src="JSQ/jquery-2.1.1.min.js"></script>

	<style type="text/css">
		body{
			background: #393D49;
			animation: 2.5s rainbow;
		}
		.masked{ 
			padding-top: 140px;
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
include("PHP/riqi.php");
include("SQL/db/db.php");
include("PHP/adminse.php");
date_default_timezone_set("Asia/Shanghai");
$time=date("G");
?>
<div class="masked">
	<center>
		<p class="hi">
			<span>
				<?php
					$nowtime=$rqmm.$rqd;
					if($_SESSION['tbirth']==$nowtime)
					{
						echo "生日快乐呐";
					}
					else
					{
						if($time>=5 && $time<=8)
						{
							echo "早呀";
						}
						if($time>=9 && $time<=11)
						{
							echo "上午好";
						}
						if($time>=12 && $time<=13)
						{
							echo "午好";
						}
						if($time>=14 && $time<=17)
						{
							echo "下午好";
						}
						if($time>=18 && $time<=23)
						{
							echo "晚上好";
						}
						if($time>=0 && $time<=4)
						{
							echo "夜深了";
						}
					}
				?>
			</span>
		</p>
		<p class="name"><?echo $_SESSION['txm'];?></p>
		<p class="name"></p>

	</center>
</div>

<?
if($_SESSION['utype']=="学生")
{
	?>
	<script type="text/javascript">
		setTimeout(function(){ 
			location.href="stu_i.php";
		}, 2000);
	</script>
	<?
}
?>

</body>
</html>