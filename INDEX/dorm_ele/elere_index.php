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
<title>宿舍水电</title>
</head>
<body  bgcolor="#F0F0F0">

<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/logo-32-t.png"></div>
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
  	
    <?
      $dorm=$_SESSION['tdorm']; //寝室
      //木有寝室的
      if(!is_numeric($dorm) || strlen($dorm) != 4) 
      {
        ?>
        <script type="text/javascript">
          $(document).ready(function(e) {
              layui.use('layer', function(){
                var layer = layui.layer;
                  layer.confirm('<center>你目前没有寝室或未录入<br>有疑问请咨询辅导员</center>', {
                  btn: ['菜单|·_·)'],
                  title: false,
                  btnAlign: 'c',
                  closeBtn: 0,
                }, function(){
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
        die();
      }
      ?>
      <!--历史-->
      <div class="layui-col-md4 layui-col-md-offset5" style=" padding-top: 60px;">
          <?
          if(isset($_POST['lst']))
          {
            $lstt=$_POST['lst'];
          }
          else
          {
            $lstt=$rqY.'-'.$rqmm;
          }
          ?>
          <form class="layui-form" name="elef" id="elef" action="" method="post">
            <div class="layui-form-item">
              <label class="layui-form-label" style="font-size: 20px;">历史</label>
                <div class="layui-input-inline">
                  <input type="text"  class="layui-input" required  lay-verify="required" placeholder="请选择日期" readonly autocomplete="off" name="lst" id="lst" value="<?=$lstt?>">
                </div>
              </div>
          </form>
          <?
            if(isset($_POST['lst']))
            {
              if(substr($lstt,-2,1)==0)
              {
                $lstrqm=substr($lstt,-1,1); //月
                $lstrqY=substr($lstt,0,4); //年
              }
              else
              {
                $lstrqm=substr($lstt,-1,2);
                $lstrqY=substr($lstt,0,4);
              }
              $cxsql="select * from sushe_user where sushe_dor='".$dorm."' and sushe_Y='".$lstrqY."' and sushe_m='".$lstrqm."'";
              $cxrs=mysql_query($cxsql,$con);
              if($cxrow=mysql_fetch_row($cxrs))
              {
          ?>
                <!--历史详情-->
                <table class="layui-table">
                  <tr>
                    <th>电费</th>
                    <th><?=$cxrow[11].'元'?></th>
                  </tr> 
                  <tr>
                    <td>是否缴费</td>
                    <td><?=$cxrow[16]?></td>
                  </tr>
                  <tr>
                    <td>抄表时间</td>
                    <td><?=$cxrow[12]?></td>
                  </tr>
                  <tr>
                    <td>用电量</td>
                    <td><?=$cxrow[7]?></td>
                  </tr>
                  <tr>
                    <td>超额量</td>
                    <td><?=$cxrow[9]?></td>
                  </tr>
                  <tr>
                    <td>电价</td>
                    <td><?=$cxrow[10].'元'?></td>
                  </tr>
                </table>
          <?
              }
              else
              {
                echo "<center>无数据</center>";
              }
            }
          ?>

      </div>
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
      $('#lst').val(value);
      $("#elef").submit();
    }//选中后提交
  });
});

</script>

</body>
</html>