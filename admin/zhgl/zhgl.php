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
<title>账号管理</title>
<style>
body{
	font-weight:600;
	font-family:"宋体";
}
.af{
	border-radius:5px;
	-moz-box-shadow:0px 3px 20px  #DEDEDE; 
	-webkit-box-shadow:0px 3px 20px  #DEDEDE; 
	box-shadow:0px 3px 20px  #DEDEDE;
	background-color:#393D49;
	color:#FFF;
	font-size:16px;
}
</style>
</head>

<body id=body onscroll=SetCookie("scroll",document.body.scrollTop); onload="scrollback();">

<!--导航
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
    	<a href="../../index.php"><div class="dh-index">首页</div></a>
        <a href="zhgl_index.php"><div class="dh-index">返回</div></a>
  </div>
</div>-->
<!--main-->

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
                <p>维修员管理</p>
                <p style="color:#FF5722;">离职：先确认该维修员没有维修任务后再标记为离职</p>
                <p style="color:#FF5722;">标记为离职的维修员不能登录</p>
                <p>
                <?
                if(isset($_GET['p']))
				{
					?>
               	 	<a href="zhgl.php?n=维修员" class="layui-btn layui-btn-sm">查看在职</a>
                	<?
				}
				else
				{
					?>
                    <a href="zhgl.php?n=维修员&p=0" class="layui-btn layui-btn-sm">查看离职</a>
                    <?
				}
				?>
                </p>
            </blockquote>
            </div>
            </div>
            </div>
<?
//在职 离职更改
if(isset($_GET['zw_zhgl_0']))
{
	$sqlzw="update sch_admin set s_g=3 where sid='".$_GET['sid']."'";
	$rszw=mysql_query($sqlzw,$con);
	if($rszw>0)
	{
		?>
        <script>
        	$(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				parent.layer.msg('更改为在职', {
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
				parent.layer.msg('更改失败', {
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
if(isset($_GET['zw_zhgl_3']))
{
	$sqlzw="update sch_admin set s_g=0 where sid='".$_GET['sid']."'";
	$rszw=mysql_query($sqlzw,$con);
	if($rszw>0)
	{
		?>
        <script>
        	$(document).ready(function(e) {
			layui.use('layer', function(){
  				var layer = layui.layer;
				parent.layer.msg('更改为离职', {
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
				parent.layer.msg('更改失败', {
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

if(isset($_GET['p']))
$sqll="select * from sch_admin where s_position='".$_GET['n']."' and s_g=0";
else
$sqll="select * from sch_admin where s_position='".$_GET['n']."' and s_g!=0";
$rsl=mysql_query($sqll,$con);
while($rowl=mysql_fetch_row($rsl))
{
	//维修员
	if($_GET['n']=='维修员')
	{
?>
		<br><br>
        <div class="layui-container">
          <div class="layui-row layui-col-space10">
          	<div class="af layui-col-md4 layui-col-md-offset4">
            	<div class="layui-row layui-col-space10">
                    <div class="layui-col-md12 layui-col-xs12">
                        <span style="font-size:20px; color:#FF5722;"><?=$rowl[3]?></span>
                        <? 
						$sqlrc="select count(sid) from sch_repair_re where s_repair='".$rowl[3]."' and s_jg='已处理'";
						
						$rsrc=mysql_query($sqlrc,$con);
						if($rowrc=mysql_fetch_row($rsrc))
						{
							$sqlrc="select count(sid) from sch_repair_re where s_repair='".$rowl[3]."' and s_jg='未处理'";
						
							$rsrc=mysql_query($sqlrc,$con);
							if($rowrc1=mysql_fetch_row($rsrc))
							{
							$sqlrc="select count(sid) from sch_repair_re where s_repair='".$rowl[3]."' and s_jg='不能处理'";
						
							$rsrc=mysql_query($sqlrc,$con);
							if($rowrc2=mysql_fetch_row($rsrc))
							{
						?>
                        <p><span class="layui-badge layui-bg-gray">已处理<?=$rowrc[0]?></span> <span class="layui-badge layui-bg-gray">未处理<?=$rowrc1[0]?></span> <span class="layui-badge layui-bg-gray">不能处理<?=$rowrc2[0]?></span></p>
                        <?
							}
							}
						}
						?>
                    </div>
                    <div class="layui-col-md12 layui-col-xs12">
                    	电话：<?=$rowl[4]?><br>职位：<?=$rowl[5]?>
                    </div>
                    <div class="layui-col-md12 layui-col-xs12">
                    	账号：<?=$rowl[1]?><br>密码：<?=$rowl[2]?>
                    </div>
                    <div class="layui-col-md12 layui-col-xs12">
                    	<p><a href="zhglwx_re.php?nid=<?=$rowl[3]?>" class="layui-btn layui-btn-sm">查看</a><a href="javascript:;" class="layui-btn layui-btn-sm xg_zhgl" id="<?=$rowl[0]?>">修改</a>
                   	  <span class="layui-form zw_zhgl" action="">
                            <?
                            $sqlsg="select s_g from sch_admin where sid='".$rowl[0]."'";
							$rssg=mysql_query($sqlsg,$con);
							if($rowsg=mysql_fetch_row($rssg))
							{
								if($rowsg[0]!=0)
								{
								?>
                            	<input type="checkbox" checked="" id="<?=$rowl[0]?>" name="open" lay-skin="switch" lay-filter="switchTest" lay-text="在|离">
                            	<?
								}
								else
								{
								?>
                                <input type="checkbox" id="<?=$rowl[0]?>" name="open" lay-skin="switch" lay-filter="switchTest" lay-text="在|离">
                                <?
								}
							}
							?>
                        </span>
                    </div>
 					
            	</div>
          	</div>
          </div>
        </div>
        <br><br>
         
               
<?
	}
	
}

?>

<script>
layui.use('form', function(){
  var form = layui.form;
   //执行离职或者在职
	form.on('switch(switchTest)', function(data){
		var sid0=$(this).attr("id");
		if(this.checked)
		{
			parent.$('#iframeid_admin').attr('src','../zhgl/zhgl.php?n=维修员&zw_zhgl_0=0&sid='+sid0+'');
		}
		else
		{
			parent.$('#iframeid_admin').attr('src','../zhgl/zhgl.php?n=维修员&zw_zhgl_3=3&sid='+sid0+'');
		}
    
  });
});
layui.use('layer', function(){
	  var layer = layui.layer;
		//修改弹出
		
		$(".xg_zhgl").click(function(e) {
			var name=$(this).attr("id");
			  parent.layer.open({
			  type: 2,
			  title: '修改资料',
			  shadeClose: true,
			  shade: 0.8,
			  shadeClose:true,
			  scrollbar:false,
			  area: ['320px', '400px'],
			  content: '../zhgl/update_zhgl.php?zw=维修员&nameid='+name //iframe的url
			}); 
		});
	});
	
</script>
</body>
</html>