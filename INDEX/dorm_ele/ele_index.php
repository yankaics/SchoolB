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
  <script src="../../JSQ/jquery-2.1.1.min.js"></script>
  <script src="../../JSQ/index.js"></script>

  <link rel="stylesheet" href="css/style.css"> <!-- 轮播 -->
  <script src="js/modernizr.js"></script> <!-- 轮播 -->
<title>宿舍水电</title>
</head>
<body  bgcolor="#F0F0F0">

<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/呕吐-1.png"></div>
	<?
  include("../../PHP/riqi.php");
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
<div class="layui-container">
  <div class="layui-row">
  	<div class="layui-col-md5">
    <?
      $dorm=$_SESSION['tdorm']; //寝室
      $sqldf="select * from sushe_user where sushe_dor='".$dorm."' and sushe_Y='".$rqY."' and sushe_m='".$rqm."'";
      $rsdf=mysql_query($sqldf,$con);
      if($rowdf=mysql_fetch_row($rsdf))
      {
        
    ?>
      	<section class="cd-intro">
          <h1 class="cd-headline clip is-full-width">
            <span></span>
            <span class="cd-words-wrapper">
              <b class="is-visible"><?=$dorm.'寝室'?></b>
              <b><?=$rqY.'年'.$rqm.'月'?></b>
              <b>
                <?
                if($rowdf[16]='已缴费')
                  echo "已缴费";
                else
                  echo $rowdf['11'].'元';
                ?>
              </b>
            </span>
          </h1>
        </section>
      </div>
      <div class="layui-col-md4">
        <!--详情-->
        <table class="layui-table">
          <tr>
            <th>电费</th>
            <th><?=$rowdf[11].'元'?></th>
          </tr> 
          <tr>
            <td>是否缴费</td>
            <td><?=$rowdf[16]?></td>
          </tr>
          <tr>
            <td>抄表时间</td>
            <td><?=$rowdf[12]?></td>
          </tr>
          <tr>
            <td>用电量</td>
            <td><?=$rowdf[7]?></td>
          </tr>
          <tr>
            <td>超额量</td>
            <td><?=$rowdf[9]?></td>
          </tr>
          <tr>
            <td>电价</td>
            <td><?=$rowdf[10].'元'?></td>
          </tr>
        </table>
        
      </div>
      <!--历史-->
      <div class="layui-col-md4 layui-col-md-offset5" style=" padding-top: 60px;">
          
          <form class="layui-form" name="elef" id="elef" action="ele_index.php" method="get">
            <div class="layui-form-item">
              <label class="layui-form-label" style="font-size: 20px;">历史</label>
                <div class="layui-input-block">
                  <input type="text"  class="layui-input" required  lay-verify="required" placeholder="请选择日期" autocomplete="off" name="lst" id="lst" value="<?=$_GET['lst']?>">
                </div>
              </div>
          </form>
          

      </div>
    <?
      }
      else
      {
        ?>
          <script type="text/javascript">
            $(document).ready(function(e) {
              layui.use('layer', function(){
                var layer = layui.layer;
                  layer.confirm('<center>管理还未上传本月电费<br>您可以前往查看历史电费</center>', {
                  btn: ['前往|·_·)','菜单'],
                  title: false,
                  btnAlign: 'c',
                  closeBtn: 0,
                }, function(){
                  location.href="elere_index.php";
                },function(){
                    <?
                    if($_SESSION['utype']=="教师")
                    {
                    ?>
                      location.href="../../tea_i.php";
                    <?
                    }
                    else
                    {
                    ?>
                      location.href="../../stu_i.php";
                    <?
                    }
                    ?>
                  
                  });
                });
                
              });
          </script>
        <?
      }
    ?>
  </div>
</div>

<script>
layui.use('element', function(){
  var element = layui.element;	
});

layui.use('form', function(){
  var form = layui.form;
  
});

layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  laydate.render({
    elem: '#lst'
    ,type: 'month'
    ,theme: '#393D49'
    ,done: function(value, date){
      location.href="ele_index.php?lst="+value;
    }//选中后提交
  });
});

</script>

<script src="js/main.js"></script> <!-- 轮播 -->
</body>
</html>