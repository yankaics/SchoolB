<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- 可选的 Bootstrap 主题文件（一般不用引入） -->
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!---->
<!--JSQ-->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="JSQ/index.js"></script>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="../../favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>维修后统计</title>
<link media="(max-width:650px)" href="../../CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
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
?>
<div class="ly">
  <h2>维修后统计</h2> <span class="input-group-addon"><p>选择日期，再选择地点进行统计</p><p>时间是维修完成的时间</p><!--<input type="button" class="btn btn-default" id="btnPrint" 
onclick="onprint()" value="打印本页" />--></span>
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
      	<button type="submit" name="all" class="btn btn-default">所有</button>
   	    <button type="submit" name="ss" class="btn btn-default">宿舍</button>
          <button type="submit" name="st" class="btn btn-default">食堂</button>
          <button type="submit" name="ydc" class="btn btn-default">运动场</button>
          <button type="submit" name="tsg" class="btn btn-default">图书馆</button>
          <button type="submit" name="zhl" class="btn btn-default">综合楼</button>
          <button type="submit" name="jxl" class="btn btn-default">教学楼</button>
          <button type="submit" name="sxl" class="btn btn-default">实训楼</button>
	  </p>
        
    </form>
    </p>
    <p>
    
    <div class="container">
	<div class="row clearfix">
		<div class="col-md-4 column">
		</div>
		<div class="col-md-4 column" id="dy" style="font-weight:700;">
        <h1 align="center">维修后物件</h1>
        <!--<h5 align="center">物件报修时间：
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
        </h5>-->
        
        <div class="table-responsive">
        <?
		
        if(isset($_GET['da1']))
		{
			if(isset($_GET['all']))
			{
				?>
                <!--宿舍-->
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='宿舍' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
				$rsa=mysql_query($sqla,$con);
					if($rowa=mysql_fetch_row($rsa))
					{
				?>
            <h2>宿 舍</h2>
                <table border="1" class="table" cellspacing="0" cellpadding="10">
                
                <tr class="top">
                    <td align="center">物件</td>
                    <td align="center">数量</td>
                </tr>
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='宿舍' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
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
				?>
                <!--食堂-->
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='食堂' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
				$rsa=mysql_query($sqla,$con);
					if($rowa=mysql_fetch_row($rsa))
					{
				?>
            <h2>食 堂</h2>
                <table border="1" class="table" cellspacing="0" cellpadding="10">
                
                <tr class="top">
                    <td align="center">物件</td>
                    <td align="center">数量</td>
                </tr>
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='食堂' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
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
				?>
                <!--运动场-->
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='运动场' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
				$rsa=mysql_query($sqla,$con);
					if($rowa=mysql_fetch_row($rsa))
					{
				?>
            <h2>运 动 场</h2>
                <table border="1" class="table" cellspacing="0" cellpadding="10">
                
                <tr class="top">
                    <td align="center">物件</td>
                    <td align="center">数量</td>
                </tr>
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='运动场' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
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
				?>
                <!--图书馆-->
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='图书馆' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
				$rsa=mysql_query($sqla,$con);
					if($rowa=mysql_fetch_row($rsa))
					{
				?>
            <h2>图 书 馆</h2>
                <table border="1" class="table" cellspacing="0" cellpadding="10">
                
                <tr class="top">
                    <td align="center">物件</td>
                    <td align="center">数量</td>
                </tr>
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='图书馆' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
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
				?>
                <!--综合楼-->
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='综合楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
				$rsa=mysql_query($sqla,$con);
					if($rowa=mysql_fetch_row($rsa))
					{
				?>
            <h2>综 合 楼</h2>
                <table border="1" class="table" cellspacing="0" cellpadding="10">
                
                <tr class="top">
                    <td align="center">物件</td>
                    <td align="center">数量</td>
                </tr>
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='综合楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
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
				?>
                <!--教学楼-->
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='教学楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
				$rsa=mysql_query($sqla,$con);
					if($rowa=mysql_fetch_row($rsa))
					{
				?>
            <h2>教 学 楼</h2>
                <table border="1" class="table" cellspacing="0" cellpadding="10">
                
                <tr class="top">
                    <td align="center">物件</td>
                    <td align="center">数量</td>
                </tr>
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='教学楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
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
				?>
                <!--实训楼-->
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='实训楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
				$rsa=mysql_query($sqla,$con);
					if($rowa=mysql_fetch_row($rsa))
					{
				?>
            <h2>实 训 楼</h2>
                <table border="1" class="table" cellspacing="0" cellpadding="10">
                
                <tr class="top">
                    <td align="center">物件</td>
                    <td align="center">数量</td>
                </tr>
                <?
                $sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='实训楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
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
			else
			{
		?>
        	<h2>
			<?
			if(isset($_GET['ss']))
			{
				echo "宿 舍";
			}
			else if(isset($_GET['st']))
			{
				echo "食 堂";
			}
			else if(isset($_GET['ydc']))
			{
				echo "运 动 场";
			}
			else if(isset($_GET['tsg']))
			{
				echo "图 书 馆";
			}
			else if(isset($_GET['zhl']))
			{
				echo "综 合 楼";
			}
			else if(isset($_GET['jxl']))
			{
				echo "教 学 楼";
			}
			else if(isset($_GET['sxl']))
			{
				echo "实 训 楼";
			}
			else
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
				if(isset($_GET['ss']))
				{
					
					$sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='宿舍' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
				}
				else
				{
					if(isset($_GET['st']))
					{
					$sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='食堂' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
					}
					else
					{
						if(isset($_GET['ydc']))
						{
						$sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='运动场' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
						}
						else
						{
							if(isset($_GET['tsg']))
							{
							$sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='图书馆' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
							}
							else
							{
								if(isset($_GET['zhl']))
								{
								$sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='综合楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
								}
								else
								{
									if(isset($_GET['jxl']))
									{
									$sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='教学楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
									}
									else
									{
										if(isset($_GET['sxl']))
										{
										$sqla="select sum(s_num),s_tt from sch_repair_rea where s_jg='已处理' and s_add='实训楼' and s_settime>='".$da1."-00:00:00' and s_settime<='".$da2."-23:59:59' group by s_tt";
										}
										
									}
								}
							}
						}
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
        <?			
					}	
		}
		
		?>
        	</table>
            
          </div>
          
          <!--<h3 align="left" style="left:5%; ">签字——<br /><br />  部门负责人：<br /><br />  工程部：<br /><br />  物资管理员：</h3>
          <h4 align="right" style="right:5%;"><?=$rqY.'年'.$rqmm.'月'.$rqd.'日';?></h4>-->
		</div>
        <?
		}
		  ?>
		<div class="col-md-4 column">
		</div>
	</div>
</div>
    </p>
</div>
</center>
</body>
</html>