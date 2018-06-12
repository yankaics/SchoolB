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
  <title>轧账管理</title>
</head>
<body>
<?
  include("../../PHP/riqi.php");
  include("../../SQL/db/db.php");
  include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
?>
<!--main-->
<div class="layui-container">
  <div class="layui-row">
    <!--提示-->
    <div class="layui-col-md12">
      <blockquote class="layui-elem-quote">
        <h3>收款轧账</h3>
        <p>扎帐主要针对水电费用，宿管员上缴财务前进行扎帐工作，只能扎帐当前账号收缴的费用</p>
        <p>第一步：查看【需要上缴】的费用总额，并清点好费用</p>
        <p>第二步：清点完整后，点击【开始轧账】</p>

      </blockquote>
    </div>
    
    <div class="layui-col-md12">
      <!--需要轧账的费用显示-->
      <?php
      //需要轧账的费用
      function cmoney()
      {
        global $con;
        $sqlsk="select sum(s_money) from sch_dfre where s_accounts='未轧账' and s_username='".$_SESSION['id']."' and s_nameid='收款'";
        $rssk=mysql_query($sqlsk,$con);
        if($rowsk=mysql_fetch_row($rssk))
        {
          if($rowsk[0]!=0)
          {
            $ssk=$rowsk[0];
          }
          else
          {
            $ssk=0;
          }
          
        }
        $sqltk="select sum(s_money) from sch_dfre where s_accounts='未轧账' and s_username='".$_SESSION['id']."' and s_nameid='退款'";
        $rstk=mysql_query($sqltk,$con);
        if($rowtk=mysql_fetch_row($rstk))
        {
          if($rowtk[0]!=0)
          {
            $stk=$rowtk[0];
          }
          else
          {
            $stk=0;
          }

        }
        $cmoney=bcsub($ssk,$stk,2);//相减保留两位小数
        return $cmoney;
      }
      ?>
      <h1 align="center" style="margin:20px;">需要上缴：<?=cmoney();?>元</h1>
      <div align="center" style="margin:20px;"><button class="startzz layui-btn layui-btn-lg layui-btn-radius layui-btn-danger">开始轧账</button></div>
      <script type="text/javascript">
        $(document).ready(function(e) {
          $(".startzz").click(function(e) {
            layui.use('layer', function(){
              var layer = layui.layer;
              parent.layer.confirm('<center>确定开始轧账？上缴：<?=cmoney();?>元</center>', {
                btn: ['确定','取消'],
                title: false,
                btnAlign: 'c',
                closeBtn: 0,
              }, function(){
                parent.layer.msg('正在轧账……', {
                  title: false,
                  closeBtn: 0,
                  time:1000,
                  maxWidth:200,
                  anim: 0,
                  offset: '240px',
                });
                //因为是parent 所以需要再次进入文件夹访问
                setTimeout(function () {
                  location.href="../ele_exp/ele_accounts.php?startzz=<?=cmoney();?>";
                },1000);

              },function(){
                
                 });
            });
          });
        });
      </script>
    </div>
    
    <div class="layui-col-md4">
      
    </div>
    <div class="layui-col-md4">
    
    </div>
    <div class="layui-col-md4">
     
    </div>

  </div>
</div>



<?php
//轧账
if(isset($_GET['startzz']))
{
  //操作日期
  $settime=$rqY."-".$rqm."-".$rqd."-".$rqH.":".$rqi.":".$rqs;
  $szz=$_GET['startzz'];
  if($szz>0)
  {
    $sqly="update sch_dfre set s_accounts='已轧账',s_acctime='".$settime."' where s_username='".$_SESSION['id']."' and s_accounts='未轧账'";
    $rsy=mysql_query($sqly,$con);
    if($rsy>0)
    {
      $sqlu="insert into sch_dfre_re(s_username,s_money,s_acctime) values('".$_SESSION['id']."','".$szz."','".$settime."')";
      $rsu=mysql_query($sqlu,$con);
      if($rsu>0)
      {
        $sqls="select * from sch_dfre where s_username='".$_SESSION['id']."' and s_accounts='已轧账' and s_acctime='".$settime."' order by sid asc";
        $rss=mysql_query($sqls,$con);
        while($rows=mysql_fetch_row($rss))
        {
          if($rows[3]=="收款")
            {
              $sqll="update sch_dfre as a,sushe_user as b set b.sushe_m='已上缴' where b.sushe_dor='".$rows[4]."' and b.sushe_Y='".$rows[6]."' and b.sushe_money='".$rows[5]."'";
              $rsl=mysql_query($sqll,$con);

            }
            if($rows[3]=="退款")
            {
              $sql2="update sch_dfre as a,sushe_user as b set b.sushe_m='已退款' where b.sushe_dor='".$rows[4]."' and b.sushe_Y='".$rows[6]."' and b.sushe_money='".$rows[5]."'";
              $rs2=mysql_query($sql2,$con);
              
            }
          
        }

          ?>
          <script type="text/javascript">
            $(document).ready(function(e) {
              layui.use('layer', function(){
                  var layer = layui.layer;
                parent.layer.msg('轧账成功<br><?=$settime?>', {
                  title: false,
                  closeBtn: 0,
                  time:2000,
                  maxWidth:200,
                  anim: 0,
                  offset: '320px',
                });
                
              });
            });
            location.href="../ele_exp/ele_accounts.php";
          </script>
          <?

      }
      else
      {
        ?>
        <script type="text/javascript">
          $(document).ready(function(e) {
            layui.use('layer', function(){
                var layer = layui.layer;
              parent.layer.msg('轧账失败#1', {
                title: false,
                closeBtn: 0,
                time:2000,
                maxWidth:200,
                anim: 0,
                offset: '240px',
              });
              
            });
          });
          location.href="../ele_exp/ele_accounts.php";
        </script>
        <?
      }
    }
    else
    {
      ?>
      <script type="text/javascript">
        $(document).ready(function(e) {
          layui.use('layer', function(){
              var layer = layui.layer;
            parent.layer.msg('轧账失败', {
              title: false,
              closeBtn: 0,
              time:2000,
              maxWidth:200,
              anim: 0,
              offset: '240px',
            });
            
          });
        });
        location.href="../ele_exp/ele_accounts.php";
      </script>
      <?
    }

  }
  else
  {
    ?>
    <script type="text/javascript">
      $(document).ready(function(e) {
        layui.use('layer', function(){
            var layer = layui.layer;
          parent.layer.msg('该金额不能轧账', {
            title: false,
            closeBtn: 0,
            time:2000,
            maxWidth:200,
            anim: 0,
            offset: '240px',
          });
          
        });
      });
      location.href="../ele_exp/ele_accounts.php";
    </script>
    <?
  }
}
?>

</body>
</html>