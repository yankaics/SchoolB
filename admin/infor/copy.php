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
<title>管理员菜单</title>
</head>
<body>
<?
	include("../../PHP/riqi.php");
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
?>
    	 <div class="layui-container">  
          <div class="layui-row">
          	<div class="layui-col-md8">
            	<blockquote class="layui-elem-quote">校园宝后台更新</blockquote>
                <fieldset class="layui-elem-field">
                  <legend>建议反馈</legend>
                  <div class="layui-field-box">
                    小朋友：胡珂 <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=YVdRVVdXUVFSWCEQEE8CDgw" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_01.png"/></a>
                    建议请发至邮箱呐~感谢来信！
                  </div>
                </fieldset>
                
                <fieldset class="layui-elem-field layui-field-title">
                  <legend style="color:#009688;">更新（后台）</legend>
                  <div class="layui-field-box">
                    <ul class="layui-timeline">
                    
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                          <h3 class="layui-timeline-title">2018-1-12</h3>
                          <p>修复了已知BUG</p>
                          <p>新增了管理员的安全性</p>
                          <p>新增了维修员能够查看用户上传的报修照片，能更好的做出解决方法。</p>
                        </div>
                      </li>

                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                          <h3 class="layui-timeline-title">2017-11-22</h3>
                          <p>增加了维修员管理 查看离职和在职的按钮</p>
                          <p>修改了 维修员管理-查看的所有内容</p>
                        </div>
                      </li>
                    
                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                          <h3 class="layui-timeline-title">2017-11-19</h3>
                          <p>全新后台！</p>
                          <p>修改了维修员的任务页的界面以及各项提示~</p>
                          <p>修改了账号管理，增加维修员管理可修改信息~</p>
                          <p>增加了维修员管理，标记离职：被标记离职的维修员将不能登录（离职前确认该维修员是否还有维修任务，务必完成后再标记离职）</p>
                        </div>
                      </li>
                      
                      <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                          <div class="layui-timeline-title">校园宝后台</div>
                        </div>
                      </li>
                      
                    </ul>
                  </div>
               </fieldset>
               
          	</div>
          </div>
        </div>
 
</body>
</html>