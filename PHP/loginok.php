<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<!------>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="favicon.ico" />
<!---JSQ--->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../JSQ/index.js"></script>
<title>用户登录成功</title>
</head>

<body>

<?
include("../SQL/db/db.php");
include"riqi.php";
$user=$_POST['user'];
$mysql['user'] = mysql_real_escape_string($user);
$_SESSION['user']=$user;
$upass=$_POST['upass'];
$mysql['upass'] = mysql_real_escape_string($upass);
$_SESSION['upass']=$upass;
$utype=$_POST['utype'];
$_SESSION['utype']=$utype;
$da1=$rqY.'-'.$rqmm.'-'.$rqd.'-'.$rqH.':'.$rqi.':'.$rqs;
	if($utype=="学生")
	{
		$sql="select * from sch_stub where tno='".$mysql['user']."'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{
			if($row[9]!='')
			{
				
				$spassid=$row[9];
			}
			else
			{
				$spassid=($row[4]+1)/2;
			}
			
			//学号
			$_SESSION['txh']=$row[7];
			//姓名
			$_SESSION['txm']=$row[1];
			//专业
			$_SESSION['tzy']=$row[5];
			//辅导员
			$_SESSION['tfdy']=$row[6];
			//电话
			$_SESSION['tdh']=($row[4]+1)/2;
			
			//密码
			$_SESSION['spassid']=$spassid;
			if($mysql['upass']==$spassid && $user==$row[7])
			{
				$sqlre="insert into sch_loginre values('','".$row[7]."','".$row[1]."','".$row[5]."','".$da1."','学生')";
				$rsre=mysql_query($sqlre,$con);
				?>
				<script language="javascript">
					location.href="../stu_i.php";
				</script>
				<?
			}
			else
			{
				?>
				<script language="javascript">
					location.href="../index.php?c=1";
				</script>
				<?
			}
	
	
		}
		else
		{
			?>
			<script>
				location.href="../index.php?z=1";
			</script>
			<?
		}
	}
	
	else if($utype=="教师")
	{
		$sql="select * from sch_teab where tjobnum='".$mysql['user']."'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{
			if($row[7]!='')
			{
				
				$spassid=$row[7];
			}
			else
			{
				$spassid=($row[4]+1)/2;
			}
			//姓名
			$_SESSION['txm']=$row[1];
			//电话
			$_SESSION['tdh']=($row[4]+1)/2;
			//部门
			$_SESSION['tjob']=$row[5];
			//密码
			$_SESSION['spassid']=$spassid;
			if($upass==$spassid && $user==$row[6])
			{
				$sqlre="insert into sch_loginre values('','".$row[6]."','".$row[1]."','".$row[5].$row[8]."','".$da1."','教师')";
				$rsre=mysql_query($sqlre,$con);
				?>
				<script language="javascript">
					location.href="../tea_i.php";
				</script>
				<?
			}
			else
			{
				?>
				<script language="javascript">
					location.href="../index.php?c=1";
				</script>
				<?
			}
	
	
		}
		else
		{
			?>
			<script language="javascript">
					location.href="../index.php?z=1";
				</script>
			<?
		}
		
	}
	else if($utype=="管理员")
	{
			$sql="select * from sch_admin where s_username='".$mysql['user']."' and s_userpass='".$mysql['upass']."'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{	
			//账号
			$_SESSION['id']=$user;
			//密码
			$_SESSION['ipass']=$upass;
			//职位
			$_SESSION['zw']=$row[5];
			//姓名
			$_SESSION['name']=$row[3];
			//部门
			$_SESSION['nameid']=$row[4];
			//楼号
			$_SESSION['poi']=$row[6];
			//权限
			$_SESSION['cg']=$row[7];
			$sqlre="insert into sch_loginre values('','".$row[1]."','".$row[3]."','".$row[5]."','".$da1."','管理员')";
			$rsre=mysql_query($sqlre,$con);
			?>
			<script language="javascript">
				location.href="../admin/infor/admincd_index.php";
			</script>
			<?
		}
			 
		else
		{
			  
			?>
			<script language="javascript">
				location.href="../index.php?c=1";
			</script>
			<?
		}
	}
	else
	{
		?>
		<script language="javascript">
			alert("非法接入！");
			window.location.href="../index.php";
		</script>
				<?
	}
	?>

</body>
</html>