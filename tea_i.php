<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
<link rel="stylesheet" href="layui/css/layui.css">
<script src="layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<!---->
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="favicon.ico" />
<!--JSQ-->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="JSQ/index.js"></script>

<link rel="stylesheet" type="text/css" href="css/tea_index.css" />
<!--CSS
以往版本的样式
<link media="(max-width:769px)" href="CSS/mobile-main.css" rel="stylesheet" type="text/css" />
<link media="(max-width:769px)" href="CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link media="(max-width:769px)" href="CSS/mobile-bt.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:769px)" href="CSS/z-index-bt.css" rel="stylesheet" type="text/css" />
<link media="(min-width:769px)" href="CSS/top-index.css" rel="stylesheet" type="text/css" />
<link media="(min-width:769px)" href="CSS/main-index.css" rel="stylesheet" type="text/css" />
-->

<title>老师你好</title>
<script>
layui.use('element', function(){
  var element = layui.element;
   
});	
layui.use('layer', function(){
  var layer = layui.layer;
  $(document).ready(function(e) {
	$(".DESS").click(function(e) {
    	layer.msg('测试中', {
    	time: 2000,
  		});
	});
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

//退出
$(document).ready(function(e) {
  $(".del_login").click(function(e) {
              layui.use('layer', function(){
                var layer = layui.layer;
                parent.layer.confirm('<center>确定退出？<br>下次将不会自动登陆</center>', {
                  btn: ['确定|·_·)','取消'],
                  title: false,
                  btnAlign: 'c',
                  closeBtn: 0,
                }, function(){
                  location.href="del_login.php";
                },function(){
                  
                    });
                  });
                });
              });
</script>
</head>

<body bgcolor="#F0F0F0">
<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="UI/logo/呕吐-1.png"></div>
  <?
  include"PHP/riqi.php";
  include"SQL/db/db.php";
  include"PHP/adminse.php";
  ?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <!--修改密码-->
        <?php
        $sql="select tid from sch_stub where tpass is null";
        $rs=mysql_query($sql,$con);
        if($row=mysql_fetch_row($rs))
        {
      ?><span class="layui-badge-dot "></span><?php }?>
        <!--报修查询-->
        <?
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
      ?><span class="layui-badge-dot "></span><? }?>
        <a href="javascript:;">
           <?=$_SESSION['txm'];?>
        </a>
        <dl class="layui-nav-child">
          <dd>
          <!--报修查询-->
          <?
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
          ?><span class="layui-badge-dot "></span><? }?>
            <a href="INDEX/gwbx/gwbxcx_index.php">报修查询</a>
          </dd>

          <dd>
          <!--修改密码-->
          <?php
            $sql="select tid from sch_stub where tpass is null";
            $rs=mysql_query($sql,$con);
            if($row=mysql_fetch_row($rs))
            {
          ?><span class="layui-badge-dot "></span><?php }?>
            <a class="updatepass" href="javascript:;">修改密码</a>
          </dd>

          <dd><a href="javascript:;" class="del_login">退出</a></dd>
        </dl>
      </li>
    </ul>
  </div>
</div><br><br>
<!--main-->

<div class="school_i">
  
<div class="layui-container">

<center>
  <!--菜单-->
<div class="layui-row layui-col-space30 layui-anim layui-anim-upbit">
      <div class="layui-col-md3 layui-col-xs6">
        <div class="layui-row grid-demo">
        <a href="INDEX/gwbx/alerts.php" class="grid-demo">
          <div class="layui-col-md4">
            <i class="layui-icon">&#xe631;</i><p>公物报修</p>
          </div>
        </a>
        </div>
      </div>
      
      <div class="layui-col-md3 layui-col-xs6">
        <div class="layui-row grid-demo">
        <a href="INDEX/comment/index.php" class="grid-demo">
          <div class="layui-col-md4">
            <i class="layui-icon">&#xe606;</i><p>评论专区</p>
          </div>
        </a>
        </div>
      </div>

      <div class="layui-col-md3 layui-col-xs6">
        <div class="layui-row grid-demo">
        <a href="javascript:;" class="grid-demo DESS">
          <div class="layui-col-md4">
            <i class="layui-icon">&#xe636;</i><p>宿舍水电</p>
          </div>
        </a>
        </div>
      </div>
      
      <div class="layui-col-md3 layui-col-xs6">
        <div class="layui-row grid-demo">
        <a href="javascript:;" class="grid-demo DE">
          <div class="layui-col-md4">
            <i class="layui-icon">&#xe705;</i><p>敬请期待</p>
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
										location.href="tea_i.php";
										});
									});
									
								});
							
	</script>
	<?
}
if($_SESSION['utype']=="学生")
{
	?>
    <script>
    location.href="stu_i.php";
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
