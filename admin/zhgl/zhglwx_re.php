<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
<link rel="stylesheet" href="../../layui/css/layui.css">
<script src="../../layui/layui.js"></script>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
  <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<link rel="shortcut icon" href="../../favicon.ico" />
<!--JSQ-->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../../JSQ/index.js"></script>
<title>报修完成记录</title>
<style>
body{ padding-bottom:100px;}
</style>
</head>

<body id=body onscroll=SetCookie("scroll",document.body.scrollTop); onload="scrollback();">
<!--导航-->
<div class="layui-header header header-doc">
    <ul class="layui-nav " style="text-align:center;">
    	<div class="layui-container ">
        	<?
			include("../../PHP/riqi.php");
			include("../../SQL/db/db.php");
			include("../../PHP/adminse.php");
      include("../adminse/admin_se.php");
			$time=$rqY.'-'.$rqmm.'-'.$rqd.'-'.$rqH.':'.$rqi.':'.$rqs;
			?>
            <li class="layui-nav-item">
				<a href="zhgl.php?n=维修员"><div class="xz-index">返回 </div></a>	
            </li>
            
        </div>
    </ul>
</div><br><br>
<!--main-->
<div class="layui-container">
  <div class="layui-row">
  	<blockquote class="layui-elem-quote">
    <?
      	if(isset($_GET['button']))
		{
			$sql="select count(*) from sch_repair_re where s_settime>='".$_GET['da1'].'-00:00:00'."' and s_settime<='".$_GET['da2'].'-23:59:59'."' and s_repair='".$_GET['nid']."' and s_jg='已处理'";
		}
		else
		{
			$sql="select count(*) from sch_repair_re where s_repair='".$_GET['nid']."' and s_jg='已处理'";
		}
		$rs=mysql_query($sql,$con);
		if($rowre=mysql_fetch_row($rs))
		{
			?>
    		<p style="color:#FF5722; font-size:20px;">
            	<?=$_GET['nid']?>时间段内已处理<?=$rowre[0]?>件  
            </p> 
        	 <br>
            <p>
            <form class="layui-form" method="get" action="">
                <input name="nid" type="hidden" value="<?=$_GET['nid']?>" />
                  <div class="layui-row">
                  <div class="layui-col-md6">
					<div class="layui-col-md4 layui-col-xs4">
                        <input name="da1" placeholder="选择开始时间" type="text" class="layui-input" id="time1" value="<?=$_GET['da1']?>" readonly="readonly">
                    </div>
                    <div class="layui-col-md4 layui-col-xs4">
                        <input name="da2" placeholder="选择结束时间" type="text" class="layui-input" id="time2" value="<?=$_GET['da2']?>" readonly="readonly">
                    </div>
                    <div class="layui-col-md2 layui-col-xs2">
                        <button name="button" class="layui-btn" type="submit">查询</button>
                    </div>
                    
                  </div>
                  </div>         
            </form>
            </p>
		
		<?
		}
		?>        
    </blockquote>
    
  	<table class="layui-table " lay-filter="nn" lay-data="" id="nn" lay-even lay-skin="nob">
      <colgroup>
        
      </colgroup>
      <thead>
        <tr>
          <th lay-data="{field:'dd',width:200}" align="left">地点</th>
          <th lay-data="{field:'xm',width:100}" align="left">姓名</th>
          <th lay-data="{field:'dh',width:150}" align="left">电话</th>
          <th lay-data="{field:'zybm',width:150}" align="left">专业部门</th>
          <th lay-data="{field:'bxsj',width:200,sort: true}" align="left">报修时间</th>
          <th lay-data="{field:'wcsj',width:200,sort: true}" align="left">完成时间</th>
          <th lay-data="{field:'wjxq',width:100}" align="left">物件详情</th>
        </tr> 
      </thead>
      <tbody>
      	<?
      	if(isset($_GET['button']))
		{
			$sql="select * from sch_repair_re where s_settime>='".$_GET['da1'].'-00:00:00'."' and s_settime<='".$_GET['da2'].'-23:59:59'."' and s_repair='".$_GET['nid']."' and s_jg='已处理'";
		}
		else
		{
			$sql="select * from sch_repair_re where s_repair='".$_GET['nid']."' and s_jg='已处理'";
		}
		$rs=mysql_query($sql,$con);
		while($rowre=mysql_fetch_row($rs))
		{
			?>
        <tr>
          <td align="left"><?=$rowre[1].$rowre[2]?></td>
          <td align="left"><?=$rowre[3]?></td>
          <td align="left"><?=$rowre[5]?></td>
          <td align="left"><?=$rowre[4]?></td>
          <td align="left"><?=$rowre[10]?></td>
          <td align="left"><?=$rowre[12]?></td>
          <td align="left">
          	<button name="button" class=" layui-btn-sm layui-btn zwj<?=$rowre[0]?>" type="button">物件详情</button>
            <script>
			layui.use('layer', function(){
	 		 var layer = layui.layer;
			$(".zwj<?=$rowre[0]?>").click(function(e) {
				layer.open({
					 title:'<?=$rowre[3]?>物件详情' ,
					 type: 1,
					 shadeClose: true,
					 area: ['200px'], //宽高
					 content: '<?
						$sqlrea="select * from sch_repair_rea where s_time='".$rowre[10]."' and s_name='".$rowre[3]."' and s_phone='".$rowre[5]."' and s_add='".$rowre[1]."'";
					$rsrea=mysql_query($sqlrea,$con);
					while($rowrea=mysql_fetch_row($rsrea))
					{
						?><center style="padding:10px;"><p><?=$rowrea[1]?> <?=$rowrea[2]?>件</p></center><? 
					} ?>'
					});
				});
			});
            </script>
          </td>
        </tr>
      		<?
		}
		?>
        
      </tbody>
    </table>
  </div>
</div> 

<script>
layui.use('form', function(){
  var form = layui.form;
});
layui.use('table', function(){
  var table = layui.table;
  //表的设置
  table.init('nn', {
  	height: 280 //设置高度
  	,page:true
	,limit:5
	}); 
	
});

layui.use('form', function(){
  var form = layui.form;
});
layui.use('laydate', function(){
  var laydate = layui.laydate;
  
  laydate.render({
    elem: '#time1'//指定元素
  });
  laydate.render({
    elem: '#time2'//指定元素
  });
});
</script>
<!--物件详情-->
<?
if(isset($_GET['wjxq']))
{
?>
<script>
	 alert('<? 
    $sqlrea="select * from sch_repair_rea where s_time='".$_GET['ttime']."' and s_name='".$_GET['tname']."' and s_phone='".$_GET['tphone']."' and s_add='".$_GET['tadd']."'";
	$rsrea=mysql_query($sqlrea,$con);
	while($rowrea=mysql_fetch_row($rsrea))
	{
		echo "（物件:".$rowrea[1];
		echo "-数量:".$rowrea[2]."）\\n";
	}
	?>');
	location.href="zhglwx_re.php?nid=<?=$_GET['nid']?>";
</script>
<?
}
?>

</body>
</html>