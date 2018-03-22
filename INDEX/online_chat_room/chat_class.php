<?php
header("content-type:text/html;charset=utf-8"); 
//聊天
	class chat_class{
		var $cname_chat;//姓名
		var $ctime_chat;//时间
		var $cid_chat;//学号
		var $cnr_chat;//内容
		function __construct($cname,$cid){
			$this->cname_chat=$cname; //姓名
			$this->cid_chat=$cid;//学号
			$this->ctime_chat=date("Y.m.d H:i:s");//年月日
		}
		//写入内容(新的写在前面)
		function chat_fwtie($cnr){
			//过滤不文明语言
			$str = "/你大爷|你麻痹|SB|日你妈|我日你妈|我日你|你他妈/";
			//内容(特殊字符转实体，过滤不文明语言)
			$znr=htmlspecialchars(preg_replace($str, "*么么哒*", mb_substr($cnr,0,30,"UTF8")));
			//生成随机名字后缀
			$zname = array("可爱","大佬","嘿嘿","小朋友"); 
			$sj=rand(0,3);
			$uname=mb_substr($this->cname_chat,0,1,"UTF8");
			//姓+随机组成名字
			$uname=$uname.$zname[$sj];
			//内容组成
			$nr='<div class="main '.$this->cid_chat.'"> <div class="ctime">'.$this->ctime_chat.'</div> <div class="cname">'.$uname.'：</div> <div class="cnr">'.$znr.'</div> </div>
			';
			$temp=file_get_contents("online_chats.txt");
			file_put_contents("online_chats.txt",$nr.$temp);
			
		}
		//读取内容
		function chat_say(){
			$myfile = fopen("online_chats.txt", "r") or die("Unable to open file!");
			echo fread($myfile,filesize("online_chats.txt"));
			fclose($myfile);
		}
	}
?>