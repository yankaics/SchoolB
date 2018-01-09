<?php
include("../../SQL/db/db.php");		
$sql="select s_tt,sid,s_id from sch_repair_rea where sid='".$_GET['photoid']."'";
$rs=mysql_query($sql,$con);
if($row=mysql_fetch_row($rs))
{
	echo $a = '{
	  "title": "维修照片",
	  "id": '.$_GET['photoid'].',
	  "start": 0,
	  "data": [
	    {
	      "alt": "'.$row[0].'",
	      "pid": '.$row[1].',
	      "src": "../../'.$row[2].'",
	      "thumb": ""
	    }
	  ]
	}';

}
		
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

		
	  	 	

