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
  <title>成绩查询</title>
</head>

<body  bgcolor="#F0F0F0">

<!--导航-->
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo"><img class="layui-icon" src="../../UI/logo/logo-32-t.png"></div>
	<?
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
  include("Snoopy.class.php");
	?>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item ">
          <a href="../../stu_i.php"><div class="xz-index">菜单</div></a>
      </li>
    </ul>
  </div>
</div>

<!--main-->
<?php
    $snoopy = new Snoopy;
    //表单提交模拟  
    $formvars["txtStudentNo"] = $_SESSION['txh'];   
    $formvars["txtStudentName"] = $_SESSION['txm'];
    $formvars["__EVENTTARGET"] = ""; 
    $formvars["__EVENTARGUMENT"] = "";
    $formvars["__VIEWSTATE"] = "/wEPDwUJODIwOTI2MDg0D2QWAgIDD2QWCAIWDxBkZBYAZAIYDw8WBB4EVGV4dAUnMjAxNy0yMDE45a2m5bm056ys5LqM5a2m5pyf6ICD6K+V6K6h5YiSHgtOYXZpZ2F0ZVVybAVCSFRUUDovL3d3dy5jcXNlYS5jb20vRmlsZXMvUmVzb3VyY2VEb3dubG9hZC8yMDE4LTQtMjQtMTQtNTctMTYueGxzZGQCGg88KwARAGQCHA88KwARAQEQFgAWABYAZBgCBQdndlNjb3JlD2dkBQhndkNyZWRpdA9nZE3dn+l8mobv9M6sSEyTQi7GO8CkGvKM9Y+wRyy8XLbe";
    $formvars["__EVENTVALIDATION"] = "/wEWBgKavrjxCQLOj4fxBwL9p/noCwLdkpmPAQKLk6mvAgKXt+TzAeusENGeEABywYcu8MMn25M3dkw4+FCWUhvhXMiynkAk";
    $formvars["btnOK"] = "确定";
    //抓取地址
    $action = "http://www.cqsea.com/cjcx/";  
       
    $snoopy->cookies["PHPSESSID"] = 'fc106b1918bd522cc863f36890e6fff7'; //伪装sessionid   
    $snoopy->agent = "(compatible; MSIE 4.01; MSN 2.5; AOL 4.0; Windows 98)"; //伪装浏览器   
    $snoopy->referer = "http://www.cqsea.com/cjcx/"; //伪装来源页地址 http_referer   
    $snoopy->rawheaders["Pragma"] = "no-cache"; //cache 的http头信息   
    $snoopy->rawheaders["X_FORWARDED_FOR"] = "127.0.0.1"; //伪装ip   
    $snoopy->submit($action,$formvars);   
    $data=$snoopy->results;   
    //单独取出数据
    preg_match_all('#<td>(.+?)</td>#',$data,$m);
    //查看取出的数组
    //print_r($m);
  ?>
<div class="layui-row">
  <div class="layui-col-md4 layui-col-md-offset4 layui-col-xs-12">
    <br><br id="xtips"><br>

    <?
      if(isset($m[0][1]))
      {
        //科目数量,统计多维数组
        $count_km=(count($m[0],true)-8)/8;
    ?>
    <p>官方链接：<a target='_blank' href='http://www.cqsea.com/cjcx/'>点击</a></p>
    <p>校园宝抓取修复时间：20180425</p>
    <table class="layui-table">
      <colgroup>
        <col width="600">
        <col width="100">
        <col width="150">
        <col width="250">
      </colgroup>
      <thead>
        <tr>
          <th>科目</th>
          <th>成绩</th>
          <th>详情</th>
          <th>补考费</th>
        </tr> 
      </thead>
      <tbody>
        <?
          for($i=0;$i<=$count_km;$i++)
          {
            if($m[0][17+12*$i]=="<td>未开考</td>")
            {
              $trbgcolor="#393D49";
            }
            elseif($m[0][17+12*$i]=="<td>不合格</td>")
            {
              $trbgcolor="#FF5722";
            }
            else
            {
              $trbgcolor="";
            }
        ?>
        <tr bgcolor="<?=$trbgcolor?>">
          <?=$m[0][5+12*$i]?>
          <?=$m[0][8+12*$i]?>
          <?=$m[0][9+12*$i]?>
          <?=$m[0][10+12*$i]?>
        </tr>
        <?
          }
        ?>
      </tbody>
    </table>

    <script type="text/javascript">
    //   layui.use('layer', function(){
    //   var layer = layui.layer;
    //   layer.tips('喏~拿好你的成绩单', '#xtips');
    // });
    </script> 
    <?
      }
      else
        echo "对不起该成绩查询只适用本校学生<br>或官方网站不能访问<br>官方链接：<a target='_blank' href='http://www.cqsea.com/cjcx/'>点击</a>";
    ?>
  </div>
</div>




</body>
</html>