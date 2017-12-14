<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
<link rel="stylesheet" href="layui/css/layui.css">
<script src="layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<!---
<meta name="viewport" content="width=device-width,initial-scale=1.0" />--->
<link rel="shortcut icon" href="favicon.ico" />
<!---JSQ--->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="JSQ/index.js"></script>

<!---CSS以往版本的样式
<link media="(max-width:769px)" href="CSS/mobile-main.css" rel="stylesheet" type="text/css" />
<link media="(max-width:769px)" href="CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link media="(max-width:769px)" href="CSS/mobile-bt.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:769px)" href="CSS/z-index-bt.css" rel="stylesheet" type="text/css" />
<link media="(min-width:769px)" href="CSS/top-index.css" rel="stylesheet" type="text/css" />
<link media="(min-width:769px)" href="CSS/main-index.css" rel="stylesheet" type="text/css" />
--->


<script>
layui.use('element', function(){
  var element = layui.element;	
});

layui.use('layer', function(){
  var layer = layui.layer;
  $(document).ready(function(e) {
	$(".DE").click(function(e) {
    	layer.msg('(｡・`ω´･)', {
    	time: 2000,
  		});
	});
	//修改密码弹出
	$(".updatepass").click(function(e) {
        layer.open({
		  type: 2,
		  title: '修改密码',
		  shadeClose: true,
		  shade: 0.8,
		  shadeClose:true,
		  scrollbar:false,
		  area: ['320px', '320px'],
		  content: 'index/xgmm/updatepass.php' //iframe的url
		}); 
    });
});
});

</script>
<title>同学你好</title>
</head>

<body bgcolor="#F0F0F0">

<!------导航------>
<div class="layui-header header header-doc">
    <ul class="layui-nav layui-icon" lay-filter="">
        <div class="layui-container">  
        	<li class="layui-nav-item layui-icon" style="z-index:1;"><a href="index.php"><img class="layui-icon" src="UI/logo/呕吐-1.png"></a>
            <span class="layui-nav-bar" style=" display:none"></span>
            </li>
        </div> 
    </ul>
    <ul class="layui-nav layui-layout-right" style="text-align:center;">
    	<div class="layui-container ">
        	
            <li class="layui-nav-item "><a href="index.php">校园宝</a> </li>
     		
        </div>
    </ul>
</div><br><br>
<?
include"PHP/riqi.php";
include"SQL/db/db.php";
include"PHP/adminse.php";
?>
<!------main------>

<div class="school_i">

<div class="layui-container">

<center>
<div class="layui-row layui-col-space30 layui-anim layui-anim-upbit">
      <div class="layui-col-md3 layui-col-xs6">
        <div class="layui-row grid-demo">
        <a href="INDEX/gwbx/alerts.php" class="grid-demo1">
          <div class="layui-col-md4">
            <i class="layui-icon 1" style="font-size:64px;">&#xe631;</i><p>公物报修</p>
          </div>
        </a>
        </div>
       
      </div>
      
     <div class="layui-col-md3 layui-col-xs6">
        <div class="layui-row grid-demo">
        <a href="INDEX/gwbx/gwbxcx_index.php" class="grid-demo2">
          <div class="layui-col-md4">
            <i class="layui-icon 2" style="font-size:64px;">&#xe615;<?
			if($_SESSION['utype']=="教师")
			{
				$sql="select * from sch_repair_re where s_schid='".$_SESSION['user']."' and s_repair!='未分配' and s_jg!='已处理'";
			}
			else
			{
				$sql="select * from sch_repair_re where s_schid='".$_SESSION['txh']."' and s_repair!='未分配' and s_jg!='已处理'";
			}
			  $rs=mysql_query($sql,$con);
			  if($row=mysql_fetch_row($rs))
			  {
				 ?><span class="layui-badge-dot "></span><? }?></i><p>报修查询</p>
          </div>
        </a>
        </div>
      </div>
      
      <div class="layui-col-md3 layui-col-xs6">
        <div class="layui-row grid-demo">
        <a href="javascript:;" class="grid-demo3 updatepass">
          <div class="layui-col-md4">
            <i class="layui-icon 3" style="font-size:64px;">&#xe642;<?
            $sql="select * from sch_stub where tno='".$_SESSION['user']."'";
			$rs=mysql_query($sql,$con);
			if($row=mysql_fetch_row($rs))
			{
				if($row[9]=='')
				{
			?><span class="layui-badge-dot "></span><? }}?></i><p>修改密码</p>
          </div>
       	</a>
        </div>
      </div>
      
      <div class="layui-col-md3 layui-col-xs6">
        <div class="layui-row grid-demo">
        <a href="javascript:;" class="grid-demo4 DE">
          <div class="layui-col-md4">
            <i class="layui-icon 4" style="font-size:64px;">&#xe705;</i><p>敬请期待</p>
          </div>
        </a>
        </div>
      
      
      
    </div>
</div> 
<?
//报修成功
if(isset($_GET['iok']))
{
	?>
    <script>
	$(document).ready(function(e) {
								layui.use('layer', function(){
									var layer = layui.layer;
									parent.layer.confirm('<center>提交成功<br>【报修查询】查看报修</center>', {
									  btn: ['前往|·_·)','菜单'],
									  title: false,
									  btnAlign: 'c',
									  closeBtn: 0,
									}, function(){
										location.href="INDEX/gwbx/gwbxcx_index.php";
									},function(){
										location.href="stu_i.php";
										});
									});
									
								});
							
	</script>
	<?
}

if($_SESSION['utype']=="教师")
{
	?>
    <script>
    location.href="tea_i.php";
    </script>
    <?
}
?>
<script language="javascript">
        //防止页面后退
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>
</center>
</div>
</div>
</body>
</html>