<!DOCTYPE html>
<html>
<head>
  <link rel="shortcut icon" href="favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" href="layui/css/layui.css">
  <script src="layui/layui.js"></script>

  <style></style>
  <title>关于校园宝</title>
</head>

<body bgcolor="#F0F0F0">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="UI/logo/logo-32-t.png"></div>
	<?
	include"PHP/riqi.php";
  include"SQL/db/db.php";
	?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item ">
        <?
          if(isset($_SESSION['txm']))
          {
            if($_SESSION['utype']=="学生")
            {
              ?>
              <a href="stu_i.php">菜单</a>
              <?
            }
            else
            {
              ?>
              <a href="tea_i.php">菜单</a>
              <?
            }
          }
          else
          {
        ?>
          <a href="index.php">登陆</a>
        <?
          }
        ?>
      </li>
      <li class="layui-nav-item" ><a href="INDEX/regstu/index.php">注册</a> </li>
      <li class="layui-nav-item layui-this" ><a href="copy.php">关于</a> </li>
    </ul>
  </div>
</div>

<div class="layui-container layui-anim layui-anim-upbit"><br>
      <div class=""><div style="font-size:36px; color:#393D49;"><blockquote class="layui-elem-quote">校园宝</blockquote></div></div>
      <fieldset class="layui-elem-field">
          <legend style="color:#009688;">你好</legend>
          <div class="layui-field-box">
            初次见面-多多指教<br>校园宝须登陆校园网后才能访问（测试）<br>感谢来信提出建议~<br><a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=YQAMDhIJFAoEIRAQTwIODA" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_01.png"/>主题：校园宝+你的主题</a> 
          </div>
      </fieldset>
      <fieldset class="layui-elem-field">
          <legend style="color:#009688;">我们</legend>
          <div class="layui-field-box">
            大朋友：罗军老师
            <br>小朋友：胡珂 <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=YQAMDhIJFAoEIRAQTwIODA" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_01.png"/>主题：校园宝+你的主题</a><br><br>&copy;
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
                  <h3 class="layui-timeline-title">2018-3-22</h3>
                  <p>增加了匿名聊天室，原留言区，实时聊天，不定期清除</p>
                  <p>增加了登陆失败五次锁定30分钟</p>
                  <p>优化了连接校园网但无网络的小伙伴访问速度</p>
                  <p>修改了部分兼容问题</p>
                </div>
              </li>

            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <h3 class="layui-timeline-title">2018-2-1</h3>
                  <p>增加了同学页底部版权以及一些关于校园宝的详细信息，方便同学联系了解</p>
                  <p>增强了网站安全以及修复了已知bug</p>
                  <p>增加了注册内容提示</p>
                  <p>修改了登陆页的样式</p>
                </div>
              </li>

            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <h3 class="layui-timeline-title">2018-1-20</h3>
                  <p>同学的首页样式更改，突出重点功能</p>
                  <p>新增了首页-右上角-个人资料，方便学生查看自己的信息，如有不符请找辅导员核实。</p>
                  <p>新增了<宿舍水电>可查看本月和历史的水电费详情，目前还不能网上缴费</p>
                </div>
              </li>

            <li class="layui-timeline-item">
                <i class="layui-icon layui-timeline-axis"  style=" background-color:#F0F0F0;">&#xe63f;</i>
                <div class="layui-timeline-content layui-text">
                  <h3 class="layui-timeline-title">2018-1-10</h3>
                  <p>2018的第一次更新</p>
                  <p>新增了<成绩查询>目前只适用本院学生，爬取的学院官网的成绩，诶嘿！所以哪天出问题了记得给我发邮箱，谢谢</p>
                  <p>新增了<评论专区>，目前还是第三方的。也就是说你的发言在我这是匿名的，学院是不知道的哦，当然不适合的言论还是会被删掉的。</p>
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
</script>

</body>
</html>