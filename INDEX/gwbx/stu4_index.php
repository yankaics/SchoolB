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

	<style>
	body{ background-color:#F0F0F0; padding-bottom:200px;};
	a:link{text-decoration:none;}
	a:visited{text-decoration:none;}
	a:hover{text-decoration:none;}
	a:active{text-decoration:none;}
	.upimg input {
	    position: absolute;
	    font-size: 100px;
	    right: 0;
	    top: 0;
	    opacity: 0;
	}
	.show
	{
	    top:40px;
	    width: 100%;
	    height: 30px;
	    font:normal normal normal 14px/30px 'Microsoft YaHei';
	}
	</style>
	<script type="text/javascript">

	</script>
	<title>预览报修订单</title>
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
  		<div class="layui-col-md4 layui-col-md-offset4 layui-col-xs-12">
    	<?
		if(isset($_POST['bxzdl']))
		{
			?>
            
              <div class="layui-field-box layui-anim layui-anim-upbit">
              	<blockquote class="layui-elem-quote">预览报修订单<br>检查订单<br>并填写损坏描述<br>也可上传对应的照片</blockquote>
              	<p>
                <!--上一步-->
                <form class="forms" name="stu3" action="stu3_index.php" method="post" role="form">
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
                </form>
                
                <form class="layui-form layui-form-pane form4" name="stu4" action="stuinsert_index.php" method="post" role="form" onsubmit="return check()" enctype="multipart/form-data">
                	<input name="bxzdl" type="hidden" value="" />
                	<div class="layui-form-item">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-block">
                          <input name="trxm" type="text" disabled required class="layui-input" placeholder="姓名" autocomplete="off" value="<?=$_POST['tname']?>" readonly  lay-verify="required"> 
                      	</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">电话</label>
                        <div class="layui-input-block">
                          <input name="trdh" type="text" disabled required class="layui-input" placeholder="电话" autocomplete="off" value="<?=$_POST['tphone']?>" readonly  lay-verify="required"> 
                      	</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">报修地址</label>
                        <div class="layui-input-block">
                          <input name="trdz" type="text" disabled required class="layui-input" placeholder="地址" autocomplete="off" value="<?=$_POST['tadd'].$_POST['taddr']?>" readonly  lay-verify="required"> 
                      	</div>
                    </div>
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label"><span class="layui-badge-dot"></span>损坏描述</label>
                        <div class="layui-input-block">
                          <textarea name="twxxq" placeholder="如：水管裂开了，尽量详细，详细的描述会让维修员更好的处理" class="layui-textarea"></textarea>
                        </div>
                     </div>
					
					 <blockquote class="layui-elem-quote">照片格式JPG,PNG,JPEG,大小不能超过10MB<br>不符合的照片，自动删除</blockquote>	
					<!--图片大小-->
                    
                    
                    <table class="layui-table">
                      <colgroup>
                        <col width="100">
                        <col width="100">
                        <col width="100">
                      </colgroup>
                      <thead>
                        <tr>
                        	<th align="left">照片</th>
                          	<th align="left">物件</th>
                       	  	<th align="left">数量</th>
                        </tr> 
                      </thead>
                      <tbody>
                      <?
					  $nbc1=count($_POST['c'])-1;
					  $t1=$_POST['c'];
					  $nb1=$_POST['nb'];
					  for($i=0;$i<=$nbc1;$i++)
					  {
					  ?>
					  	<input name="MAX_FILE_SIZE" type="hidden" value="10240000" />
                        <tr>
                        	<td align="left">
                        		<a href="javascript:;" class="upimg fupimg<?=$i?> layui-btn">选择
									<input name="ttp<?=$i?>" class="fileimg<?=$i?>" type="file" accept="image/jpeg,image/jpg,image/png;capture=camera"/>
									
								</a>
								<div class="show<?=$i?>"></div>
							</td>
                        	<td align="left"><?=$t1[$i]?></td>
                        	<td align="left"><?=$nb1[$i]?></td>
                        </tr>

                        <script type="text/javascript">
                        	//上传图片
						    $(document).ready(function(){
						            $(".fupimg<?=$i?>").on("change","input[type='file']",function(){
									    var filePath=$(this).val();
									    
									    if(filePath.indexOf("jpg")!=-1 || filePath.indexOf("png")!=-1 || filePath.indexOf("jpeg")!=-1){
									        $(".fileerrorTip").html("").hide();
									        var arr=filePath.split('\\');
									        var fileName=arr[arr.length-1];
									        $('.show<?=$i?>').html(fileName.substr(0, 2)+'..'+fileName.substr(-6));
									    }
									    
									    else
									    {
									    	//部分浏览器
									    	$(".fileimg<?=$i?>").prop("value","");
									    	//IE 
									    	$(".fileimg<?=$i?>").replaceWith($(".fileimg<?=$i?>").clone());  
									        $(".show<?=$i?>").html("");
									        layui.use('layer', function(){
											var layer = layui.layer;
											layer.msg('您未上传文件<br>或文件类型有误！', {
											title: false,
											closeBtn: 0,
															
												});
											});
											//延迟弹出
											setTimeout(function(){ 
												$(document).ready(function(e) {
													layui.use('layer', function(){
													var layer = layui.layer;
													layer.msg('<button onclick="opens()" type="submit" class="layui-btn">上一步</button><button onclick="openf()" type="submit" class="layui-btn">提交报修</button>', {
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
									});
						        });
                        </script>
                      <?
					  }
					  ?>
                      </tbody>
                    </table>

                	<input name="tname" type="hidden" class="form-control" id="firstname" maxlength="40" readonly value="<?=$_POST['tname']?>">
                    <input name="tphone" type="hidden" class="form-control" id="firstname" maxlength="40" readonly value="<?=$_POST['tphone']?>">
                    <input name="tzy" type="hidden" class="form-control" id="firstname" maxlength="40" readonly value="<?=$_POST['tzy']?>">
                    <input name="taddr" type="hidden" value="<?=$_POST['taddr']?>" />
                	<input name="tadd" type="hidden" value="<?=$_POST['tadd']?>" />
                    <?
					if(isset($_POST['tea']))
					{
						?>
					  	<input name="ttea" type="hidden" value="教师报修" />
						<input name="tea" type="hidden" value="" />
						<?
					}
					else
					{
					  	?>
					 	<input name="ttea" type="hidden" class="form-control" id="firstname" maxlength="40" readonly value="<?=$_POST['ttea']?>">
					  	<?
					}
					?>
                    <?
				  	$nbc=count($_POST['c'])-1;
					$_SESSION['j']=$nbc;
					$t=$_POST['c'];
					$nb=$_POST['nb'];
					for($i=0;$i<=$nbc;$i++)
					{
						?>
						<input name="tres<?=$i?>" type="hidden" class="form-control" id="firstname" maxlength="40" readonly value="<?=$t[$i]?>">
						<input name="tnum<?=$i?>" type="hidden" class="form-control" id="firstname" maxlength="40" readonly value="<?=$nb[$i]?>">						
					  	<?
					}
					?>
                </form>
                
                </p>
             </div>

<script type="text/javascript">
//提示，提交部分  
layui.use('form', function(){
	var form = layui.form;
});

tc();

//底部弹出
function tc(){
	$(document).ready(function(e) {
		layui.use('layer', function(){
		var layer = layui.layer;
		layer.msg('<button onclick="opens()" type="submit" class="layui-btn">上一步</button><button onclick="openf()" type="submit" class="layui-btn">提交报修</button>', {
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
							
                        	
//表单提交
function openf(){
	$(document).ready(function(e) {
	layui.use('layer', function(){
		var layer = layui.layer;
		parent.layer.confirm('确定提交？', {
		  btn: ['提交','取消'],
		  title: false,
		  closeBtn: 0,
		}, function(){
			layer.msg('正在提交...', {
		      time: 10000,
		    });
			$(".form4").submit();
			
		},function(){
			tc();
		});
		
	});
});
	 
}
//上一步
function opens(){
	 $(".forms").submit()
}
//判断
function check()
{
	tw=stu4.twxxq.value;
	if(tw=="")
	{
		$(document).ready(function(e) {
			layui.use('layer', function(){
			var layer = layui.layer;
			layer.msg('损坏描述必填~', {
			title: false,
			closeBtn: 0,
							
				});
			});
		});
		//延迟弹出
		setTimeout(function(){ tc(); }, 2000);
		return false;
	}
	var pattern = new RegExp("[`~!@#$^&*()=|{}':;'\\[\\].<>/~@#￥……&*——|{}【】‘；：”“'、？]");//特殊字符判断
	if(tw.length>100 || pattern.test(tw))
	{
		$(document).ready(function(e) {
			layui.use('layer', function(){
			var layer = layui.layer;
			layer.msg('损坏描述最多100字非特殊字符', {
			title: false,
			closeBtn: 0,
							
				});
			});
		});
		//延迟弹出
		setTimeout(function(){ tc(); }, 2000);
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