<!--
/**
 * This file is part of online_chat_room.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    AmosHuKe<amoshuke@qq.com>
 * @copyright AmosHuKe<amoshuke@qq.com>
 * @link      https://github.com/AmosHuKe/Hi/tree/master/Online_Chat_Room
 * @license   http://www.opensource.org/licenses/mit-license.php (MIT License)
 */
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="../../layui/css/layui.css">
	<script src="../../layui/layui.js"></script>
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<title>住房预定审批</title>
	<style type="text/css">
		a:link {
			text-decoration: none;
		}
		a:visited {
			text-decoration: none;
		}
		a:hover {
			text-decoration: none;
		}
		a:active {
			text-decoration: none;
		}
		body{ 
			
			margin:10px;
		}
	</style>
</head>
<body>
<?php
	include("../../PHP/riqi.php");
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
	include("../adminse/admin_se.php");
	include("class/admin_reserve_class.php");			//住房预定审批类
	$re=new admin_reserve_class($con,$_SESSION['id']); 	//实例化
	
?>

<blockquote class="layui-elem-quote">
	<h4>住房预定审批</h4>
	<p>
		<?php
			if($_SESSION['id']=="sha")
			{
				echo"审核员A进行第一次审批";
			}
			else if($_SESSION['id']=="shb")
			{
				echo"审核员B进行最后审批";
			}
		?>
	</p>
	<p>
		<form name="cz" class="cz" method="get" action="">
			<button name="wsh" type="submit" class="layui-btn layui-btn-sm">未审核</button>
			<button name="ty" type="submit" class="layui-btn layui-btn-sm">同意</button>
			<button name="jj" type="submit" class="layui-btn layui-btn-sm">拒绝</button>
		</form>
	</p>
</blockquote>

<!-- main -->
<div class="table-responsive">
  	<table width="100%" class="layui-table table" id="" lay-filter="reserve_table" lay-even>
  		<thead>
	  		<tr>
			    <td lay-data="{field:'ID', width:140,fixed:'left' }" align="center" class="">操作</td>
			    <td lay-data="{field:'tuser', width:140}" align="center" class="">申请人</td>
			    <td lay-data="{field:'tbm'}" align="center" class="">部门</td>
			    <td lay-data="{field:'tphone', width:160}" align="center" class="">电话</td>
			    <td lay-data="{field:'tstart', width:160, sort:true}" align="center" class="">入住时间</td>
			    <td lay-data="{field:'tend', width:160, sort:true}" align="center" class="">退房时间</td>
			    <td lay-data="{field:'tnan', width:100, sort:true}" align="center" class="">男生</td>
			    <td lay-data="{field:'tnv', width:100, sort:true}" align="center" class="">女生</td>
			    <td lay-data="{field:'ttime', width:160, sort:true}" align="center" class="">申请时间</td>
			    
			</tr>
		</thead>
		<tbody>
			<?php
				//查询数据
				if(isset($_GET['wsh']))
				{
					$rs=$re->Select_SH("未审核",true);
					$wwwz="wsh";
				}
				else if(isset($_GET['ty']))
				{
					$rs=$re->Select_SH("同意",false);
					$wwwz="ty";
				}
				else if(isset($_GET['jj']))
				{
					$rs=$re->Select_SH("拒绝",false);
					$wwwz="jj";
				}
				else
				{
					$rs=$re->Select_SH("未审核",true);
					$wwwz="wsh";
				}
				while($rowsh=mysql_fetch_row($rs))
				{
			?>
		  	<tr>
			    	<td align="center">
			    		<?php
			    			if($wwwz=="wsh")
							{
			    		?>
			    		<form name="cz" class="cz" method="post" action="">
			    			<input type="hidden" name="tid" class="tid" value="">
			    			<input type="hidden" name="tcz" class="tcz" value="">
							<button name="ty" type="submit" onclick="return form_re(<?=$rowsh[2]?>,'同意');" class="layui-btn layui-btn-sm">同意</button>
							<button name="jj" type="submit" onclick="return form_re(<?=$rowsh[2]?>,'拒绝');" class="layui-btn layui-btn-danger layui-btn-sm">拒绝</button>
						</form>
						<?php
							}
							else if($wwwz=="ty")
							{
								echo"同意";
							}
							else if($wwwz=="jj")
							{
								echo"拒绝";
							}
						?>
			    	</td>
			    	<td align="center"><?=$rowsh[0]?></td>
			    	<td align="center"><?=$rowsh[1]?></td>
			    	<td align="center"><?=$rowsh[4]?></td>
			    	<td align="center"><?=$rowsh[8]?></td>
			    	<td align="center"><?=$rowsh[9]?></td>
			    	<td align="center"><?=$rowsh[5]?></td>
			    	<td align="center"><?=$rowsh[6]?></td>
			    	<td align="center"><?=$rowsh[7]?></td>
		  	</tr>
		  	<?php
		  		}
		  	?>
		</tbody>
	</table>
</div>






<script type="text/javascript">
layui.use('table', function(){
  var table = layui.table;

	table.init('reserve_table', {
	  
	  limit: 10
	  ,page: true
	});
  	
});

/*
	操作
	cid 	ID
	cz 		同意 | 拒绝

 */
function form_re(cid,cz){
	$(document).ready(function(e) {
		$('.tid').attr("value",cid);
		$('.tcz').attr("value",cz);

		layui.use('layer', function(){
			var layer = layui.layer;
			parent.layer.confirm('确定'+cz+'?', {
			  btn: ['确定','取消'],
			  title: false,
			  closeBtn: 0,
			}, function(){
				$(".cz").submit();
				parent.layer.closeAll();
			},function(){
				
			});
		
		});
	});
	return false;
}

/*
	弹窗提示
	nr	提示文本
 */
function ftc(nr){
	$(document).ready(function(e) {
		layui.use('layer', function(){
		var layer = layui.layer;
		parent.layer.msg(nr, {
		title: false,
		closeBtn: 0,
		time:2000,
			
			});
		});
	});
	
}
</script>


<?php
	if(isset($_POST['tid']) && isset($_POST['tcz']));
	{
		$rid=$_POST['tid'];
		$rcz=$_POST['tcz'];
		$rjg=$re->SH($rid,$rcz);
		if($rjg=="同意")
		{
			?>
			<script type="text/javascript">
				location.href="admin_reserve.php";
				ftc("已同意");
				
			</script>
			<?
		}
		else if($rjg=="拒绝")
		{
			?>
			<script type="text/javascript">
				location.href="admin_reserve.php";
				ftc("已拒绝");
			</script>
			<?
		}
		else if($rjg=="error")
		{
			?>
			<script type="text/javascript">
				location.href="admin_reserve.php";
				ftc("审批失败，请稍后再试");
			</script>
			<?
		}
	}
?>


</body>
</html>