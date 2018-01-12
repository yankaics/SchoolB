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
<!--JSQ-->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../../JSQ/index.js"></script>
<title>注册维修员</title>
<script>
function check()
{
	cuname=form.username.value;
	cupass=form.userpass.value;
	cqupass=form.quserpass.value;
	cname=form.name.value;
	cuid=form.userid.value;
	if(cuname=="" || cupass=="" || cqupass=="" || cname=="" || cuid=="")
	{
		$(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('未填完', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:120,
				  anim: 6,
				  offset: '240px'
				});
				
			});
		});
		return false;
	}
	if(cupass!=cqupass)
	{
		$(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('两次密码不同', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:140,
				  anim: 6,
				  offset: '240px'
				});
				
			});
		});
		return false;
	}
	var patrn=/^\w{6,20}$/; //数字字母6-20位 符号：下划线 
	if(!patrn.exec(cqupass))
	{
		$(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('密码为6-20位<br>符号下划线', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:140,
				  anim: 6,
				  offset: '240px'
				});
				
			});
		});
		return false;
	}
	var pattern = new RegExp("[`~!@#$^&*()=|{}':;',\\[\\].<>/?~！@#￥……&*（）——|{}【】‘；：”“'。，、？]");//特殊字符判断
	if(pattern.test(cuname) || pattern.test(cname) || pattern.test(cuid))
	{
		$(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				layer.msg('不能有特殊字符', {
				  title: false,
				  closeBtn: 0,
				  time:2000,
				  maxWidth:140,
				  anim: 6,
				  offset: '240px'
				});
				
			});
		});
		return false;
	}
}
</script>
</head>

<body>
<?
include"../../PHP/riqi.php";
include"../../SQL/db/db.php";
include"../../PHP/adminse.php";
include("../adminse/admin_se.php");
?>
<!--导航
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
    	<a href="../../index.php"><div class="dh-index">首页</div></a>
        <a href="zhgl_index.php"><div class="dh-index">返回</div></a>
  </div>
</div>-->
<!--main-->
<div class="layui-container">
  <div class="layui-row">
  	 <div class="layui-col-md4 layui-col-md-offset4">
     	<blockquote class="layui-elem-quote">
       	  	<p>注册维修员账号</p>
            <p>管理员为维修员注册账号</p>
            <p>注册完毕后告知维修员并告知相关注意事项</p>
            <p style="color:#FF5722;">*账号和姓名注册后不能修改*</p>
        </blockquote>
     	<form class="layui-form layui-form-pane" name="form" onsubmit="return check()" method="post" action="">
          <div class="layui-form-item">
            <label class="layui-form-label">维修员账号</label>
            <div class="layui-input-block">
              <input type="text" id="username" name="username" required  lay-verify="required" placeholder="请输入维修员账号" autocomplete="off" class="layui-input">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
              <input type="password" name="userpass" required  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
              <input type="password" name="quserpass" required  lay-verify="required" placeholder="请确认密码" autocomplete="off" class="layui-input">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">姓名</label>
            <div class="layui-input-block">
              <input type="text" id="name" name="name" required  lay-verify="required" placeholder="请输入姓名" autocomplete="off" class="layui-input">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">电话</label>
            <div class="layui-input-block">
              <input type="text" name="userid" required  lay-verify="required" placeholder="请输入本人电话，方便进行通知" autocomplete="off" class="layui-input">
            </div>
          </div>
          
          <div class="layui-form-item">
    <div class="layui-input-block">
      <button name="button" class="layui-btn" lay-submit >立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
          
        </form>
     </div>
  </div>
</div> 
<script>
layui.use('form', function(){
var form = layui.form;
});
</script>




        <?
        if(isset($_POST['button']))
		{
			$sqlname="select s_username from sch_admin where s_username='".$_POST['username']."'";
			$rsname=mysql_query($sqlname,$con);
			if($row=mysql_fetch_row($rsname))
			
			{
				?>
                <script>
                	$(document).ready(function(e) {
					layui.use('layer', function(){
						var layer = layui.layer;
						layer.msg('账号已存在', {
						  title: false,
						  closeBtn: 0,
						  time:2000,
						  maxWidth:120,
						  anim: 6,
						  offset: '240px',
							});
						});
					});
					
                </script>
                <?
			}
			
			else
			{
				$sqlna="select s_name from sch_admin where s_name='".$_POST['name']."'";
			$rsna=mysql_query($sqlna,$con);
			if($rowna=mysql_fetch_row($rsna))
			
			{
				?>
                <script language="javascript">
                	$(document).ready(function(e) {
					layui.use('layer', function(){
						var layer = layui.layer;
						layer.msg('姓名已存在', {
						  title: false,
						  closeBtn: 0,
						  time:2000,
						  maxWidth:120,
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
			$sql="insert into sch_admin values('','".$_POST['username']."','".$_POST['userpass']."','".$_POST['name']."','".$_POST['userid']."','维修员','0','3')";
			$rs=mysql_query($sql,$con);
			if($rs>0)
			{
				?>
                <script>
					$(document).ready(function(e) {
						layui.use('layer', function(){
						var layer = layui.layer;
						layer.confirm('注册成功！<br>姓名：<?=$_POST['name']?><br>账号：<?=$_POST['username']?><br>密码：<?=$_POST['userpass']?><br>部门：<?=$_POST['userid']?>', {
						btn: ['确定'],
						title: false,
						btnAlign: 'c',
						closeBtn: 0
						},function(){
							location.href="wxinsert.php";
							});
						});			
					});
					
                </script>
                <?
			}
			}
			}
			
		}
		?>
		
</body>
</html>