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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>维修标记已处理</title>
</head>

<body>
<?
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
$time=$rqY.'-'.$rqmm.'-'.$rqd.'-'.$rqH.':'.$rqi.':'.$rqs;
$sid=$_GET['id'];
$wj=$_GET['wj'];

$sql="select * from sch_repair_re where sid='".$sid."'";
$rs=mysql_query($sql,$con);
if($row=mysql_fetch_row($rs))
{
	
	
		$sqlycl2="update sch_repair_rea set s_jg='已处理',s_settime='".$time."'  where s_tt='".$wj."' and s_add='".$row[1]."' and s_name='".$row[3]."' and s_phone='".$row[5]."' and s_time='".$row[10]."' and s_repair='".$_SESSION['name']."'";
		$rsycl2=mysql_query($sqlycl2,$con);
		if($rsycl2>0)
		{
			
				$sqlcx="select count(sid) from sch_repair_rea where s_jg='未处理' and s_add='".$row[1]."' and s_name='".$row[3]."' and s_phone='".$row[5]."' and s_time='".$row[10]."' and s_repair='".$_SESSION['name']."'";
				$rscx=mysql_query($sqlcx,$con);
				if($rowcx=mysql_fetch_row($rscx))
				{
				if($rowcx[0]==0)
				{
				$sqlycl1="update sch_repair_re set s_jg='已处理',s_wxtime='".$time."'  where sid='".$sid."'";
				$rsycl1=mysql_query($sqlycl1,$con);
				}
				}
				
				$sqlcx1="select count(sid) from sch_repair_rea where s_jg='不能处理' and s_add='".$row[1]."' and s_name='".$row[3]."' and s_phone='".$row[5]."' and s_time='".$row[10]."' and s_repair='".$_SESSION['name']."'";
				$rscx1=mysql_query($sqlcx1,$con);
				if($rowcx1=mysql_fetch_row($rscx1))
				{
					if($rowcx1[0]>=1)
					{
						$sqlycl2="update sch_repair_re set s_jg='不能处理'  where sid='".$sid."'";
						$rsycl2=mysql_query($sqlycl2,$con);
					}	
				}
				
		?>
		<script language="javascript">
			alert("处理完成！");
			location.href="czxq.php?id=<?=$sid?>";
		</script>
       
		<?
		}
		else
		{
			?>
            <script language="javascript">
			alert("处理完成失败！#1请告知技术人员");
			location.href="czxq.php?id=<?=$sid?>";
			</script>
            <?
		}
	}
	else
	{
		?>
		<script language="javascript">
			alert("处理完成失败！请告知技术人员");
			location.href="czxq.php?id=<?=$sid?>";
		</script>
		<?
	}

?>
</body>
</html>