
<!-- 定时刷新一次 -->
<script type="text/javascript">
	setTimeout(function(){  
		window.location.reload();//页面刷新
	},600000);
</script>
<?php
	/*
		自动发送短信（主要用于住房预定提醒审核员审核）
		查询提醒一次
		$tphone 需要发送的电话
	 */
	header("content-type:text/html;charset=utf-8"); 
	date_default_timezone_set("Asia/Shanghai");
	include("../../SQL/db/db.php");//数据库
	if($_GET["SMSToKen"]=="reservesms")
	{
		
		include("../../PHP/SMS.php");//短信类
		$tphoneA=array("电话"); //第一次审核员电话
		$tphoneB=array("电话"); //第二次审核员电话
		$tphoneEnd=array("电话"); //分配房间的人员电话
		$gms=new SMS($con);

		/*
			初审短信提醒

		 */
		//审核员A
		//文件名
		$myroom="reserve_room_numA.xml";
		//如果没有文件创建文件
		if(!file_exists($myroom))
		{
			$myfile = fopen($myroom, "w") or die("Unable to open file!");
			$nr='<?xml version="1.0" encoding="utf-8" ?><ChatRoom><chat><id>0</id></chat></ChatRoom>';
			fwrite($myfile,$nr);
		}
		//读取内容
		//上次存入的id
		$xmldoc = new DOMDocument();
		$xmldoc->load($myroom);
		$stus =$xmldoc->getElementsByTagName("chat");
		$oldnum= $stus->item(0)->getElementsByTagName("id")->item(0)->nodeValue;
		//本次查询最新id
		$sqls="select rid from reserve_room_re order by rid desc limit 1";
		$rss=mysql_query($sqls,$con);
		if($rows=mysql_fetch_row($rss))
		{
			$newnum=$rows[0];
		}
		
		if($newnum>$oldnum)
		{
			$stu1 = $stus->item(0);
			$stu1_id = $stu1->getElementsByTagName("id")->item(0);
			$stu1_id->nodeValue = $newnum;
			//更新 xml 文档
			$xmldoc->save($myroom);
			for($i=0;$i<=count($tphoneA)-1;$i++)
			{
				$jg=$gms->say_sms($tphoneA[$i],"校园宝住房预定","有新的住房预定需要审核（第一次审核）  ".date('Y-m-d H:i:s',
					time()));
			}

		}


		/*
			终审短信提醒

		 */
		//审核员B
		//文件名
		$myroom="reserve_room_numB.xml";
		//如果没有文件创建文件
		if(!file_exists($myroom))
		{
			$myfile = fopen($myroom, "w") or die("Unable to open file!");
			$nr='<?xml version="1.0" encoding="utf-8" ?><ChatRoom><chat><id>0</id></chat></ChatRoom>';
			fwrite($myfile,$nr);
		}
		//读取内容
		//上次存入的id
		$xmldoc = new DOMDocument();
		$xmldoc->load($myroom);
		$stus =$xmldoc->getElementsByTagName("chat");
		$oldnum= $stus->item(0)->getElementsByTagName("id")->item(0)->nodeValue;
		//本次查询最新id
		$sqls="select count(rid) from reserve_room_re where r_sh_a='同意'";
		$rss=mysql_query($sqls,$con);
		if($rows=mysql_fetch_row($rss))
		{
			$newnum=$rows[0];
		}
		
		if($newnum>$oldnum)
		{
			$stu1 = $stus->item(0);
			$stu1_id = $stu1->getElementsByTagName("id")->item(0);
			$stu1_id->nodeValue = $newnum;
			//更新 xml 文档
			$xmldoc->save($myroom);
			for($i=0;$i<=count($tphoneB)-1;$i++)
			{
				$jg=$gms->say_sms($tphoneB[$i],"校园宝住房预定","有新的住房预定需要审核（最终审核）  ".date('Y-m-d H:i:s',
					time()));
			}

		}

		/*
			已通过房间分配短信提醒

		 */
		//分配房间的人员
		//文件名
		$myroom="reserve_room_numEnd.xml";
		//如果没有文件创建文件
		if(!file_exists($myroom))
		{
			$myfile = fopen($myroom, "w") or die("Unable to open file!");
			$nr='<?xml version="1.0" encoding="utf-8" ?><ChatRoom><chat><id>0</id></chat></ChatRoom>';
			fwrite($myfile,$nr);
		}
		//读取内容
		//上次存入的id
		$xmldoc = new DOMDocument();
		$xmldoc->load($myroom);
		$stus =$xmldoc->getElementsByTagName("chat");
		$oldnum= $stus->item(0)->getElementsByTagName("id")->item(0)->nodeValue;
		//本次查询最新id
		$sqls="select count(rid) from reserve_room_re where r_sh_a='同意' and r_sh_b='同意'";
		$rss=mysql_query($sqls,$con);
		if($rows=mysql_fetch_row($rss))
		{
			$newnum=$rows[0];
		}
		
		if($newnum>$oldnum)
		{
			$stu1 = $stus->item(0);
			$stu1_id = $stu1->getElementsByTagName("id")->item(0);
			$stu1_id->nodeValue = $newnum;
			//更新 xml 文档
			$xmldoc->save($myroom);
			for($i=0;$i<=count($tphoneEnd)-1;$i++)
			{
				$jg=$gms->say_sms($tphoneEnd[$i],"校园宝住房预定","有新的预定需要安排房间  ".date('Y-m-d H:i:s',
					time()));
			}

		}
	
	}
	else
	{
		echo "Error";
	}
?>