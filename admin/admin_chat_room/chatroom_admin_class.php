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

include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");
//屏蔽错误
ini_set('display_errors', 'off');
error_reporting(0);
error_reporting(E_ALL^E_NOTICE^E_WARNING);
//
header("content-type:text/html;charset=utf-8"); 
date_default_timezone_set("Asia/Shanghai");
include("chatroom_config.php");//聊天室配置文件
//房间管理类
class chatroom_admin_class
{
	var $chatroom_wjj;//需要查询的文件夹位置
	function __construct()
	{
		//构造函数
		include("chatroom_config.php");//聊天室配置文件
		$this->chatroom_wjj=$chatroom_location; //文件夹位置
	}
	//查出所有房间名字
	function chatroom_all()
	{
		//文件夹位置
		$wjj=$this->chatroom_wjj;
		$i=-1;
		//检查是否为目录
		if(is_dir($wjj)){
			//打开一个目录句柄
			if ($dh = opendir($wjj)){
				//判断打开的目录句柄中的条目
				while (($file = readdir($dh)) !== false){
					
					if($file!="." && $file!=".."){
						$i=$i+1;
						$room[$i]=$file;
					}
				}
				return $room;
			//关闭由 opendir() 函数打开的目录句柄。
			closedir($dh);
			}
		}

	}
	//查询某个房间的聊天数($room=房间号)
	function chatroom_count($room)
	{
		$wjj=$this->chatroom_wjj; //文件夹位置
		$xmldoc = new DOMDocument();
		$xmldoc->load($wjj.$room);
		return $xmldoc->getElementsByTagName("ChatRoom")->item(0)->childNodes->length;
	}
	//查询房间的创建时间($room=房间号)
	function chatroom_time($room)
	{
		$wjj=$this->chatroom_wjj; //文件夹位置
		$xmldoc = new DOMDocument();
		$xmldoc->load($wjj.$room);
		$stus =$xmldoc->getElementsByTagName("chat");
		return $stus->item(0)->getElementsByTagName("chattime")->item(0)->nodeValue;
	}

}

//删除文件(delroom=房间号)
if(isset($_GET['delroom']))
{
	$filedz=$chatroom_location.$_GET['delroom'].".xml";
	if(unlink($filedz))
	{
		header("Location:chatroom_admin.php?del=ok");
	}
	else
	{
		header("Location:chatroom_admin.php?del=error");
	}
	
}
//删除节点(nroom=房间号,cnode=节点位置)
if(isset($_GET['nroom']))
{
	$dom = new DOMDocument();
	$dom->load($chatroom_location.$_GET['nroom'].".xml");

	$stu_nodes =$dom->getElementsByTagName("chat");

	$stu_node=$stu_nodes->item($_GET['cnode']);

	$stu_node->parentNode->removeChild($stu_node);

	$dom->save($chatroom_location.$_GET['nroom'].".xml");

	header("Location:chatroom_index.php?room=".$_GET['nroom']."");
}

?>