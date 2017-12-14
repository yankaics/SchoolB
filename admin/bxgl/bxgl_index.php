<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!------>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="../../favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-admin-index.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
<link media="(min-width:500px)" href="../../CSS/admin-index.css" rel="stylesheet" type="text/css" />
<title>报修管理</title>
</head>

<body>
<!------导航------>
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
    	<a href="../../index.php"><div class="dh-index">首页</div></a>
        <a href="../infor/admincd_index.php"><div class="dh-index">返回</div></a>
  </div>
</div>
<!------main------>
<center>
<?

include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
?>

<div class="admin-main">
<?
    if($_SESSION['cg']==1 || $_SESSION['zw']=='维修主管')
	{
	?>
	<h2>报修管理</h2>
    
	<p>
    <a href="admin_ly.php?all="><input type="button" name="button" id="button" value="报修分配" /></a>
	</p>
    <?
	}
	?>
	<?
    if($_SESSION['cg']==1 || $_SESSION['zw']=='维修主管')
	{
	?>
    <a href="bxztcx.php?wcl="><input type="button" name="button2" id="button2" value="报修状态查询" /></a>
    <?
	}
	?>
    <?
    if($_SESSION['cg']==1 || $_SESSION['zw']=='维修主管')
	{
	?>
    <p>
    <a href="bx_re.php?ballw="><input type="button" name="buttonwj" id="buttonwj" value="维修前统计" /></a>
    </p>
    <?
	}
	?>
     <?
    if($_SESSION['cg']==1 || $_SESSION['zw']=='维修主管')
	{
	?>
    <p>
    <a href="bx_re_af.php?ballw="><input type="button" name="buttonwj" id="buttonwj" value="维修后统计" /></a>
    </p>
    <?
	}
	?>
    
	<?
    if($_SESSION['cg']==1 || $_SESSION['zw']=='维修主管')
	{
	?>
    <p>
  	<a href="inbxre.php"><input type="button" name="button2" id="button2" value="物件增加" /></a>
	</p>
    <?
	}
	?>
    <?
    if($_SESSION['zw']=='维修员')
	{
		
	?>
    <script language="javascript">
    	location.href="wxrw.php";
    </script>
  	<p>
  	<a href="wxrw.php"><input type="button" name="button2" id="button2" value="维修员任务页" /></a>
	</p>
    <?
	}
	?>
    
</div>
</center>
</body>
</html>