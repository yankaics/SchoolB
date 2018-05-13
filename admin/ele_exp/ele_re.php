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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
	<link rel="stylesheet" href="../../layui/css/layui.css">
	<script src="../../layui/layui.js"></script>
	<link rel="shortcut icon" href="../../favicon.ico" />
	<!--JSQ-->
	<script src="../../JSQ/jquery-2.1.1.min.js"></script>
	<script src="../../JSQ/index.js"></script>
	<title>电费详情统计</title>
</head>
<body>
<?
  include("../../PHP/riqi.php");
  include("../../SQL/db/db.php");
  include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
?>
<!--main-->
<div class="layui-container">
  <div class="layui-row">
    <!--日期选择操作-->
    <div class="layui-col-md12">
      	<blockquote class="layui-elem-quote">
			<p>电费详情统计</p>
			<p>选择上传电费表的日期进行查询</p>

			<form class="layui-form" action="" name="drre" method="get">
				<div class="layui-inline">
				<select name="sadminY" id="sadminY" lay-verify="required">
				  <?
				  for($j=2017;$j<=$rqY;$j++)
				  {
				  ?>
				    <option value="<?=$j?>"><?=$j?>年</option>
				  <?
				  }
				  ?>
				</select>
				</div>

				<div class="layui-inline">
				<select name="sadminm" id="sadminm" lay-verify="required">
				  <?
				  for($i=1;$i<=12;$i++)
				  {
				  ?>
				    <option value="<?=$i?>"><?=$i?>月</option>
				  <?
				  }
				  ?>
				</select>
				</div>

				<div class="layui-inline">
				  <button class="layui-btn" name="button" id="button" lay-submit lay-filter="form">查询</button>
				</div>

	        </form>
      	</blockquote>

		<?
		if(isset($_GET['button']))
		{
			//日期
			$taY=$_GET['sadminY'];
			$tam=$_GET['sadminm']; 

			$zdf="select sum(sushe_money),count(user_id) from sushe_user where sushe_Y='".$taY."' and sushe_m='".$tam."'";
            $rszdf=mysql_query($zdf,$con);
            if($rzdf=mysql_fetch_row($rszdf))
            {
				$sumall=$rzdf[0]; //总费用
				$call=$rzdf[1]; //总寝室
            }
			$wjf="select sum(sushe_money),count(user_id) from sushe_user where sushe_Y='".$taY."' and sushe_m='".$tam."' and sushe_jg='未缴费'";
            $rswjf=mysql_query($wjf,$con);
            if($rwjf=mysql_fetch_row($rswjf))
            {
				$sumwjf=$rwjf[0]; //未缴费用
				$cwjf=$rwjf[1]; //未缴费寝室总数
            }

		?>
			<table class="layui-table">
	            <colgroup>
	              <col>
	              <col>
	              <col>
	              <col>
	            </colgroup>
	            <thead>
	              <tr>
	                <th>时间</th>
	                <th>总电费</th>                
	                <th>寝室总数</th>
	                <th>未缴费</th>
	                <th>未缴费总寝室</th>
	              </tr> 
	            </thead>
	            <tbody>
	              <tr >
	                <td><?=$taY?>年<?=$tam?>月</td>
	                <td><?=$sumall?>元</td>
	                <td><?=$call?>间</td>
	                <td><?=$sumwjf?>元</td>
	                <td><?=$cwjf?>间</td>
	              </tr>
	          </tbody>
      		</table>
				<!--每号楼总电费,抄表时间,总寝室-->
                <?
                $z1="select sum(sushe_money),sushe_date,count(user_id) from sushe_user where sushe_name=1 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsz1=mysql_query($z1,$con);
				if($rowz1=mysql_fetch_row($rsz1))
				{
					$do1=$rowz1[0].'元';
					$dod1=$rowz1[1];
					$cdo1=$rowz1[2].'间';
				}
				if($do1=='元')
				{
					$do1='暂无数据';
					$dod1='暂无数据';
					$cdo1='暂无数据';
				}
				$z2="select sum(sushe_money),sushe_date,count(user_id) from sushe_user where sushe_name=2 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsz2=mysql_query($z2,$con);
				if($rowz2=mysql_fetch_row($rsz2))
				{
					$do2=$rowz2[0].'元';
					$dod2=$rowz2[1];
					$cdo2=$rowz2[2].'间';
				}
				if($do2=='元')
				{
					$do2='暂无数据';
					$dod2='暂无数据';
					$cdo2='暂无数据';
				}
				$z3="select sum(sushe_money),sushe_date,count(user_id) from sushe_user where sushe_name=3 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsz3=mysql_query($z3,$con);
				if($rowz3=mysql_fetch_row($rsz3))
				{
					$do3=$rowz3[0].'元';
					$dod3=$rowz3[1];
					$cdo3=$rowz3[2].'间';
				}
				if($do3=='元')
				{
					$do3='暂无数据';
					$dod3='暂无数据';
					$cdo3='暂无数据';
				}
				$z4="select sum(sushe_money),sushe_date,count(user_id) from sushe_user where sushe_name=4 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsz4=mysql_query($z4,$con);
				if($rowz4=mysql_fetch_row($rsz4))
				{
					$do4=$rowz4[0].'元';
					$dod4=$rowz4[1];
					$cdo4=$rowz4[2].'间';
				}
				if($do4=='元')
				{
					$do4='暂无数据';
					$dod4='暂无数据';
					$cdo4='暂无数据';
				}
				$z5="select sum(sushe_money),sushe_date,count(user_id) from sushe_user where sushe_name=5 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsz5=mysql_query($z5,$con);
				if($rowz5=mysql_fetch_row($rsz5))
				{
					$do5=$rowz5[0].'元';
					$dod5=$rowz5[1];
					$cdo5=$rowz5[2].'间';
				}
				if($do5=='元')
				{
					$do5='暂无数据';
					$dod5='暂无数据';
					$cdo5='暂无数据';
				}
				?>
                <!--每号楼未缴费，未缴费总寝室-->
                <?
                $zw1="select sum(sushe_money),count(user_id) from sushe_user where sushe_name=1 and sushe_Y='".$taY."' and sushe_m='".$tam."' and sushe_jg='未缴费'";
				$rszw1=mysql_query($zw1,$con);
				if($rowzw1=mysql_fetch_row($rszw1))
				{
					$dow1=$rowzw1[0].'元';
					$cdow1=$rowzw1[1].'间';
				}
				if($dow1=='元')
				{
					$dow1='暂无数据';
					$cdow1='暂无数据';
				}
				$zw2="select sum(sushe_money),count(user_id) from sushe_user where sushe_name=2 and sushe_Y='".$taY."' and sushe_m='".$tam."' and sushe_jg='未缴费'";
				$rszw2=mysql_query($zw2,$con);
				if($rowzw2=mysql_fetch_row($rszw2))
				{
					$dow2=$rowzw2[0].'元';
					$cdow2=$rowzw2[1].'间';
				}
				if($dow2=='元')
				{
					$dow2='暂无数据';
					$cdow2='暂无数据';
				}
				$zw3="select sum(sushe_money),count(user_id) from sushe_user where sushe_name=3 and sushe_Y='".$taY."' and sushe_m='".$tam."' and sushe_jg='未缴费'";
				$rszw3=mysql_query($zw3,$con);
				if($rowzw3=mysql_fetch_row($rszw3))
				{
					$dow3=$rowzw3[0].'元';
					$cdow3=$rowzw3[1].'间';
				}
				if($dow3=='元')
				{
					$dow3='暂无数据';
					$cdow3='暂无数据';
				}
				$zw4="select sum(sushe_money),count(user_id) from sushe_user where sushe_name=4 and sushe_Y='".$taY."' and sushe_m='".$tam."' and sushe_jg='未缴费'";
				$rszw4=mysql_query($zw4,$con);
				if($rowzw4=mysql_fetch_row($rszw4))
				{
					$dow4=$rowzw4[0].'元';
					$cdow4=$rowzw4[1].'间';
				}
				if($dow4=='元')
				{
					$dow4='暂无数据';
					$cdow4='暂无数据';
				}
				$zw5="select sum(sushe_money),count(user_id) from sushe_user where sushe_name=5 and sushe_Y='".$taY."' and sushe_m='".$tam."' and sushe_jg='未缴费'";
				$rszw5=mysql_query($zw5,$con);
				if($rowzw5=mysql_fetch_row($rszw5))
				{
					$dow5=$rowzw5[0].'元';
					$cdow5=$rowzw5[1].'间';
				}
				if($dow5=='元')
				{
					$dow5='暂无数据';
					$cdow5='暂无数据';
				}
				?>
                <!--每号楼用电量-->
                <?
                $dl1="select sum(sushe_ele) from sushe_user where sushe_name=1 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsdl1=mysql_query($dl1,$con);
				if($rowdl1=mysql_fetch_row($rsdl1))
					$ydl1=$rowdl1[0];
				if($ydl1=='')
					$ydl1='暂无数据';
				$dl2="select sum(sushe_ele) from sushe_user where sushe_name=2 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsdl2=mysql_query($dl2,$con);
				if($rowdl2=mysql_fetch_row($rsdl2))
					$ydl2=$rowdl2[0];
				if($ydl2=='')
					$ydl2='暂无数据';
				$dl3="select sum(sushe_ele) from sushe_user where sushe_name=3 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsdl3=mysql_query($dl3,$con);
				if($rowdl3=mysql_fetch_row($rsdl3))
					$ydl3=$rowdl3[0];
				if($ydl3=='')
					$ydl3='暂无数据';
				$dl4="select sum(sushe_ele) from sushe_user where sushe_name=4 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsdl4=mysql_query($dl4,$con);
				if($rowdl4=mysql_fetch_row($rsdl4))
					$ydl4=$rowdl4[0];
				if($ydl4=='')
					$ydl4='暂无数据';
				$dl5="select sum(sushe_ele) from sushe_user where sushe_name=5 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsdl5=mysql_query($dl5,$con);
				if($rowdl5=mysql_fetch_row($rsdl5))
					$ydl5=$rowdl5[0];
				if($ydl5=='')
					$ydl5='暂无数据';
				?>
                <!--每号楼超额量-->
                <?
                $ce1="select sum(sushe_excess) from sushe_user where sushe_name=1 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsce1=mysql_query($ce1,$con);
				if($rowce1=mysql_fetch_row($rsce1))
					$cel1=$rowce1[0];
				if($cel1=='')
					$cel1='暂无数据';
				$ce2="select sum(sushe_excess) from sushe_user where sushe_name=2 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsce2=mysql_query($ce2,$con);
				if($rowce2=mysql_fetch_row($rsce2))
					$cel2=$rowce2[0];
				if($cel2=='')
					$cel2='暂无数据';
				$ce3="select sum(sushe_excess) from sushe_user where sushe_name=3 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsce3=mysql_query($ce3,$con);
				if($rowce3=mysql_fetch_row($rsce3))
					$cel3=$rowce3[0];
				if($cel3=='')
					$cel3='暂无数据';
				$ce4="select sum(sushe_excess) from sushe_user where sushe_name=4 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsce4=mysql_query($ce4,$con);
				if($rowce4=mysql_fetch_row($rsce4))
					$cel4=$rowce4[0];
				if($cel4=='')
					$cel4='暂无数据';
				$ce5="select sum(sushe_excess) from sushe_user where sushe_name=5 and sushe_Y='".$taY."' and sushe_m='".$tam."'";
				$rsce5=mysql_query($ce5,$con);
				if($rowce5=mysql_fetch_row($rsce5))
					$cel5=$rowce5[0];
				if($cel5=='')
					$cel5='暂无数据';
				?>
				<table border="1" class="layui-table" cellspacing="0" cellpadding="10">
		          <tr class="top">
		            <td class="qsbh" align="center">详情</td>
		            <td align="center" class="qs">1号楼</td>
		            <td align="center" class="qs">2号楼</td>
		            <td align="center" class="qs">3号楼</td>
		            <td align="center" class="qs">4号楼</td>
		            <td align="center" class="qs">5号楼</td>
		          </tr>
		          <tr>
		          	<td class="qs" align="center">抄表时间</td>
		            <td align="center"><?=$dod1?></td>
		            <td align="center"><?=$dod2?></td>
		            <td align="center"><?=$dod3?></td>
		            <td align="center"><?=$dod4?></td>
		            <td align="center"><?=$dod5?></td>
		          </tr>
		          <tr>
		            <td class="qs" align="center">总电费</td>
		            <td align="center"><?=$do1?></td>
		            <td align="center"><?=$do2?></td>
		            <td align="center"><?=$do3?></td>
		            <td align="center"><?=$do4?></td>
		            <td align="center"><?=$do5?></td>
		          </tr>
		          <tr>
		            <td class="qs" align="center">总寝室</td>
		            <td align="center"><?=$cdo1?></td>
		            <td align="center"><?=$cdo2?></td>
		            <td align="center"><?=$cdo3?></td>
		            <td align="center"><?=$cdo4?></td>
		            <td align="center"><?=$cdo5?></td>
		          </tr>
		          <tr>
		          	<td class="qs" align="center">未缴费</td>
		            <td align="center"><?=$dow1?></td>
		            <td align="center"><?=$dow2?></td>
		            <td align="center"><?=$dow3?></td>
		            <td align="center"><?=$dow4?></td>
		            <td align="center"><?=$dow5?></td>
		          </tr>
		          <tr>
		          	<td class="qs" align="center">未缴费总寝室</td>
		            <td align="center"><?=$cdow1?></td>
		            <td align="center"><?=$cdow2?></td>
		            <td align="center"><?=$cdow3?></td>
		            <td align="center"><?=$cdow4?></td>
		            <td align="center"><?=$cdow5?></td>
		          </tr>
		          <tr>
		          	<td class="qs" align="center">用电量</td>
		            <td align="center"><?=$ydl1?></td>
		            <td align="center"><?=$ydl2?></td>
		            <td align="center"><?=$ydl3?></td>
		            <td align="center"><?=$ydl4?></td>
		            <td align="center"><?=$ydl5?></td>
		          </tr>
		          <tr>
		          	<td class="qs" align="center">超额量</td>
		            <td align="center"><?=$cel1?></td>
		            <td align="center"><?=$cel2?></td>
		            <td align="center"><?=$cel3?></td>
		            <td align="center"><?=$cel4?></td>
		            <td align="center"><?=$cel5?></td>
		          </tr>
		        </table>
		<?
		}
		?>
	</div>
  </div>
</div>

<script>
layui.use('form', function(){
  var form = layui.form;

});
</script>

<?
//日期判断
if(isset($_GET['button']))
{
?>
	<script type="text/javascript">
		document.getElementById("sadminY").value = "<?=$_GET['sadminY']?>";
		document.getElementById("sadminm").value = "<?=$_GET['sadminm']?>";
	</script>
<?
}
else
{
?>
	<script type="text/javascript">
		document.getElementById("sadminY").value = "<?=$rqY?>";
		document.getElementById("sadminm").value = "<?=$rqm?>";
	</script>
<?
}
?>
</body>
</html>