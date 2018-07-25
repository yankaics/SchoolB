<?php
/**
 * This file is part of online_chat_room.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    AmosHuKe<amoshuke@qq.com>
 * @copyright AmosHuKe<amoshuke@qq.com>
 * @link      https://github.com/AmosHuKe/Hi/tree/master/Online_Chat_Room
 * @license   http://www.opensource.org/licenses/mit-license.php (MIT License)
 */

//住房预定审批类
ini_set('display_errors', 'off');
error_reporting(0);
error_reporting(E_ALL^E_NOTICE^E_WARNING);

header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set("Asia/Shanghai");

class admin_reserve_class{
	var $con;	//数据库
	var $ruser;	//审核员账号
	function __construct($con,$tuser){
		$this->con=$con;
		$this->ruser=$tuser;
	}

	/*
		根据审核员查询数据
		$zt 	根据审核结果查询数据（未审核，同意，拒绝）
	 */
	function Select_SH($zt){
		//数值
		$con=$this->con;
		$ruser=$this->ruser;
		//查数据
		if($ruser=="sha")		//审核员A
		{
			$sql="select a.tname,a.tdepar,b.* from sch_teab as a,reserve_room_re as b where a.tjobnum=b.ruser and b.r_sh_a='".$zt."' order by rend_time asc";
			$rs=mysql_query($sql,$con);
		}
		else if($ruser=="shb")	//审核员B
		{
			$sql="select a.tname,a.tdepar,b.* from sch_teab as a,reserve_room_re as b where a.tjobnum=b.ruser and b.r_sh_a='同意' and b.r_sh_b='".$zt."' order by rend_time asc";
			$rs=mysql_query($sql,$con);
		}

		return $rs;

	}

	/*
		审批
		$zt 	审批结果（未审核，同意，拒绝）
	 */
	function SH($zt){
		//数值
		$con=$this->con;
		$ruser=$this->ruser;
		//查数据
		if($ruser=="sha")		//审核员A
		{
			$sql="select a.tname,a.tdepar,b.* from sch_teab as a,reserve_room_re as b where a.tjobnum=b.ruser and b.r_sh_a='".$zt."'";
			$rs=mysql_query($sql,$con);
		}
		else if($ruser=="shb")	//审核员B
		{
			$sql="select a.tname,a.tdepar,b.* from sch_teab as a,reserve_room_re as b where a.tjobnum=b.ruser and b.r_sh_a='同意' and b.r_sh_b='".$zt."'";
			$rs=mysql_query($sql,$con);
		}

		return $rs;

	}
}

?>