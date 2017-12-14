<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>评分评价</title>
</head>

<body>
<?
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
if($_POST['tcom']=="")
$tcom='无';
else
$tcom=$_POST['tcom'];
$sql="update sch_repair_re set s_score='".$_POST['rsc']."',s_com='".$tcom."' where sid='".$_POST['id']."'";
$rs=mysql_query($sql,$con);
if($rs>0)
{
	?>
    <script language="javascript">
    	alert("评分成功！");
		location.href="gwbxcx_index.php";
    </script>
    <?
}
else
{
	?>
    <script language="javascript">
		alert("评分失败！请告知技术人员~");
		location.href="gwbxcx_index.php"
    </script>
    <?
}
?>
</body>
</html>