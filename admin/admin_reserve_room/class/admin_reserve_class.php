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
		$zt 		根据审核结果查询数据（未审核，同意，拒绝)
		$zt_order 	ID排列顺序(true升序,false降序)
	 */
	function Select_SH($zt,$zt_order){
		if($zt_order)
		{
			$zt_order="asc";
		}
		else
		{
			$zt_order="desc";
		}
		//数值
		$con=$this->con;
		$ruser=$this->ruser;
		//查数据
		if($ruser=="sha")		//审核员A
		{
			$sql="select a.tname,a.tdepar,b.* from sch_teab as a,reserve_room_re as b where a.tjobnum=b.ruser and b.r_sh_a='".$zt."' order by rid ".$zt_order."";
			$rs=mysql_query($sql,$con);
		}
		else if($ruser=="shb")	//审核员B
		{
			$sql="select a.tname,a.tdepar,b.* from sch_teab as a,reserve_room_re as b where a.tjobnum=b.ruser and b.r_sh_a='同意' and b.r_sh_b='".$zt."' order by rid ".$zt_order."";
			$rs=mysql_query($sql,$con);
		}

		return $rs;

	}

	/*
		审批
		$tid 	ID
		$tcz 	审批结果（未审核，同意，拒绝）
	 */
	function SH($tid,$tcz='未审核'){
		if($tid!="" || $tid!=null)
		{
			//数值
			$con=$this->con;
			$ruser=$this->ruser;
			//审批
			if($ruser=="sha")		//审核员A
			{
				$sql="update reserve_room_re set r_sh_a='".$tcz."' where rid=".$tid."";
				$rs=mysql_query($sql,$con);
				if($rs>0)
				{
					$jg=$tcz;
				}
				else
				{
					$jg="error";
				}
			}
			else if($ruser=="shb")	//审核员B
			{
				$sql="update reserve_room_re set r_sh_b='".$tcz."' where rid=".$tid." and r_sh_a='同意'";
				$rs=mysql_query($sql,$con);
				if($rs>0)
				{
					$jg=$tcz;
				}
				else
				{
					$jg="error";
				}
			}

			return $jg;
		}

	}
}

?>