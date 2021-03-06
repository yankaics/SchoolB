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
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
  	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
  	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
  	<script src="../../bootstrap/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  	<!---->
	<meta name="viewport" content="width=device-width,initial-scale=1.0" />
	<link rel="shortcut icon" href="../../favicon.ico" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>报修物件增加</title>
	<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
	<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
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
include("address.php");//地点
		
		
$t='ss';
$tt='宿舍';
for($i=0;$i<count($arrayall);$i++)
{
    if(isset($_GET[$arrayalldm[$i]]))
	{
	  	$t=$arrayalldm[$i];
		$tt=$arrayall[$i];
	}
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
      	<?php
      		for($i=0;$i<count($arrayall);$i++)
			{
      	?>
          	<button type="submit" name="<?=$arrayalldm[$i]?>" class="btn btn-default"><?=$arrayall[$i]?><span class="badge"></span></button>
         <?php
     		}
         ?>
      </p>
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
		<div class="col-md-2 column">
		</div>
		<div class="col-md-8 column">
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
			$sql="select * from sch_repair_res where s_res='".$_GET['ink']."' and s_g='".$_GET['wjaddx']."' order by s_order asc";
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
				$sql="insert into sch_repair_res(s_res,s_g,s_order) values('".$_GET['ink']."','".$_GET['wjaddx']."','0')";
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
    <td align="center">排序</td>
  </tr>
  <?
  $sqlcx="select * from sch_repair_res where s_g='".$tt."' order by s_order asc";
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

    <td align="left">
		<form name="order_res" class="form-inline" action="" method="get">
			<div class="form-group">
				<input name="order" class="form-control" type="text" value="<?=$rowcx[3]?>" />
			</div>
		    <input name="id" type="hidden" value="<?=$rowcx[0]?>" />
		    <input name="dewj" type="hidden" value="<?=$tt?>" />
		    <input name="<?=$t?>" type="hidden" value="" />
		    <button onclick="return confirm('确定保存？');" name="buttonorder" type="submit" class="btn btn-default">保存</button>
		</form>
    </td>

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
  	/*
  		排序保存

  	 */
	if(isset($_GET['buttonorder']))
	{
	  $sqlde="update sch_repair_res set s_order='".$_GET['order']."' where sid='".$_GET['id']."' and s_g='".$_GET['dewj']."'";
	  $rsde=mysql_query($sqlde,$con);
	  if($rsde>0)
	  {
		  ?>
	      <script language="javascript">
	
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
		<div class="col-md-2 column">
		</div>
	</div>
	</div>
    
    
</div>
</center>
</body>
</html>