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
	<title>预定已通过审核</title>
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

	include("../../PHP/SMS.php");//短信类
	$sms_s=new SMS($con);
	include("class/admin_reserve_class.php");			//住房预定审批类
	$re=new admin_reserve_class($con,'shb'); 	//实例化
	
?>
<!-- main -->
<div class="table-responsive">
  	<table width="100%" class="layui-table table" id="" lay-filter="reserve_table" lay-even>
  		<thead>
	  		<tr>
			    <td lay-data="{field:'ID', width:140,fixed:'left' }" align="center" class="">ID</td>
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
	
				$rs=$re->Select_SH("同意",false);
				$wwwz="ty";

				while($rowsh=mysql_fetch_row($rs))
				{
					$timet=$rqY.'-'.$rqmm.'-'.$rqd;
					if(!($rowsh[9]<$timet))
					{
			?>
		  	<tr>
			    	<td align="center">
			    		<?=$rowsh[2]?>
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
</script>
</body>
</html>