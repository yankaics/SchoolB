<?PHP

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

class sms_re_class
{
	var $con;//数据库
	function __construct($con){
		$this->con=$con;
	}
	/*
		日期年月日
	 */
	function sms_time(){
		$con=$this->con;
		$timesms=array();
		$i=0;
		$sql="select stime from sms_re group by stime";
		$rs=mysql_query($sql,$con);
		while($row=mysql_fetch_row($rs))
		{
			$timesms[$i]=$row[0];
			$i++;
		}
		return $timesms;
	}
	/*
		按日期算数量
	 */
	function sms_sum(){
		$con=$this->con;
		$sumsms=array();
		$i=0;
		$sql="select count(stime) from sms_re group by stime";
		$rs=mysql_query($sql,$con);
		while($row=mysql_fetch_row($rs))
		{
			$sumsms[$i]=$row[0];
			$i++;
		}
		return $sumsms;
	}
}

?>