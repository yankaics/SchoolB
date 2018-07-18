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
  <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
  <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
  <script src="../../bootstrap/js/bootstrap.min.js"></script>
  <title>报修状态查询</title>
  <!-- <link media="(max-width:650px)" href="../../CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
  <link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
  <link media="(min-width:500px)" href="../../CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
  <link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" /> -->
  <style type="text/css">
    a:link {
    	text-decoration: none;
    }
    a:visited {
    	text-decoration: none;
    }
    a:hover {
    	text-decoration: underline;
    }
    a:active {
    	text-decoration: none;
    }
    body{ 
      
      margin:10px;
    }
  </style>

  <script type="text/javascript">
    function Trim(strValue) 
    { 
      //return strValue.replace(/^s*|s*$/g,""); 
      return strValue;  
    }

    function SetCookie(sName,sValue) 
    { 
      document.cookie = sName + "=" + escape(sValue); 
    } 

    function GetCookie(sName) 
    { 
      var aCookie = document.cookie.split(";"); 
      for(var　i=0;　i　< aCookie.length;　i++) 
      { 
        var aCrumb = aCookie[i].split("="); 
        if(sName　== Trim(aCrumb[0])) 
        { 
          return unescape(aCrumb[1]); 
        } 
      } 

    　　return null; 
    } 

    function scrollback() 
    { 
      if(GetCookie("scroll")!=null){document.body.scrollTop=GetCookie("scroll")} 
    } 
  </script>

  <script language="javascript">
    setTimeout("self.location.reload();",60*10000);
  </script>
</head>

<body>
<!--导航
<div class="top-index">
	<div class="logo"><img src="../../UI/logo/logogif.gif"></div>
    <div class="top-dh">
    	<a href="../../index.php"><div class="dh-index">首页</div></a>
        <a href="bxgl_index.php"><div class="dh-index">返回</div></a>
  </div>
</div>-->
<!--main-->

<?php
  include("../../PHP/riqi.php");
  include("../../SQL/db/db.php");
  include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");

  //未处理数量
  $sql10="select count(sid) from sch_repair_re where s_jg='未处理' and s_repair!='未分配'";
  $rs10=mysql_query($sql10,$con);
  if($row10=mysql_fetch_row($rs10))
  	$num10=$row10[0];
  //已处理数量
  $sql11="select count(sid) from sch_repair_re where s_jg='已处理'";
  $rs11=mysql_query($sql11,$con);
  if($row11=mysql_fetch_row($rs11))
  	$num11=$row11[0];
  //不能处理数量
  $sql12="select count(sid) from sch_repair_rea where s_jg='不能处理'";
  $rs12=mysql_query($sql12,$con);
  if($row12=mysql_fetch_row($rs12))
  	$num12=$row12[0];
?>

<div class="ly">
  <!--状态选择-->
  <blockquote class="layui-elem-quote">
    <h2>报修状态查询</h2>

    <form class="form-horizontal" action="" method="get" role="form">
      <div class="table-responsive">
          <table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>
                <button type="submit" name="bncl" class="layui-btn layui-btn-sm layui-btn-danger">不能处理<span class="layui-badge layui-bg-black"><?=$num12?></span></button>
                <button type="submit" name="wcl" class="layui-btn layui-btn-sm layui-btn-warm">未处理<span class="layui-badge layui-bg-black"><?=$num10?></span></button>
                <button type="submit" name="ycl" class="layui-btn layui-btn-sm layui-btn-normal">已处理<span class="layui-badge layui-bg-black"><?=$num11?></span></button>
       
              </td>
            </tr>
          </table>
        </div>
    </form>

  </blockquote>
  <!--详情-->
  <div class="table-responsive">
    <table width="100%" class="layui-table table" lay-even>
      <thead>
        <tr>
        	<?php
            if(isset($_GET['ycl']) || isset($_GET['wcl']) || isset($_GET['yclall']))
            {
      		?>
            <td align="center" class="">操作</td> 
            <td align="center" class="">地点</td>
            <td align="center" class="">姓名</td>
            <td align="center" class="">电话</td>
            <td align="center" class="">专业</td>
            <td align="center" class="">报修时间</td>
            <td align="center" class="">维修员</td>
            <td align="center" class="">处理情况</td>
            <td align="center" class="">维修时间</td>
            <td align="center" class="">物件详情</td>
          
          <?php
          	}
          	else
          	{
          ?>
            
            <td align="center" class="">操作</td>
            <td align="center" class="layui-bg-red">原因</td>
            <td align="center" class="">损坏描述</td>
            <td align="center" class="">地点</td>
            <td align="center" class="">物件</td>
            <td align="center" class="">数量</td> 
            <td align="center" class="">维修员</td>
            <td align="center" class="">维修时间</td>
            <td align="center" class="">姓名</td>
            <td align="center" class="">电话</td>
            <td align="center" class="">专业</td>
            
            <td align="center" class="">报修时间</td>
          <?php
            }
          ?>
        </tr>
      </thead>
      <tbody>
        <?php
      	if(isset($_GET['bncl']))
        {
    		  $sqlre="select a.sid,a.s_class,a.s_addr,b.*,a.s_wxxq from sch_repair_re a,sch_repair_rea b where b.s_jg='不能处理' and a.s_name=b.s_name and a.s_add=b.s_add and a.s_phone=b.s_phone and a.s_settime=b.s_time order by s_settime asc";
    		  $b='bncl=';
      	}
      	else if(isset($_GET['ycl']))
      	{

      		$sqlre="select * from sch_repair_re where s_jg='已处理' order by s_settime desc limit 20";
          $b='ycl=';
        }
        else if(isset($_GET['yclall']))
        {
          $sqlre="select * from sch_repair_re where s_jg='已处理' order by s_settime desc";
          $b='yclall=';
        }
    		else if(isset($_GET['wcl']))
    		{
    			
    			$sqlre="select * from sch_repair_re where s_jg='未处理' and s_repair!='未分配' order by s_settime asc";
    			$b='wcl=';
    		}
    		else
        {
          $sqlre="select a.sid,a.s_class,a.s_addr,b.*,a.s_wxxq from sch_repair_re a,sch_repair_rea b where b.s_jg='不能处理' and a.s_name=b.s_name and a.s_add=b.s_add and a.s_phone=b.s_phone and a.s_settime=b.s_time order by s_settime asc";
          $b='bncl=';
        }
        $rsre=mysql_query($sqlre,$con);
        while($rowre=mysql_fetch_row($rsre))
        {
        ?>
        <tr>
        	<?php
            if(isset($_GET['ycl']) || isset($_GET['wcl']) || isset($_GET['yclall']))
            {
      		?>
            <td align="center">
              <?php
              if(isset($_GET['wcl']))
                echo "未处理";
              else
                echo "已处理";
              ?>
            </td>
            <td align="center"><?=$rowre[1].$rowre[2]?></td>
            <td align="center"><?=$rowre[3]?></td>
            <td align="center"><?=$rowre[5]?></td>
            <td align="center"><?=$rowre[4]?></td>
            <td align="center"><?=$rowre[10]?></td>
            <td align="center"><?=$rowre[7]?></td>
            <td align="center"><?=$rowre[11]?></td>
            <td align="center"><?=$rowre[12]?></td>
            <td align="center">
              <button type="button" onclick="consay('<? 
          $sqlrea="select * from sch_repair_rea where s_time='".$rowre[10]."' and s_name='".$rowre[3]."' and s_phone='".$rowre[5]."' and s_add='".$rowre[1]."'";
        $rsrea=mysql_query($sqlrea,$con);
        while($rowrea=mysql_fetch_row($rsrea))
        {
          echo "（".$rowrea[1];
          echo " - 数量：".$rowrea[2]."）<br>";
        }
        ?>');" name="wjxq" class="layui-btn">物件详情</button>
            </td>
          <?php
          	}
          	else
          	{
        	?>
            <td align="center">
            <?php
              if($rowre[7]!="零星维修")
              {
            ?>
              <button type="button" onclick="zlxwx(<?=$rowre[0]?>)" name="lxwx" class="layui-btn layui-btn-warm">转【零星维修】处理</button>
              
            <?php
              }
              else
              {
                echo "零星维修处理中";
              }
            ?>

            </td>
            <td align="center" class="text-danger" style="width:200px;word-break: normal;word-wrap: break-word; ">
              <div style="text-align: left;width:200px;height:80px;word-break: normal;word-wrap: break-word;overflow-y: scroll;overflow-x: auto;overflow:-moz-scrollbars-vertical;">
                <?=$rowre[8]?>
              </div>
            </td>

            <td align="center">
              <button type="button" onclick="consay('<?=$rowre[17]?>')" name="shms" class="layui-btn">损坏描述</button>
            </td>
            <td align="center"><?=$rowre[10].$rowre[2]?></td>
            <td align="center"><?=$rowre[4]?></td>
            <td align="center"><?=$rowre[5]?></td>
            
            <td align="center"><?=$rowre[7]?></td>
            <td align="center"><?=$rowre[15]?></td>
            
            <td align="center"><?=$rowre[12]?></td>
            <td align="center"><?=$rowre[13]?></td>
            <td align="center"><?=$rowre[1]?></td>
            
            <td align="center"><?=$rowre[9]?></td>
                   
          <?php
            }
        	?>
          
        </tr>
      <?php
        }
      ?>
          <!--已处理查看所有-->
          <?
            if(isset($_GET['ycl']))
            {
          ?>
          <td colspan="10" align="center">
            <form class="" action="" method="get" role="form">
              <button type="submit" name="yclall" class="layui-btn layui-btn-sm layui-btn-normal">查看所有</button>
            </form>
          </td>
          <?
            }
          ?>

      </tbody>
    </table>
  </div>
</div>


<!--转<零星维修>处理-->
<?php
if(isset($_GET['lxwx']))
{
  // $selectsql="select s_schid,s_settime from sch_repair_re where sid='".$_GET['lxwx']."'";
  // $selectrs=mysql_query($selectsql,$con);
  // if($selectrow=mysql_fetch_row($selectrs))
  // {
  //   $tid=$selectrow[0];
  //   $ttime=$selectrow[1];
  // }
  $sql="update sch_repair_re as a,sch_repair_rea as b set a.s_repair='零星维修',b.s_repair='零星维修' where a.sid='".$_GET['lxwx']."' and a.s_settime=b.s_time and a.s_schid=b.s_schid";
  $rs=mysql_query($sql,$con);
  if($rs>0)
  {
    ?>
    <script type="text/javascript">
      layui.use('layer', function(){
        var layer = layui.layer;
        parent.layer.msg('成功转到 - 零星维修');
      });
      location.href="bxztcx.php?bncl";
    </script>
    <?

  }
  else
  {
    ?>
    <script type="text/javascript">
      layui.use('layer', function(){
        var layer = layui.layer;
        parent.layer.msg('转任务失败');
      });
      location.href="bxztcx.php?bncl";
    </script>
    <?
  }
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
      },function(){
        parent.layer.closeAll();
      });
    }); 
  }
  //转为零星维修
  //tid=任务id
  function zlxwx(tid)
  {
    layui.use('layer', function(){
      var layer = layui.layer;

      parent.layer.confirm("确认转给零星维修处理？", {
      btn: ['确认','取消'] //按钮
      ,title:"转零星维修"
      }, function(){
        location.href="../bxgl/bxztcx.php?lxwx="+tid;
      }, function(){
          parent.layer.closeAll();
      });
    }); 
  }
</script>

</body>
</html>