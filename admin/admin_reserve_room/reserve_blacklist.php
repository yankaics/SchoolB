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
	<title>黑名单</title>
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

	include("class/reserve_blacklist_class.php");	//黑名单类
	$blist=new reserve_blacklist_class($con); 		//实例化
	
?>

<blockquote class="layui-elem-quote">
	<h4>黑名单</h4>
	<p>拉黑后的教师将不能预定住房</p>
</blockquote>
<!-- main -->
<div class="table-responsive">
  	<table width="100%" class="layui-table table" id="" lay-filter="reserve_table" lay-even>
  		<thead>
	  		<tr>
			    <td lay-data="{field:'ID', width:140,fixed:'left' }" align="center" class="">操作</td>
			    <td lay-data="{field:'tuser', width:140, sort:true}" align="center" class="">账号</td>
			    <td lay-data="{field:'tname', width:160, sort:true}" align="center" class="">姓名</td>
			    <td lay-data="{field:'tsex', width:160, sort:true}" align="center" class="">性别</td>
			    <td lay-data="{field:'tjob'}" align="center" class="">部门</td>
			    <td lay-data="{field:'tphone'}" align="center" class="">电话</td>
			</tr>
		</thead>
		<tbody>
			<?
				$rs=$blist->select_tea();
				while($row=mysql_fetch_row($rs))
				{
			?>
		  	<tr>
		    	<td align="center">
		    		<form name="cz" class="cz" method="get" action="">
		    			<input type="hidden" name="tid" class="tid" value="">
		    			<input type="hidden" name="tcz" class="tcz" value="">
		    			<?php
		    				$rsb=$blist->selectb($row[6]);
		    				if($rowss=mysql_fetch_row($rsb))
		    				{
		    			?>
								<button name="ty" type="submit" onclick="return form_re('<?=$row[6]?>',false);" class="layui-btn layui-btn-sm">取消拉黑</button>
						<?
							}
							else
							{
						?>
						<button name="jj" type="submit" onclick="return form_re('<?=$row[6]?>',true);" class="layui-btn layui-btn-danger layui-btn-sm">拉黑</button>
						<?
							}
						?>
					</form>
		    	</td>
		    	<td align="center"><?=$row[6]?></td>
		    	<td align="center"><?=$row[1]?></td>
		    	<td align="center"><?=$row[2]?></td>
		    	<td align="center"><?=$row[5]?></td>
				<td align="center"><?=$row[4]?></td>
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
	  
	  limit: 20
	  ,page: true
	});
  	
});

/*
	操作
	cid 	ID
	cz 		true 拉黑 | false 取消拉黑

 */
function form_re(cid,cz){
	$(document).ready(function(e) {
		$('.tid').attr("value",cid);
		$('.tcz').attr("value",cz);
		if(cz)
		{
			cz="拉黑";
		}
		else
		{
			cz="取消拉黑";
		}
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

<?
if(isset($_GET['tid']) && isset($_GET['tcz']))
{
	$rid=$_GET['tid'];
	$rcz=$_GET['tcz'];
	
	$rjg=$blist->set_blacklist($rid,$rcz);
	if($rjg>0)
	{
		?>
		<script type="text/javascript">
			location.href="reserve_blacklist.php";
			ftc("操作成功");
		</script>
		<?
	}
	else
	{
		?>
		<script type="text/javascript">
			location.href="reserve_blacklist.php";
			ftc("操作失败");
		</script>
		<?
	}
}	
?>

</body>
</html>