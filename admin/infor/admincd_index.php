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
  <script src="../../JSQ/index.js"></script>
  <title>校园宝后台</title>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin ">
<?
include("admin_infor.php");
if($_SESSION['zw']=="维修员")
{
  $dz="../bxgl/wxrw.php";
}
else
{
  $dz="admin_index.php";
}
?>
<div class="layui-body main_admin">
    <!-- 内容主体区域 -->
    <div>
         <iframe src="<?=$dz?>" frameborder="0"  id="iframeid_admin" onload="Javascript:SetCwinHeight()" width="100%"></iframe>     
    </div>
  </div>
  <div class="layui-footer main_admin">
  <center>
    <!-- 底部固定区域 -->
    © 校园宝
  </center> 
  </div>
</div>

<script>
//JavaScript代码区域
layui.use('element', function(){
  var element = layui.element;
  
});


//iframe获取高度
 function SetCwinHeight(){
  var iframeid=document.getElementById("iframeid_admin"); //iframe id
  if (document.getElementById){
   if (iframeid && !window.opera){
    if (iframeid.contentDocument && iframeid.contentDocument.body.offsetHeight){
     iframeid.height = iframeid.contentDocument.body.offsetHeight+500;
    }else if(iframeid.Document && iframeid.Document.body.scrollHeight){
     iframeid.height = iframeid.Document.body.scrollHeight+500;
    }
   }
  }
 }

//左侧收缩
$(document).ready(function(e) {
setTimeout(function () {
    var a = $('.dynamic-navigation');   
	a && (a.attr("tg") ? (a.animate({
        left: -200,
        opacity: "show"
    }, 300), a.removeAttr("tg")) : (a.animate({
        left: -200,
        opacity: "show"
    }, 300), a.attr("tg", "1")))
},500);	
	
	//主体内容
	var a = $('.main_admin');
    a && (a.attr("tg") ? (a.animate({
        left: 0,
        opacity: "show"
    }, 0), a.removeAttr("tg")) : (a.animate({
        left: 0,
        opacity: "show"
    }, 0), a.attr("tg", "1")))
	
});

//点击获取id的src给iframe赋值进行跳转页面
$(document).ready(function(){
$(".ann").click(function(e) {
	var name=$(this).attr("id");
	$('#iframeid_admin').attr('src',name);
	//延时左侧收缩
	setTimeout(function () {
    var a = $('.dynamic-navigation');   
	a && (a.attr("tg") ? (a.animate({
        left: -200,
        opacity: "show"
    }, 300), a.removeAttr("tg")) : (a.animate({
        left: -200,
        opacity: "show"
    }, 300), a.attr("tg", "1")))
	},500);	
});

});
//子页面../bxgl/czxq.php页面底部返回
function ifsrc()
{
  $(document).ready(function(){
    $('#iframeid_admin').attr('src',"../bxgl/wxrw.php");
    //延时左侧收缩
    setTimeout(function () {
      var a = $('.dynamic-navigation');   
    a && (a.attr("tg") ? (a.animate({
          left: -200,
          opacity: "show"
      }, 300), a.removeAttr("tg")) : (a.animate({
          left: -200,
          opacity: "show"
      }, 300), a.attr("tg", "1")))
    },500); 
    //关闭所有弹出层
    layer.closeAll();
  });
}

//点击logo收缩
$('body').on('click', '.layui-logo', function(){
    var a = $('.dynamic-navigation');
    a && (a.attr("tg") ? (a.animate({
        left: 0,
        opacity: "show"
    }, 300), a.removeAttr("tg")) : (a.animate({
        left: -200,
        opacity: "show"
    }, 200), a.attr("tg", "1")))
});

</script>
</body>
</html>