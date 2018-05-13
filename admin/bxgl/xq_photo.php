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

// 这个也没用咯，服务器不支持json，直接改用js
// include("../../SQL/db/db.php");
// include("../adminse/admin_se.php");	
// $sql="select s_tt,sid,s_id from sch_repair_rea where sid='".$_GET['photoid']."'";
// $rs=mysql_query($sql,$con);
// if($row=mysql_fetch_row($rs))
// {
// 	echo $a = '{
// 	  "title": "维修照片",
// 	  "id": '.$_GET['photoid'].',
// 	  "start": 0,
// 	  "data": [
// 	    {
// 	      "alt": "'.$row[0].'",
// 	      "pid": '.$row[1].',
// 	      "src": "../../'.$row[2].'",
// 	      "thumb": ""
// 	    }
// 	  ]
// 	}';

// }
		
		//作废咯下面的方法
		// class xqphoto
		// {
		// 	public $alt="";//图片名
		// 	public $pid= "";//图片id
		// 	public $src="";//原图地址
		// 	public $thumb="";//缩略图地址
		// }
		// include("../../SQL/db/db.php");
		// $sql="select s_tt,sid,s_id from sch_repair_rea where sid='".$_GET['photoid']."'";
		// $rs=mysql_query($sql,$con);
		// if($row=mysql_fetch_row($rs))
		// {
		// 	$fphoto =new xqphoto();
		// 	$fphoto->alt=urlencode($row[0]);
		// 	$fphoto->pid=urlencode($row[1]);
		// 	$fphoto->src=urlencode('../../'.$row[2]);
		//     echo urldecode(json_encode($fphoto));
	 	//  }
?>

		
	  	 	

