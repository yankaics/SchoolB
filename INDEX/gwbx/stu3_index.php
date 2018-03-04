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
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!--以往的CSS
<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />-->
<style>
body{ background-color:#F0F0F0; padding-bottom:200px;};
a:link{text-decoration:none;}
a:visited{text-decoration:none;}
a:hover{text-decoration:none;}
a:active{text-decoration:none;}
</style>
<title>报修选择</title>

</head>

<body>
<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/logo-32-t.png"></div>
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

	<div class="layui-row">
  		<div class="layui-col-md6 layui-col-md-offset3 layui-col-xs-12">
    	<?
		if(isset($_POST['bxzdl']))
		{
			?>
            
              <div class="layui-field-box layui-anim layui-anim-upbit">
              	<blockquote class="layui-elem-quote">物件选择</blockquote>
              	<p>
                <!--上一步-->
                <form class="forms" name="stu3" action="stu2_index.php" method="post" role="form">
                	<input name="bxzdl" type="hidden" value="" />
                </form>
                
               	<form class="form-horizontal form3" name="stu3" action="stu4_index.php" method="post" role="form" onsubmit="return checknum()">
                        <!--!!!-->
                        <input name="taddr" type="hidden" value="<?=$_POST['taddr']?>" />
                        <input name="tadd" type="hidden" value="<?=$_POST['tadd']?>" />
                        <input name="bxzdl" type="hidden" value="" />
                        <input name="tname" type="hidden" value="<?=$_POST['tname']?>" />
                        <input name="tphone" type="hidden" value="<?=$_POST['tphone']?>" />
                        <input name="tzy" type="hidden" value="<?=$_POST['tzy']?>" />
                        <input name="ttea" type="hidden" value="<?=$_POST['ttea']?>" />
                        <?
                        if(isset($_POST['tea']))
                        {
                            ?>
                            <input name="tea" type="hidden" value="" />
                            <?
                        }
                        ?>
                        
                      <table  class="layui-table" lay-skin="line" align="center">
                            <thead align="center">
                              <tr align="center">
                                <td align="center">物件</td>
                                <td align="center">数量</td>
                                <td align="center">选择</td>
                              </tr>
                            </thead>
                            <tbody>
                            <?
                            $sqlres="select s_res from sch_repair_res where s_g='".$_POST['tadd']."'";
                            $rsres=mysql_query($sqlres,$con);
                            while($rowres=mysql_fetch_row($rsres))
                            {
                            ?>
                              <tr align="center">
                                <td align="center"><?=$rowres[0]?></td>
                                <td align="center">
                                  
                                    <span class="layui-btn layui-btn-sm jian"><a class="jian" style="color:#FFF;">-</a></span>
                                    <input name="nb[]" type="text" disabled="disabled" class="lskdo btn " style="width:40px;" value="0" size="1" />
                                  <span class="layui-btn layui-btn-sm jia"><a class="jia" style="color:#FFF;">+</a></span>
                                
                                
                                </td>
                                <td align="center"><input name="c[]" id="<?=$rowres[0]?>" class="choo" type="checkbox" value="<?=$rowres[0]?>"  style=" width:20px; height:20px;" ><label for="<?=$rowres[0]?>">选择</label></td>
                              </tr>
                            <?
                            }
                            ?>
                            </tbody>
                          </table>
                          
                    <center>
                      <!--<button onclick="return confirm('确定下一步？');" type="submit" class="layui-btn">下一步预览订单</button>-->
               	    </center>
                	</form>
                </p>
              </div>
              
              
<script>
	layui.use('form', function(){
  		var form = layui.form;
	});
$("#allc").change(function(){
	var innum=$(".choo").length;
	if($(this).prop("checked")){
		$(".choo").prop("checked",true);
		$("#in_num").text(innum);
		$(".lskdo").val(1);
		$("#sp_num").text(innum);
		$(".lskdo").prop("disabled",false);
	}
	else{
		$(".choo").prop("checked",false);
		$("#in_num").text(0);
		$(".lskdo").val(0);
		$("#sp_num").text(0);
		$(".lskdo").prop("disabled",true);
		}
	})
$(".choo").change(function(){
	var lskd=$(".choo:checked").length;
	$("#in_num").text(lskd);
	var lsoe=$(this).parent().parent().find(".lskdo");
	var ls=$(this).find(".tt");
	if($(this).prop("checked")){
		lsoe.prop("disabled",false);
		lsoe.val(1);
		$("#sp_num").text(parseInt($("#sp_num").text())+parseInt(lsoe.val()));
		//alert();
		}else{
			lsoe.prop("disabled",true);
			$("#sp_num").text(parseInt($("#sp_num").text())-parseInt(lsoe.val()));
			lsoe.val(0);
			}
	})

//$(".jian").each(function(){
    $(".jian").click(function(){
		var lskdpd=$(this).parent().parent().find(".choo");
		var lsoek=$(this).parent().find(".lskdo");
		var ls=$(this).parent().find(".tt");
		//alert(lsoek.val()>1);
		if(lskdpd.prop("checked")&&lsoek.val()>1){
			//alert("ccc");
			var lskoe=parseInt(lsoek.val());
			var eiow=parseInt($("#sp_num").text());
			//alert(eiow);
			lsoek.val(lskoe-1);
			$("#sp_num").text(eiow-1);
			}else{}
		})
//	})
//$(".jia").each(function(){
    $(".jia").click(function(iiii){
		var lskdpd=$(this).parent().parent().find(".choo");
		var lsoek=$(this).parent().find(".lskdo");
		var ls=$(this).parent().find(".tt");
		//alert(lsoek.val()>1);
		if(lskdpd.prop("checked")){
			//alert("ccc");
			var lskoe=parseInt(lsoek.val());
			var eiow=parseInt($("#sp_num").text());
			lsoek.val(lskoe+1);
			$("#sp_num").text(eiow+1);
			//return $("#sp_num").text();
			}else{}
		})
//	})
$(".lskdo").on('input propertychange',function(){
	          var deox=$(this).val();
			  if(isNaN(deox)){
				  alert("请输入您想报修的数量!");
				  $(this).val(1);
				  }
	          var loel=0;
			  for(i=0;i<$(".lskdo").length;i++){
			  //alert($(".lskdo").eq(i).val());
			  loel=parseInt(loel)+parseInt($(".lskdo").eq(i).val());
			  }
			  //alert(loel);
			  $("#sp_num").text(loel);
			})
</script>
<script>
							//底部弹出
                        	$(document).ready(function(e) {
								layui.use('layer', function(){
								var layer = layui.layer;
								layer.msg('<button onclick="opens()" type="submit" class="layui-btn">上一步</button><button onclick="openf()" type="submit" class="layui-btn">下一步预览订单</button>', {
								title: false,
								closeBtn: 0,
								time:0,
								anim: 2,
								shadeClose :false,
								offset: 'b',
								area: ['100%', '60px']	
									});	
								});
								
							});
							//表单提交
							function openf(){
								 $(".form3").submit();
							}
							//上一步
							function opens(){
								 $(".forms").submit()
							}
//物件选择
function checknum()
	{
		
		if(!$('.choo').is(':checked'))
		 {
    			$(document).ready(function(e) {
					layui.use('layer', function(){
					var layer = layui.layer;
					layer.msg('请选择物件', {
					title: false,
					closeBtn: 0,
					time:2000,
						
						});
					});
				});
				
				//延迟弹出
				setTimeout(function(){ 
				$(document).ready(function(e) {
								layui.use('layer', function(){
								var layer = layui.layer;
								layer.msg('<button onclick="opens()" type="submit" class="layui-btn">上一步</button><button onclick="openf()" type="submit" class="layui-btn">下一步预览订单</button>', {
								title: false,
								closeBtn: 0,
								time:0,
								anim: 2,
								shadeClose :false,
								offset: 'b',
								area: ['100%', '60px']	
									});	
								});
								
							});
				
				 }, 2000);
				return false;
		}
	}
							
</script>
          	<?
		}
		else
		{
			?>
            <script>
			location.href="alerts.php?z=1";
            </script>
            <?
		}
		?>
		</div>
	</div>
<script language="javascript">
        //防止页面后退
        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });
    </script>

</body>
</html>