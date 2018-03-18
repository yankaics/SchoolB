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
	<title>学生管理</title>
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
        	<div class="layui-col-md6 layui-col-xs12 layui-col-md-offset3">
            	<blockquote class="layui-elem-quote">
                	<p>学生管理</p>
	                <p style="color:#FF5722;">请填写相关信息进行查找学生</p>
	                <p style="color:#FF5722;">请确认信息后再修改学生信息</p>
					<form class="layui-form layui-form-pane" method="post" action="">
						<input name="cxok" type="hidden" value="" />
						<div class="layui-form-item">
						    <label class="layui-form-label">学号</label>
						    <div class="layui-input-block">
						      <input type="text" name="tstuid" required  lay-verify="required" placeholder="请输入学生学号" autocomplete="off" class="layui-input" value="<?=$_POST['tstuid']?>">
						    </div>
						  </div>

						<div class="layui-form-item">
						    <label class="layui-form-label">姓名</label>
						    <div class="layui-input-block">
						      <input type="text" name="tstuname" required  lay-verify="required" placeholder="请输入学生姓名" autocomplete="off" class="layui-input" value="<?=$_POST['tstuname']?>">
						    </div>
						  </div>

						<div class="layui-form-item">
						    <div class="layui-input-block">
						      <button class="layui-btn" lay-submit lay-filter="formDemo">查询</button>
						    </div>
						  </div>
	                </form>
            	</blockquote>
				<?
					if(isset($_POST['cxok']))
					{
						$tno=$_POST['tstuid'];
						$tname=$_POST['tstuname'];
						$sql="select * from sch_stub where tno='".$tno."' and tname='".$tname."'";
						$rs=mysql_query($sql,$con);
						if($row=mysql_fetch_row($rs))
						{
				?>
				<fieldset class="layui-elem-field layui-field-title">
				  <legend>可修改信息</legend>
				  <div class="layui-field-box">
	            	<form class="layui-form layui-form-pane" method="post" action="">
	            		<input name="updateok" type="hidden" value="" />
	            		<input name="txid" type="hidden" value="<?=$tno?>" />

					  <div class="layui-form-item">
					    <label class="layui-form-label">姓名</label>
					    <div class="layui-input-block">
					      <input type="text" name="txname" required  lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input" value="<?=$row[1]?>">
					    </div>
					  </div>

						<div class="layui-form-item">
						    <label class="layui-form-label">性别</label>
						    <div class="layui-input-block">
						    	<?
						    		if($row[2]=="女")
						    		{
						    	?>
							    <input type="radio" name="txsex" value="男" title="男">
							    <input type="radio" name="txsex" value="女" title="女" checked>
						      	<?
						      		}
						      		else
						      		{
						      	?>
							    <input type="radio" name="txsex" value="男" title="男" checked>
							    <input type="radio" name="txsex" value="女" title="女">
						      	<?
						      		}
						      	?>
						    </div>
						  </div>

					  <div class="layui-form-item">
					    <label class="layui-form-label">寝室</label>
					    <div class="layui-input-block">
					      <input type="text" name="txdorm" required  lay-verify="required" placeholder="请输入寝室" autocomplete="off" class="layui-input" value="<?=$row[8]?>">
					    </div>
					  </div>
					  
					  <div class="layui-form-item">
					    <label class="layui-form-label">专业班级</label>
					    <div class="layui-input-block">
					      <input type="text" name="txmajor" required  lay-verify="required" placeholder="请输入专业班级" autocomplete="off" class="layui-input" value="<?=$row[5]?>">
					    </div>
					  </div>

						<div class="layui-form-item">
						    <label class="layui-form-label">辅导员</label>
						    <div class="layui-input-block">
						      <input type="text" name="txtea" required  lay-verify="required" placeholder="请输入辅导员" autocomplete="off" class="layui-input" value="<?=$row[6]?>">
						    </div>
						  </div>

					  <div class="layui-form-item">
					    <div class="layui-input-block">
					      <button class="layui-btn" lay-submit lay-filter="formDemo" onclick="return confirm('确定修改？');">确认修改</button>
					    </div>
					  </div>

					</form>
					</div>
				</fieldset>
				<?
						}
						else
							echo "<p>未查找到改学生，请检查信息是否填写错误。</p>";
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
		if(isset($_POST['updateok']))
		{
			$sql="update sch_stub set tname='".$_POST['txname']."',tsex='".$_POST['txsex']."',tmajor='".$_POST['txmajor']."',tteacher='".$_POST['txtea']."',tdorm='".$_POST['txdorm']."' where tno='".$_POST['txid']."'";
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
				
		        </script>
				<?
			}
		}
	?>
</body>
</html>