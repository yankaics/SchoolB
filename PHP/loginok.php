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


<?
include("../SQL/db/db.php");
include"riqi.php";

//CSRF保护（登陆页）
class verifyCsrf{
	
	protected static $originCheck = true; //来源控制
	public $token;
	public $time_token;
	
	public static function _checkToken( $key, $origin ){
		if ( !isset( $_SESSION[ 'csrf_' . $key ] ) )
            return false;
		
		if ( !isset( $origin[ $key ] ) )
            return false;
			
		$hash = $_SESSION[ 'csrf_' . $key ]; //获取存在session中的token
		
		//验证来源  根据加密验证
		if( self::$originCheck && sha1( $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT'] ) != substr( base64_decode( $hash ), 10, 40 ) ) 
			return false;
		
		//验证token
		if ( $origin[ $key ] != $hash )
            return false;
		
		//验证时间
		$expired_time = time() - $_SESSION['token_time'];
		if ($expired_time >= 300)
			return false;
		
        return true;
	}
 
	
	//跳转
	public static function _jump() {
		header("Location: ../del_login.php?er");
	}
	
}
 
$post['token'] = $_POST['token'];
 
$vc = verifyCsrf::_checkToken('token',$post);
 
if ($vc === true) {
	

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
						//登陆失败清除次数
						setcookie("schoolb_username_sd",0,time()-1800,'/');
						
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
					//账号
					$_SESSION['txh']=$row[6];
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
					//登陆失败清除次数
					setcookie("schoolb_username_sd",0,time()-1800,'/');
					
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
						location.href="../del_login.php?c=1&sname=<?=$user?>";
					</script>
					<?
				}
		
		
			}
			else
			{
				?>
				<script language="javascript">
						location.href="../del_login.php?z=1";
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
				//登陆失败清除次数
				setcookie("schoolb_username_sd",0,time()-1800,'/');
				
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
					location.href="../del_login?c=1";
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

} else {
	verifyCsrf::_jump();//CSRF
}
?>