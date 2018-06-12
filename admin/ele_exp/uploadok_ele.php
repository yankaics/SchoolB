<!--
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
-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!---->
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link rel="shortcut icon" href="../../favicon.ico" />
<meta http-equiv="Content-Type" content="text/html"; charset="GB2312" />
<title>上传处理</title>
</head>

<body>
<center>
<div style="padding-top:100px;">
<?
header("Content-Type: text/html;charset=gb2312");
include("../../PHP/riqi.php");
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
include("../adminse/admin_se.php");

$adminm=$_POST['sadminm'];
$adminY=$_POST['sadminY'];
$upname=$_FILES['ttupload']['name'];
$tmpname=$_FILES['ttupload']['tmp_name'];
move_uploaded_file($tmpname,"../../excelcsv/".$rqY.$rqm.$rqd.$rqH.$rqi.$rqs.'-'.$upname);

$temp=file("../../excelcsv/".$rqY.$rqm.$rqd.$rqH.$rqi.$rqs.'-'.$upname."");//连接EXCEL文件,格式为.csv

//查找是否有重复
$cxstring=explode(",",$temp[2]);
$cxsql="select * from sushe_user where sushe_name='".$cxstring[0]."' and sushe_date='".$cxstring[11]."'";
$cxrs=mysql_query($cxsql,$con);
if($row=mysql_fetch_row($cxrs))
{
  ?>
  <script type="text/javascript">
    alert("所录入的表已经存在，录入中断。\n======================\n抄表时间：<?=$cxstring[11]?>");
    location.href="upload_ele.php";
  </script>
  <?
}
else
{

  for ($i=0;$i <count($temp);$i++) 
  { 
    $string=explode(",",$temp[$i]);//通过循环得到EXCEL文件中每行记录的值 
    //将EXCEL文件中每行记录的值插入到数据库中 
    $q="insert into sushe_user (sushe_name,sushe_dor,sushe_number,sushe_uname,sushe_mbase,sushe_mreading,sushe_ele,sushe_quota,sushe_excess,sushe_emoney,sushe_money,sushe_date,sushe_people,sushe_Y) values('$string[0]','$string[1]','$string[2]','$string[3]','$string[4]','$string[5]','$string[6]','$string[7]','$string[8]','$string[9]','$string[10]','$string[11]','$string[12]','".$adminY."-".$adminm."')"; 
    $rs=mysql_query($q) or die (mysql_error()); 

    if (mysql_error())
    { 
    ?>
    	<script language="javascript">
        	alert("上传失败，联系技术人员");
    		location.href="upload_ele.php";
    	</script>
        
    <?
    }
    else
    {
    echo "<br>".$string[1]." 上传成功";
    unset($string);
    	?>
        <script language="javascript">
        	alert("上传成功，你所上传的数据为<?=$adminY?>年<?=$adminm?>月");
    		location.href="upload_ele.php";
    	</script>
        <?
    } 
  }

}
  ?>
</div>
</center>
</body>
</html>