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

//住房预定审批类
ini_set('display_errors', 'off');
error_reporting(0);
error_reporting(E_ALL^E_NOTICE^E_WARNING);

header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set("Asia/Shanghai");



class reserve_blacklist_class{
	var $con;	//数据库
	function __construct($con){
		$this->con=$con;
	}

	/*
		查询已经入住过的老师
	 */
	function select_tea(){
		$con=$this->con;
		$sql="select b.* from reserve_room_re as a,sch_teab as b where a.ruser=b.tjobnum group by a.ruser";
		$rs=mysql_query($sql,$con);
		return $rs;
	}
	/*
		操作
		$tid 	账号
		$cz 	具体操作（true-拉黑,false-取消拉黑）

	 */
	function set_blacklist($tid,$cz)
	{

		$con=$this->con;
		if($cz=="true")
		{
			$cz="拉黑";
			$czs="取消";
		}
		else
		{
			$cz="取消";
			$czs="拉黑";
		}
		$sqls="select * from reserve_room_blacklist where rmm='".$czs."' and ruser='".$tid."'";
		$rss=mysql_query($sqls,$con);
		if($row=mysql_fetch_row($rss))
		{
			$sql="update reserve_room_blacklist set rmm='".$cz."' where ruser='".$tid."'";
			$rs=mysql_query($sql,$con);
		}
		else
		{
			$sql="insert into reserve_room_blacklist(ruser,rmm) values('".$tid."','".$cz."')";
			$rs=mysql_query($sql,$con);
		}
		return $rs;
	}
	/*
		查询是否被拉黑
		$tid 	账号

	 */
	function selectb($tid)
	{
		$con=$this->con;
		$sql="select * from reserve_room_blacklist where ruser='".$tid."' and rmm='拉黑'";
		$rs=mysql_query($sql,$con);
		return $rs;
	}
	
}

?>