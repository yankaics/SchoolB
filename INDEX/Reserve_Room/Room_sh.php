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
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<link rel="stylesheet" href="../../layui/css/layui.css">
	<script src="../../layui/layui.js"></script>
	<title>住房审批</title>
	<style type="text/css">
		body{
			background: #F0F0F0;
			padding-bottom:200px;
		}
		a:link{text-decoration:none;}
		a:visited{text-decoration:none;}
		a:hover{text-decoration:none;}
		a:active{text-decoration:none;}
		.layui-container{
			margin-top: 10px;
		}
	</style>
</head>
<body>
<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/logo-32-t.png"></div>
	<?
		include"../../PHP/riqi.php";
		include"../../SQL/db/db.php";
		include"../../PHP/adminse.php";
		include"class/Reserve_Room_class.php"; //住房预定类
		$res_room=new Reserve_Room_class($con);
		
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
    </ul>
  </div>
</div>

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
	            $lstt=$res_room->newRoom($_SESSION['txh'],$rqY,$rqmm);
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
	        	
            </div>
	  	</form>

	</div>
</div>
<?php
	if(isset($_POST['timesql']))
	{
		$rs=$res_room->SelectRoom($_SESSION['txh'],$_POST['timesql']);
		if(!$rowre=mysql_fetch_row($rs))
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
		else
		{
?>
<div class="layui-container">
  <div class="layui-row">
  	<div class="layui-col-md8 layui-col-md-offset2">
		<table  class="layui-table" lay-skin="line" align="center">
	        <thead align="center">
	          <tr align="center">
	            <td align="center">申请日</td>
	            <td align="center">详情</td>
	            <td align="center">审核流程</td>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php
	        		$rs=$res_room->SelectRoom($_SESSION['txh'],$_POST['timesql']);
	        		while($row=mysql_fetch_row($rs))
	        		{
	        			
	        			$txq="<center>入住时间 - ".$row[6]."<br>退房时间 - ".$row[7]."<br>男 - ".$row[3]."人 | 女 - ".$row[4]."人</center>";

	       				if($row[8]=="未审核" && $row[9]=="未审核")
	       				{
	       					$sh="等待审核";
	       				}
	       				else if($row[8]=="同意" && $row[9]=="未审核")
	       				{
	       					$sh="等待二级审核";
	       				}
	       				else if($row[8]=="拒绝" || $row[9]=="拒绝")
	       				{
	       					$sh="住房被拒绝";
	       				}
	       				else if($row[8]=="同意" && $row[9]=="同意")
	       				{
	       					$sh="已同意·耐心等待电话";
	       				}
	        			$tsh="<p>初审 【 ".$row[8]." 】</p><p>终审 【 ".$row[9]." 】</p><p>审核结果 【 ".$sh." 】</p>";

	        	?>
				<tr align="center">
					<td align="center">
						<?=substr($row[5],8,2)."日";?>
					</td>
					<td align="center">
						<button class="layui-btn" onclick="consay('<?=$txq?>');">详情</button>
					</td>
					<td align="center">
						<?php
							if($row[8]=="未审核" && $row[9]=="未审核")
							{
								?>
								<button class="layui-btn layui-btn-warm" onclick="consay('<?=$tsh?>');">未审核</button>
								<?
							}
							else if($row[8]=="同意" && $row[9]=="未审核")
							{
								?>
								<button class="layui-btn layui-btn-warm" onclick="consay('<?=$tsh?>');">待审核</button>
								<?
							}
							else if($row[8]=="拒绝" || $row[9]=="拒绝")
							{
								?>
								<button class="layui-btn layui-btn-danger" onclick="consay('<?=$tsh?>');">拒绝</button>
								<?
							}
							else if($row[8]=="同意" && $row[9]=="同意")
							{
								?>
								<button class="layui-btn" onclick="consay('<?=$tsh?>');">同意</button>
								<?
							}

						?>
						
					</td>
				</tr>
				<?php
					}
				?>
	        </tbody>
	    </table>


  	</div>
  </div>
</div>
<?php
		}
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

//询问框
//tnr=内容
function consay(tnr)
{
	layui.use('layer', function(){
	  var layer = layui.layer;

	  parent.layer.confirm(tnr, {
	    btn: ['关闭'] //按钮
	    ,title:false
	    ,shadeClose:true
	  },function(){
	    parent.layer.closeAll();
	  });
	}); 
}
</script>


</body>
</html>