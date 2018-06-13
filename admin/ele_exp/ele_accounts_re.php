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
	<script src="../../JSQ/index.js"></script>
	<title>轧账财务统计</title>
	<script type="text/javascript">
		//打印
		function printHtml(html) {
			var bodyHtml = document.body.innerHTML;
			document.body.innerHTML = html;
			window.print();
			document.body.innerHTML = bodyHtml;
		}
		function onprint() {
			var html = $("#dy").html();
			printHtml(html);
		}
	</script>
</head>
<body>
<?
  include("../../PHP/riqi.php");
  include("../../SQL/db/db.php");
  include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
?>
<!--main-->
<div class="layui-container">
 	<div class="layui-row">
 		<!--提示-->
	    <div class="layui-col-md12">
		    <blockquote class="layui-elem-quote">
		        <h3>轧账财务统计</h3>
		        <p>针对宿管已经上缴轧账金额进行统计（按表上传日期）</p>
		        <p>第一步：选择需要查看的某月水电费（默认本月）</p>
		        <p>第二步：查看轧账财务的详情统计</p>
				<!--时间-->
				<form name="timef" id="elef" class="layui-form layui-form-pane" action="" method="get" onSubmit="return checktime()" style="margin-top: 20px;">
					<?
					  if(isset($_GET['timesql']))
					  {
					    $lstt=$_GET['timesql'];
					  }
					  else
					  {
					    $lstt=$rqY.'-'.$rqm;
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
					  <div class="layui-input-inline">
					    <input type="text"  class="layui-input" required  lay-verify="required" placeholder="请选择日期" readonly autocomplete="off" name="timesql" id="timetext" value="<?=$lstt?>">
					  </div>
	
					</div>
					<!--打印-->
					<input type="button" class="layui-btn" id="btnPrint" onclick="onprint()" value="打印本页" />
					<!--导出-->
					<a href="re_excel.php?timesql=<?=$lstt?>&dcby"><button name="dcby" class="layui-btn" type="button">导出本页（excel）</button></a>
					<a href="re_excel.php?timesql=<?=$lstt?>&dczb"><button name="dczb" class="layui-btn" type="button">导出当月已缴费寝室整表（excel）</button></a>
					
				</form>
				
		    </blockquote>
		
			<!--显示详情结果-->
			<div id="dy">
				<h1 align="center"><?=$lstt?>电费财务详情</h1>
				<?php
				
				for($i=1;$i<=5;$i++)
				{
					$sqlre="select sushe_date,sum(sushe_money),count(sushe_dor),sum(sushe_ele),sum(sushe_excess) from sushe_user where sushe_m='已上缴' and sushe_Y='".$lstt."' and sushe_dor like '".$i."%'";
					$rsre=mysql_query($sqlre,$con);
					if($rowre=mysql_fetch_row($rsre))
					{
						
						//抄表时间
						${"cbsj".$i}=$rowre[0]!=""?$rowre[0]:"暂无数据";
						//已轧账费用
						${"yfy".$i}=$rowre[1]!=""?$rowre[1]:"暂无数据";
						//已轧账寝室
						${"ydor".$i}=$rowre[2]!=0?$rowre[2]:"暂无数据";
						//已轧账用电量
						${"yele".$i}=$rowre[3]!=""?$rowre[3]:"暂无数据";
						//已轧账超额量
						${"yexc".$i}=$rowre[4]!=""?$rowre[4]:"暂无数据";

						$sqlrew="select sushe_date,sum(sushe_money),count(sushe_dor),sum(sushe_ele),sum(sushe_excess) from sushe_user where sushe_m!='已上缴' and sushe_Y='".$lstt."' and sushe_dor like '".$i."%'";
						$rsrew=mysql_query($sqlrew,$con);
						if($rowrew=mysql_fetch_row($rsrew))
						{
							//未轧账用电量
							${"wele".$i}=$rowrew[3]!=""?$rowrew[3]:"暂无数据";
							//未轧账超额量
							${"wexc".$i}=$rowrew[4]!=""?$rowrew[4]:"暂无数据";
							//未轧账费用
							${"wfy".$i}=$rowrew[1]!=""?$rowrew[1]:"暂无数据";
							//未轧账寝室
							${"wdor".$i}=$rowrew[2]!=0?$rowrew[2]:"暂无数据";
						}
					}
					
				}

				?>
				<table class="layui-table" >
					<colgroup>
						<col>
						<col>
						<col>
						<col>
						<col>
					</colgroup>
					<thead>
						<tr>
							<th>详情</th>
							<th>1号楼</th>
							<th>2号楼</th>
							<th>3号楼</th>
							<th>4号楼</th>
							<th>5号楼</th>
						</tr> 
					</thead>
					<tbody>
						<tr>
							<td>抄表时间</td>
							<td><?=$cbsj1?></td>
							<td><?=$cbsj2?></td>
							<td><?=$cbsj3?></td>
							<td><?=$cbsj4?></td>
							<td><?=$cbsj5?></td>
						</tr>
						<tr>
							<td>已轧账费用（元）</td>
							<td><?=$yfy1?></td>
							<td><?=$yfy2?></td>
							<td><?=$yfy3?></td>
							<td><?=$yfy4?></td>
							<td><?=$yfy5?></td>
						</tr>
						<tr>
							<td>已轧账寝室（间）</td>
							<td><?=$ydor1?></td>
							<td><?=$ydor2?></td>
							<td><?=$ydor3?></td>
							<td><?=$ydor4?></td>
							<td><?=$ydor5?></td>
						</tr>
						<tr>
							<td>已轧账用电量（元）</td>
							<td><?=$yele1?></td>
							<td><?=$yele2?></td>
							<td><?=$yele3?></td>
							<td><?=$yele4?></td>
							<td><?=$yele5?></td>
						</tr>
						<tr>
							<td>已轧账超额量</td>
							<td><?=$yexc1?></td>
							<td><?=$yexc2?></td>
							<td><?=$yexc3?></td>
							<td><?=$yexc4?></td>
							<td><?=$yexc5?></td>
						</tr>
						<tr>
							<td>未轧账费用（元）</td>
							<td><?=$wfy1?></td>
							<td><?=$wfy2?></td>
							<td><?=$wfy3?></td>
							<td><?=$wfy4?></td>
							<td><?=$wfy5?></td>
						</tr>
						<tr>
							<td>未轧账寝室（间）</td>
							<td><?=$wdor1?></td>
							<td><?=$wdor2?></td>
							<td><?=$wdor3?></td>
							<td><?=$wdor4?></td>
							<td><?=$wdor5?></td>
						</tr>
						<tr>
							<td>未轧账用电量</td>
							<td><?=$wele1?></td>
							<td><?=$wele2?></td>
							<td><?=$wele3?></td>
							<td><?=$wele4?></td>
							<td><?=$wele5?></td>
						</tr>
						<tr>
							<td>未轧账超额量</td>
							<td><?=$wexc1?></td>
							<td><?=$wexc2?></td>
							<td><?=$wexc3?></td>
							<td><?=$wexc4?></td>
							<td><?=$wexc5?></td>
						</tr>
					</tbody>
				</table>
			</div>

	    </div>


	</div>
</div>

<?php
//导出excel方法

//导出本页
if(isset($_GET['dcby']))
{
	//表格数组  
	
	// $data = array(
	// 	array('抄表时间',$cbsj1,$cbsj2,$cbsj3,$cbsj4,$cbsj5),
	// 	array('已轧账费用（元）',$yfy1,$yfy2,$yfy3,$yfy4,$yfy5),
	// 	array('已轧账寝室（间）',$ydor1,$ydor2,$ydor3,$ydor4,$ydor5),
	// 	array('已轧账用电量（元）',$yele1,$yele2,$yele3,$yele4,$yele5),
	// 	array('已轧账超额量',$yexc1,$yexc2,$yexc3,$yexc4,$yexc5),
	// 	array('未轧账费用（元）',$wfy1,$wfy2,$wfy3,$wfy4,$wfy5),
	// 	array('未轧账寝室（间）',$wdor1,$wdor2,$wdor3,$wdor4,$wdor5),
	// 	array('未轧账用电量',$wele1,$wele2,$wele3,$wele4,$wele5),
	// 	array('未轧账超额量',$wexc1,$wexc2,$wexc3,$wexc4,$wexc5)
 //    );
 //    getExcel("123","233",$data);
 	
}
	
//导出整表
?>

<script type="text/javascript">
layui.use('form', function(){
  var form = layui.form;

});
layui.use('laydate', function(){
	var laydate = layui.laydate;

	laydate.render({
	  elem: '#timetext'
	  ,type: 'month'
	  ,format: 'yyyy-M'
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

//防止页面后退
  history.pushState(null, null, document.URL);
  window.addEventListener('popstate', function () {
      history.pushState(null, null, document.URL);
  });
</script>
</body>
</html>