<?php
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
else if(isset($_GET['sd5']))
{
	//登陆错误5次
	header("location:index.php?sd5=1");
}
else if(isset($_GET['sd4']))
{
	//登陆错误4次
	header("location:index.php?sd4=1");
}
else if(isset($_GET['sd3']))
{
	//登陆错误3次
	header("location:index.php?sd3=1");
}
else
{
	header("location:index.php");
}
?>