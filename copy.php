<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="favicon.ico" />
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
<link rel="stylesheet" href="layui/css/layui.css">
<script src="layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>


</script>
<style></style>
<title>关于校园宝</title>
</head>

<body bgcolor="#F0F0F0">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="UI/logo/呕吐-1.png"></div>
	<?
	include"PHP/riqi.php";
	?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item "><a href="index.php">登陆</a> </li>
      <li class="layui-nav-item layui-this" ><a href="">关于</a> </li>
    </ul>
  </div>
</div>

<div class="layui-container layui-anim layui-anim-upbit"><br>
      <div class=""><div style="font-size:36px; color:#393D49;"><blockquote class="layui-elem-quote">校园宝</blockquote></div></div>
      <fieldset class="layui-elem-field">
          <legend style="color:#009688;">你好</legend>
          <div class="layui-field-box">
            初次见面-多多指教<br>本系统须登陆校园网后才能访问（测试）<br>感谢来信提出建议~<br><a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=YVdRVVdXUVFSWCEQEE8CDgw" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_01.png"/></a> 
          </div>
      </fieldset>
      <fieldset class="layui-elem-field">
          <legend style="color:#009688;">我们</legend>
          <div class="layui-field-box">
            大朋友：罗军老师
            <br>小朋友：胡珂 <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=YVdRVVdXUVFSWCEQEE8CDgw" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_01.png"/></a><br>&copy;
			<?
			if($rqY>2017)
				echo "2017-".$rqY;
			else
				echo "2017";
            ?>
          </div>
        </fieldset>
         
        <fieldset class="layui-elem-field layui-field-title">
          <legend style="color:#009688;">更新（用户）</legend>
          <div class="layui-field-box">
            <ul class="layui-timeline">
            
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <h3 class="layui-timeline-title">2018-1-10</h3>
                  <p>2018的第一次更新</p>
                  <p>新增了<评论专区>，目前还是第三方的。也就是说你的发言在我这是匿名的。</p>
                  <p>新增了<公物报修>预览报修订单处能够<上传物件照片>，方便维修员更好的进行处理</p>
                  <p>新增了自动登录，默认保存30天。</p>
                  <p>修复了已知BUG！</p>
                  <p>修改了<报修查询>，移动至右上角，并加入提示信息。</p>
                  <p>优化了部分代码以及用户体验！</p>
                </div>
              </li>

            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <h3 class="layui-timeline-title">2017-12-27</h3>
                  	<p>新增用户右上角个人管理（姓名显示）</p>
                    <p>修改了顶部导航布局，加入了部分提示</p>
                  	<p>修改了已知bug~~</p>
                  <p></p>
                </div>
              </li>
            
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <h3 class="layui-timeline-title">2017-11-13</h3>
                  <p>修改了公物报修提示信息~~</p>
                  <p></p>
                </div>
              </li>
            
            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <h3 class="layui-timeline-title">2017-11-4</h3>
                  <p>
                    用户修改密码页修改为弹窗样式<br>还是默认密码的小伙伴记得改密码咯~<br>还修复了若干bug以及优化了部分显示<br>全面修改了报修查询页面 | 加强了密码安全 | 加入了部分提示(｡・`ω´･)<br>全面修改优化了公物报修页面~更改多项提示。
                  </p>
                </div>
              </li>
            
              <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <h3 class="layui-timeline-title">2017</h3>
                  <p>
                    你好呐 <i class="layui-icon" style="font-size:24px;">&#xe60c;</i>
                    <br>现在的校园宝也只有公物报修以及报修查询的功能。
                    <br>现在页面过于辣眼睛，我会慢慢统一风格的~
                    <br>后续还会推出其他功能~
                  </p>
                </div>
              </li>
              
              <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <div class="layui-timeline-title">校园宝</div>
                </div>
              </li>
              
           	</ul>
          </div>
       </fieldset>
      
      
          
</div>
<script>
layui.use('element', function(){
  var element = layui.element;
  
});

</body>
</html>