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



header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set("Asia/Shanghai");

//住房预定类
class Reserve_Room_class{
	var $tuser;			//申请人账号
	var $tphone;		//申请人电话
	var $tnan;			//男生人数
	var $tnv;			//女生人数
	var $ttime;			//申请时间
	var $tstart_time;	//入住时间
	var $tend_time;		//退房时间
	var $con;			//数据库
	function __construct($con){
		// $this->tuser=$tuser;
		// $this->tphone=$tphone;
		// $this->tnan=$tnan;
		// $this->tnv=$tnv;
		// $this->ttime=$ttime;
		// $this->tstart_time=$tstart_time;
		// $this->tend_time=$tend_time;
		$this->con=$con;
	}
	//新增
	function Room_insert($tuser,$tphone,$tnan,$tnv,$ttime,$tstart_time,$tend_time){
		if($tuser=="" || $tphone=="" || $tnan=="" || $tnv=="" || $ttime=="" || $tstart_time=="" || $tend_time=="")
		{
			$jg="error_#0";
		}
		else
		{
			$con=$this->con;
			//新增预定
			$jg="";
			$sql="insert into reserve_room_re(ruser,rphone,rnan,rnv,rtime,rstart_time,rend_time,r_sh_a,r_sh_b) values('".$tuser."','".$tphone."','".$tnan."','".$tnv."','".$ttime."','".$tstart_time."','".$tend_time."','未审核','未审核')";
			$rs=mysql_query($sql,$con);
			if($rs>0)
			{
				$jg="ok";
			}
			else
			{
				$jg="error_#1";
			}
			$jphone="update sch_teab set tphone='".$tphone."' where tjobnum='".$tuser."'";
			$rsphone=mysql_query($jphone,$con);
		}
		return $jg;
	}

	//匹配黑名单
	function Room_Blacklist(){

	}

	//查询电话
	function Room_phone($tuser){
		$con=$this->con;
		$jg="";
		$sql="select tphone from sch_teab where tjobnum='".$tuser."'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{
			$jg=$row[0];
		}
		else
		{
			$jg="";
		}
		return $jg;
	}

	/*
		最新预定日期（年-月）
		$tuser 		账号
		$nowY 		当前年
		$nowm		当前月
	 */
	function newRoom($tuser,$nowY,$nowm){
		$con=$this->con;
		$jg="";
		$sql="select rtime from reserve_room_re where ruser='".$tuser."' order by rid desc";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{
			$jg=substr($row[0],0,7);
		}
		else
		{
			$jg=$nowY.'-'.$nowm;
		}
		return $jg;
	}

	/*
		根据日期查询内容
		$tuser 	账号
		$rtime 	查询年月

	 */
	function SelectRoom($tuser,$rtime){
		$con=$this->con;
		$sql="select * from reserve_room_re where ruser='".$tuser."' and rtime like '".$rtime."%'";
		$rs=mysql_query($sql,$con);
		return $rs;
	}



}

?>