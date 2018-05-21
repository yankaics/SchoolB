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
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
<link rel="stylesheet" href="../../layui/css/layui.css">
<script src="../../layui/layui.js"></script>
<link rel="shortcut icon" href="../../favicon.ico" />
<!---JSQ-->
<script src="../../JSQ/jquery-2.1.1.min.js"></script>
<script src="../../JSQ/index.js"></script>
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

<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/logo-32-t.png"></div>
	<?
  include("../../PHP/riqi.php");
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
    <ul class="layui-nav layui-layout-right">
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
    </ul>
  </div>
</div><br><br>
<!--main-->
<div class="layui-container">
  <div class="layui-row layui-col-md-offset4">
  	<form name="timef" id="elef" class="layui-form" action="" method="post" onSubmit="return checktime()">

  		<div class="layui-col-md4 layui-col-xs10">

        <?
          if(isset($_POST['timesql']))
          {
            $lstt=$_POST['timesql'];
          }
          else
          {
            $lstt=$rqY.'-'.$rqmm;
            ?>
            <script type="text/javascript">
              $(document).ready(function(){
                $("#elef").submit();
              });
            </script>
            <?
          }
          
    		?>
            <div class="layui-form-item">
              <label class="layui-form-label">日期</label>
              <div class="layui-input-block">
                <input type="text"  class="layui-input" required  lay-verify="required" placeholder="请选择日期" readonly autocomplete="off" name="timesql" id="timetext" value="<?=$lstt?>">
            </div>
            
        </div>
        
  	</form>
  </div>
</div>  

<? 
if(isset($_POST['timesql']))
{

	?>
<p>
<div class="layui-container">
  <div class="layui-row">
  	<div class="layui-col-md8 layui-col-md-offset2">
<?
		//已处理无数据
		$countsql="select count(*) from sch_repair_re where s_schid='".$_SESSION['user']."' and s_jg='已处理' and s_settime like '".$_POST['timesql']."%'";
		$countrs=mysql_query($countsql,$con);
		if($countrow=mysql_fetch_row($countrs))
		if($countrow[0]==0)
		{
			?>
            <script>
			$(document).ready(function(e) {
				  	layui.use('layer', function(){
  					var layer = layui.layer;
					layer.msg('当前日期无记录(｡・`ω´･)', {
					time: 2000,
					area: ['240px','50px'],
					});
				});
			});
            </script>
            <?
		}
		//查询已处理
		$sql="select * from sch_repair_re a where s_schid='".$_SESSION['user']."' and s_settime like '".$_POST['timesql']."%' and s_jg='已处理'";
		  $rs=mysql_query($sql,$con);
		  while($row=mysql_fetch_row($rs))
		  {
		?>
<blockquote class="layui-elem-quote" style="font-size:18px; background-color:#F0F0F0;">
<?=$row[10]?>
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
  
  laydate.render({
    elem: '#timetext'
    ,type: 'month'
    ,theme: '#393D49'
    ,done: function(value, date){
      $('#timetext').val(value);
      $("#elef").submit();
    }//选中后提交
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