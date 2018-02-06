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
<script src="../../JSQ/jquery-2.1.1.min.js"></script>
<script src="../../JSQ/index.js"></script>
<title>修改宿管员</title>
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
<!--main-->
<?

	$sqlname="select * from sch_admin where sid='".$_GET['nameid']."'";
	$rsname=mysql_query($sqlname,$con);
	if($row=mysql_fetch_row($rsname))	
	{
?>
<div class="layui-container">
  <div class="layui-row">
  	 <div class="layui-col-md4 layui-col-md-offset4">
     	<form class="layui-form layui-form-pane" name="form" onsubmit="return check()" method="post" action="">
        	<input name="sid" type="hidden" value="<?=$_GET['nameid']?>">
          <div class="layui-form-item">
            <label class="layui-form-label">账号(不改)</label>
            <div class="layui-input-block">
              <input name="username" type="text" required class="layui-input" id="username" placeholder="请输入维修员账号" autocomplete="off" value="<?=$row[1]?>" readonly="readonly"  lay-verify="required">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">姓名(不改)</label>
            <div class="layui-input-block">
              <input name="name" type="text" required class="layui-input" id="name" placeholder="请输入姓名" autocomplete="off" value="<?=$row[3]?>" readonly="readonly"  lay-verify="required">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
              <input type="password" name="userpass" required  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input" value="<?=$row[2]?>">
            </div>
          </div>
          
          <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
              <input type="password" name="quserpass" required  lay-verify="required" placeholder="请确认密码" autocomplete="off" class="layui-input" value="">
            </div>
          </div>

          <div class="layui-form-item">
		    <label class="layui-form-label">楼号</label>
		    <div class="layui-input-block">
		      <select name="lh" id="lh" lay-verify="required">
		        <option value="1">1号楼</option>
		        <option value="2">2号楼</option>
		        <option value="3">3号楼</option>
		        <option value="4">4号楼</option>
		        <option value="5">5号楼</option>
		      </select>
			      	<script>
					   document.getElementById("lh").value = "<?=$row[6]?>";
					</script>
		    </div>
		  </div>

          <div class="layui-form-item">
            <label class="layui-form-label">电话</label>
            <div class="layui-input-block">
              <input type="text" name="userid" required  lay-verify="required" placeholder="请输入本人电话" autocomplete="off" class="layui-input" value="<?=$row[4]?>">
            </div>
          </div>
          
          <div class="layui-form-item">
    <div class="layui-input-block">
      <button name="button" class="layui-btn" id="" lay-submit>修改</button>
    </div>
  </div>
          
        </form>
     </div>
  </div>
</div>
<?
	}
?>
<script>
layui.use('form', function(){
var form = layui.form;
});
</script>




        <?
        if(isset($_POST['button']))
		{
			
			
			
			$sql="update sch_admin set s_userpass='".$_POST['userpass']."',s_userid='".$_POST['userid']."',s_poi='".$_POST['lh']."' where sid='".$_POST['sid']."'";
			$rs=mysql_query($sql,$con);
			if($rs>0)
			{
				?>
                <script>
					$(document).ready(function(e) {
						layui.use('layer', function(){
						var layer = layui.layer;
						layer.confirm('修改成功！<br>姓名：<?=$_POST['name']?><br><?=$_POST['lh']?>号楼<br>账号：<?=$_POST['username']?><br>密码：<?=$_POST['userpass']?><br>电话：<?=$_POST['userid']?>', {
						btn: ['确定'],
						title: false,
						btnAlign: 'c',
						closeBtn: 0
						},function(){ 
							parent.$('#iframeid_admin').attr('src','../zhgl/sg_zhgl.php');
							parent.layer.closeAll();
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