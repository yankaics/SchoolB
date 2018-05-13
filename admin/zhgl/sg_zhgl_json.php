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

include("../../SQL/db/db.php");	
include("../adminse/admin_se.php");	
// 暂时使用自己写的样式，所以这个用不到，先保留。
// echo $a = '{
// 	  "code": 0,
// 		"msg": "",
// 		"count": 0,
// 		"data": [
// 		{
// 	      "id": "*",
// 	      "username": "*",
// 	      "userpass": "*",
// 	      "lh": "*",
// 	      "name": "*",
// 	      "phone": "*",
// 	      "zw": "*"
// 	    }';
// $sql="select * from sch_admin where s_position='宿管员'";
// $rs=mysql_query($sql,$con);
// while($row=mysql_fetch_row($rs))
// {
// 	echo $xq='
// 	    ,{
// 	      "id": "'.$row[0].'",
// 	      "username": "'.$row[1].'",
// 	      "userpass": "'.$row[2].'",
// 	      "lh": "'.$row[6].'",
// 	      "name": "'.$row[3].'",
// 	      "phone": "'.$row[4].'",
// 	      "zw": "'.$row[5].'"
// 	    }';
// }
// echo $ft=']
// 	}';
?>