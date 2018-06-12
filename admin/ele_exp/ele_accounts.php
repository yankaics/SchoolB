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
                
                //因为是parent 所以需要再次进入文件夹访问
                location.href="../ele_exp/ele_accounts.php?startzz=<?=cmoney();?>";

              },function(){
                
                 });
            });
          });
        });
      </script>
    </div>
    <!--轧账详情显示-->
    <div class="layui-row layui-col-space20" style="margin-top: 40px;">
      <div class="layui-col-md6">
        <blockquote class="layui-elem-quote">
          <h3>轧账记录（最近五条）</h3>
        </blockquote>
        
          <table class="layui-table">
            <colgroup>
              <col>
              <col>
              <col>
            </colgroup>
            <thead>
              <tr>
                <th>轧账金额</th>
                <th>轧账时间</th>
                <th>查看</th>
              </tr> 
            </thead>
            <tbody>
            <?php
            //记录显示5条
            $sqlre="select * from sch_dfre_re where s_username='".$_SESSION['id']."' order by s_acctime desc limit 5";
            $rsre=mysql_query($sqlre,$con);
            while($rowre=mysql_fetch_row($rsre))
            {
              ?>
              <tr>
                <td><?=$rowre[2]?></td>
                <td><?=$rowre[3]?></td>
                <td>
                  <button type="button" onclick="consay('<? 
                  $sqlrea="select * from sch_dfre where s_username='".$_SESSION[id]."' and s_acctime='".$rowre[3]."'";
                  $rsrea=mysql_query($sqlrea,$con);
                  echo '<table width=600px><tr><th>寝室</th><th>金额</th><th>状态</th><th>收款时间</th></tr>';
                  while($rowrea=mysql_fetch_row($rsrea))
                  {
                    if(substr($rowrea[7],0,1)!=0)
                    {
                      echo "<tr><th>".$rowrea[4]."</th><th>".$rowrea[5]."</th><th>".$rowrea[3]."</th><th>".$rowrea[7]."</th></tr>";
                    }
                  }
                  echo "</table>";
                  ?>')" name="button" class="layui-btn">详情</button>
                </td>
              </tr>
              <?
            }
            ?>
            </tbody>
          </table>
          
      </div>
      <div class="layui-col-md6">
        <blockquote class="layui-elem-quote">
          <h3>轧账记录查询（按轧账年月份查询）</h3>
          <!--时间-->
          <form name="timef" id="elef" class="layui-form layui-form-pane" action="" method="post" onSubmit="return checktime()" style="margin-top: 20px;">
            <?
              if(isset($_POST['timesql']))
              {
                $lstt=$_POST['timesql'];
              }
              else
              {
                $lstt=$rqY.'-'.$rqm;
              }
              
            ?>
            <div class="layui-form-item">
              <label class="layui-form-label">日期</label>
              <div class="layui-input-inline">
                <input type="text"  class="layui-input" required  lay-verify="required" placeholder="请选择日期" readonly autocomplete="off" name="timesql" id="timetext" value="<?=$lstt?>">
              </div>
            
            </div>
          
          </form>
        </blockquote>
        <?php

          if(isset($_POST['timesql']))
          {
            ?>
            
            <?
            $sqluc="select * from sch_dfre_re where s_username='".$_SESSION[id]."' and s_acctime>='".$_POST['timesql']."-00:00:00' and s_acctime<='".$_POST['timesql']."-23:59:59' order by s_acctime desc";
            $rsuc=mysql_query($sqluc,$con);
            $rsuct=mysql_query($sqluc,$con);
            if($rowuct=mysql_fetch_row($rsuct))
            {
              ?>
              <table class="layui-table">
              <colgroup>
                <col>
                <col>
                <col>
              </colgroup>
              <thead>
                <tr>
                  <th>轧账金额</th>
                  <th>轧账时间</th>
                  <th>查看</th>
                </tr> 
              </thead>
              <tbody>
              <?
              while($rowuc=mysql_fetch_row($rsuc))
              {
              ?>
              <tr>
                <td><?=$rowuc[2]?></td>
                <td><?=$rowuc[3]?></td>
                <td>
                  <button type="button" onclick="consay('<? 
                  $sqlrea="select * from sch_dfre where s_username='".$_SESSION[id]."' and s_acctime='".$rowuc[3]."'";
                  $rsrea=mysql_query($sqlrea,$con);
                  echo '<table width=600px><tr><th>寝室</th><th>金额</th><th>状态</th><th>收款时间</th></tr>';
                  while($rowrea=mysql_fetch_row($rsrea))
                  {
                    if(substr($rowrea[7],0,1)!=0)
                    {
                      echo "<tr><th>".$rowrea[4]."</th><th>".$rowrea[5]."</th><th>".$rowrea[3]."</th><th>".$rowrea[7]."</th></tr>";
                    }
                  }
                  echo "</table>";
                  ?>')" name="button" class="layui-btn">详情</button>
                </td>
              </tr>
              <?
              }
            }
            else
            {
              ?>
              <script>
              $(document).ready(function(e) {
                    layui.use('layer', function(){
                    var layer = layui.layer;
                    parent.layer.msg('当前日期无记录(｡・`ω´･)', {
                    time: 2000,
                    area: ['240px','50px'],
                    });
                });
              });
              </script>
              <?
            }
            
            ?>
              </tbody>
            </table>
            <?
          }

        ?>

      </div>
      
    </div>


  </div>
</div>

<?php
//轧账
if(isset($_GET['startzz']))
{
  ?>
  <script type="text/javascript">
    $(document).ready(function(e) {
      layui.use('layer', function(){
        var layer = layui.layer;
        parent.layer.msg('正在轧账中……', {
          title: false,
          closeBtn: 0,
          time:10000,
          maxWidth:200,
          anim: 0,
          offset: '240px',
        });
      });
    });
    
  </script>
  <?
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

<script type="text/javascript">
  layui.use('laydate', function(){
    var laydate = layui.laydate;
    
    laydate.render({
      elem: '#timetext'
      ,type: 'month'
      ,format: 'yyyy-M'
      ,theme: '#393D49'
      ,done: function(value, date){
        $('#timetext').val(value);
        $("#elef").submit();
      }//选中后提交
    });
  });
  //询问框
  //tnr=内容
  function consay(tnr)
  {
    layui.use('layer', function(){
      var layer = layui.layer;
      parent.layer.open({
        type: 1,
        title:'轧账详情记录',
        closeBtn: 1, //不显示关闭按钮
        anim: 0,
        area:['600px','300px'],
        shadeClose: true, //开启遮罩关闭
        content: tnr
      });

    }); 
  }

  function checktime()
  {
    if(timef.timesql.value=="")
    {
      $(document).ready(function(e) {
              layui.use('layer', function(){
              var layer = layui.layer;
            layer.msg('点击选择时间(｡・`ω´･)', {
            time: 2000,
            area: ['240px','50px'],
            });
          });
        });
        return false;
    }
  }

  //防止页面后退
  history.pushState(null, null, document.URL);
  window.addEventListener('popstate', function () {
      history.pushState(null, null, document.URL);
  });
</script>
</body>
</html>