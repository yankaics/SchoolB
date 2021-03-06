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
                    小朋友：胡珂 <a target="_blank" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=YVdRVVdXUVFSWCEQEE8CDgw" style="text-decoration:none;"><img src="http://rescdn.qqmail.com/zh_CN/htmledition/images/function/qm_open/ico_mailme_01.png"/>主题：校园宝+你的问题</a>
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
                          <h3 class="layui-timeline-title">2018-4-25</h3>
                          <p>增加了 报修状态查询中不能处理可转入<零星维修>进行维修</p>
                          <p>修改了报修前统计，所有详情：统计所选报修时间内，所有的报修详情。所以统计：统计所选报修时间内所有地区物件</p>
                          <p>修复了维修员任务中不能点击暂停后不能输入的bug</p>
                          <p>优化了维修员小屏手机的使用体验</p>
                        </div>
                      </li>

                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                          <h3 class="layui-timeline-title">2018-1-26</h3>
                          <p>修复了已知BUG</p>
                          <p>新增了<账号管理>-<学生管理>&amp;<增加宿管员>&amp;<管理宿管员> </p>
                          <p>新增了<水电费管理>-<电费表excel.csv上传></p>
                          <p>新增【宿管主管】以及【宿管员】两种职位</p>
                          <p>新增了<学生整体管理></p>
                        </div>
                      </li>

                    <li class="layui-timeline-item">
                        <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                        <div class="layui-timeline-content layui-text">
                          <h3 class="layui-timeline-title">2018-1-15</h3>
                          <p>修复了已知BUG</p>
                          <p>新增了管理员的安全性</p>
                          <p>新增了<账号管理>-<学生管理>,假如有学生信息有变化，宿管方便进行修改。</p>
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