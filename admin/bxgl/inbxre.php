<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!---->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="../../favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>报修物件增加</title>
<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
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
<title>报修类型增加</title>
</head>

<body>
<!--导航
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
    	<a href="../../index.php"><div class="dh-index">首页</div></a>
        <a href="bxgl_index.php"><div class="dh-index">返回</div></a>
  </div>
</div>-->
<!--main-->
<center>
<?
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
		
		
			$t='ss';
			$tt='宿舍';
        if(isset($_GET['ss']))
		{
		  	$t='ss';
			$tt='宿舍';
		}
		if(isset($_GET['ydc']))
		{
		  	$t='ydc';
			$tt='运动场';
		}
		if(isset($_GET['tsg']))
		{
		  	$t='tsg';
			$tt='图书馆';
		}
		if(isset($_GET['zhl']))
		{
			$t='zhl';
			$tt='综合楼';
		}
		if(isset($_GET['jxl']))
		{
		  	$t='jxl';
			$tt='教学楼';
		}
		if(isset($_GET['st']))
		{
		  	$t='st';
			$tt='食堂';
		}
		if(isset($_GET['sxl']))
		{
		  	$t='sxl';
			$tt='实训楼';
		}
				
		  
?>
<script language="javascript">
function c()
{
	n=ink.ink.value;
	if(n=="")
	{
		location.href="inbxre.php?r=1&<?=$t?>=";
		return false;
	}
}
</script>
<div class="ly">
	<h2><?=$tt?>物件增加</h2><span class="input-group-addon">
          	<p>查看或者删除：选择地点,进行操作</p><p>录入物件：选择地点，输入物件名</p><p>物件名如：水龙头，桌子，椅子等</p>
          </span>
    <form class="form-horizontal" action="" method="get" role="form">
      <p>
          <button type="submit" name="ss" class="btn btn-default">宿舍<span class="badge"></span></button>
          <button type="submit" name="st" class="btn btn-default">食堂<span class="badge"></span></button>
          <button type="submit" name="ydc" class="btn btn-default">运动场<span class="badge"></span></button>
          <button type="submit" name="tsg" class="btn btn-default">图书馆<span class="badge"></span></button>
          <button type="submit" name="zhl" class="btn btn-default">综合楼<span class="badge"></span></button>
          <button type="submit" name="jxl" class="btn btn-default">教学楼<span class="badge"></span></button>
          <button type="submit" name="sxl" class="btn btn-default">实训楼<span class="badge"></span></button></p>
          </form>
          
          
    	<form action="" onsubmit="return c()" name="ink" method="get">
        <input name="wjadd" type="hidden" value="<?=$t?>" />
        <input name="wjaddx" type="hidden" value="<?=$tt?>" />
    	<input name="ink" type="text" id="tkeyly" placeholder="输入物件名称，如：水龙头" />
        <p class="br"><br /></p>
        <input type="submit" name="button" id="button" value="物件增加" />
    </form>
    </p>
    <div class="container">
	<div class="row clearfix">
		<div class="col-md-4 column">
		</div>
		<div class="col-md-4 column">
        <h3>
    <?
    if(isset($_GET['r']))
		echo "物件不能为空~";
		if(isset($_GET['m']))
		echo "已有相同物件~";
		if(isset($_GET['o']))
		echo "增加成功~";
		if(isset($_GET['no']))
		echo "增加失败，请告知技术人员~";
		?>
	</h3>
    <?	
		if(isset($_GET['button']))
		{
			$sql="select * from sch_repair_res where s_res='".$_GET['ink']."' and s_g='".$_GET['wjaddx']."'";
			$rs=mysql_query($sql,$con);
			if($row=mysql_fetch_row($rs))
			{
				?>
    <script language="javascript">
                	location.href="inbxre.php?m=1&<?=$_GET['wjadd']?>=";
                </script>
                <?
			}
			else
			{
				$sql="insert into sch_repair_res(s_res,s_g) values('".$_GET['ink']."','".$_GET['wjaddx']."')";
				$rs=mysql_query($sql,$con);
				if($rs>0)
				{
					?>
    <script language="javascript">
                		location.href="inbxre.php?o=1&<?=$_GET['wjadd']?>=";
                	</script>
                    <?
				}
				else
				{
					?>
                    <script language="javascript">
                		location.href="inbxre.php?no=1&<?=$_GET['wjadd']?>=";
                	</script>
                    <?
				}
			}
		}
	?>
    <span class="input-group-addon">
    	<?=$tt?>物件共有：
		<?
		$sco="select count(sid) from sch_repair_res where s_g='".$tt."'";
  		$rco=mysql_query($sco,$con);
  		if($roco=mysql_fetch_row($rco))
		echo $roco[0];
		?>
        种
    </span>
    <div class="pp">
   	  <p>
   	  <div class="table-responsive">
   		  <table width="90%" border="1" class="table" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center">操作</td>
    <td align="center">类型</td>
  </tr>
  <?
  $sqlcx="select * from sch_repair_res where s_g='".$tt."' order by sid desc";
  $rscx=mysql_query($sqlcx,$con);
  while($rowcx=mysql_fetch_row($rscx))
  {
  ?>
  <tr>
    <td align="right">
    <?
	if($rowcx[1]!='无')
	{
    ?><form name="bde" action="" method="get">
    <input name="id" type="hidden" value="<?=$rowcx[0]?>" />
    <input name="dewj" type="hidden" value="<?=$tt?>" />
    <input name="<?=$t?>" type="hidden" value="" />
    <button onclick="return confirm('确定删除？');" name="buttonde" type="submit" class="btn btn-default">删除</button></form>
    <?
	}
	else
	 echo "无";
	?>
    </td>
    <td align="left"><?=$rowcx[1]?></td>
  </tr>
  <? 
  }
  if(isset($_GET['buttonde']))
  {
	  $sqlde="delete from sch_repair_res where sid='".$_GET['id']."' and s_g='".$_GET['dewj']."'";
	  $rsde=mysql_query($sqlde,$con);
	  if($rsde>0)
	  {
		  ?>
          <script language="javascript">
          	alert("删除成功~");
			location.href="inbxre.php?<?=$t?>=";
          </script>
          <?
		 }
		 else
		 {
			  ?>
          <script language="javascript">
          	alert("删除失败~请告知技术人员");
			location.href="inbxre.php?<?=$t?>=";
          </script>
          <?
			}
  }
	
  ?>
 
</table>

      </div>
        </p>
		</div>
        </div>
		<div class="col-md-4 column">
		</div>
	</div>
	</div>
    
    
</div>
</center>
</body>
</html>