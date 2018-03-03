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

<!---以往的CSS
<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
-->
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
    $formvars["__VIEWSTATE"] = "/wEPDwULLTEyODE2MTMzNjUPZBYCAgMPZBYGAhYPEGRkFgBkAhgPPCsAEQBkAhoPPCsAEQEBEBYAFgAWAGQYAgUHZ3ZTY29yZQ9nZAUIZ3ZDcmVkaXQPZ2Q0vZ9kcrUU+TZE61Bo6Cj1/MAPlBQAKHwTNWddmQ6OlA==";
    $formvars["__EVENTVALIDATION"] = "/wEWBgLlvo2iCALOj4fxBwL9p/noCwLdkpmPAQKLk6mvAgKXt+TzAXM3720UDhWcPUtOLX8Il0quPlehyyQNYIBW67NbdoWi";
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
    // print_r($m);
  ?>
<div class="layui-row">
  <div class="layui-col-md4 layui-col-md-offset4 layui-col-xs-12">
    <br><br id="xtips"><br>
    <?
      if(isset($m[0][1]))
      {
    ?>
    <table class="layui-table">
      <colgroup>
        <col width="600">
        <col width="100">
        <col width="200">
      </colgroup>
      <thead>
        <tr>
          <th>科目</th>
          <th>成绩</th>
          <th>详情</th>
        </tr> 
      </thead>
      <tbody>
        <?
          for($i=0;$i<32;$i++)
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
          <?=$m[0][13+12*$i]?>
          <?=$m[0][16+12*$i]?>
          <?=$m[0][17+12*$i]?>
        </tr>
        <?
          }
        ?>
      </tbody>
    </table>

    <script type="text/javascript">
      layui.use('layer', function(){
      var layer = layui.layer;
      layer.tips('喏~拿好你的成绩单', '#xtips');
    });
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