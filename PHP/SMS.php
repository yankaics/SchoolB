<?php
/*

短信10分钟内只能发给同一个人3次，超过将不能收到。

1、appID与appToken向技术中心申请。
2、调用前，将PHP的soap扩展模块打开，即php.ini中的extension = php_soap.dll 前面的分号去掉
3、php文件编码必须设置为utf-8。可用记事本打开，保存时选择htf-8格式
*/


class SMS{

	var $tphone;	//电话
	var $ttext;		//内容
	var $con;		//数据库
	var $client; 	//短信需要
	var $wsdl;		//接口地址
	var $appID;		//账号ID
	var	$appToken;	//ToKen
	var $strMd5;	//加密验证

	function __construct($con){
		$this->con=$con;
	}

	/*
		单人发送
		$tphone	电话
		$ttitle 头部（例如：校园宝报修，校园宝住房）
		$ttext 	发送内容

	 */
	function say_sms($tphone,$ttitle,$ttext){
		$con=$this->con;
		date_default_timezone_set("Asia/Shanghai");
		$wsdl = ""; //短信接口
		$client = new SoapClient($wsdl);
		$appID=""; //ID账号
		$appToken=""; //Token密码
		$strMd5=strtoupper(md5($appID.$appToken));

		//参数赋值
		$param = array('appId'=>$appID,'strMD5'=>$strMd5,'Mobiles'=>$tphone, 'SmContent'=>'【'.$ttitle.'】'.$ttext);

		//发送短信
		$ret = $client->SendMs($param);
		$sql="insert into sms_re(sphone,stitle,stext,stime) values('".$tphone."','".$ttitle."','".$ttext."','".date("Y-m-d")."')";
		$rs=mysql_query($sql,$con);
		//返回结果
		return $ret;
	}
}

?>