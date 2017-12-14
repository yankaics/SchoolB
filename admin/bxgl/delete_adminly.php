<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>删除</title>
</head>

<body>
<?
$tname=$_GET['tname'];
$tphone=$_GET['tphone'];
$tadd=$_GET['tadd'];
$ttime=$_GET['ttime'];

include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");

$sql="delete from sch_repair_re where s_add='".$tadd."' and s_name='".$tname."' and s_phone='".$tphone."' and s_settime='".$ttime."'";
$rs=mysql_query($sql,$con);
if($rs>0)
{
	$sql="delete from sch_repair_rea where s_add='".$tadd."' and s_name='".$tname."' and s_phone='".$tphone."' and s_time='".$ttime."'";
	$rs=mysql_query($sql,$con);	
	if($rs>0)
	{
	?>
    <script language="javascript">
        	alert("删除成功");
			location.href="admin_ly.php";
        </script>
    <?
	}
	else
	{
		?>
        <script language="javascript">
        	alert("删除物件失败，请联系技术人员");
			location.href="admin_ly.php";
        </script>
        <?
	}
}
else
{
	?>
    <script language="javascript">
        	alert("删除失败，请联系技术人员");
			//location.href="admin_ly.php";
        </script>
    <?
}
?>
</body>
</html>