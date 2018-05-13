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

	//必须相对的定义地点和地点代码，比如宿舍=ss，计数代码在前加个count ，如宿舍=ss=countss，不能有相同的命名。用在权限判断后
	//地点
	$arrayall=array('宿舍','食堂','运动场','图书馆','综合楼','教学楼','实训楼','其他区域','超市','洗澡堂','锅炉房','6号楼');
	//地点代码
	$arrayalldm=array('ss','st','ydc','tsg','zhl','jxl','sxl','qtqy','cs','xzt','glf','lhl');
	//地点计数
	$arraycount=array('countss','countst','countydc','counttsg','countzhl','countjxl','countsxl','countqtqy','countcs','countxzt','countglf','countlhl');
?>