<?php
session_start(); 
session_destroy(); 
//自动登录删除
setcookie("schoolb_username","",time()-86400*31,'/');//30天后cookie失效
setcookie("schoolb_password","",time()-86400*31,'/');
setcookie("schoolb_type","",time()-86400*31,'/');
if(isset($_GET['z']))
{
	header("location:index.php?z=1");
}
else if(isset($_GET['c']))
{
	header("location:index.php?c=1&sname=".$_GET['sname']."");
}
else if(isset($_GET['jg']))
{
	header("location:index.php?jg=1");
}
else
{
	header("location:index.php");
}
?>