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
    <script src="../../JSQ/jquery-2.1.1.min.js"></script>
    <!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="../../bootstrap/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!---->
    <script src="../../JSQ/index.js"></script>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link rel="shortcut icon" href="../../favicon.ico" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>维修前统计</title>
    <link media="(max-width:650px)" href="../../CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
    <link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
    <link media="(min-width:500px)" href="../../CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
    <link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
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
    </style>
    <script type="text/javascript">
    function printHtml(html) {
    var bodyHtml = document.body.innerHTML;
    document.body.innerHTML = html;
    window.print();
    document.body.innerHTML = bodyHtml;
    }
    function onprint() {
    var html = $("#dy").html();
    printHtml(html);
    }
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
<center>
<?
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
include("address.php");//地点
?>
<div class="ly">
  <h2>维修后统计</h2> <span class="input-group-addon"><p>选择日期，再选择地点进行统计</p><p>时间是维修完成的时间</p><!--<input type="button" class="btn btn-default" id="btnPrint" 
onclick="onprint()" value="打印本页" />-->
    <form action="" method="get" name="bxre">

    </form>

    </span>
    <p>
    <form action="" method="get" name="bxre">
        <p>
            <?
            if(isset($_GET['da1']))
            {
                $da1=$_GET['da1'];
            }
            else
            {
                $da1=$rqY.'-'.$rqmm.'-'.$rqd;
            }
            if(isset($_GET['da2']))
            {
                $da2=$_GET['da2'];
            }
            else
            {
                $da2=$rqY.'-'.$rqmm.'-'.$rqd;
            }
            ?>
          <input name="da1" type="date" value="<?=$da1?>"/>
          至<input name="da2" type="date" value="<?=$da2?>"/>
      <p>
        
        <button type="submit" name="alltj" class="btn btn-default">所有统计</button>
        <p>
        <?php
            for($i=0;$i<count($arrayall);$i++)
            {
        ?>
            <button type="submit" name="<?=$arrayalldm[$i]?>" class="btn btn-default"><?=$arrayall[$i]?></button>
        <?php
            }
        ?>
        </p>
      </p>
        
    </form>
    </p>
    <p>
    
    <div class="container">
    <div class="row clearfix">
        <div class="col-md-2 column">
        </div>
        <div class="col-md-8 column" id="dy" style="font-weight:700;">
        <h1 align="center">维修后物件</h1>
        <!-- <h5 align="center">物件完成时间：
        <?
        if($da1==$da2)
        {
            ?>
            <?=$da1?>
        <?
        }
        else
        {
            ?>
        <?=$da1?>至<?=$da2?>
        <?
        }
        ?>
        </h5> -->
        
        <div class="table-responsive">
        <?
        
        if(isset($_GET['da1']))
        {
            
            if(isset($_GET['alltj']))
            {
                for($i=0;$i<count($arrayall);$i++)
                {
                //所有
                    $sqla="select sum(s_num),s_tt,s_repair from sch_repair_rea where s_jg='已处理' and s_add='".$arrayall[$i]."' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
                        $rsa=mysql_query($sqla,$con);
                            if($rowa=mysql_fetch_row($rsa))
                            {
                    ?>
                        <h2><?php echo '<'.$arrayall[$i].'总计>'?></h2>
                        <table border="1" class="table" cellspacing="0" cellpadding="10">
                        
                        <tr class="top">
                            <td align="center">物件</td>
                            <td align="center">数量</td>
                        </tr>
                        <?
                       $sqla="select sum(s_num),s_tt,s_repair from sch_repair_rea where s_jg='已处理' and s_add='".$arrayall[$i]."' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
                        $rsa=mysql_query($sqla,$con);
                            while($rowa=mysql_fetch_row($rsa))
                            {
                        ?>
                        <tr class="top">
                            <td align="center"><?=$rowa[1]?></td>
                            <td align="center"><?=$rowa[0]?></td>
                        </tr>
                        <?
                            }
                        ?>
                        </table>
                    <?
                    }
                }

            }
            else
            {
        ?>
            <h2>
            <?
            for($i=0;$i<count($arrayall);$i++)
            {
                if(isset($_GET[$arrayalldm[$i]]))
                {
                    echo $arrayall[$i];
                }
            }
            ?>
            </h2>
            <table border="1" class="table" cellspacing="0" cellpadding="10">
                <tr class="top">
                    <td align="center">物件</td>
                    <td align="center">数量</td>
                </tr>
                <?
                    $da1=$_GET['da1'];
                    $da2=$_GET['da2'];
                    for($i=0;$i<count($arrayall);$i++)
                    {
                        if(isset($_GET[$arrayalldm[$i]]))
                        {
                            
                            $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='".$arrayall[$i]."' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
                        }
                    
                    }
                    $rsa=mysql_query($sqla,$con);
                    while($rowa=mysql_fetch_row($rsa))
                    {
                ?>
                <tr class="top">
                    <td align="center"><?=$rowa[1]?></td>
                    <td align="center"><?=$rowa[0]?></td>
                </tr>
        <?          }
                        
        }
        
        ?>
            </table>
            
          </div>
          
          <!-- <h3 align="left" style="left:5%; ">签字——<br /><br />  部门负责人：<br /><br />  工程部：<br /><br />  物资管理员：</h3>
          <h4 align="right" style="right:5%;"><?=$rqY.'年'.$rqmm.'月'.$rqd.'日';?></h4> -->
        </div>
        <?
        }

          ?>
        <div class="col-md-2 column">
        </div>
    </div>
</div>
    </p>
</div>
</center>
</body>
</html>