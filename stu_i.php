<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" href="layui/css/layui.css">
  <script src="layui/layui.js"></script>
  <link rel="shortcut icon" href="favicon.ico" />
  <!--JSQ-->
  <script src="JSQ/jquery-2.1.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/stu_index.css" />
  <title>Hi-同学</title>
</head>

<body bgcolor="#F0F0F0">
<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="UI/logo/logo-32-t.png"></div>
	<?
	include"PHP/riqi.php";
	include"SQL/db/db.php";
	include"PHP/adminse.php";
	?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <!--修改密码-->
      	<?php
  			$sql="select tid from sch_stub where tpass is null and tno='".$_SESSION['user']."' or tpass=''";
  			$rs=mysql_query($sql,$con);
  			if($row=mysql_fetch_row($rs))
  			{
  		?><span class="layui-badge-dot "></span><?php }?>
        <!--报修查询-->
        <?
        if($_SESSION['utype']=="教师")
        {
          $sql="select * from sch_repair_re where s_schid='".$_SESSION['user']."' and s_repair!='未分配' and s_jg!='已处理'";
        }
        else
        {
          $sql="select * from sch_repair_re where s_schid='".$_SESSION['txh']."' and s_repair!='未分配' and s_jg!='已处理'";
        }
        $rs=mysql_query($sql,$con);
        if($row=mysql_fetch_row($rs))
        {
      ?><span class="layui-badge-dot "></span><? }?>
        <a href="javascript:;">
           <?=$_SESSION['txm'];?>
        </a>
        <dl class="layui-nav-child">

          <dd>
          <!--个人资料-->
            <a class="" href="INDEX/user_data/user_data_index.php">个人资料</a>
          </dd>

          <dd>
          <!--报修查询-->
          <?
            if($_SESSION['utype']=="教师")
            {
              $sql="select * from sch_repair_re where s_schid='".$_SESSION['user']."' and s_repair!='未分配' and s_jg!='已处理'";
            }
            else
            {
              $sql="select * from sch_repair_re where s_schid='".$_SESSION['txh']."' and s_repair!='未分配' and s_jg!='已处理'";
            }
            $rs=mysql_query($sql,$con);
            if($row=mysql_fetch_row($rs))
            {
          ?><span class="layui-badge-dot "></span><? }?>
            <a href="INDEX/gwbx/gwbxcx_index.php">报修查询</a>
          </dd>

          <dd>
          <!--修改密码-->
          <?php
            $sql="select tid from sch_stub where tpass is null and tno='".$_SESSION['user']."' or tpass=''";
            $rs=mysql_query($sql,$con);
            if($row=mysql_fetch_row($rs))
            {
          ?><span class="layui-badge-dot "></span><?php }?>
            <a class="updatepass" href="javascript:;">修改密码</a>
          </dd>

          <dd><a href="javascript:;" class="del_login">退出</a></dd>
        </dl>
      </li>
    </ul>
  </div>
</div>
<!--main-->
<!--主要功能-->
<div class="layui-col-md-offset2 paddingtop layui-anim layui-anim-upbit">
  <div class="layui-col-md12">
      <div class="layui-row">
        <div class="layui-col-md3 layui-col-sm5 border_box_icon">
          <a class="md" id=""></a>
          <i class="layui-icon">&#xe68e;</i>&nbsp;主要功能
        </div>
    </div>
  </div>
  <!--菜单主要功能-->   
  <a href="INDEX/gwbx/alerts.php" class="z_index_box">
  <div class="layui-col-md3 layui-col-sm5 border_box">
      <div class="layui-row">
        <div class="layui-col-md2 layui-col-xs2 layui-col-sm2">
          <i class="layui-icon img48">&#xe631;</i>
        </div>
        <div class="layui-col-md10 layui-col-xs10 layui-col-sm10">
          &nbsp;&nbsp;公物报修
        </div>
        <div class="layui-col-md12 layui-col-xs12 layui-col-sm10 yy">
          针对本学院的公共物品进行报修
        </div>
      </div>
  </div>
  </a>

  <a href="INDEX/dorm_ele/ele_index.php" class="z_index_box">
  <div class="layui-col-md3 layui-col-sm5 border_box">
      <div class="layui-row">
        <div class="layui-col-md2 layui-col-xs2 layui-col-sm2">
          <i class="layui-icon img48">&#xe636;</i>
        </div>
        <div class="layui-col-md10 layui-col-xs10 layui-col-sm10">
          &nbsp;&nbsp;宿舍水电
        </div>
        <div class="layui-col-md12 layui-col-xs12 layui-col-sm10 yy">
          宿舍水电费查看以及缴费
        </div>
      </div>
  </div>
  </a>

</div>
<!--学生功能-->
<div class="layui-col-md-offset2 paddingtop layui-anim layui-anim-upbit">
  <div class="layui-col-md12">
      <div class="layui-row">
        <div class="layui-col-md3 layui-col-sm5 border_box_icon">
          <a class="md" id=""></a>
          <i class="layui-icon">&#xe613;</i>&nbsp;学生功能
        </div>
    </div>
  </div>
  <!--菜单学生功能-->   
  <a href="INDEX/CQDD_CJCX/CJCX_index.php" class="z_index_box CJCX">
  <div class="layui-col-md3 layui-col-sm5 border_box">
      <div class="layui-row">
        <div class="layui-col-md2 layui-col-xs2 layui-col-sm2">
          <i class="layui-icon img48">&#xe63c;</i>
        </div>
        <div class="layui-col-md10 layui-col-xs10 layui-col-sm10">
          &nbsp;&nbsp;成绩查询
        </div>
        <div class="layui-col-md12 layui-col-xs12 layui-col-sm10 yy">
          学院官网期末成绩查询
        </div>
      </div>
  </div>
  </a>

  <a href="INDEX/comment/index.php" class="z_index_box ">
  <div class="layui-col-md3 layui-col-sm5 border_box">
      <div class="layui-row">
        <div class="layui-col-md2 layui-col-xs2 layui-col-sm2">
          <i class="layui-icon img48">&#xe606;</i>
        </div>
        <div class="layui-col-md10 layui-col-xs10 layui-col-sm10">
          &nbsp;&nbsp;评论专区
        </div>
        <div class="layui-col-md12 layui-col-xs12 layui-col-sm10 yy">
          反映学院不足处自由评论
        </div>
      </div>
  </div>
  </a>

  <a href="javascript:;" class="DE z_index_box">
  <div class="layui-col-md3 layui-col-sm5 border_box">
      <div class="layui-row">
        <div class="layui-col-md2 layui-col-xs2 layui-col-sm2">
          <i class="layui-icon img48">&#xe705;</i>
        </div>
        <div class="layui-col-md10 layui-col-xs10 layui-col-sm10">
          &nbsp;&nbsp;敬请期待
        </div>
        <div class="layui-col-md12 layui-col-xs12 layui-col-sm10 yy">
          更多实用的功能
        </div>
      </div>
  </div>
  </a>


</div>

<!--底部-->
<center>
<div class=" layui-col-md-offset2 paddingtop layui-anim layui-anim-upbit">
<div class="layui-col-md12 bt">
    <div class="layui-row">
      <div class="layui-col-md10 layui-col-sm12 border_box_icon">
        <a id="bta" href="copy.php">&copy;<? if($rqY>2017) echo "2017-".$rqY; else echo "2017";?> | 关于 | 联系 |</a>
      </div>
  </div>
</div>
</div>
</center>

<script>
layui.use('element', function(){
  var element = layui.element;  
});


layui.use('layer', function(){
  var layer = layui.layer;
  $(document).ready(function(e) {
  var countDESS=0;
  $(".DESS").click(function(e) {
    countDESS++;
    if(countDESS>5)
    {
      layer.msg('都说了测试中', {
      time: 2000,
      });
    }
    else
    {
      layer.msg('测试中', {
      time: 2000,
      });
    }
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

  $(".CJCX").click(function(e) {
        layer.msg('抓取学院数据中。。。', {
        time: 0,
        });
  });

  //修改密码弹出
  $(".updatepass").click(function(e) {
        layer.open({
        type: 2,
        title: '修改密码',
        shadeClose: true,
        shade: 0.8,
        shadeClose:true,
        scrollbar:false,
        area: ['320px', '320px'],
        content: 'index/xgmm/updatepass.php' //iframe的url
      }); 
    });
  });
});

//退出
$(document).ready(function(e) {
  $(".del_login").click(function(e) {
              layui.use('layer', function(){
                var layer = layui.layer;
                parent.layer.confirm('<center>确定退出？<br>下次将不会自动登陆</center>', {
                  btn: ['确定|·_·)','取消'],
                  title: false,
                  btnAlign: 'c',
                  closeBtn: 0,
                }, function(){
                  location.href="del_login.php";
                },function(){
                  
                    });
                  });
                });
              });
</script>
  <?
  //报修成功
  if(isset($_GET['iok']))
  {
  	?>
      <script>
  	$(document).ready(function(e) {
  								layui.use('layer', function(){
  									var layer = layui.layer;
  									parent.layer.confirm('<center>提交成功<br>【报修查询】查看报修</center>', {
  									  btn: ['前往|·_·)','菜单'],
  									  title: false,
  									  btnAlign: 'c',
  									  closeBtn: 0,
  									}, function(){
  										location.href="INDEX/gwbx/gwbxcx_index.php";
  									},function(){
  										location.href="stu_i.php";
  										});
  									});
  									
  								});
  							
  	</script>
  	<?
  }

  if($_SESSION['utype']=="教师")
  {
  	?>
      <script>
      location.href="tea_i.php";
      </script>
      <?
  }
  ?>
  <script language="javascript">
          //防止页面后退
          history.pushState(null, null, document.URL);
          window.addEventListener('popstate', function () {
              history.pushState(null, null, document.URL);
          });
  </script>

</body>
</html>