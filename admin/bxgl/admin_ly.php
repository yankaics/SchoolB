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
	<title>报修分配</title>
	<link media="(max-width:650px)" href="../../CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
	<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
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

	function checkfp()
	{
		if(!$(".choo").is(":checked"))
		{
			alert("请勾选需要分配的任务");
			return false;
		}		
	}
	</script>

	<script language="javascript">
	setTimeout("self.location.reload();",60*10000);
	</script>
</head>

<body id=body onscroll=SetCookie("scroll",document.body.scrollTop); onload="scrollback();">
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

$sqlall="select count(sid) from sch_repair_re where s_jg='未处理' and s_repair='未分配'";
$rsall=mysql_query($sqlall,$con);
if($rowall=mysql_fetch_row($rsall))
	$numall=$rowall[0];

for($i=0;$i<count($arrayall);$i++)
{
	$sql="select count(sid) from sch_repair_re where s_add='".$arrayall[$i]."' and s_jg='未处理' and s_repair='未分配'";
	$rs=mysql_query($sql,$con);
	if($row=mysql_fetch_row($rs))
		$arraycount[$i]=$row[0];//计数
}

?>
<div class="ly">
	<h2>报修分配</h2>
    <p>
    <form class="form-horizontal" action="" method="get" role="form">
      <p><button type="submit" name="all" class="btn btn-default">所有<span class="badge"><?=$numall?></span></button>
      	<?php
      		for($i=0;$i<count($arrayall);$i++)
			{
      	?>
          <button type="submit" name="<?=$arrayalldm[$i]?>" class="btn btn-default"><?=$arrayall[$i]?><span class="badge"><?=$arraycount[$i]?></span></button>
        <?
        	}
        ?>
      </p>
    </form>
          <form name="wxyfp" action="" method="get" onsubmit="return checkfp()">
          <span class="input-group-addon">
          	<p>默认显示所有未分配</p><p>选择进行分配</p>
            <p>
            <div class="form-group">
                <div class="col-sm-offset-5 col-sm-2">
                    <span>
                    <select name="wxy" class="form-control" id="tt2">
                
                      <?
                      $sqlwx="select * from sch_admin where s_position='维修员' and s_g!=0";
                      $rswx=mysql_query($sqlwx,$con);
                      while($rowwx=mysql_fetch_row($rswx))
                      {
                      ?>
                      <option value="<?=$rowwx[3]?>"><?=$rowwx[3]?></option>
                      <?
                      }
                      ?>
                    </select>
                    <button name="buttonfp" onclick="return confirm('确定分配？');" type="submit" class="btn btn-default">分配</button>
            	</div>
            </div>
            </p>
          </span>
       <p>
       
       </p>
    
    </p>
    
    <p>
    <div class="table-responsive">
      <table width="90%" class="table" border="1" cellspacing="0" cellpadding="0">
   
  <tr>
  	
    <td align="center" class="text-danger"><input name="allc" id="allc" class="allc" type="checkbox" value="allc"  style=" width:20px;" ><label for="allc">全选</label> |  删除</td>
    <td align="center" class="text-danger">地点</td>
    <td align="center" class="text-danger">姓名</td>
    <td align="center" class="text-danger">电话</td>
    <td align="center" class="text-danger">专业或部门</td>
    <td align="center" class="text-danger">报修时间 </td>
    <td align="center" class="text-danger">维修员</td>
    <td align="center" class="text-danger">处理情况</td>
    <td align="center" class="text-danger">物件详情</td>
  </tr>
  <?
  
	if(isset($_GET['all']))
	{
		$sqlre="select * from sch_repair_re where s_jg='未处理' and s_repair='未分配' order by s_settime asc";
		$b='all=';
	}
	else
	{
		$sqlre="select * from sch_repair_re where s_repair='未分配' and s_jg='未处理' order by s_settime asc";
	}

	for($i=0;$i<count($arrayall);$i++)
	{
		if(isset($_GET[$arrayalldm[$i]]))
		{
			$sqlre="select * from sch_repair_re where s_add='".$arrayall[$i]."' and s_jg='未处理' and s_repair='未分配' order by s_settime asc";
			$b=$arrayalldm[$i];
		}
	}
   $rsre=mysql_query($sqlre,$con);
   while($rowre=mysql_fetch_row($rsre))
   {
   ?>
  <tr>
    <td align="center">
    	<input name="c[]" id="<?=$rowre[0]?>" class="choo" type="checkbox" value="<?=$rowre[0]?>"  style=" width:20px;" ><label for="<?=$rowre[0]?>">选择</label>
    	<input name="tb" type="hidden" value="<?=$b?>" />
   
	</form><span>
    <a href="delete_adminly.php?tname=<?=$rowre[3]?>&tphone=<?=$rowre[5]?>&tadd=<?=$rowre[1]?>&ttime=<?=$rowre[10]?>&b=<?=$b?>"><button onclick="return confirm('确定删除？');" type="button" class="btn btn-default">删除</button></a></span>
    </td>
    <td align="center"><?=$rowre[1].$rowre[2]?></td>
    <td align="center"><?=$rowre[3]?></td>
    <td align="center"><?=$rowre[5]?></td>
    <td align="center"><?=$rowre[4]?></td>
    <td align="center"><?=$rowre[10]?></td>
    <td align="center"><?=$rowre[7]?></td>
    <td align="center"><?=$rowre[11]?></td>
    
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
</table>
<!--物件详情-->
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
	location.href="admin_ly.php?<?=$_GET['tb']?>";
</script>
<?
}
?>
<script type="text/javascript">
$("#allc").change(function(){
	var innum=$(".choo").length;
	if($(this).prop("checked")){
		$(".choo").prop("checked",true);
		$("#in_num").text(innum);
		$(".lskdo").val(1);
		$("#sp_num").text(innum);
		$(".lskdo").prop("disabled",false);
	}
	else{
		$(".choo").prop("checked",false);
		$("#in_num").text(0);
		$(".lskdo").val(0);
		$("#sp_num").text(0);
		$(".lskdo").prop("disabled",true);
		}
	})
	
	</script>
<!--分配-->
<?
if(isset($_GET['buttonfp']))
{	
	$nc=$_GET['c'];
	$n=count($_GET['c']);
	$tb=$_GET['tb'];
	$wxy=$_GET['wxy'];
	for($i=0;$i<=$n-1;$i++)
	{
		$sql_inewxy="select * from sch_repair_re where sid='".$nc[$i]."'";
		$rs_inewxy=mysql_query($sql_inewxy,$con);
		if($rowewxy=mysql_fetch_row($rs_inewxy))
		{
			$sql_update="update sch_repair_rea set s_repair='".$wxy."' where s_time='".$rowewxy[10]."' and s_add='".$rowewxy[1]."' and s_name='".$rowewxy[3]."' and s_phone='".$rowewxy[5]."'";
			$rs_update=mysql_query($sql_update,$con);
		}
		$sql_inwxy="update sch_repair_re set s_repair='".$wxy."' where sid='".$nc[$i]."'";
		$rs_inwxy=mysql_query($sql_inwxy,$con);
	}
	if($rs_inwxy>0)
	{
		/*
		短信平台：http://www.sms.cn/
		 
		$requesturl='http://api.sms.cn/sms/?ac=send&uid=amos&pwd=7191d511822634f5783dc89baeea616d&template=418231&mobile=15111888341&content={"name":"'.$wxy.'"}';
	    //curl方式获取json数组
	    $curl = curl_init(); //初始化
	    curl_setopt($curl, CURLOPT_URL, $requesturl);//设置抓取的url
	    curl_setopt($curl, CURLOPT_HEADER, 0);//设置头文件的信息作为数据流输出
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//设置获取的信息以文件流的形式返回，而不是直接输出。
	    $data = curl_exec($curl);//执行命令
	    curl_close($curl);//关闭URL请求

	    */
				?>
		        <script language="javascript">
		        	alert("分配成功：<?=$wxy?>");
					location.href="admin_ly.php?<?=$tb?>";
		        </script>
		        <?
			}
			
		}
?>
</div>
    </p>
</div>
</center>
</body>
</html>