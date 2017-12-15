<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!------>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="../../favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>报修状态查询</title>
<link media="(max-width:650px)" href="../../CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="../../CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
</style>

<script type="text/javascript">
function Trim(strValue) 
{ 
//return strValue.replace(/^s*|s*$/g,""); 
return strValue;  
}

function SetCookie(sName,sValue) 
{ 
document.cookie = sName + "=" + escape(sValue); 
} 

function GetCookie(sName) 
{ 
var aCookie = document.cookie.split(";"); 
for(var　i=0;　i　< aCookie.length;　i++) 
{ 
var aCrumb = aCookie[i].split("="); 
if(sName　== Trim(aCrumb[0])) 
{ 
return unescape(aCrumb[1]); 
} 
} 

　　return null; 
} 

function scrollback() 
{ 
if(GetCookie("scroll")!=null){document.body.scrollTop=GetCookie("scroll")} 
} 
</script>

<script language="javascript">
setTimeout("self.location.reload();",60*10000);
</script>
</head>

<body id=body onscroll=SetCookie("scroll",document.body.scrollTop); onload="scrollback();">
<!------导航
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
    	<a href="../../index.php"><div class="dh-index">首页</div></a>
        <a href="bxgl_index.php"><div class="dh-index">返回</div></a>
  </div>
</div>------>
<!------main------>
<center>
<?
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
error_reporting(E_ALL^E_NOTICE^E_WARNING);
$sql10="select count(sid) from sch_repair_re where s_jg='未处理' and s_repair!='未分配'";
$rs10=mysql_query($sql10,$con);
if($row10=mysql_fetch_row($rs10))
	$num10=$row10[0];
$sql11="select count(sid) from sch_repair_re where s_jg='已处理'";
$rs11=mysql_query($sql11,$con);
if($row11=mysql_fetch_row($rs11))
	$num11=$row11[0];
$sql12="select count(sid) from sch_repair_rea where s_jg='不能处理'";
$rs12=mysql_query($sql12,$con);
if($row12=mysql_fetch_row($rs12))
	$num12=$row12[0];
?>
<div class="ly">
	<h2>报修状态查询</h2>
    <p>
    <form class="form-horizontal" action="" method="get" role="form">
       <p>
       <button type="submit" name="wcl" class="btn btn-default">未处理<span class="badge"><?=$num10?></span></button>
       <button type="submit" name="ycl" class="btn btn-default">已处理<span class="badge"><?=$num11?></span></button>
       <button type="submit" name="bncl" class="btn btn-default">不能处理<span class="badge"><?=$num12?></span></button>
       </p>
    </form>
    </p>
    <p>
    <div class="table-responsive">
      <table width="90%" class="table" border="1" cellspacing="0" cellpadding="0">
   
  <tr>
  	<?
    if(isset($_GET['bncl']))
	{
		?>
    <td align="center" class="text-danger">操作</td>
    <td align="center" class="text-danger">地点</td>
    <td align="center" class="text-danger">姓名</td>
    <td align="center" class="text-danger">电话</td>
    <td align="center" class="text-danger">专业</td>
    <td align="center" class="text-danger">物件</td>
    <td align="center" class="text-danger">数量</td>
    <td align="center" class="text-danger">原因</td>
    <td align="center" class="text-danger">维修时间</td>
    <td align="center" class="text-danger">维修员</td>
    <td align="center" class="text-danger">报修时间</td>
    
        <?
	}
	else
	{
	?>
    <td align="center" class="text-danger">操作</td>
    <td align="center" class="text-danger">地点</td>
    <td align="center" class="text-danger">姓名</td>
    <td align="center" class="text-danger">电话</td>
    <td align="center" class="text-danger">专业</td>
    <td align="center" class="text-danger">报修时间 </td>
    <td align="center" class="text-danger">维修员</td>
    <td align="center" class="text-danger">处理情况</td>
    <td align="center" class="text-danger">维修时间</td>
    <td align="center" class="text-danger">物件详情</td>
    <?
	}
	?>
  </tr>
  <?
  	if(isset($_GET['bncl']))
	{
		$sqlre="select a.s_class,a.s_addr,b.* from sch_repair_re a,sch_repair_rea b where b.s_jg='不能处理' and a.s_name=b.s_name and a.s_add=b.s_add and a.s_phone=b.s_phone and a.s_settime=b.s_time order by s_settime asc";
		$b='bncl=';
	}
	else
	{
		if(isset($_GET['ycl']))
		{
			$sqlre="select * from sch_repair_re where s_jg='已处理' order by s_settime asc";
			$b='ycl=';
		}
		else
		{
			if(isset($_GET['wcl']))
			{
				$sqlre="select * from sch_repair_re where s_jg='未处理' and s_repair!='未分配' order by s_settime asc";
				$b='wcl=';
			}
		}
	}
		
        $rsre=mysql_query($sqlre,$con);
   while($rowre=mysql_fetch_row($rsre))
   {
   ?>
  <tr>
  	<?
    if(isset($_GET['bncl']))
	{
		?>
    <td align="center">不能处理</td>
    <td align="center"><?=$rowre[9].$rowre[1]?></td>
    <td align="center"><?=$rowre[11]?></td>
    <td align="center"><?=$rowre[12]?></td>
    <td align="center"><?=$rowre[0]?></td>
    <td align="center"><?=$rowre[3]?></td>
    <td align="center"><?=$rowre[4]?></td>
    <td align="center" class="text-danger"><?=$rowre[7]?></td>
    <td align="center"><?=$rowre[14]?></td>
    <td align="center"><?=$rowre[6]?></td>
    <td align="center"><?=$rowre[8]?></td>
        <?
	}
	else
	{
	?>
    <td align="center">
    <?
    if(isset($_GET['wcl']))
		echo "未处理";
		else
		echo "已处理";
	?>
    </td>
    <td align="center"><?=$rowre[1].$rowre[2]?></td>
    <td align="center"><?=$rowre[3]?></td>
    <td align="center"><?=$rowre[5]?></td>
    <td align="center"><?=$rowre[4]?></td>
    <td align="center"><?=$rowre[10]?></td>
    <td align="center"><?=$rowre[7]?></td>
    <td align="center"><?=$rowre[11]?></td>
    <td align="center"><?=$rowre[12]?></td>
    <td align="center">
    <form action="" method="get">
    <?
    if(isset($_GET['tb']))
	{
	?>
    <input name="tb" type="hidden" value="<?=$_GET['tb']?>" />
    <?
	}
	else
	{
	?>
    <input name="tb" type="hidden" value="<?=$b?>" />
    <?
	}
	?>
    <input name="tname" type="hidden" value="<?=$rowre[3]?>" />
    <input name="tphone" type="hidden" value="<?=$rowre[5]?>" />
    <input name="tadd" type="hidden" value="<?=$rowre[1]?>" />
    <input name="ttime" type="hidden" value="<?=$rowre[10]?>" />
    <button type="submit" name="wjxq" class="btn btn-default">物件详情</button>
    </form>
    </td>
    <?
	}
	?>
    
  </tr>
  <?
   }
?>
</table>
<!---物件详情--->
<?
if(isset($_GET['wjxq']))
{
?>
<script language="javascript">
	alert('<? 
    $sqlrea="select * from sch_repair_rea where s_time='".$_GET['ttime']."' and s_name='".$_GET['tname']."' and s_phone='".$_GET['tphone']."' and s_add='".$_GET['tadd']."'";
	$rsrea=mysql_query($sqlrea,$con);
	while($rowrea=mysql_fetch_row($rsrea))
	{
		echo "（物件:".$rowrea[1];
		echo "-数量:".$rowrea[2]."）\\n";
	}
	?>');
	location.href="bxztcx.php?<?=$_GET['tb']?>";
</script>
<?
}
?>

</div>
    </p>
</div>
</center>
</body>
</html>