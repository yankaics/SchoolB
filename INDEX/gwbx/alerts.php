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

<!---以往的CSS
<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
-->
<title>报修须知</title>
</head>

<body  bgcolor="#F0F0F0">

<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/呕吐-1.png"></div>
	<?
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
	?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item ">
		  <?
          if($_SESSION['utype']=="教师")
          {
          ?>
          <a href="../../tea_i.php">
          <div class="xz-index">菜单</div></a>
          <?
          }
          else
          {
          ?>
          <a href="../../stu_i.php">
          <div class="xz-index">菜单</div></a>
          <?
          }
          ?>
      </li>
    </ul>
  </div>
</div>

<!--main-->
<div class="layui-container">
  <div class="layui-row">
  	<div class="layui-col-md4 layui-col-md-offset4">
    	<fieldset class="layui-elem-field">
          <legend style="font-size:32px;">报修须知</legend><br>
          <div class="layui-field-box layui-anim layui-anim-upbit">
            <p>可选：拍好你需要维修的照片。</p><br>
            <p>报修请严格按照提示进行填写！</p><br>
            <p>不可乱填，不可用别人的信息！</p><br>
            <p>发现违规行为，将会进行处罚！</p><br>
            <p>点击&lt;知道了&gt;开始填写( • ̀ω•́ )✧</p><br>
            <p>
                <form name="qrf" method="post" action="stu2_index.php">
                <?
                if($_SESSION['utype']=="教师")
                {
                    ?>
                    <input name="tea" type="hidden" value="" />
                    <?
                }
                ?>
                <button type="submit" name="bxzdl" class="layui-btn layui-btn-danger">知道了</button>
                </form>
             </p>
          </div>
        </fieldset>
  	</div>
  </div>
</div> 
<?
if(isset($_GET['z']))
{
?> 
<script>
$(document).ready(function(e) {
	layui.use('layer', function(){
  	var layer = layui.layer;
	layer.msg('你未查看报修须知', {
	title: false,
	closeBtn: 0,
					
		});
	});
});
</script>
<? }?>

<script>
layui.use('element', function(){
  var element = layui.element;	
});
</script>
</body>
</html>