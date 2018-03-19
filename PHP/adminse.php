<?
//此处修改非法接入返回位置（网址首页）
$add="http://127.0.0.1:8080/schoolB/index.php";

$user=$_SESSION['user'];
$upass=$_SESSION['upass'];
$utype=$_SESSION['utype'];

if($utype=="管理员" || $utype=="教师" || $utype=="学生")
{
	if($utype=="管理员")
	{
		if($_SESSION['cg']!=0)
		{
			$sql="select * from sch_admin where s_username='".$user."'";
			$rs=mysql_query($sql,$con);
			if($row=mysql_fetch_row($rs))
			{
				if($upass!==$_SESSION['spassid'] || $user!==$row[1])
				{	
				?>
				<script language="javascript">
					alert("请先登陆！");
					window.location.href="<?=$add?>";
				</script>
				<?
				die();
				}
				
			}
		}
		else
		{
			session_start(); 
			session_destroy(); 
			//自动登录删除
			setcookie("schoolb_username","",time()-86400*31,'/');//30天后cookie失效
			setcookie("schoolb_password","",time()-86400*31,'/');
			setcookie("schoolb_type","",time()-86400*31,'/');
			?>
            <script language="javascript">
					alert(" 该账号已离职 \n 如有疑问请询问部门主管");
					window.location.href="<?=$add?>";
				</script>
            <?
			die();
		}
	}
	
	if($utype=="学生")
	{
		$sql="select * from sch_stub where tno='".$user."'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{
			if($upass!==$_SESSION['spassid'] || $user!==$row[7])
			{	
			?>
			<script language="javascript">
				alert("请先登陆！");
				window.location.href="<?=$add?>";
			</script>
			<?
			die();
			}
			
		}
	}
	
	if($utype=="教师")
	{
		$sql="select * from sch_teab where tjobnum='".$user."'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{
			if($upass!==$_SESSION['spassid'] || $user!==$row[6])
			{	
			?>
			<script language="javascript">
				alert("请先登陆！");
				window.location.href="<?=$add?>";
			</script>
			<?
			die();
			}
			
		}
	}
}
else
{
			?>
			<script language="javascript">
				alert("请先登陆！");
				window.location.href="<?=$add?>";
			</script>
			<?
			die();
}

?>