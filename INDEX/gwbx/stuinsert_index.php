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
<meta http-equiv="Content-Type" content="text/html; charset=GB2312" />
<title>提交报修订单</title>
</head>

<body>
<?
include("../../SQL/db/db.php");
include("../../php/riqi.php");
include("../../PHP/adminse.php");
if(isset($_POST['bxzdl']))
{
$j=$_SESSION['j'];
$time=$rqY.'-'.$rqmm.'-'.$rqd.'-'.$rqH.':'.$rqi.':'.$rqs;
$tname=$_POST['tname'];
$tphone=$_POST['tphone'];
$tzy=$_POST['tzy'];
$ttea=$_POST['ttea'];
$tadd=$_POST['tadd'];
$taddr=$_POST['taddr'];
$twxxq=$_POST['twxxq'];

if(!isset($_POST['tea']))
{
	$sql="insert into sch_repair_re values('','".$tadd."','".$taddr."','".$tname."','".$tzy."','".$tphone."','".$ttea."','未分配','0','','".$time."','未处理','','".$_SESSION['txh']."','".$twxxq."')";
	$rs=mysql_query($sql,$con);
	if($rs>0)
	{
		for($i=0;$i<=$j;$i++)
		{
			if($_FILES['ttp'.$i]['size']!=0)
			{
				$frand=rand(1,100);
				$ftime=date('YmdhisB').$i;
				$fname=$_FILES['ttp'.$i]['name'];
				$fsize=$_FILES['ttp'.$i]['size'];
				$ftname=$_FILES['ttp'.$i]['tmp_name'];
				$ferr=$_FILES['ttp'.$i]['error'];
				$fttype='.'.substr(strrchr($fname, '.'), 1); 
				move_uploaded_file($ftname,"../../img/stu_BX/".$ftime."_".$frand.$i.$fttype);
				$ftmpname="img/stu_BX/".$ftime."_".$frand.$i.$fttype;
			}
			else
			{
				$ftmpname="";
			}

			$sqlrea="insert into sch_repair_rea values('','".$_POST['tres'.$i]."','".$_POST['tnum'.$i]."','','未分配','','".$time."','".$tadd."','".$ftmpname."','".$tname."','".$tphone."','未处理','','".$_SESSION['txh']."')";
			$rsrea=mysql_query($sqlrea,$con);
		}
		if($rsrea>0)
		{
			?>
            <script language="javascript">
				//提交成功
    				location.href="../../stu_i.php?iok=hk";
  				
				
			</script>
            <?
		}
		else
		{
			?>
            <script language="javascript">
    			alert("物件提交失败~");
				
    				location.href="../../stu_i.php";
  				
    		</script>
            <?
		}
	}
	else
	{
		?>
        <script language="javascript">
			alert("提交失败~");
			
    				location.href="../../stu_i.php";
  				
    	</script>
        <?
	}
}
else
{
	$sql="insert into sch_repair_re values('','".$tadd."','".$taddr."','".$tname."','".$tzy."','".$tphone."','".$ttea."','未分配','0','','".$time."','未处理','','".$_SESSION['user']."','".$twxxq."')";
	$rs=mysql_query($sql,$con);
	if($rs>0)
	{
		for($i=0;$i<=$j;$i++)
		{
			if($_FILES['ttp'.$i]['size']!=0)
			{
				$frand=rand(1,100);
				$ftime=date('YmdhisB').$i;
				$fname=$_FILES['ttp'.$i]['name'];
				$fsize=$_FILES['ttp'.$i]['size'];
				$ftname=$_FILES['ttp'.$i]['tmp_name'];
				$ferr=$_FILES['ttp'.$i]['error'];
				$fttype='.'.substr(strrchr($fname, '.'), 1); 
				move_uploaded_file($ftname,"../../img/tea_BX/".$ftime."_".$frand.$i.$fttype);
				$ftmpname="img/tea_BX/".$ftime."_".$frand.$i.$fttype;
			}
			else
			{
				$ftmpname="";
			}

		$sqlrea="insert into sch_repair_rea values('','".$_POST['tres'.$i]."','".$_POST['tnum'.$i]."','','未分配','','".$time."','".$tadd."','".$ftmpname."','".$tname."','".$tphone."','未处理','','".$_SESSION['user']."')";
		$rsrea=mysql_query($sqlrea,$con);
		}
		if($rsrea>0)
		{
			?>
            <script language="javascript">
				//提交成功
				
            		location.href="../../tea_i.php?iok=hk";
            	
				
			</script>
            <?
		}
		else
		{
			?>
            <script language="javascript">
    			alert("物件提交失败~");
    			
            		location.href="../../tea_i.php";
            	
    		</script>
            <?
		}
	}
	else
	{
		?>
        <script language="javascript">
			alert("提交失败~");
			
            		location.href="../../tea_i.php";
            	
    	</script>
        <?
	}
}
?>
<?
}
else
{
	?>
    <script language="javascript">
		location.href="alerts.php?z=1";
    </script>
    <?
}
?>
<script language="javascript">
        //防止页面后退
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });

    </script>
</body>
</html>