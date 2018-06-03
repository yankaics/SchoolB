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
	<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
	<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
	<script src="../../bootstrap/js/bootstrap.min.js"></script>
	<title>报修分配</title>
	<!-- <link media="(max-width:650px)" href="../../CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
	<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
	<link media="(min-width:500px)" href="../../CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
	<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" /> -->
	<style type="text/css">
	a:link {
		text-decoration: none;
	}
	a:visited {
		text-decoration: none;
	}
	a:hover {
		text-decoration: underline;
	}
	a:active {
		text-decoration: none;
	}
	body{ 
		
		margin:10px;
	}
	</style>
	<script type="text/javascript">
		function Trim(strValue) 
		{ 
			//return strValue.replace(/^s*|s*$/g,""); 
			return strValue;  
		}

		function SetCookie(sName,sValue) 
		{ 
			document.cookie = sName + "=" + escape(sValue); 
		} 

		function GetCookie(sName) 
		{ 
			var aCookie = document.cookie.split(";"); 
			for(var　i=0;　i　< aCookie.length;　i++) 
			{ 
				var aCrumb = aCookie[i].split("="); 
				if(sName　== Trim(aCrumb[0])) 
				{ 
					return unescape(aCrumb[1]); 
				} 
			} 

		　　return null; 
		} 

		function scrollback() 
		{ 
			if(GetCookie("scroll")!=null){document.body.scrollTop=GetCookie("scroll")} 
		} 

		function checkfp()
		{
			if(!$(".choo").is(":checked"))
			{
				layui.use('layer', function(){
				  var layer = layui.layer;
				  parent.layer.msg('请勾选需要分配的任务');
				});
				return false;
			}		
		}
	</script>
</head>

<body>
<!--导航
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
    	<a href="../../index.php"><div class="dh-index">首页</div></a>
        <a href="bxgl_index.php"><div class="dh-index">返回</div></a>
  </div>
</div>-->
<!--main-->
<?php
	include("../../PHP/riqi.php");
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
	include("../adminse/admin_se.php");
	include("address.php");//地点

	$sqlall="select count(sid) from sch_repair_re where s_jg='未处理' and s_repair='未分配'";
	$rsall=mysql_query($sqlall,$con);
	if($rowall=mysql_fetch_row($rsall))
		$numall=$rowall[0];

	for($i=0;$i<count($arrayall);$i++)
	{
		$sql="select count(sid) from sch_repair_re where s_add='".$arrayall[$i]."' and s_jg='未处理' and s_repair='未分配'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
			$arraycount[$i]=$row[0];//计数
	}

?>
<div class="ly">
	<blockquote class="layui-elem-quote">
		<h3>报修分配</h3>
		<p>对未分配报修进行分配</p>
		<!--地点选择-->
	    <form class="" action="" method="get" role="form">
	    	<div class="table-responsive">
	    		<table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
	    			<tr>
	    				<td>
				      		<button type="submit" name="all" class="layui-btn layui-btn-sm layui-btn-normal">所有<span class="layui-badge"><?=$numall?></span></button>
				      	<?php
				      		for($i=0;$i<count($arrayall);$i++)
							{
				      	?>
				          	<button type="submit" name="<?=$arrayalldm[$i]?>" class="layui-btn layui-btn-sm"><?=$arrayall[$i]?><span class="layui-badge"><?=$arraycount[$i]?></span></button>
				        <?php
				        	}
				        ?>
				    	</td>
			    	</tr>
	    		</table>
	      	</div>
	    </form>
	</blockquote>
	<!--维修员分配-->
	<form name="wxyfp" id="wxyfp" action="" method="get" onsubmit="return checkfp()">
		<blockquote class="layui-elem-quote">
			<div class="layui-form layui-form-pane">

		    	<div class="layui-form-item">
				    <label class="layui-form-label">维修员</label>
				    <div class="layui-input-inline">
				      	<select name="wxy" class="" id="tt2">
							<?php
								$sqlwx="select * from sch_admin where s_position='维修员' and s_g!=0";
								$rswx=mysql_query($sqlwx,$con);
								while($rowwx=mysql_fetch_row($rswx))
								{
							?>
								<option value="<?=$rowwx[3]?>"><?=$rowwx[3]?></option>
							<?php
								}
							?>
				        </select>
				    </div>
				    <button name="buttonfp" id="buttonfp" type="button" class="layui-btn layui-form-mid" style="width: 80px;">分配</button>
				</div>
			</div>
		</blockquote>
	



	    <div class="table-responsive">
	      	<table width="100%" class="layui-table table" lay-even>
	      		<colgroup>
					<col width="100">
					<col width="100">
					<col width="100">
					<col width="300">
					<col width="80">
					<col width="100">
					<col width="200">
					<col width="160">
					
				</colgroup>
	      		<thead>
			  		<tr>
					    <td align="center" class="">
					    	<input name="allc" id="allc" class="allc" type="checkbox" value="allc"  style=" width:20px;" ><label for="allc">全选</label>&nbsp;·&nbsp;删除
					    </td>
					    <td align="center" class="">损坏描述</td>
					    <td align="center" class="">物件详情</td>
					    <td align="center" class="">地点</td>
					    <td align="center" class="">姓名</td>
					    <td align="center" class="">电话</td>
					    <td align="center" class="">专业或部门</td>
					    <td align="center" class="">报修时间 </td>
					    
					</tr>
				</thead>
				<tbody>
					<?php
						if(isset($_GET['all']))
						{
							$sqlre="select * from sch_repair_re where s_jg='未处理' and s_repair='未分配' order by s_settime asc";
							$b='all=';
						}
						else
						{
							$sqlre="select * from sch_repair_re where s_repair='未分配' and s_jg='未处理' order by s_settime asc";
						}

						for($i=0;$i<count($arrayall);$i++)
						{
							if(isset($_GET[$arrayalldm[$i]]))
							{
								$sqlre="select * from sch_repair_re where s_add='".$arrayall[$i]."' and s_jg='未处理' and s_repair='未分配' order by s_settime asc";
								$b=$arrayalldm[$i];
							}
						}
						$rsre=mysql_query($sqlre,$con);
						while($rowre=mysql_fetch_row($rsre))
						{
					?>
				  	<tr>
					    <td align="center">
					    	<input name="c[]" id="<?=$rowre[0]?>" class="choo" type="checkbox" value="<?=$rowre[0]?>"  style=" width:20px;" ><label for="<?=$rowre[0]?>">选择</label>
					    	<input name="tb" type="hidden" value="<?=$b?>" />
					   
							

							<span>&nbsp;<a href="delete_adminly.php?tname=<?=$rowre[3]?>&tphone=<?=$rowre[5]?>&tadd=<?=$rowre[1]?>&ttime=<?=$rowre[10]?>&b=<?=$b?>"><button onclick="return confirm('确定删除？');" type="button" class="layui-btn layui-btn-xs layui-btn-danger">删除</button></a></span>
						</td>
						<td align="center"><button type="button" onclick="consay('<?=$rowre[14]?>');" name="shms" class="layui-btn">损坏描述</button></td>
					    
					    <td align="center">
							    <button type="button" onclick="consay('<? 
			    $sqlrea="select * from sch_repair_rea where s_time='".$rowre[10]."' and s_name='".$rowre[3]."' and s_phone='".$rowre[5]."' and s_add='".$rowre[1]."'";
				$rsrea=mysql_query($sqlrea,$con);
				while($rowrea=mysql_fetch_row($rsrea))
				{
					echo "（".$rowrea[1];
					echo " - 数量：".$rowrea[2]."）<br>";
				}
				?>');" name="wjxq" class="layui-btn">物件详情</button>
					    </td>
					    <td align="center"><?=$rowre[1].$rowre[2]?></td>
					    <td align="center"><?=$rowre[3]?></td>
					    <td align="center"><?=$rowre[5]?></td>
					    <td align="center"><?=$rowre[4]?></td>
					    <td align="center"><?=$rowre[10]?></td>
					    
				    <?php
						}
					?>
					    
				  	</tr>
				</tbody>
			</table>
		</div>
	</form><!--form name="wxyfp"-->

</div>

	<script type="text/javascript">
		//多选
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
		
	</script>
	<!--分配-->
	<?php
		if(isset($_GET['wxy']))
		{	
			$nc=$_GET['c'];
			$n=count($_GET['c']);
			$tb=$_GET['tb'];
			$wxy=$_GET['wxy'];
			for($i=0;$i<=$n-1;$i++)
			{
				$sql_inewxy="select * from sch_repair_re where sid='".$nc[$i]."'";
				$rs_inewxy=mysql_query($sql_inewxy,$con);
				if($rowewxy=mysql_fetch_row($rs_inewxy))
				{
					$sql_update="update sch_repair_rea set s_repair='".$wxy."' where s_time='".$rowewxy[10]."' and s_add='".$rowewxy[1]."' and s_name='".$rowewxy[3]."' and s_phone='".$rowewxy[5]."'";
					$rs_update=mysql_query($sql_update,$con);
				}
				$sql_inwxy="update sch_repair_re set s_repair='".$wxy."' where sid='".$nc[$i]."'";
				$rs_inwxy=mysql_query($sql_inwxy,$con);
			}
			if($rs_inwxy>0)
			{
				/*
				短信平台：http://www.sms.cn/
				 
				$requesturl='http://api.sms.cn/sms/?ac=send&uid=amos&pwd=7191d511822634f5783dc89baeea616d&template=418231&mobile=15111888341&content={"name":"'.$wxy.'"}';
			    //curl方式获取json数组
			    $curl = curl_init(); //初始化
			    curl_setopt($curl, CURLOPT_URL, $requesturl);//设置抓取的url
			    curl_setopt($curl, CURLOPT_HEADER, 0);//设置头文件的信息作为数据流输出
			    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);//设置获取的信息以文件流的形式返回，而不是直接输出。
			    $data = curl_exec($curl);//执行命令
			    curl_close($curl);//关闭URL请求

			    */
				?>
		        <script language="javascript">
		        	layui.use('layer', function(){
					  var layer = layui.layer;
					  parent.layer.msg('成功分配到 - <?=$wxy?>');
					});
					location.href="admin_ly.php?<?=$tb?>";
		        </script>
		        <?
			}
			else
			{
				?>
		        <script language="javascript">
		        	layui.use('layer', function(){
					  var layer = layui.layer;
					  parent.layer.msg('分配失败');
					});
					location.href="admin_ly.php?<?=$tb?>";
		        </script>
		        <?
			}
					
		}
	?>

	<script>
	//表单
	layui.use('form', function(){
	  var form = layui.form;
	});
	//询问框
	//tnr=内容
	function consay(tnr)
	{
		layui.use('layer', function(){
		  var layer = layui.layer;

		  parent.layer.confirm(tnr, {
		    btn: ['关闭'] //按钮
		    ,title:false
		  },function(){
		    parent.layer.closeAll();
		  });
		}); 
	}
	//维修员分配询问框
	$("#buttonfp").click(function(e) {
		layui.use('layer', function(){
			var layer = layui.layer;

			parent.layer.confirm("分配给 - "+$("#tt2").find("option:selected").text()+"？", {
			btn: ['确认','取消'] //按钮
			,title:"分配任务"
			}, function(){
				$("#wxyfp").submit();
				
			}, function(){
			  	parent.layer.closeAll();
			});
		}); 
	});
	</script>

</body>
</html>