<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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
        <a href="../infor/admincd_index.php"><div class="dh-index">返回</div></a>
  </div>
</div>-->
<!--main-->
<center>
<?
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
$sqla="select count(tid) from sch_loginre";			
$rsa=mysql_query($sqla,$con);
if($rowa=mysql_fetch_row($rsa))
$logincount=$rowa[0];
?>
<div class="ly">
  <h2>登陆记录</h2><span class="input-group-addon">账号（学号·工号·账号）<br />详情（专业·办公室·职位）<br />查询输入账号（选择时间）<br /><p><h3 style="color:#C30;">共有<?=$logincount?>人登陆过</h3></p></span>
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
          <input name="key" type="text" value=""/> <button type="submit" name="tkey" class="btn btn-default">查询</button>
          </p>
   	  <p>
      	<button type="submit" name="all" class="btn btn-default">所有</button>
   	    <button type="submit" name="stu" class="btn btn-default">学生</button>
          <button type="submit" name="tea" class="btn btn-default">教师</button>
          <button type="submit" name="adm" class="btn btn-default">管理员</button>
	  </p>
        
    </form>
    </p>
    <p>
    
    <div class="container">
	<div class="row clearfix">
		<div class="col-md-1 column">
		</div>
		<div class="col-md-10 column" id="dy" style="font-weight:700;">
        <div class="table-responsive">
        <?
		
        if(isset($_GET['da1']))
		{
			
		?>
        	<h2>
			<?
			if(isset($_GET['stu']))
			{
				$sqla="select count(tid) from sch_loginre where ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59' and ttype='学生'";
				$rsa=mysql_query($sqla,$con);
				if($rowa=mysql_fetch_row($rsa))
				echo "学生这段时间<br>登陆".$rowa[0]."人";
			}
			else if(isset($_GET['tea']))
			{
				$sqla="select count(tid) from sch_loginre where ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59' and ttype='教师'";
				$rsa=mysql_query($sqla,$con);
				if($rowa=mysql_fetch_row($rsa))
				echo "教师这段时间<br>登陆 ".$rowa[0]."人";
			}
			else if(isset($_GET['adm']))
			{
				$sqla="select count(tid) from sch_loginre where ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59' and ttype='管理员'";
				$rsa=mysql_query($sqla,$con);
				if($rowa=mysql_fetch_row($rsa))
				echo "管理员这段时间<br>登陆".$rowa[0]."人";
			}
			else if(isset($_GET['all']))
			{
				$sqla="select count(tid) from sch_loginre where ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59'";
				$rsa=mysql_query($sqla,$con);
				if($rowa=mysql_fetch_row($rsa))
				echo "所有这段时间<br>登陆".$rowa[0]."人";
			}
			else
			{
				echo $_GET['key'];
			}
			?>
            </h2>
            <table border="1" class="table" cellspacing="0" cellpadding="10">
                <tr class="top">
                    <td align="center">账号</td>
                    <td align="center">姓名</td>
                    <td align="center">详情</td>
                    <td align="center">登陆时间</td>
                    <td align="center">类型</td>
                </tr>
				<?
                $da1=$_GET['da1'];
				$da2=$_GET['da2']; 
				if(isset($_GET['stu']))
				{
					
					$sqla="select * from sch_loginre where ttype='学生' and ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59' order by ttime desc";
				}
				else
				{
					if(isset($_GET['tea']))
					{
					$sqla="select * from sch_loginre where ttype='教师' and ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59' order by ttime desc";
					}
					else
					{
						if(isset($_GET['adm']))
						{
						$sqla="select * from sch_loginre where ttype='管理员' and ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59' order by ttime desc";
						}
						else
						{
							if(isset($_GET['adm']))
							{
								$sqla="select * from sch_loginre where ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59' order by ttime desc";
							}
							else
							{
								$sqla="select * from sch_loginre where ttime>='".$da1."-00:00:00' and ttime<='".$da2."-23:59:59' and tuser like '%".$_GET['key']."%' order by ttime desc";
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
                    <td align="center"><?=$rowa[2]?></td>
                    <td align="center"><?=$rowa[3]?></td>
                    <td align="center"><?=$rowa[4]?></td>
                    <td align="center"><?=$rowa[5]?></td>
                </tr>
        <?			
					}	
		}
		
		?>
        	</table>
            
          </div>
		</div>
        <?
		
		  ?>
		<div class="col-md-1 column">
		</div>
	</div>
</div>
    </p>
</div>
</center>
</body>
</html>