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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="../../layui/css/layui.css">
	<script src="../../layui/layui.js"></script>
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<script src="../../JSQ/index.js"></script>
	<title>学生整体管理</title>
</head>
<body>
	<?
	include"../../PHP/riqi.php";
	include"../../SQL/db/db.php";
	include"../../PHP/adminse.php";
	include("../adminse/admin_se.php");
	?>
	<div class="layui-container">
    	<div class="layui-row layui-col-space10 ">
        	<div class="layui-col-md8 layui-col-xs12 layui-col-md-offset2">
            	<blockquote class="layui-elem-quote">
                	<p>学生整体管理</p>
	                <p style="color:#FF5722;">对所有学生信息大面积修改</p>
	                <p style="color:#FF5722;">请确认信息后再操作</p>
					<a href="stu_whole.php?stu_whole_njjg=" class="layui-btn layui-btn-sm">在|离校修改</a>
					<a href="stu_whole.php?stu_whole_rejg=" class="layui-btn layui-btn-sm">在|离校统计</a>
            	</blockquote>
				
				<?
					if(isset($_GET['stu_whole_njjg']))
					{
				?>
					<form method="post" name="stu_whole_njjg" class="layui-form" action="">
						<div class="layui-form-item">
						    <label class="layui-form-label">年级</label>
						    <div class="layui-input-inline">
						      <select name="stu_whole_se" id="stu_whole_se"  lay-verify="required">
						      	<?
						      		for($tn=2010;$tn<=$rqY;$tn++)
						      		{
						      			$tnj=substr($tn,-2,2);
						      			$sql="select tjg,count(*) from sch_stub where tno like '".$tnj."%' or tno like '0".$tn."%' or tno like '".$tn."%' limit 1";
										$rs=mysql_query($sql,$con);
										if($row=mysql_fetch_row($rs))
										{
											$jg=$row[0];
											$cjg=$row[1]!=0?$row[1]:"暂无";
										}
										else
											$jg="暂无"
												
						      	?>
						        <option value="<?=$tn?>"><?=$tn?>级（<?=$jg.":".$cjg."人"?>）</option>
						        <?
						    			
						        	}
						        ?>
						      </select>
										
						    </div>
						    <div class="layui-input-inline">
						      <select name="stu_whole_jg" id="stu_whole_jg" lay-verify="required">
						      	
						        <option value="在校">在校</option>
						        <option value="离校">离校</option>

						      </select>
						    </div>
						    <div class="layui-input-inline">
						    	<button class="layui-btn" name="njjg_update" lay-submit lay-filter="form" onclick="return confirm('确定修改？');">修改</button>
						 	</div>
						 </div>


					</form>
					<?
						if(isset($_GET['stu_whole_jg']))
						{
					?>
						<script type="text/javascript">
							document.getElementById("stu_whole_jg").value = "<?=$_GET['stu_whole_jg']?>";
							document.getElementById("stu_whole_se").value = "<?=$_GET['stu_whole_se']?>";
						</script>
				<?
						}
					}
				?>
				<?
					if(isset($_GET['stu_whole_rejg']))
					{
						
						function cx($sql)
						{
							include"../../SQL/db/db.php";
							$rs=mysql_query($sql,$con);
							if($row1=mysql_fetch_row($rs))
								echo $row1[0];
							else
								echo "0";
						}
				?>
						<table class="layui-table">
				            <colgroup>
				              <col>
				              <col>
				              <col>
				              <col>
				            </colgroup>
				            <thead>
				              <tr>
				                <th>总人数</th>
				                <th>在校总人数</th>                
				                <th>在寝总人数</th>
				                <th>离校总人数</th>
				              </tr> 
				            </thead>
				            <tbody>
				              <tr >
				                <td><? cx("select count(tid) from sch_stub")?>人</td>
				                <td><? cx("select count(tid) from sch_stub where tjg='在校'")?>人</td>
				                <td><? cx("select count(tid) from sch_stub where tjg='在校' and tdorm>0")?>人</td>
				                <td><? cx("select count(tid) from sch_stub where tjg='离校'")?>人</td>
				              </tr>
				          </tbody>
			      		</table>
				<?
					}
				?>

            </div>
        </div>
    </div>

    <script>
		layui.use('form', function(){
		  var form = layui.form;
		});
	</script>

	<?
		if(isset($_POST['njjg_update']))
		{
			$tnj=substr($_POST['stu_whole_se'],-2,2);
			$sql="update sch_stub set tjg='".$_POST['stu_whole_jg']."' where tno like '".$tnj."%' or tno like '0".$_POST['stu_whole_se']."%' or tno like '".$_POST['stu_whole_se']."%'";
			$rs=mysql_query($sql,$con);
			if($rs>0)
			{
				?>
					<script>
			        	$(document).ready(function(e) {
						layui.use('layer', function(){
			  				var layer = layui.layer;
							parent.layer.msg('修改成功', {
							  title: false,
							  closeBtn: 0,
							  time:2000,
							  maxWidth:140,
							  anim: 6,
							  offset: '240px'
							});
							
						});
					});
					location.href="stu_whole.php?stu_whole_njjg=&stu_whole_jg=<?=$_POST['stu_whole_jg']?>&stu_whole_se=<?=$_POST['stu_whole_se']?>"
			        </script>
				<?
			}
			else
			{
				?>
					<script>
		        	$(document).ready(function(e) {
					layui.use('layer', function(){
		  				var layer = layui.layer;
						parent.layer.msg('修改失败', {
						  title: false,
						  closeBtn: 0,
						  time:2000,
						  maxWidth:140,
						  anim: 6,
						  offset: '240px'
						});
						
					});
				});
				location.href="stu_whole.php?stu_whole_njjg=&stu_whole_jg=<?=$_POST['stu_whole_jg']?>&stu_whole_se=<?=$_POST['stu_whole_se']?>"
		        </script>
				<?
			}
		}
	?>
</body>
</html>