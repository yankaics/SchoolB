<?php
ini_set('display_errors', 'off');
error_reporting(0);
error_reporting(E_ALL^E_NOTICE^E_WARNING);
header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set("Asia/Shanghai");
session_start();
//聊天
	class chat_class{
		var $room_chat;//房间号
		var $cname_chat;//姓名
		var $ctime_chat;//时间
		var $cid_chat;//学号
		var $cnr_chat;//内容
		function __construct($croom,$cname,$cid){
			$this->room_chat="chat_room/".$croom;//房间
			$this->cname_chat=$cname; //姓名
			$this->cid_chat=$cid;//学号
			$this->ctime_chat=date("Y.m.d H:i:s");//年月日
		}
		//写入内容(新的写在前面)
		function chat_fwtie($cnr){
			//房间号
			$myroom=$this->room_chat;
			//过滤不文明语言
			$str = "/你大爷|你麻痹|SB|日你妈|我日你妈|我日你|草你|你他妈/";
			//内容(特殊字符转实体，过滤不文明语言)
			$znr=htmlspecialchars(preg_replace($str, "*么么哒*", mb_substr($cnr,0,30,"UTF8")));
			//生成随机名字后缀
			//$zname = array("大佬","嘿嘿","小朋友","大朋友"); 
			//$sj=rand(0,3);
			//$uname=mb_substr($this->cname_chat,0,1,"UTF8");
			//姓+随机组成名字
			//$uname=$uname.$zname[$sj];
			$uname=$this->cname_chat;
			//内容组成
			$nr='<div class="main '.$this->cid_chat.'"> <div class="ctime">'.$this->ctime_chat.'</div> <div class="cname">'.$uname.'：</div> <div class="cnr">'.$znr.'</div> </div>
			';
			$temp=file_get_contents($myroom.".txt");
			file_put_contents($myroom.".txt",$nr.$temp);
			
		}
		//读取内容
		function chat_say(){
			//房间号
			$myroom=$this->room_chat;
			//如果没有房间则创建房间
			if(!file_exists($myroom.".txt"))
			{
				$myfile = fopen($myroom.".txt", "w") or die("Unable to open file!");
			}
			//读取内容
			$myfile = fopen($myroom.".txt", "r") or die("Unable to open file!");
			echo fread($myfile,filesize($myroom.".txt"));
			fclose($myfile);
		}
	}
?>