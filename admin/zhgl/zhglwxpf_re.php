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
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-admincd-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-main-zhgl.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
<link media="(min-width:500px)" href="../../CSS/admincd-index.css" rel="stylesheet" type="text/css" />
<link media="(min-width:500px)" href="../../CSS/main-zhgl.css" rel="stylesheet" type="text/css" />

<title>账号管理</title>
</head>

<body>
<?
include"../../PHP/riqi.php";
include"../../SQL/db/db.php";
include"../../PHP/adminse.php";
$sqlc="select count(sid) from sch_repair_re where s_repair='".$_GET['n']."' and s_jg='已处理' and s_score!=0";
$rsc=mysql_query($sqlc,$con);
if($rowc=mysql_fetch_row($rsc))
{
	$sqlc2="select sum(s_score) from sch_repair_re where s_repair='".$_GET['n']."' and s_jg='已处理' and s_score!=0";
$rsc2=mysql_query($sqlc2,$con);
	if($rowc2=mysql_fetch_row($rsc2))
	{
		
		if($rowc[0]==0)
			$c=0;
		else
		$c=round($rowc2[0]/$rowc[0],1);
		
	}
}
?>
<!------导航------>
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
    	<a href="../../index.php"><div class="dh-index">首页</div></a>
        <a href="zhglwx_re.php?nid=<?=$_GET['n']?>"><div class="dh-index">统计</div></a>
        <a href="zhgl.php?n=维修员"><div class="dh-index">返回</div></a>
        
  </div>
</div>
<!------main------>
<center>
<div class="admin-main">
<h2><?=$_GET['n']?>的平均评分:
	<?
	if($c==0)
	echo "0";
	else
	echo $c;
	
	if($c)
	?>

</h2><span class="input-group-addon">1分很差-2分差-3分好-4分很好</span>
<hr />
<h2>
<?
if($c!=0)
{
?>
大家给你的评价

</h2>
<?
$sqll="select * from sch_repair_re where s_repair='".$_GET['n']."' and s_jg='已处理' and s_score!=0";
$rsl=mysql_query($sqll,$con);
while($rowl=mysql_fetch_row($rsl))
{
	?>
<div class="gi-w">
        <div class="gi-st">
        
        评分：
        <?
        if($rowl[8]==1)
			echo "很差";
			if($rowl[8]==2)
			echo "差";
			if($rowl[8]==3)
			echo "好";
			if($rowl[8]==4)
			echo "很好";
		?>
        
        
        <p class="gitime"><br />评价：</p>
        </div>
        <div class="gi-mt">
      	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<textarea style="background-color:#DEEBE0;" name="tcom" cols="34" rows="4" readonly="readonly" id="tcom"><?=$rowl[9]?></textarea>
        </div>
    </div>
<?
}

}
else
echo "暂无评论";
?>

</div>
</center>
</body>
</html>