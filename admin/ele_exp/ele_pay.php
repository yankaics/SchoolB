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
  <title>电费缴费</title>
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
    <!--日期选择操作-->
    <div class="layui-col-md12">
      <blockquote class="layui-elem-quote">
          <p>电费缴费</p>
          <p>选择操作的电费日期（电费上传的日期）</p>
          <p>输入寝室号查询后操作</p>
          <p>确认该寝室已经缴费之后再标记为<已缴费></p>
          <p style="color:#FF5722;">已经标记了<已缴费>的寝室，【只能退款一次】，操作时一定注意。</p>

          <form class="layui-form" action="" name="admin" method="get">
          <div class="layui-inline">
            <select name="sadminY" id="sadminY" lay-verify="required">
              <?
              for($j=2017;$j<=$rqY;$j++)
              {
              ?>
                <option value="<?=$j?>"><?=$j?>年</option>
              <?
              }
              ?>
            </select>
          </div>
          
          <div class="layui-inline">
            <select name="sadminm" id="sadminm" lay-verify="required">
              <?
              for($i=1;$i<=12;$i++)
              {
              ?>
                <option value="<?=$i?>"><?=$i?>月</option>
              <?
              }
              ?>
            </select>
          </div>
          
          <div class="layui-inline">
              <button class="layui-btn" name="button" id="button" lay-submit lay-filter="form">操作</button>
          </div>

        </form>
      </blockquote>
      

    </div>
    <!--内容操作-->
    <div class="layui-col-md12">
      <?
      if(isset($_GET['button']))
      {
        //时间
        $Y=$_GET['sadminY'];
        $_SESSION['Y']=$Y;
        $m=$_GET['sadminm'];
        $_SESSION['m']=$m;
        $YM=$Y."-".$m;
        //人员楼号
        if($_SESSION['cg']==1 || $_SESSION['cg']==2)
        {
          $lh="所有楼层";
        }
        else if($_SESSION['zw']=='宿管员')
        {
          $lh=$_SESSION['poi'];
        }
        //总费用，未缴费总和未缴费寝室总数，已缴费寝室总数
        if($_SESSION['cg']==1 || $_SESSION['cg']==2)
        {
          $sumsql="select sum(sushe_money),count(user_id) from sushe_user where sushe_Y='".$YM."'";
          $sumwjf="select sum(sushe_money),count(user_id) from sushe_user where sushe_Y='".$YM."' and sushe_jg='未缴费'";
          $summoney=mysql_query($sumsql,$con);
          if($rowsum=mysql_fetch_row($summoney))
          {
            $sumall=$rowsum[0]; //总费用
            $call=$rowsum[1]; //总寝室
          }
          else
          {
            $sumall='0';
            $call='0';
          }
          $sumwjf=mysql_query($sumwjf,$con);
          if($rowwjf=mysql_fetch_row($sumwjf))
          {
            $wjfs=$rowwjf[0]; //未缴费
            $cwjf=$rowwjf[1]; //未缴费寝室总数
          }
          else
          {
            $wjfs='0';
            $cwjf='0';
          }
        }
        else if($_SESSION['zw']=='宿管员')
        {
          $sumsql="select sum(sushe_money),count(user_id) from sushe_user where sushe_name='".$_SESSION['poi']."' and sushe_Y='".$YM."'";
          $sumwjf="select sum(sushe_money),count(user_id) from sushe_user where sushe_name='".$_SESSION['poi']."' and sushe_Y='".$YM."' and sushe_jg='未缴费'";
          $summoney=mysql_query($sumsql,$con);
          if($rowsum=mysql_fetch_row($summoney))
          {
            $sumall=$rowsum[0]; //总费用
            $call=$rowsum[1]; //总寝室
          }
          else
          {
            $sumall='0';
            $call='0';
          }
          $sumwjf=mysql_query($sumwjf,$con);
          if($rowwjf=mysql_fetch_row($sumwjf))
          {
            $wjfs=$rowwjf[0]; //未缴费
            $cwjf=$rowwjf[1]; //未缴费寝室总数
          }
          else
          {
            $wjfs='0';
            $cwjf='0';
          }
        }
        else
          echo "你木有权限";
        ?>
          <table class="layui-table">
            <colgroup>
              <col>
              <col>
              <col>
              <col>
            </colgroup>
            <thead>
              <tr>
                <th>时间</th>
                <th>楼号</th>
                <th>总费用</th>
                <th>寝室总数</th>
                <th>未缴费</th>
                <th>未缴费寝室总数</th>
              </tr> 
            </thead>
            <tbody>
              <tr >
                <td><?=$Y?>年<?=$m?>月</td>
                <td><?=$lh?>号楼</td>
                <td><?=$sumall?>元</td>
                <td><?=$call?>间</td>
                <td><?=$wjfs?>元</td>
                <td><?=$cwjf?>间</td>
              </tr>
              <tr>
                <td colspan="6">
                  <!--宿舍查询-->
                  <form id="form1" class="layui-form" name="form1" method="post" action="">
                    <div class="layui-form-item">
                      <label class="layui-form-label">寝室号：</label>
                      <div class="layui-input-inline">
                        <input type="text" name="tkey" id="tkey" placeholder="请输入寝室号" autocomplete="off" class="layui-input" value="<?=$_POST['tkey']?>">
                      </div>
                      <div class="layui-inline">
                          <button class="layui-btn" name="button3" id="button3" lay-submit lay-filter="form">查询</button>
                      </div>
                      <div class="layui-inline">
                          <button class="layui-btn" name="yjf" id="button3" lay-submit lay-filter="form">已缴费</button>
                      </div>
                      <div class="layui-inline">
                          <button class="layui-btn" name="wjf" id="button3" lay-submit lay-filter="form">未缴费</button>
                      </div>
                    </div>
                  </form>
                </td>
              </tr>
            </tbody>
          </table>
          <?
            if(isset($_POST['tkey']))
            {
          ?>
          <!--缴费数据-->
          <form action="" class="layui-form" name="admin" method="post">
            <table lay-filter="elepay" border="1" class="layui-table" cellspacing="0" cellpadding="10">
              <tr class="top">
                <td align="center">操作</td>
                <td align="center" style="color:#FF5722;">寝室号</td>
                <td align="center" style="color:#FF5722;">电费</td>
                <td align="center">用电量</td>
                <td align="center">定额量</td>
                <td align="center">超额量</td>
                <td align="center">电价</td>
                <td align="center">抄表时间</td>
                <td align="center" style="color:#FF5722;">是否缴费</td>
              </tr>
              <?
              if($_SESSION['cg']==1 || $_SESSION['cg']==2)
              {
                if(isset($_POST['wjf']))
                {
                  $sql="select * from sushe_user where sushe_Y='".$YM."' and sushe_jg='未缴费' order by sushe_dor";
                }
                else
                {
                  if(isset($_POST['yjf']))
                  {
                    $sql="select * from sushe_user where sushe_Y='".$YM."' and sushe_jg='已缴费' order by sushe_dor";
                  }
                  else
                  {
                    if(isset($_POST['button3']))
                    {
                      $sql="select * from sushe_user where sushe_Y='".$YM."' and sushe_dor='".$_POST['tkey']."' order by sushe_dor";
                    }
                    else
                    {
                      $jg="";
                    }
                  }
                }
              }
              else
              {
                if(isset($_POST['wjf']))
                {
                  $sql="select * from sushe_user where sushe_Y='".$YM."' and sushe_name='".$_SESSION['poi']."' and sushe_jg='未缴费' order by sushe_dor";
                }
                else
                {
                  if(isset($_POST['yjf']))
                  {
                    $sql="select * from sushe_user where sushe_Y='".$YM."' and sushe_name='".$_SESSION['poi']."' and sushe_jg='已缴费' order by sushe_dor";
                  }
                  else
                  {
                    if(isset($_POST['button3']))
                    {
                      $sql="select * from sushe_user where sushe_Y='".$YM."' and sushe_name='".$_SESSION['poi']."' and sushe_dor='".$_POST['tkey']."' order by sushe_dor";
                    }
                    else
                    {
                      $jg="";
                    
                    }
                  }
                }
              }
            $rs=mysql_query($sql,$con);
            while($row=mysql_fetch_row($rs))
            {
            ?>
               <tr>
                <td class="qsbh" align="center">
                  <?
                  if($row[16]=='已缴费')
                  {
                    echo "已缴费";
                    if($row[15]!="已退款" && $row[15]!="已上缴")
                    {
                    ?>
                      <a href="javascript:;" class="tk_pay<?=$row[2]?>"><button type="button" name="button" class="layui-btn layui-btn-danger">退款</button></a>
                      <script type="text/javascript">
                        $(document).ready(function(e) {
                          $(".tk_pay<?=$row[2]?>").click(function(e) {
                            layui.use('layer', function(){
                              var layer = layui.layer;
                              parent.layer.confirm('<center><div style="color:#FF5722;">确定退款（只有一次）？将会标记为【未缴费】！</div><br>寝室：<?=$row[2]?> 电费：<?=$row[11]?></center>', {
                                btn: ['确定','取消'],
                                title: false,
                                btnAlign: 'c',
                                closeBtn: 0,
                              }, function(){
                                parent.layer.closeAll();
                                //因为是parent 所以需要再次进入文件夹访问
                                location.href="../ele_exp/ele_payok.php?mtk=<?=$row[2]?>";

                              },function(){
                                
                                 });
                            });
                          });
                        });
                      </script>
                    <?
                    }
                    else
                    {
                      ?>
                      <a href="javascript:;" onclick="consay('只能退款一次或已轧账')"><button type="button" name="button" class="layui-btn layui-btn-disabled">退款</button></a>
                      <?
                    }
                  }
                  else
                  {
                  ?>
                    <a class="yjf_pay<?=$row[2]?>"><button type="button" name="button" class="layui-btn">缴费</button></a>
                    <script type="text/javascript">
                      $(document).ready(function(e) {
                        $(".yjf_pay<?=$row[2]?>").click(function(e) {
                          layui.use('layer', function(){
                            var layer = layui.layer;
                            parent.layer.confirm('<center>确定标记为<已缴费>？寝室：<?=$row[2]?> 电费：<?=$row[11]?></center>', {
                              btn: ['确定','取消'],
                              title: false,
                              btnAlign: 'c',
                              closeBtn: 0,
                            }, function(){
                              parent.layer.closeAll();
                              //因为是parent 所以需要再次进入文件夹访问
                              location.href="../ele_exp/ele_payok.php?m=<?=$row[2]?>";

                            },function(){
                              
                               });
                          });
                        });
                      });
                    </script>
                  <?
                  }
                  ?>
                     <button type="button" onclick="consay('<? 
          $sqlrea="select * from sch_stub where tdorm='".$row[2]."' and tjg='在校' group by tno order by tno desc limit 8";
        $rsrea=mysql_query($sqlrea,$con);
        while($rowrea=mysql_fetch_row($rsrea))
        {
          if(substr($rowrea[7],0,1)!=0)
          {
            echo "学号：".$rowrea[7];
            echo " - 姓名：".$rowrea[1]."<br>";
          }
        }
        $sqlr="select distinct * from sch_stub where tdorm='".$row[2]."' and tno like '0%' and tjg='在校' group by tno order by tno desc limit 8";
        $rsr=mysql_query($sqlr,$con);
        while($rowr=mysql_fetch_row($rsr))
        {
            echo "报名号：".$rowr[7];
            echo " - 姓名：".$rowr[1]."<br>";
        }
        ?>')" name="button" class="layui-btn">人员</button>

                </td>
                <td align="center" style="color:#FF5722;"><?=$row[2]?></td>
                <td align="center" style="color:#FF5722;"><?=$row[11]?>元</td>
                <td align="center"><?=$row[7]?></td>
                <td align="center"><?=$row[8]?></td>
                <td align="center"><?=$row[9]?></td>
                <td align="center"><?=$row[10]?></td>
                <td align="center"><?=$row[12]?></td>
                <td align="center" style="color:#FF5722;"><?=$row[16]?></td>
              </tr>
            <?
            }
              //没有数据时显示
              $rs=mysql_query($sql,$con);
              if(!$row=mysql_fetch_row($rs))
                echo "<center>没有查询到该寝室或没有数据</center>";
            ?>
             
            </table>
          </form>
      <?
            }
        }
      ?>

    </div>

  </div>
</div> 

<script>
layui.use('form', function(){
  var form = layui.form;

});

</script>
<?
//日期判断
if(isset($_GET['button']))
{
?>
  <script type="text/javascript">
    document.getElementById("sadminY").value = "<?=$_GET['sadminY']?>";
    document.getElementById("sadminm").value = "<?=$_GET['sadminm']?>";
  </script>
<?
}
else
{
?>
  <script type="text/javascript">
    document.getElementById("sadminY").value = "<?=$rqY?>";
    document.getElementById("sadminm").value = "<?=$rqm?>";
  </script>
<?
}
?>
<script type="text/javascript">
  //询问框
  //tnr=内容
  function consay(tnr)
  {
    layui.use('layer', function(){
      var layer = layui.layer;

      parent.layer.confirm(tnr, {
        btn: ['关闭'] //按钮
        ,title:false
        ,shadeClose:true
      },function(){
        parent.layer.closeAll();
      });
    }); 
  }
</script>
</body>
</html>