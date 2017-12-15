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
<!---JSQ--->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../../JSQ/index.js"></script>

<!---以往的CSS
<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
--->
<style>
body{ padding-bottom:300px;};
</style>
<title>联系·报修地址</title>
</head>

<body bgcolor="#F0F0F0">

<!------导航------>
<div class="layui-header header header-doc">
    <ul class="layui-nav layui-icon" lay-filter="">
        <div class="layui-container">  
        	<li class="layui-nav-item layui-icon" style="z-index:1;"><a href="../../index.php"><img class="layui-icon" src="../../UI/logo/呕吐-1.png"></a>
            <span class="layui-nav-bar" style=" display:none"></span>
            </li>
        </div> 
    </ul>
    <ul class="layui-nav layui-layout-right" style="text-align:center;">
    	<div class="layui-container ">
        	<?
			include("../../SQL/db/db.php");
			include("../../PHP/adminse.php");
			?>
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
            
        </div>
    </ul>
</div>
<!------main------>
  <div class="layui-row">
  	<div class="layui-col-md4 layui-col-md-offset4 layui-col-xs-12">
    	<?
		if(isset($_POST['bxzdl']))
		{
			?>
            <blockquote class="layui-elem-quote">联系 · 报修地址</blockquote>
              <div class="layui-field-box layui-anim layui-anim-upbit">
              	<p>
                <form class="layui-form layui-form-pane form2" name="stu2" action="stu3_index.php" method="post" role="form" onsubmit="return checkadd()">
                	<div class="layui-form-item">
                        <label class="layui-form-label">电话</label>
                        <div class="layui-input-block">
                          <input type="text" name="tphone" required  lay-verify="required" placeholder="电话" maxlength="11" autocomplete="off" class="layui-input" value="<?=$_SESSION['tdh']?>">
                        </div>
                    </div>
                	
                    <div class="layui-form-item">
                        <label class="layui-form-label">地点</label>
                        <div class="layui-input-block">
                        	<select name="tadd" id="tadd" lay-verify="required" onchange="show_sub(this.options[this.options.selectedIndex].value)">
                              <option value="宿舍">宿舍</option>
                              <option value="食堂" >食堂</option>
                              <option value="运动场">运动场</option>
                              <option value="图书馆">图书馆</option>
                              <option value="实训楼">实训楼</option>
                              <option value="教学楼">教学楼</option>
                              <option value="综合楼">综合楼</option>
                              
                           </select>
                        </div>
                    </div>
                    
                    <div class="layui-form-item">
                        <label class="layui-form-label">详细地址</label>
                        <div class="layui-input-block">
                          <input type="text" name="taddr" required  lay-verify="required" placeholder="宿舍·教室·办公室号或地点" maxlength="25" autocomplete="off" class="layui-input" id="taddr">
                        </div>
                    </div>
                    
              		<!---!!!--->
                    <input name="bxzdl" type="hidden" value="" />
					<?
                    if($_SESSION['utype']=="教师")
                    {
                        ?>
                        <input name="tea" type="hidden" value="" />
                        <input name="tname" type="hidden" value="<?=$_SESSION['txm']?>" />
                        <input name="tzy" type="hidden" value="<?=$_SESSION['tjob']?>" />
                        <input name="ttea" type="hidden" value="教师报修" />
                        <?
                    }
                    else
                    {
                        ?>
                        <input name="tname" type="hidden" value="<?=$_SESSION['txm']?>" />
                        <input name="tzy" type="hidden" value="<?=$_SESSION['tzy']?>" />
                        <input name="ttea" type="hidden" value="<?=$_SESSION['tfdy']?>" />
                        <?
                    }
                    ?>
                    
                    <!--<div class="layui-form-item">
                        <div class="layui-input-block">
                          <button id="xyb" onClick="return confirm('确定下一步？')" class="layui-btn" lay-submit lay-filter="formDemo">下一步</button>
                        </div>
                     </div>-->
                    
                </form>
                </p>
              </div>
<script> 
//提示暂留    
function show_sub(v){     
        var ts=$('#tadd option:selected').val();
    	var inp = $('#taddr')
    	inp.show(function(){
		if(ts=="食堂")
		{
      		inp.attr('placeholder','如：1楼');
    	}
		else if(ts=="宿舍")
		{
			inp.attr('placeholder','如：1605寝室');
		}
		else if(ts=="运动场") 
		{
			inp.attr('placeholder','如：篮球架');
		} 
		else if(ts=="图书馆") 
		{
			inp.attr('placeholder','如：一楼');
		}   
		else if(ts=="实训楼") 
		{
			inp.attr('placeholder','如：多媒体4');
		} 
		else if(ts=="教学楼") 
		{
			inp.attr('placeholder','如：606教室或办公室号');
		} 
		else
		{
			inp.attr('placeholder','如：教室号或办公室号');
		} 
    });    
}
</script>
<script>
layui.use('form', function(){
  var form = layui.form;

});

//判断
function checkadd(){
		cadd=stu2.tadd.value;
		caddr=stu2.taddr.value;
		cphone=stu2.tphone.value;
		var yz=/^(13[0-9]|14[5|7]|15[0|1|2|3|5|6|7|8|9]|18[0|1|2|3|5|6|7|8|9])\d{8}$/;
		if(cadd=='宿舍')
			if(caddr.length!=4 ||isNaN(caddr))
			{
				$(document).ready(function(e) {
					layui.use('layer', function(){
					var layer = layui.layer;
					layer.msg('宿舍为4位数字!!!∑(ﾟДﾟノ)ノ', {
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
								layer.msg('<button onclick="openf()" type="submit" class="layui-btn">下一步</button>', {
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
			//不能空
			if(caddr=="")
			{
				$(document).ready(function(e) {
					layui.use('layer', function(){
					var layer = layui.layer;
					layer.msg('还有空位!!!∑(ﾟДﾟノ)ノ', {
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
								layer.msg('<button onclick="openf()" type="submit" class="layui-btn">下一步</button>', {
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
			if(!yz.exec(cphone))
			{
				$(document).ready(function(e) {
					layui.use('layer', function(){
					var layer = layui.layer;
					layer.msg('电话不正确!!!∑(ﾟДﾟノ)ノ', {
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
								layer.msg('<button onclick="openf()" type="submit" class="layui-btn">下一步</button>', {
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
		//弹出
		$(document).ready(function(e) {
								layui.use('layer', function(){
								var layer = layui.layer;
								layer.msg('<button onclick="openf()" type="submit" class="layui-btn">下一步</button>', {
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
								 $(".form2").submit();
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

</body>
</html>