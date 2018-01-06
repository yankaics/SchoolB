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
<title>预览报修订单</title>
</head>

<body>

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
<div class="layui-row">
  		<div class="layui-col-md4 layui-col-md-offset4 layui-col-xs-12">
    	<?
		if(isset($_POST['bxzdl']))
		{
			?>
            <blockquote class="layui-elem-quote">预览报修订单<br>检查订单并填写损坏描述</blockquote>
              <div class="layui-field-box layui-anim layui-anim-upbit">
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
                
                <form class="layui-form layui-form-pane form4" name="stu4" action="stuinsert_index.php" method="post" role="form" onsubmit="return check()">
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
                          <textarea name="twxxq" placeholder="如：桌子腿坏了或水管裂开了" class="layui-textarea"></textarea>
                        </div>
                     </div>
                    <table class="layui-table">
                      <colgroup>
                        <col width="100">
                        <col width="100">
                        <col width="100">
                      </colgroup>
                      <thead>
                        <tr>
                        	<th align="left">图片</th>
                          	<th align="left">物件</th>
                       	  	<th align="left">数量</th>
                        </tr> 
                      </thead>
                      <tbody>
                      <?
					  $nbc1=count($_POST['c']);
					  $t1=$_POST['c'];
					  $nb1=$_POST['nb'];
					  for($i=1;$i<=$nbc1;$i++)
					  {
					  ?>
                        <tr>
                        	<td align="left"><input class="layui-btn" type="file" name="uploadImg" onchange="Javascript:validate_img(this);" size="12"/></td>
                        	<td align="left"><?=$t1[$i-1]?></td>
                        	<td align="left"><?=$nb1[$i-1]?></td>
                        </tr>
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
				  	$nbc=count($_POST['c']);
					$_SESSION['j']=$nbc;
					$t=$_POST['c'];
					$nb=$_POST['nb'];
					for($i=1;$i<=$nbc;$i++)
					{
						?>
						<input name="tres<?=$i?>" type="hidden" class="form-control" id="firstname" maxlength="40" readonly value="<?=$t[$i-1]?>">
						<input name="tnum<?=$i?>" type="hidden" class="form-control" id="firstname" maxlength="40" readonly value="<?=$nb[$i-1]?>">						
					  	<?
					}
					?>
                </form>
                
                </p>
             </div>
<script>
$('input[type=file]').each(function()   
                {
                    var max_size=102400;
                     $(this).change(function(evt)   
                        {   
                            var finput = $(this);
                            var file = a.value;   
                            var files = evt.target.files; // 获得文件对象   
                            var output = [];   
                            for (var i = 0, f; f = files[i]; i++)   
                                    {  //检查文件大小   
                                     if(f.size > max_size)   
                                        {   
                                            alert("上传的图片不能超过100KB!");   
                                            $(this).val('');   
                                        }   
                                    }
			});   
        }); 

layui.use('form', function(){
  		var form = layui.form;
	});
							//底部弹出
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
										$(".form4").submit();
									},function(){
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