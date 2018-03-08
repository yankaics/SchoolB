<?
//获取数据库
$sql_name="root";
$sql_pass="123";
//链接数据库
$con=mysql_connect('127.0.0.1',"$sql_name","$sql_pass");
//选择数据库
mysql_select_db('schoolb',$con) or die("选择数据库失败");
//中字错误修复
mysql_query("set names 'utf8' ");
mysql_query("set character_set_client=utf8");
mysql_query("set character_set_results=utf8");
session_start();

ini_set('display_errors', 'off');
error_reporting(0);
error_reporting(E_ALL^E_NOTICE^E_WARNING);
?>