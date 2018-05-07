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
//必须相对的定义地点和地点代码，比如宿舍=ss
$arrayall=array('宿舍','食堂','运动场','图书馆','综合楼','教学楼','实训楼','其他区域','超市','洗澡堂','锅炉房','6号楼');
$arrayalldm=array('ss','st','ydc','tsg','zhl','jxl','sxl','qtqy','cs','xzt','glf','lhl');
?>
<div class="ly">
  <h2>维修前物件</h2> <span class="input-group-addon"><p>选择日期，再选择地点进行统计</p><p>时间是用户报修的时间</p><input type="button" class="btn btn-default" id="btnPrint" 
onclick="onprint()" value="打印本页" />
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
                $sqla="select s_settime from sch_repair_re where s_jg='未处理' and s_repair!='未分配' order by s_settime asc";
                $rsa=mysql_query($sqla,$con);
                if($rowa=mysql_fetch_row($rsa))
                {
				    $da1=substr($rowa[0],0,10);
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
    	  <input name="da1" type="date" value="<?=$da1?>"/>
    	  至<input name="da2" type="date" value="<?=$da2?>"/>
   	  <p>
      	<button type="submit" name="all" class="btn btn-default">所有详情</button>
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
                        <table border="1" class="table" cellspacing="0" cellpadding="10">
                        
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
                        <table border="1" class="table" cellspacing="0" cellpadding="10">
                        
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
                        <hr style="background-color:#000;height: 1px;border:none;"/>
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
                        <table border="1" class="table" cellspacing="0" cellpadding="10">
                        
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
</center>
</body>
</html>