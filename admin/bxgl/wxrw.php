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
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" href="../../layui/css/layui.css">
  <script src="../../layui/layui.js"></script>
  <link rel="shortcut icon" href="../../favicon.ico" />
  <!--JSQ-->
  <script src="../../JSQ/jquery-2.1.1.min.js"></script>
  <script src="../../JSQ/jquery.cookie.js"></script>
  <script src="../../JSQ/index.js"></script>
  <title>校园宝后台-维修员任务</title>
  <style>
  body{
  	font-weight:200;
  	font-family:"微软雅黑";
  }
  .af{
  	border-radius:5px;
  	-moz-box-shadow:0px 10px 40px rgba(102,102,102,0.8);
    -webkit-box-shadow:0px 10px 40px rgba(102,102,102,0.8);
    box-shadow:0px 10px 40px rgba(102,102,102,0.8);
  	background-color:#393D49;
  	color:#FFF;
  	font-size:16px;
    word-wrap: break-word; 
    word-break: normal; 
  }
  </style>
</head>

<body>
<?
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
?>
<!--导航
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
        <a href="../infor/admincd_index.php"><div class="dh-index">菜单</div></a>
        <a href="wxpfpj.php"><div class="dh-index">评分</div></a>
  </div>
</div>-->
<!--main-->
<blockquote class="layui-elem-quote">
	维修任务
	<p>&lt;操作&gt;里是该报修所有详情</p>
    <p>维修完成或不能完成的点击&lt;操作&gt;进行操作</p>
    <p id="test"></p>
    <p>
    	<form method="get">
        	<button name="all_a" class="layui-btn" type="submit">所有</button>
            <button name="wcl_a" class="layui-btn" type="submit">未处理</button>
            <button name="bncl_a" class="layui-btn" type="submit">不能处理</button>
        </form>
    </p>
</blockquote>
<?

$sqlle="select * from sch_repair_re where s_repair='".$_SESSION['name']."' and s_jg!='已处理'";
$rsle=mysql_query($sqlle,$con);
if($rowle=mysql_fetch_row($rsle))
{
	if(isset($_GET['wcl_a']))
	$sqll="select * from sch_repair_re where s_repair='".$_SESSION['name']."' and s_jg='未处理' order by s_settime asc";
	else if(isset($_GET['bncl_a']))
	$sqll="select * from sch_repair_re where s_repair='".$_SESSION['name']."' and s_jg='不能处理' order by s_settime asc";
	else
	$sqll="select * from sch_repair_re where s_repair='".$_SESSION['name']."' and s_jg!='已处理' order by s_settime asc";
	$rsl=mysql_query($sqll,$con);
	while($rowl=mysql_fetch_row($rsl))
	{
	
	?><br><br>
<div class="layui-container" >
  <div class="layui-row layui-col-space10" >
  	<div class="af layui-col-md4 layui-col-md-offset4 layui-anim layui-anim-fadein">
    	<div class="layui-row layui-col-space10">
          <div class="layui-col-md12 layui-col-xs12">
          	<p><?=$rowl[1].'-'.$rowl[2]?></p>    
          </div>
          <div class="layui-col-md12 layui-col-xs12">
            <p>姓名：<?=$rowl[3]?> | 电话：<?=$rowl[5]?></p>
          </div>
          <div class="layui-col-md12 layui-col-xs12">
            <?
                if($rowl[11]!='不能处理')
                {
                  echo "<span class='layui-badge'>".$rowl[11]."</span>";
                }
                else
                {
                  echo "<span class='layui-badge layui-bg-orange'>".$rowl[11]."</span>";
                }
              
            ?>
            <?=$rowl[10]?>
          </div>
          <div class="layui-col-md12 layui-col-xs12">
            
            <a href="czxq.php?id=<?=$rowl[0]?>"><button name="button" class="layui-btn layui-btn-sm " type="button">操作</button></a>
            <button name="button" class=" layui-btn-sm layui-btn zwj<?=$rowl[0]?>" type="button">物件详情</button>
            <script>
              layui.use('layer', function(){
               var layer = layui.layer;
              $(".zwj<?=$rowl[0]?>").click(function(e) {
                parent.layer.open({
                   title:'<?=$rowl[3]?>物件详情' ,
                   type: 1,
                   shadeClose: true,
                   area: ['200px'], //宽高
                   content: '<?
                    $sqlrea="select * from sch_repair_rea where s_repair='".$_SESSION['name']."' and s_jg!='已处理' and s_add='".$rowl[1]."' and s_name='".$rowl[3]."' and s_phone='".$rowl[5]."' and s_time='".$rowl[10]."'";
                  $rsrea=mysql_query($sqlrea,$con);
                  while($rowrea=mysql_fetch_row($rsrea))
                  {
                    ?><center style="padding:10px;"><p><?=$rowrea[1]?> <?=$rowrea[2]?>件</p></center><? 
                  } ?>'
                  });
                });
              });
            </script>
          
          </div>
        </div>
        
  	</div>
  </div>
</div><br><br>
	<?
	}
}
else
echo "<h2>暂无任务</h2>";
?>
<script>
//
layui.use('form', function(){
  var form = layui.form;
});

/*返回上次浏览位置*/
$(function () {
var str = window.location.href;
str = str.substring(str.lastIndexOf("/") + 1);
if ($.cookie(str)) {

$("html,body").animate({ scrollTop: $.cookie(str) }, 1000);
}
else {
}
})

$(window).scroll(function () {
var str = window.location.href;
str = str.substring(str.lastIndexOf("/") + 1);
var top = $(document).scrollTop();
$.cookie(str, top, { path: '/' });
return $.cookie(str);
})
/*返回上次浏览位置*/
</script>

</body>
</html>