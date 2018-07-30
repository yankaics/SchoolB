
<!-- 定时刷新一次 -->
<script type="text/javascript">
	setTimeout(function(){  
		window.location.reload();//页面刷新
	},600000);
</script>
<?php
	/*
		自动发送短信（主要用于公物报修提醒主管分配）
		查询提醒一次
		$tphone 需要发送的电话
	 */
	header("content-type:text/html;charset=utf-8"); 
	date_default_timezone_set("Asia/Shanghai");
	include("../../SQL/db/db.php");//数据库
	if($_GET["SMSToKen"]=="gwbxsms")
	{
		
		include("../../PHP/SMS.php");//短信类
		$tphone=array("电话");
		$gms=new SMS($con);

		//文件名
		$myroom="gwbx_num.xml";
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
		$sqls="select sid from sch_repair_re order by sid desc limit 1";
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

			$sql="select s_repair from sch_repair_re where s_repair='未分配'";
			$rs=mysql_query($sql,$con);
			if($row=mysql_fetch_row($rs))
			{
				for($i=0;$i<=count($tphone)-1;$i++)
				{
					$jg=$gms->say_sms($tphone[$i],"校园宝报修","有新的报修需要进行分配  ".date('Y-m-d H:i:s',time()));
				}
			}
		}
	
	}
	else
	{
		echo "Error";
	}
?>