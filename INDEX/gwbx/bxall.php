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
<!---JSQ--->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../../JSQ/index.js"></script>
<!---以往得CSS
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="../favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />--->
<script>
function checktime()
{
	if(timef.timesql.value=="")
	{
		$(document).ready(function(e) {
				  	layui.use('layer', function(){
  					var layer = layui.layer;
					layer.msg('点击选择时间(｡・`ω´･)', {
					time: 2000,
					area: ['240px','50px'],
					});
				});
			});
			return false;
	}
}
</script>
<title>所有报修</title>

</head>

<body bgcolor="#F0F0F0">

<!------导航------>
<div class="layui-header header header-doc">
    <ul class="layui-nav layui-icon" lay-filter="">
        <div class="layui-container">  
        	<li class="layui-nav-item layui-icon" style="z-index:1;"><a href="../../index.php"><img class="layui-icon" src="../../UI/logo/呕吐-1.png"></a>
            <span class="layui-nav-bar" style=" display:none"></span>
            </li>
        </div> 
    </ul>
<?
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
//报修查询数量
$countsql="select count(*) from sch_repair_re where s_schid='".$_SESSION['user']."' and s_jg!='已处理'";
$countrs=mysql_query($countsql,$con);
if($countrow=mysql_fetch_row($countrs))
	$countnum=$countrow[0];
else
	$countnum=0;

?>
    <ul class="layui-nav layui-layout-right" style="text-align:center;">
    	<div class="layui-container ">
        	
            <li class="layui-nav-item ">
            	<?
				if($_SESSION['utype']=="教师")
				{
				?>
				<a href="../../tea_i.php">
				<div class="xz-index">菜单</div></a>
				<?
				}
				else
				{
				?>
				<a href="../../stu_i.php">
				<div class="xz-index">菜单</div></a>
				<?
				}
				?>
            </li>
     		<li class="layui-nav-item "><a href="gwbxcx_index.php">报修查询<span class="layui-badge"><?=$countnum?></span></a></li>
            
        </div>
    </ul>
</div><br><br>
<!------main------>
<div class="layui-container">
  <div class="layui-row layui-col-md-offset4 layui-col-xs-offset2">
  	<form name="timef" class="layui-form" action="" method="get" onSubmit="return checktime()">
  		<div class="layui-col-md3 layui-col-xs6">
        <?
        if(isset($_GET['timesql']))
		{
		?>
            <input type="text" readOnly =  "readOnly" name="timesql" placeholder="时间" class="layui-input" id="timetext" value="<?=$_GET['timesql']?>">
        <?
		}
		else
		{
        ?>
        <input type="text" readOnly =  "readOnly" name="timesql" placeholder="时间" class="layui-input" id="timetext">
        <?
		}
		?>
        </div>
        <div class="layui-col-md4 layui-col-xs6">
            <button name="buttons" type="submit" class="layui-btn">查询</button>
        </div>
  	</form>
  </div>
</div>  

<? 
if(isset($_GET['buttons']))
{

	?>
<p>
<div class="layui-container">
  <div class="layui-row">
  	<div class="layui-col-md8 layui-col-md-offset2">
<?

		$timea=$_GET['timesql'].'-00:00:00';
		$timeb=$_GET['timesql'].'-23:59:59';
		//已处理无数据
		$countsql="select count(*) from sch_repair_re where s_schid='".$_SESSION['user']."' and s_jg='已处理' and s_settime between '".$timea."' and '".$timeb."'";
		$countrs=mysql_query($countsql,$con);
		if($countrow=mysql_fetch_row($countrs))
		if($countrow[0]==0)
		{
			?>
            <script>
			$(document).ready(function(e) {
				  	layui.use('layer', function(){
  					var layer = layui.layer;
					layer.msg('无记录(｡・`ω´･)', {
					time: 2000,
					area: ['240px','50px'],
					});
				});
			});
            </script>
            <?
		}
		//查询已处理
		$sql="select * from sch_repair_re a where s_schid='".$_SESSION['user']."' and s_settime between '".$timea."' and '".$timeb."' and s_jg='已处理'";
		  $rs=mysql_query($sql,$con);
		  while($row=mysql_fetch_row($rs))
		  {
		?>
<blockquote class="layui-elem-quote" style="font-size:20px; background-color:#F0F0F0;">
时间：<?=substr($row[10],11,8)?>
</blockquote>
<table class="layui-table" lay-even lay-skin="nob" >
        	<colgroup>
            	<col width="100">
            	<col>
          	</colgroup>
          <tbody bgcolor="#F0F0F0">
            <tr>
              <td align="right">地点：</td>
              <td align="left"><?=$row[1].$row[2]?></td>
            </tr>
            <tr>
              <td align="right">姓名：</td>
              <td align="left"><?=$row[3]?></td>
            </tr>
            <tr>
              <td align="right">电话：</td>
              <td align="left"><?=$row[5]?></td>
            </tr>
            <tr>
              <td align="right">
              	<?
				if($_SESSION['utype']=="教师")
				{
					echo "部门：";
				}
				else
				{
					echo "专业：";
				}
				
				?>
              </td>
              <td align="left"><?=$row[4]?></td>
            </tr>
            <tr>
              <td align="right">维修员：</td>
              <td align="left"><?=$row[7]?>&nbsp;&nbsp;<?=$row[11]?></td>
            </tr>
            <tr>
              <td align="right">完成时间：</td>
              <td align="left"><?=$row[12]?></td>
            </tr>
            <tr>
              <td align="right">损坏描述：</td>
              <td align="left"><?=$row[14]?></td>
            </tr>   
            <tr>
              <td align="right" style="color:#FF5722;">物件：</td>
              <td align="left">
              <?
				
					$sqlrea="select * from sch_repair_rea where s_time='".$row[10]."' and s_schid='".$_SESSION['user']."' and s_add='".$row[1]."'";
				$rsrea=mysql_query($sqlrea,$con);
				while($rowrea=mysql_fetch_row($rsrea))
				{
				?>
              	<p><?=$rowrea[1]?> <?=$rowrea[2]?>件</p>
                <?
				}
				?>
              </td>
            </tr>
            
            
          </tbody>
        </table>
        <?
		  }
		?>
    </div>
  </div>
</div>
</p>
<?
}
?>

<script>
layui.use('element', function(){
  var element = layui.element;	
});

layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  //时间
  laydate.render({
    elem: '#timetext' //指定元素
  });
  
});
</script>







<!---旧显示 加评分
<div class="ly">
<h1>所有报修</h1><span class="input-group-addon">除最新报修外，都不可再评分</span>
<div class="table-responsive">
      <table width="90%" class="table" border="1" cellspacing="0" cellpadding="0">
  <tr>
  	<td align="center">物件详情</td>
    <td align="center">地点</td>
    <td align="center">姓名</td>
    <td align="center">处理结果</td>
    <td align="center">报修时间</td>
    <td align="center">维修员</td>
    <td align="center">评分</td>
    <td align="center">评价</td>
  </tr>
   <?
   //if($_SESSION['utype']=="教师")
//   {
//	   $sql="select * from sch_repair_re where s_schid='".$_SESSION['user']."' order by s_settime desc";
//   }
//   else
//   {
//  $sql="select * from sch_repair_re where s_schid='".$_SESSION['user']."' order by s_settime desc";
//   }
//  $rs=mysql_query($sql,$con);
//  while($row=mysql_fetch_row($rs))
//  {
//  ?>
  <tr>
  	<td align="center">
    <form action="" method="get">
    <input name="ttime" type="hidden" value="<?=$row[10]?>"/>
                        <input name="tadd" type="hidden" value="<?=$row[1]?>"/>
                        <input name="button" type="hidden" value=""/>
    <button type="submit" name="wjxq" class="btn btn-default">物件详情</button>
    </form>
    </td>
    <td align="center"><?=$row[1].$row[2]?></td>
    <td align="center"><?=$row[3]?></td>
    <td align="center"><?=$row[11]?></td>
    <td align="center"><?=$row[10]?></td>
    <td align="center"><?=$row[7]?></td>
    <td align="center">
	<?
    //if($row[8]==0)
//		echo "未评分";
//	if($row[8]==1)
//		echo "很差";
//	if($row[8]==2)
//		echo "差";
//	if($row[8]==3)
//		echo "好";
//	if($row[8]==4)
//		echo "很好";
//	
	?>
    </td>
    <td align="center"><textarea name="tcom" cols="20" rows="4" readonly="readonly" id="tcom"><?=$row[9]?></textarea></td>
  </tr>
  <?
  //}
  ?>
</table>
</div>
</div>
--->
</body>
</html>