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
	<!-- 引入 ECharts 文件 -->
    <script src="echarts.min.js"></script>
	<title>短信统计</title>
	<style type="text/css">
		a:link {
			text-decoration: none;
		}
		a:visited {
			text-decoration: none;
		}
		a:hover {
			text-decoration: none;
		}
		a:active {
			text-decoration: none;
		}
		body{ 
			
			margin:10px;
		}
	</style>
</head>
<body>
<?php
	include("../../PHP/riqi.php");
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
	include("../adminse/admin_se.php");
	include("class/sms_re_class.php");			//短信统计类
	$re=new sms_re_class($con); 					//实例化
	
?>
<blockquote class="layui-elem-quote">
	<h4>短信统计</h4>
</blockquote>
<div class="table-responsive">
	<div id="main" style="min-width:200px;height:400px;minAspectRatio: 1.3;"></div>
	<?
		//短信发送所有时间
		$smstime=$re->sms_time();
		?>
			<script type="text/javascript">var datatime=new Array();</script>
		<?
		for($i=0;$i<count($smstime);$i++)
		{
			?>
			<script type="text/javascript">
				datatime[<?=$i?>]="<?=$smstime[$i]?>";
			</script>
			<?
		}
		//短信发送所有数量
		$smssum=$re->sms_sum();
		?>
			<script type="text/javascript">var datasum=new Array();</script>
		<?
		for($i=0;$i<count($smssum);$i++)
		{
			?>
			<script type="text/javascript">
				datasum[<?=$i?>]="<?=$smssum[$i]?>";
			</script>
			<?
		}
	?>
</div>
<script type="text/javascript">
//时间
function p(s) {
    return s < 10 ? '0' + s: s;
}
//当前年月日
function nowdate(AddDayCount) { 
	var dd = new Date(); 
	dd.setDate(dd.getDate()+AddDayCount);//获取AddDayCount天后的日期 
	var y = dd.getFullYear(); 
	var m = dd.getMonth()+1;//获取当前月份的日期 
	var d = dd.getDate(); 
	return y+"-"+p(m)+"-"+p(d);
}

//年月日统计
// 基于准备好的dom，初始化echarts实例
var myChart = echarts.init(document.getElementById('main'));

// 指定图表的配置项和数据
var option = {

    tooltip: {
        trigger: 'axis',
        position: function (pt) {
            return [pt[0], '10%'];
        }
    },

    title: {
        left: 'center',
        text: '发送量',

    },
    toolbox: {
        feature: {
            dataZoom: {
                yAxisIndex: 'none'
            },
            restore: {},
            saveAsImage: {}
        }
    },
    dataZoom: [{
        type: 'inside',
        start: 0,
        end: 100,
    }, {
        start: 0,
        end: 10,
        handleIcon: 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
        handleSize: '80%',
        handleStyle: {
            color: '#fff',
            shadowBlur: 3,
            shadowColor: 'rgba(0, 0, 0, 0.6)',
            shadowOffsetX: 2,
            shadowOffsetY: 2
        }
    }],
    xAxis: {
    	type: 'category',
        boundaryGap: false,
        data: datatime
    },
    yAxis: {
    	type: 'value',
        boundaryGap: [0, '100%']
    },
    series: [{
        name: '发送量',
        type:'line',
	    smooth:true,
	    symbol: 'none',
        sampling: 'average',
        itemStyle: {
            normal: {
                color: 'rgb(255, 70, 131)'
            }
        },
        areaStyle: {
            normal: {
                color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
                    offset: 0,
                    color: 'rgb(255, 158, 68)'
                }, {
                    offset: 1,
                    color: 'rgb(255, 70, 131)'
                }])
            }
        },
        data: datasum
    }]
};

// 使用刚指定的配置项和数据显示图表。
myChart.setOption(option);
</script>


</body>
</html>