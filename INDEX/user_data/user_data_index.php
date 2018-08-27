<!--
/**
 * This file is part of CardDesign.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    AmosHuKe<amoshuke@qq.com>
 * @copyright AmosHuKe<amoshuke@qq.com>
 * @link      https://github.com/AmosHuKe/Hi/tree/master/CardDesign
 * @license   http://www.opensource.org/licenses/mit-license.php (MIT License)
 */
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="../../favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <!-- JQuery -->
	<script src="../../jsq/jquery-2.1.1.min.js"></script>
  <!-- LayUI -->
  <link rel="stylesheet" href="../../layui/css/layui.css">
  <script src="../../layui/layui.js"></script>
	<!-- BootStrap -->
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
	<script src="../../bootstrap/js/bootstrap.min.js"></script>
  
  
	<!--Card_2 Style -->
	<link rel="stylesheet" href="css/Card_2.css">
	
	<title>个人资料</title>
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
	<div class="container-fluid">
	   	<div class="row">
	   	<!-- Card_2 -->
			<!--信息卡片-->
      <?
        $sql="select * from sch_stub where tno='".$_SESSION['txh']."'";
        $rs=mysql_query($sql,$con);
        if($row=mysql_fetch_row($rs))
        {
      ?>
			<div class="box_main z-index2">
				<div class="box_img">
					<!-- <button class="atlb">修改资料</button> -->
          <div class="atlb_name"><?=$row[1]?></div>
				</div>
				<div class="box_text">
					<p class="t_h1">寝室</p>
					<div class="t_h2"><?=$row[8]?></div>
					<p class="t_h1">专业</p>
					<p class="t_h2"><?=$row[5]?></p>
					<p class="t_h1">辅导员</p>
					<p class="t_h2"><?=$row[6]?></p>
          
          <p class="t_h2">提供的信息不完全准确，具体询问辅导员</p>
				</div>
			</div>
			<!-- 顶部背景 -->
	   	<div class="col-md-12 main_top">
				
			</div>
			<!-- main -->
			<div align="center" class="col-md-12 box_maint">
				<!-- 工具栏 -->
				<div class="col-md-4 col-sm-4 box_main_i">
					<div class="col-md-12 box_tool_i">
            <a class="CJCX" href="../CQDD_CJCX/CJCX_index.php">
  						<div class="col-md-4 col-sm-4 col-xs-4 cd_i">
  							<p class="t_h1_i">成绩</p>
  							<img class="box_img_b_i" src="../../UI/index/result.svg">
  						</div>
            </a>

						<div class="col-md-4 col-sm-4 col-xs-4 cd_i chat_room">
							<p class="t_h1_i">聊天</p>
							<img class="box_img_b_i" src="../../UI/index/chat.svg">
						</div>
						<div class="col-md-4 col-sm-4 col-xs-4 cd_i DE">
							<p class="t_h1_i">嘿嘿</p>
							<img class="box_img_b_i" src="../../UI/index/more.svg">
						</div>
					</div>
				</div>
				<!-- 内容栏 -->
				<div class="col-md-4 col-sm-4 box_main_i">
					<div class="col-md-12 box_top_i">
						<img class="box_img_i" src="img/Card_1_3.svg">
						<span>
							<div class="top_text_i">
								<p class="t_h1_i">关于</p>
								<p class="t_h2_i">校园宝</p>
							</div>
						</span>
					</div>
					<div class="col-md-12 box_bottom_i">
						<p class="t_h1_b_i"></p>
            <p class="t_h2_b_i">后勤顾问：罗军</p>
            <p class="t_h2_b_i">技术支持：胡珂</p>

						<p class="t_h2_b_i">作者邮箱：amoshuke@qq.com（建议和BUG提交）</p>
						<p class="t_h2_b_i">用户调查：<a href="https://wj.qq.com/s/2111491/269d">【进入】</a></p>
            <p class="t_h2_b_i">感谢各位！</p>
					</div>
				</div>

	   	</div>
      <?
        }
      ?>

   	</div>
  </div>

  <script type="text/javascript">
    layui.use('element', function(){
      var element = layui.element;  
    });

    //聊天室房间号弹出
    $(".chat_room").click(function(e) {
      layer.confirm('选择需要进入的房间', {
        btn: ['官方','私人'] //按钮
      }, function(){
        location.href="../online_chat_room/chat_index.php?room=1"
        layer.closeAll();
      }, function(){
        layer.prompt({title: '输入房间号(字母，数字)', formType: 0},function(val, index){
            location.href="../online_chat_room/chat_index.php?room="+val;
            layer.closeAll();
          });
        });
      });

    layui.use('layer', function(){
      var layer = layui.layer;
        $(".CJCX").click(function(e) {
            layer.msg('抓取学院数据中。。。', {
            time: 3000,
        });
      });
    });

    //点击敬请期待的小彩蛋
    var countDE=1;
    $(".DE").click(function(e) {
        countDE++;
        if(countDE>20)
        {
          layer.msg('(┙>∧<)┙へ┻┻嗷嗷嗷！', {
          time: 2000,
          });
        }
        else if(countDE>3)
        {
          layer.msg('(/= _ =)/~┴┴再点生气了', {
          time: 2000,
          });
        }
        else
        {
          layer.msg('(｡・`ω´･)', {
          time: 2000,
          });
        }
    });
  </script>
</body>
</html>