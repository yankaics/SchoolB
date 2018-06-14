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
	<title>电费表备份</title>
</head>
<body>
<?php
  include("../../PHP/riqi.php");
  include("../../SQL/db/db.php");
  include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
?>

<!--main-->
<div class="layui-container">
 	<div class="layui-row">
		<div class="layui-col-md12">
		    <blockquote class="layui-elem-quote">
		    	<h3>电费表备份</h3>
		    	<p>防止数据丢失，需要备份时进行备份</p>
		    	<p align="center" style="margin:10px;"><a href="ele_BFcopy.php"><button class="startzz layui-btn layui-btn-lg layui-btn-radius layui-btn-danger">开始备份</button></a></p>
		    </blockquote>
		</div>
		<!--历史-->
		<div class="layui-row layui-col-space20" style="margin-top: 40px;">
      		<div class="layui-col-md6">
        		<blockquote class="layui-elem-quote">
        			<p>电费相关表备份记录（最近15份）</p>
        		</blockquote>
        		<table class="layui-table">
					<colgroup>
						<col>
						<col>
					</colgroup>
				  	<thead>
					    <tr>
					      <th>数据库</th>
					      <th>备份时间</th>
					    </tr> 
					</thead>
					<tbody>
					<?php
						$dir    = '../../SQL/ele_BFcopy';
						$files1 = scandir($dir);
						// print_r($files1);
						for($i=count($files1)-3;$i>=count($files1)-17;$i--)
						{

							$ttime=substr($files1[$i+2],0,14);//时间
							//表描述
							if(substr($files1[$i+2],24,2)=="r_")
							{
								$tname="电费数据总表";
							}
							else if(substr($files1[$i+2],24,2)=="v1")
							{
								$tname="电费流水记录表";
							}
							else if(substr($files1[$i+2],24,2)=="re")
							{
								$tname="流水轧账记录表";
							}
							else
							{
								$tname="空";
							}
					?>
					    <tr>
					      <td><?=$tname?></td>
					      <td><?=$ttime;?></td>
					    </tr>
					<?php
						}
					?>
					</tbody>
				</table>
					
        	</div>

        	<div class="layui-col-md6">
        		<blockquote class="layui-elem-quote">
        			<p>数据库整表备份记录（最近15份）</p>
        		</blockquote>
        		<table class="layui-table">
					<colgroup>
						<col>
						<col>
					</colgroup>
				  	<thead>
					    <tr>
					      <th>数据库</th>
					      <th>备份时间</th>
					    </tr> 
					</thead>
					<tbody>
					<?php
						$dir    = '../../SQL/SchoolB_BF';
						$files1 = scandir($dir);
						// print_r($files1);
						for($i=count($files1)-3;$i>=count($files1)-17;$i--)
						{

							$ttime=substr($files1[$i+2],0,14);//时间
							
					?>
					    <tr>
					      <td>校园宝整表</td>
					      <td><?=$ttime;?></td>
					    </tr>
					<?php
						}
					?>
					</tbody>
				</table>
        		
        	</div>

        </div>

 	</div>
</div>


<?php
//备份成功提示
if(isset($_GET['bfok']))
{
	?>
	<script type="text/javascript">
	  $(document).ready(function(e) {
	          layui.use('layer', function(){
	          var layer = layui.layer;
	        parent.layer.msg('备份成功', {
	        time: 2000,
	        area: ['240px','50px'],
	        });
	      });
	    });
	</script>
	<?
}
?>
<script type="text/javascript">
//防止页面后退
  history.pushState(null, null, document.URL);
  window.addEventListener('popstate', function () {
      history.pushState(null, null, document.URL);
  });
</script>
</body>
</html>