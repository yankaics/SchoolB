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
    <title>维修前统计</title>
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
<?
    include("../../PHP/riqi.php");
    include("../../SQL/db/db.php");
    include("../../PHP/adminse.php");
    include("../adminse/admin_se.php");
    include("address.php");//地点
?>
<div class="ly">
    <blockquote class="layui-elem-quote">
        <h3>维修前物件统计 <input type="button" class="layui-btn" id="btnPrint" 
onclick="onprint()" value="打印本页" /></h3>
        <p>选择日期，再选择地点进行统计</p>
        <p>时间是用户报修的时间</p>
        <form action="" class="layui-form layui-form-pane" method="get" name="bxre">
            <?
                if(isset($_GET['da1']))
                {
                    $da1=$_GET['da1'];
                }
                else
                {
                    $sqla="select s_settime from sch_repair_re where s_jg='未处理' and s_repair!='未分配' order by s_settime asc";
                    $rsa=mysql_query($sqla,$con);
                    if($rowa=mysql_fetch_row($rsa))
                    {
                        $da1=substr($rowa[0],0,10);
                    }
                    else
                    {
                        $da1=$rqY.'-'.$rqmm.'-'.$rqd;
                    }
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
            <div class="layui-form-item">
                
                <div class="layui-inline">
                    <label class="layui-form-label">时间</label>
                    <div class="layui-input-inline" style="width: 140px;">
                        <input name="da1" class="layui-input" id="da1" type="text" value="<?=$da1?>"/>
                    </div>
                <div class="layui-form-mid">-</div>
                <div class="layui-input-inline" style="width: 140px;">
                    <input name="da2" class="layui-input" id="da2" type="text" value="<?=$da2?>"/>
                </div>
              </div>
            </div> 

            <div class="table-responsive">
                <table width="100%" class="table" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <button type="submit" name="all" class="layui-btn layui-btn-sm layui-btn-normal">所有详情</button>
                            <button type="submit" name="alltj" class="layui-btn layui-btn-sm layui-btn-normal">所有统计</button>
                            <?php
                                for($i=0;$i<count($arrayall);$i++)
                                {
                            ?>
                                <button type="submit" name="<?=$arrayalldm[$i]?>" class="layui-btn layui-btn-sm"><?=$arrayall[$i]?></button>
                            <?php
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <script>
            layui.use('laydate', function(){
              var laydate = layui.laydate;
              
              //执行一个laydate实例
              laydate.render({
                elem: '#da1' //指定元素
              });
              laydate.render({
                elem: '#da2' //指定元素
              });
            });
            </script>
        </form>
    </blockquote>

    <p>
    
    <div class="container">
	<div class="row clearfix">
		<div class="col-md-2 column">
		</div>
		<div class="col-md-8 column" id="dy" style="font-weight:700;">
        <h1 align="center">维修前所需清单</h1>
        <h5 align="center">物件报修时间：
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
        </h5>
        
        <div class="table-responsive">
        <?
		
        if(isset($_GET['da1']))
		{
			if(isset($_GET['all']))
			{
                
                for($i=0;$i<count($arrayall);$i++)
                {

				?>
    				
                    <?
                    //详情
                    $sqlrepair="select s_name from sch_admin where s_position='维修员'";
                    $rsrepair=mysql_query($sqlrepair,$con);
                    while($rowrepair=mysql_fetch_row($rsrepair))
                    {

                        $sqla="select sum(s_num),s_tt,s_repair from sch_repair_rea where s_jg='未处理' and s_repair!='未分配' and s_add='".$arrayall[$i]."' and s_repair='".$rowrepair[0]."' and s_time>='".$da1."-00:00:00' and s_time<='".$da2."-23:59:59' group by s_tt,s_repair";
        				$rsa=mysql_query($sqla,$con);
        					if($rowa=mysql_fetch_row($rsa))
        					{

        			?>
                        <h2><?php echo $arrayall[$i]."：".$rowa[2]?></h2>
                        <table border="1" class="table " cellspacing="0" cellpadding="10">
                        
                        <tr class="top">
                            <td align="center">地点</td>
                            <td align="center">姓名</td>
                            <td align="center">物件</td>
                            <td align="center">数量</td>
                            <td align="center">报修时间</td>
                        </tr>
                        <?
                            $sqla1="select s_settime,s_add,s_schid,s_addr from sch_repair_re where s_jg='未处理' and s_repair!='未分配' and s_add='".$arrayall[$i]."' and s_repair='".$rowa[2]."' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59'";
        				    $rsa1=mysql_query($sqla1,$con);
        					while($rowa1=mysql_fetch_row($rsa1))
        					{
                                $sqlr="select s_name,s_time,s_tt,s_num from sch_repair_rea where s_jg='未处理' and s_repair!='未分配' and s_add='".$rowa1[1]."' and s_repair='".$rowa[2]."' and s_schid='".$rowa1[2]."' and s_time='".$rowa1[0]."' ";
                                $rsr=mysql_query($sqlr,$con);
                                while($rowr=mysql_fetch_row($rsr))
                                {
                                    

        				?>
                        <tr class="top">
                            <td align="center"><?=$arrayall[$i].$rowa1[3]?></td>
                            <td align="center"><?=$rowr[0]?></td>
                            <td align="center"><?=$rowr[2]?></td>
                            <td align="center"><?=$rowr[3]?></td>
                            <td align="center"><?=$rowa1[0]?></td>
                        </tr>
                        <?
                                         
                                }
        					}
        				?>
                        </table>
                    <?
    					   }
                    }

                    //所有
                    $sqla="select sum(s_num),s_tt,s_repair from sch_repair_rea where s_jg='未处理' and s_repair!='未分配' and s_add='".$arrayall[$i]."' and s_time>='".$da1."-00:00:00' and s_time<='".$da2."-23:59:59' group by s_tt";
                        $rsa=mysql_query($sqla,$con);
                            if($rowa=mysql_fetch_row($rsa))
                            {
                    ?>
                        <h2><?php echo '<'.$arrayall[$i].'总计>'?></h2>
                        <table border="1" class="table " cellspacing="0" cellpadding="10">
                        
                        <tr class="top">
                            <td align="center">物件</td>
                            <td align="center">数量</td>
                        </tr>
                        <?
                       $sqla="select sum(s_num),s_tt,s_repair from sch_repair_rea where s_jg='未处理' and s_repair!='未分配' and s_add='".$arrayall[$i]."' and s_time>='".$da1."-00:00:00' and s_time<='".$da2."-23:59:59' group by s_tt";
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
                        <br/><br/><br/><br/>
                    <?
                           }
    				?>
                
                <?
				}
			}
            else if(isset($_GET['alltj']))
            {
                for($i=0;$i<count($arrayall);$i++)
                {
                //所有
                    $sqla="select sum(s_num),s_tt,s_repair from sch_repair_rea where s_jg='未处理' and s_repair!='未分配' and s_add='".$arrayall[$i]."' and s_time>='".$da1."-00:00:00' and s_time<='".$da2."-23:59:59' group by s_tt";
                        $rsa=mysql_query($sqla,$con);
                            if($rowa=mysql_fetch_row($rsa))
                            {
                    ?>
                        <h2><?php echo '<'.$arrayall[$i].'总计>'?></h2>
                        <table border="1" class="table " cellspacing="0" cellpadding="10">
                        
                        <tr class="top">
                            <td align="center">物件</td>
                            <td align="center">数量</td>
                        </tr>
                        <?
                       $sqla="select sum(s_num),s_tt,s_repair from sch_repair_rea where s_jg='未处理' and s_repair!='未分配' and s_add='".$arrayall[$i]."' and s_time>='".$da1."-00:00:00' and s_time<='".$da2."-23:59:59' group by s_tt";
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
            <table border="1" class="table " cellspacing="0" cellpadding="10">
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
        					
        					$sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='未处理' and s_add='".$arrayall[$i]."' and s_time>='".$da1."-00:00:00' and s_time<='".$da2."-23:59:59' group by s_tt";
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
        <?			}
				    	
		}
		
		?>
        	</table>
            
          </div>
          
          <h3 align="left" style="left:5%; ">签字——<br /><br />  部门负责人：<br /><br />  工程部：<br /><br />  物资管理员：</h3>
          <h4 align="right" style="right:5%;"><?=$rqY.'年'.$rqmm.'月'.$rqd.'日';?></h4>
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

</body>
</html>