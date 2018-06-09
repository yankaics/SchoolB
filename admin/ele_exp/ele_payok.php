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
	//微秒
	function  microtime_float ()
	{
	    list( $usec ,  $sec ) =  explode ( " " ,  microtime ());
	    $sec=(string)$sec;
	    $sec=substr($sec,0);
	    return ((int) $sec +(int)$usec);
	}
	//已缴费
	if(isset($_GET['m']))
	{
	  	$qs=$_GET['m'];
		$sqlcx="select * from sushe_user where  sushe_Y='".$_SESSION['Y']."' and sushe_m='".$_SESSION['m']."' and sushe_dor='".$qs."'";
		$rscx=mysql_query($sqlcx,$con);
		while($rowcx=mysql_fetch_row($rscx))
		{
			$sql="update sushe_user set sushe_jg='已缴费' where sushe_Y='".$_SESSION['Y']."' and sushe_m='".$_SESSION['m']."' and sushe_dor='".$qs."'";
			$q=(mysql_query($sql));
			if($q>0)
			{
				//操作日期
				$settime=$rqY."-".$rqm."-".$rqd."-".$rqH.":".$rqi.":".$rqs;
				//水电流水号
				$serial=$rqY.$rqmm.$rqd.$rqH.$rqi.$rqs.microtime_float();
				$sql="insert into sch_dfre values('','".$_SESSION['id']."','".$_SESSION['name']."','收款','".$qs."','".$rowcx[11]."','".$_SESSION['Y']."-".$_SESSION['m']."','".$settime."','".$serial."','未扎帐')";
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
	}

	//退款
	else if(isset($_GET['mtk']))
	{
	  	$qs=$_GET['mtk'];
		$sqlcx="select * from sushe_user where  sushe_Y='".$_SESSION['Y']."' and sushe_m='".$_SESSION['m']."' and sushe_dor='".$qs."'";
		$rscx=mysql_query($sqlcx,$con);
		while($rowcx=mysql_fetch_row($rscx))
		{
			$sql="update sushe_user set sushe_jg='未缴费' where sushe_Y='".$_SESSION['Y']."' and sushe_m='".$_SESSION['m']."' and sushe_dor='".$qs."'";
			$q=(mysql_query($sql));
			if($q>0)
			{
				//操作日期
				$settime=$rqY."-".$rqm."-".$rqd."-".$rqH.":".$rqi.":".$rqs;
				//水电流水号
				$serial=$rqY.$rqmm.$rqd.$rqH.$rqi.$rqs.microtime_float();
				$sql="insert into sch_dfre values('','".$_SESSION['id']."','".$_SESSION['name']."','退款','".$qs."','".$rowcx[11]."','".$_SESSION['Y']."-".$_SESSION['m']."','".$settime."','".$serial."','未扎帐')";
				$rs=mysql_query($sql,$con);
				if($rs>0)
				{
				?>
			    <script language="javascript">
			    		$(document).ready(function(e) {
							layui.use('layer', function(){
				  				var layer = layui.layer;
								parent.layer.msg('处理结果为：已退款', {
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
	}
	else
	{
		?>
		<script language="javascript">
			location.href="ele_pay.php";
        </script>
		<?
	}
?>


</body>
</html>
