<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
<link rel="stylesheet" href="../../layui/css/layui.css">
<script src="../../layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<link rel="shortcut icon" href="../../favicon.ico" />
<!--JSQ-->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../../JSQ/index.js"></script>
<title>校园宝后台-维修员任务</title>
<style>
body{
	font-weight:600;
	font-family:"宋体";
}
.af{
	border-radius:5px;
	-moz-box-shadow:0px 3px 20px  #DEDEDE; 
	-webkit-box-shadow:0px 3px 20px  #DEDEDE; 
	box-shadow:0px 3px 20px  #DEDEDE;
	background-color:#393D49;
	color:#FFF;
	font-size:16px;
}
</style>
</head>

<body>
<?
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
?>
<!--导航
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
        <a href="../infor/admincd_index.php"><div class="dh-index">菜单</div></a>
        <a href="wxpfpj.php"><div class="dh-index">评分</div></a>
  </div>
</div>-->
<!--main-->
<blockquote class="layui-elem-quote">
	维修任务
	<p>&lt;操作&gt;里是该报修所有详情</p>
    <p>维修完成或不能完成的点击&lt;操作&gt;进行操作</p>
    <p id="test"></p>
    <p>
    	<form method="get">
        	<button name="all_a" class="layui-btn" type="submit">所有</button>
            <button name="wcl_a" class="layui-btn" type="submit">未处理</button>
            <button name="bncl_a" class="layui-btn" type="submit">不能处理</button>
        </form>
    </p>
</blockquote>
<?

$sqlle="select * from sch_repair_re where s_repair='".$_SESSION['name']."' and s_jg!='已处理'";
$rsle=mysql_query($sqlle,$con);
if($rowle=mysql_fetch_row($rsle))
{
	if(isset($_GET['wcl_a']))
	$sqll="select * from sch_repair_re where s_repair='".$_SESSION['name']."' and s_jg='未处理' order by s_settime asc";
	else if(isset($_GET['bncl_a']))
	$sqll="select * from sch_repair_re where s_repair='".$_SESSION['name']."' and s_jg='不能处理' order by s_settime asc";
	else
	$sqll="select * from sch_repair_re where s_repair='".$_SESSION['name']."' and s_jg!='已处理' order by s_settime asc";
	$rsl=mysql_query($sqll,$con);
	while($rowl=mysql_fetch_row($rsl))
	{
	
	?><br><br>
<div class="layui-container" >
  <div class="layui-row layui-col-space10" >
  	<div class="af layui-col-md4 layui-col-md-offset4 ">
    	<div class="layui-row layui-col-space10">
          <div class="layui-col-md12 layui-col-xs12">
          	<p><?=$rowl[1].$rowl[2]?></p>
            <p><?=$rowl[10]?></p>
            <p style="color:#FF5722;"><?=$rowl[11]?></p>
          </div>
          <div class="layui-col-md12 layui-col-xs12">
            <a href="czxq.php?id=<?=$rowl[0]?>"><button name="button" class="layui-btn" type="button">操作</button></a>
          </div>
          <div class="layui-col-md12 layui-col-xs12">
            姓名:<?=$rowl[3]?> | 电话:<?=$rowl[5]?>
          </div>
          <div class="layui-col-md12 layui-col-xs12">
          <form style="color:#333; " class="layui-form" action="">
            <select  name="admin_city" lay-verify="required">
            	<option value="0">点击查看物件</option>
            <?
			$sqlwj="select * from sch_repair_rea where s_repair='".$_SESSION['name']."' and s_jg!='已处理' and s_add='".$rowl[1]."' and s_name='".$rowl[3]."' and s_phone='".$rowl[5]."' and s_time='".$rowl[10]."'";
			$rswj=mysql_query($sqlwj,$con);
			while($rowwj=mysql_fetch_row($rswj))
			{
				?>
                <option value="<?=$rowwj[1]?>"><?=$rowwj[1]?> | <?=$rowwj[2]?>件</option>
				<? 
			}
			?> 
                
            </select>
          </form>
          </div>
        </div>
        
  	</div>
  </div>
</div><br><br>
	<?
	}
}
else
echo "<h2>暂无任务</h2>";
?>
<script>
//
layui.use('form', function(){
  var form = layui.form;
});
//每半小时刷新一次
$(document).ready(function(e) {
    setTimeout(function () {
		location.reload();
	},1800000);
});
</script>

</body>
</html>