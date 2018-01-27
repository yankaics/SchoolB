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
    <div class="layui-col-md6 layui-col-md-offset3">
      <blockquote class="layui-elem-quote">
          <p>电费缴费</p>
          <p>选择操作的电费日期（电费上传的日期）</p>
          <p>确认该寝室已经缴费之后再标记为<已缴费></p>
          <p style="color:#FF5722;">已经标记了<已缴费>的寝室，就不能撤销，操作时一定注意。</p>

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
        //人员楼号
        if($_SESSION['cg']==1 || $_SESSION['cg']==2)
        {
          $lh="所有楼层";
        }
        else if($_SESSION['zw']=='宿管')
        {
          $lh=$_SESSION['poi'];
        }
        //总费用以及未缴费总和
        if($_SESSION['cg']==1 || $_SESSION['cg']==2)
        {
          $sumsql="select sum(sushe_money) from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."'";
          $sumwjf="select sum(sushe_money) from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_jg='未缴费'";
          $summoney=mysql_query($sumsql,$con);
          if($rowsum=mysql_fetch_row($summoney))
          {
            $sumall=$rowsum[0];
          }
          else
          {
            $sumall='0';
          }
          $sumwjf=mysql_query($sumwjf,$con);
          if($rowwjf=mysql_fetch_row($sumwjf))
          {
            $wjfs=$rowwjf[0];
          }
          else
          {
            $sumall='0';
          }
        }
        else if($_SESSION['zw']=='宿管')
        {
          $sumsql="select sum(sushe_money) from sushe_user where sushe_name='".$_SESSION['poi']."' and sushe_Y='".$Y."' and sushe_m='".$m."'";
          $sumwjf="select sum(sushe_money) from sushe_user where sushe_name='".$_SESSION['poi']."' and sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_jg='未缴费'";
          if($rowsum=mysql_fetch_row($summoney))
          {
            $sumall=$rowsum[0];
          }
          else
          {
            $sumall='0';
          }
          $sumwjf=mysql_query($sumwjf,$con);
          if($rowwjf=mysql_fetch_row($sumwjf))
          {
            $wjfs=$rowwjf[0];
          }
          else
          {
            $sumall='0';
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
                <th>未缴费</th>
              </tr> 
            </thead>
            <tbody>
              <tr>
                <td><?=$Y?>年<?=$m?>月</td>
                <td><?=$lh?>号楼</td>
                <td><?=$sumall?>元</td>
                <td><?=$sumall?>元</td>
              </tr>
              <tr>
                <td colspan="4">
                  <!--宿舍查询-->
                  <form id="form1" class="layui-form" name="form1" method="post" action="">
                    <div class="layui-form-item">
                      <label class="layui-form-label">寝室号：</label>
                      <div class="layui-input-inline">
                        <input type="text" name="tkey" id="tkey" placeholder="请输入寝室号" autocomplete="off" class="layui-input">
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
          <!--缴费数据-->
          <form action="" class="layui-form" name="admin" method="post">
            <table lay-filter="elepay" border="1" class="layui-table" cellspacing="0" cellpadding="10">
              <tr class="top">
                <td align="center" lay-data="{field:'cz', width:100}">操作</td>
                <td align="center" lay-data="{field:'qsh', width:100}">寝室号</td>
                <td align="center" lay-data="{field:'df', width:100}">电费</td>
                <td align="center" lay-data="{field:'ydl', width:100}">用电量</td>
                <td align="center" lay-data="{field:'del', width:100}">定额量</td>
                <td align="center" lay-data="{field:'cel', width:100}">超额量</td>
                <td align="center" lay-data="{field:'dj', width:100}">电价</td>
                <td align="center" lay-data="{field:'xq', width:100}">是否缴费</td>
              </tr>
              <?
              if($_SESSION['cg']==1 || $_SESSION['cg']==2)
              {
                if(isset($_POST['wjf']))
                {
                  $sql="select * from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_jg='未缴费' order by sushe_dor limit 10";
                }
                else
                {
                  if(isset($_POST['yjf']))
                  {
                    $sql="select * from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_jg='已缴费' order by sushe_dor limit 10";
                  }
                  else
                  {
                    if(isset($_POST['button3']))
                    {
                      $sql="select * from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_dor like '%".$_POST['tkey']."%' order by sushe_dor limit 10";
                    }
                    else
                    {
                      $sql="select * from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' order by sushe_dor";
                    }
                  }
                }
              }
              else
              {
                if(isset($_POST['wjf']))
                {
                  $sql="select * from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_name='".$_SESSION['poi']."' and sushe_jg='未缴费' order by sushe_dor";
                }
                else
                {
                  if(isset($_POST['yjf']))
                  {
                    $sql="select * from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_name='".$_SESSION['poi']."' and sushe_jg='已缴费' order by sushe_dor";
                  }
                  else
                  {
                    if(isset($_POST['button3']))
                    {
                      $sql="select * from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_name='".$_SESSION['poi']."' and sushe_dor like '%".$_POST['tkey']."%' order by sushe_dor";
                    }
                    else
                    {
                      $sql="select * from sushe_user where sushe_Y='".$Y."' and sushe_m='".$m."' and sushe_name='".$_SESSION['poi']."' order by sushe_dor";
                    
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
                  }
                  else
                  {
                  ?>
                    <a onclick="return confirm('确定标记为<已缴费>？寝室：<?=$row[2]?> 电费：<?=$row[11]?>');" href="updatejg_index.php?m=<?=$row[2]?>"><button type="button" name="button" class="btn btn-default">已缴费</button></a>
                  <?
                  }
                  ?>
                    <a href="dormp.php?dorm=<?=$row[2]?>&sadminY=<?=$Y?>&sadminm=<?=$m?>"><button type="button" name="button" class="btn btn-default">详情</button></a>
                </td>
                <td align="center" class="qs"><?=$row[2]?></td>
                <td align="center"><?=$row[11]?>元</td>
                <td align="center"><?=$row[7]?></td>
                <td align="center"><?=$row[8]?></td>
                <td align="center"><?=$row[9]?></td>
                <td align="center"><?=$row[10]?></td>
                <td align="center"><?=$row[16]?></td>
              </tr>
            <?
            }
            ?>
             
            </table>
          </form>
      <?
        }
      ?>

    </div>

  </div>
</div> 

<script>
layui.use('form', function(){
  var form = layui.form;

});

//时间
document.getElementById("sadminY").value = "<?=$_GET['sadminY']?>";
document.getElementById("sadminm").value = "<?=$_GET['sadminm']?>";
</script>

</body>
</html>