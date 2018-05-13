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

ini_set('display_errors', 'off');
error_reporting(0);
error_reporting(E_ALL^E_NOTICE^E_WARNING);

header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set("Asia/Shanghai");
session_start();
//聊天
	class chat_class{
		var $room_name;//房间名
		var $room_chat;//房间地址
		var $cname_chat;//姓名
		var $ctime_chat;//时间
		var $cid_chat;//学号
		var $cnr_chat;//内容
		function __construct($croom,$cname,$cid){
			$this->room_name=$croom.".xml";//房间名
			$this->room_chat="chat_room/".$croom.".xml";//房间地址
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

			$uname=$this->cname_chat; //名字
			$uid=$this->cid_chat; //学号
			$utime=$this->ctime_chat; //时间
			//xml新增
			$xmldoc = new DOMDocument();
			$xmldoc->load($myroom);
			$root = $xmldoc->getElementsByTagName("ChatRoom")->item(0);
			$stu_node = $xmldoc->createElement("chat");
			//新增id
			$name_node = $xmldoc->createElement("id");
			$name_node->nodeValue=$this->count_p();
			$stu_node->appendChild($name_node);
			//新增姓名
			$name_node = $xmldoc->createElement("name");
			$name_node->nodeValue=$uname;
			$stu_node->appendChild($name_node);
			//新增学号
			$name_node = $xmldoc->createElement("stuid");
			$name_node->nodeValue=$uid;
			$stu_node->appendChild($name_node);
			//新增时间
			$name_node = $xmldoc->createElement("chattime");
			$name_node->nodeValue=$utime;
			$stu_node->appendChild($name_node);
			//新增内容
			$name_node = $xmldoc->createElement("chatnr");
			$name_node->nodeValue=$znr;
			$stu_node->appendChild($name_node);
			//写入文件
			$root->appendChild($stu_node);
			$xmldoc->save($myroom);

			
			
		}
		//创建，读取内容（节点名，节点位置）
		function chat_say($name,$i)
		{
			//房间地址
			$myroom=$this->room_chat;
			//如果没有房间则创建房间
			if(!file_exists($myroom))
			{
				$myfile = fopen($myroom, "w") or die("Unable to open file!");
				$nr='<?xml version="1.0" encoding="utf-8" ?><ChatRoom><chat><id>0</id><name>房间创建</name><stuid>'.$this->room_name.'</stuid><chattime>'.$this->ctime_chat.'</chattime><chatnr>'.$this->ctime_chat.'</chatnr></chat></ChatRoom>';
				fwrite($myfile,$nr);
			}
			//读取内容
			//xml Dom
			$xmldoc = new DOMDocument();
			$xmldoc->load($myroom);
			$stus =$xmldoc->getElementsByTagName("chat");
			return $stus->item($i)->getElementsByTagName($name)->item(0)->nodeValue;
		}
		
		//子节点个数
		function count_p()
		{
			$xmldoc = new DOMDocument();
			$xmldoc->load($this->room_chat);
			return $xmldoc->getElementsByTagName("ChatRoom")->item(0)->childNodes->length;
		}
	}
?>