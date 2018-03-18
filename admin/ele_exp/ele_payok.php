<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="../../layui/css/layui.css">
	<script src="../../layui/layui.js"></script>
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<script src="../../JSQ/index.js"></script>
</head>
<body>
<?
	include("../../PHP/riqi.php");
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
	include("../adminse/admin_se.php");

  	$qs=$_GET['m'];
	$sqlcx="select * from sushe_user where  sushe_Y='".$_SESSION['Y']."' and sushe_m='".$_SESSION['m']."' and sushe_dor='".$qs."'";
	$rscx=mysql_query($sqlcx,$con);
	while($rowcx=mysql_fetch_row($rscx))
	{
		$sql="update sushe_user set sushe_jg='已缴费' where sushe_Y='".$_SESSION['Y']."' and sushe_m='".$_SESSION['m']."' and sushe_dor='".$qs."'";
		$q=(mysql_query($sql));
		if($q>0)
		{
			$settime=$rqY."-".$rqm."-".$rqd;
			$sql="insert into sch_dfre values('','".$_SESSION['id']."','".$_SESSION['name']."','".$_SESSION['nameid']."','".$qs."','".$rowcx[11]."','".$_SESSION['Y']."-".$_SESSION['m']."','".$settime."')";
			$rs=mysql_query($sql,$con);
			if($rs>0)
			{
			?>
		    <script language="javascript">
		    		$(document).ready(function(e) {
						layui.use('layer', function(){
			  				var layer = layui.layer;
							parent.layer.msg('处理结果为：已缴费', {
							  title: false,
							  closeBtn: 0,
							  time:2000,
							  maxWidth:200,
							  anim: 0,
							  offset: '240px',
							});
							
						});
					});
					location.href="ele_pay.php?sadminY=<?=$_SESSION['Y']?>&sadminm=<?=$_SESSION['m']?>&button=操作";
		        </script>
		    <?
			}
			else
			{
			?>
		    <script language="javascript">
		        	alert("处理结果更新失败，请联系技术人员#1");
					location.href="ele_pay.php?sadminY=<?=$_SESSION['Y']?>&sadminm=<?=$_SESSION['m']?>&button=操作";
		        </script>
		    <?
			}
		}
		else
		{
			?>
		    <script language="javascript">
		        	alert("处理结果更新失败，请联系技术人员");
					location.href="ele_pay.php?sadminY=<?=$_SESSION['Y']?>&sadminm=<?=$_SESSION['m']?>&button=操作";
		        </script>
		    <?
		}
	}
?>


</body>
</html>
