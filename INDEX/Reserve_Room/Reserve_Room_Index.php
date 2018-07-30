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
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<link rel="stylesheet" href="../../layui/css/layui.css">
	<script src="../../layui/layui.js"></script>
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="../../bootstrap/js/bootstrap.min.js"></script>
	<title>住房预定</title>
	<style type="text/css">
		body{
			
			padding-bottom:200px;
		}
		a:link{text-decoration:none;}
		a:visited{text-decoration:none;}
		a:hover{text-decoration:none;}
		a:active{text-decoration:none;}
		.form-horizontal{
			margin-top: 10px;
		}
	</style>
</head>
<body>
<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/logo-32-t.png"></div>
	<?
		include"../../PHP/riqi.php";
		include"../../SQL/db/db.php";
		include"../../PHP/adminse.php";
		include"class/Reserve_Room_class.php"; //住房预定类
		$res_room=new Reserve_Room_class($con);
		
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
		<div class="layui-col-md4 layui-col-md-offset4 layui-col-xs12">
			<blockquote class="layui-elem-quote">华岩校区6号楼预定</blockquote>
			<div class="layui-col-md12 layui-col-xs12">
				<form class="form-horizontal layui-form-pane reserve_room_form" method="post" name="reserve_room_form" action="" onsubmit="return reserve_room()">
					<div class="layui-form-item">
						<label class="layui-form-label">联系电话</label>
						<div class="layui-input-block">
						  <input type="text" name="tphone" required  lay-verify="required" placeholder="联系电话" autocomplete="off" class="layui-input" value="<?=$res_room->Room_phone($_SESSION['txh'])?>">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">入住时间</label>
						<div class="layui-input-block">
						  <input type="text" readonly="readonly" name="starttime" id="starttime" required  lay-verify="required" placeholder="入住时间" autocomplete="off" class="layui-input starttime">
						</div>
					</div>
					<div class="layui-form-item">
						<label class="layui-form-label">退房时间</label>
						<div class="layui-input-block">
						  <input type="text" readonly="readonly" name="endtime" id="endtime" required  lay-verify="required" placeholder="退房时间" autocomplete="off" class="layui-input endtime">
						</div>
					</div>
					<table  class="layui-table" lay-skin="line" align="center">
                        <thead align="center">
                          <tr align="center">
                            <td align="center">性别</td>
                            <td align="center">人数</td>
                            <td align="center">选择</td>
                          </tr>
                        </thead>
                        <tbody>
							<tr align="center">
								<td align="center">男</td>
								<td align="center">
								  
								    <span class="layui-btn layui-btn-sm jian"><a class="jian" style="color:#FFF;">-</a></span>
								    <input name="tnan" type="text" disabled="disabled" class="lskdo btn " style="width:38px;" value="0" size="1" />
								  	<span class="layui-btn layui-btn-sm jia"><a class="jia" style="color:#FFF;">+</a></span>


								</td>
								<td align="center"><input name="rnan" id="rnan" class="choo" type="checkbox" value="rnan"  style=" width:20px; height:20px;" ><label for="rnan"></label></td>
							</tr>
							<tr align="center">
								<td align="center">女</td>
								<td align="center">
								  
								    <span class="layui-btn layui-btn-sm jian"><a class="jian" style="color:#FFF;">-</a></span>
								    <input name="tnv" type="text" disabled="disabled" class="lskdo btn " style="width:38px;" value="0" size="1" />
								  	<span class="layui-btn layui-btn-sm jia"><a class="jia" style="color:#FFF;">+</a></span>


								</td>
								<td align="center"><input name="rnv" id="rnv" class="choo" type="checkbox" value="rnv"  style=" width:20px; height:20px;" ><label for="rnv"></label></td>
							</tr>

                        </tbody>
                    </table>
					


				</form>


			</div>
		</div>
	</div>
</div>


<?php 
	//提交
	if(isset($_POST["starttime"]))
	{	
		$tuser=$_SESSION['txh'];								//账号
		$tphone=$_POST["tphone"];								//电话
		$tnan=$_POST["tnan"]==null?"0":$_POST["tnan"];			//男生人数
		$tnv=$_POST["tnv"]==null?"0":$_POST["tnv"];				//女生人数
		$starttime=$_POST["starttime"];							//入住时间
		$endtime=$_POST["endtime"];								//退房时间
		$nowtime=$rqY.'-'.$rqmm.'-'.$rqd;						//申请时间
		//新增
		$jg=$res_room->Room_insert($tuser,$tphone,$tnan,$tnv,$nowtime,$starttime,$endtime);
		$jgQ=substr($jg,1,strpos($jg, '_'));
		if($jg=="ok")
		{
			?>
			<script type="text/javascript">
				location.href="../../tea_i.php?reserve_room=ok";
			</script>
			<?
			
		}
		else if($jgQ=="#0")
		{
			?>
			<script type="text/javascript">
				location.href="../../tea_i.php?reserve_room=#0";
			</script>
			<?
			
		}
		else if($jgQ=="#1")
		{
			?>
			<script type="text/javascript">
				location.href="../../tea_i.php?reserve_room=#1";
			</script>
			<?
		}
		else
		{
			?>
			<script type="text/javascript">
				location.href="../../tea_i.php?reserve_room=#1";
			</script>
			<?
		}
	}
?>






<script>
layui.use('form', function(){
  var form = layui.form;

});
//时间
function p(s) {
    return s < 10 ? '0' + s: s;
}
//当前年月日
function nowdate(AddDayCount) { 
	var dd = new Date(); 
	dd.setDate(dd.getDate()+AddDayCount);//获取AddDayCount天后的日期 
	var y = dd.getFullYear(); 
	var m = dd.getMonth()+1;//获取当前月份的日期 
	var d = dd.getDate(); 
	return y+"-"+p(m)+"-"+p(d);
}
layui.use('laydate', function(){
	var laydate = layui.laydate;

	var AnowDate=nowdate(1);//入住时间
	var BnowDate=nowdate(2);//退房时间
	//date
	var start =laydate.render({
		elem: '#starttime'
		,showBottom: false
		,theme: '#393D49'
		,value: AnowDate
		,calendar: true
		,min:AnowDate
		,done: function(value, date, endDate) {
                end.config.min = {
                    year: date.year,
                    month: date.month - 1,
                    date: date.date,
                    hours: date.hours,
					minutes: date.minutes,
					seconds: date.seconds
                }
                if($("#endtime").val()<=value)
                {
                	$("#endtime").val(value);
                }
                

            }
	});
	//date
	var end=laydate.render({
		elem: '#endtime'
		,showBottom: false
		,theme: '#393D49'
		,value: BnowDate
		,calendar: true
		,min: BnowDate
	});
});


//选择
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
			  if(isNaN(deox) || deox=="0"){
				  alert("请输入人数!");
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

//底部弹出
function tc(){
	$(document).ready(function(e) {
		layui.use('layer', function(){
		var layer = layui.layer;
		layer.msg('<button onclick="opens()" type="submit" class="layui-btn">确认预定</button>', {
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
}
tc();
//提交
function opens(){
	$(document).ready(function(e) {
		layui.use('layer', function(){
			var layer = layui.layer;
			parent.layer.confirm('确定预定？', {
			  btn: ['确定','取消'],
			  title: false,
			  closeBtn: 0,
			}, function(){
				layer.msg('正在提交...', {
			      time: 10000,
			    });
				$(".reserve_room_form").submit();
				
			},function(){
				tc();
			});
		
		});
	});
	
}
//判断
function reserve_room(){
	var yz=/^(\d{11}|\d{11})$/;
	var tphone=reserve_room_form.tphone.value; //电话

	if(!yz.exec(tphone))
	{
		ftc("电话不正确");
		return false;
	}
	else if(!$('.choo').is(':checked'))
	{
		ftc("请选择人员数量");
		return false;
	}
}

//弹窗提示
function ftc(nr){
	$(document).ready(function(e) {
		layui.use('layer', function(){
		var layer = layui.layer;
		layer.msg(nr, {
		title: false,
		closeBtn: 0,
		time:2000,
			
			});
		});
	});
	
	//延迟弹出
	setTimeout(function(){ tc(); }, 2000);
	
}


</script>
	
</body>
</html>