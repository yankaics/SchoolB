<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<!---->
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="favicon.ico" />
<!--JSQ-->
<script src="../JSQ/jquery-2.1.1.min.js"></script>
<title>登录</title>
</head>

<body bgcolor="#393D49">

<?
include("../SQL/db/db.php");
include"riqi.php";

//登陆超过五次错误锁定30分钟
if($_COOKIE['schoolb_username_sd']>=5)
{
	?>
	<script language="javascript">
		location.href="../del_login.php?sd5=1";
	</script>
	<?
	die();
}
//登陆错误处理
function sdcl()
{
	//登陆错误五次锁定30分钟（暂时用cookie，以后有时间弄成数据库）
	$sd=1+$_COOKIE['schoolb_username_sd'];
	setcookie("schoolb_username_sd",$sd,time()+1800,'/');
	//登陆错误提示
	if($_COOKIE['schoolb_username_sd']==3)
	{
		?>
		<script language="javascript">
			location.href="../del_login.php?sd3=1";
		</script>
		<?
	}
	else if($_COOKIE['schoolb_username_sd']==4)
	{
		?>
		<script language="javascript">
			location.href="../del_login.php?sd4=1";
		</script>
		<?
	}
}

$user=$_POST['user'];
$mysql['user'] = mysql_real_escape_string($user);
$_SESSION['user']=$user;

if(isset($_COOKIE['schoolb_password']))
{
	$upass=$_COOKIE['schoolb_password'];
}
else
{
	$upass=sha1(md5($_POST['upass']));
}
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
			if($row[10]=="在校")
			{
				if($row[9]!='')
				{
					
					$spassid=sha1(md5($row[9]));
				}
				else
				{
					$spassid=sha1(md5($row[3]));
				}

				if($mysql['upass']===$spassid && $user===$row[7])
				{
					//学号
					$_SESSION['txh']=$row[7];
					//姓名
					$_SESSION['txm']=$row[1];
					//生日
					$_SESSION['tbirth']=substr($row[3],-4,4);
					//专业
					$_SESSION['tzy']=$row[5];
					//寝室
					$_SESSION['tdorm']=$row[8];
					//辅导员
					$_SESSION['tfdy']=$row[6];
					//电话
					$_SESSION['tdh']=$row[4];
					//学生自动登录
					setcookie("schoolb_username",$user,time()+86400*30,'/');//30天后cookie失效
					setcookie("schoolb_password",$upass,time()+86400*30,'/');
					setcookie("schoolb_type",$utype,time()+86400*30,'/');

					//密码
					$_SESSION['spassid']=$spassid;
					$sqlre="insert into sch_loginre values('','".$row[7]."','".$row[1]."','".$row[5]."','".$da1."','学生')";
					$rsre=mysql_query($sqlre,$con);
					?>
					<script language="javascript">
						location.href="../loginok.php";
					</script>
					<?
				}
				else
				{
					//登陆错误处理
					sdcl();
					?>
					<script language="javascript">
						location.href="../del_login.php?c=1&sname=<?=$user?>";
					</script>
					<?
				}
			}
			else
			{
				?>
				<script language="javascript">
					location.href="../del_login.php?jg=1";
				</script>
				<?
			}
	
		}
		else
		{
			?>
			<script>
				location.href="../del_login.php?z=1";
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
				
				$spassid=sha1(md5($row[7]));
			}
			else
			{
				$spassid=sha1(md5($row[3]));
			}
			
			if($mysql['upass']===$spassid && $user===$row[6])
			{
				//姓名
				$_SESSION['txm']=$row[1];
				//电话
				$_SESSION['tdh']=$row[4];
				//部门
				$_SESSION['tjob']=$row[5];
				//教师自动登录
				setcookie("schoolb_username",$user,time()+86400*30,'/');//30天后cookie失效
				setcookie("schoolb_password",$upass,time()+86400*30,'/');
				setcookie("schoolb_type",$utype,time()+86400*30,'/');

				//密码
				$_SESSION['spassid']=$spassid;
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
				//登陆错误处理
				sdcl();
				
				?>
				<script language="javascript">
					location.href="../index.php?c=1&sname=<?=$user?>";
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
		$sql="select * from sch_admin where s_username='".$mysql['user']."'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{
				$spassid=sha1(md5($row[2]));
		}
		if($mysql['upass']===$spassid && $user===$row[1])
		{
			
			//账号
			$_SESSION['id']=$user;
			//密码
			$_SESSION['ipass']=$upass;
			//职位
			$_SESSION['zw']=$row[5];
			//姓名
			$_SESSION['name']=$row[3];
			//电话
			$_SESSION['nameid']=$row[4];
			//楼号
			$_SESSION['poi']=$row[6];
			//权限
			$_SESSION['cg']=$row[7];

			//管理员自动登录
			setcookie("schoolb_username",$user,time()+86400*30,'/');//30天后cookie失效
			setcookie("schoolb_password",$upass,time()+86400*30,'/');
			setcookie("schoolb_type",$utype,time()+86400*30,'/');
			//密码
			$_SESSION['spassid']=$spassid;
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
			//登陆错误处理
			sdcl();
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
	if($user=="" || $upass=="")
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