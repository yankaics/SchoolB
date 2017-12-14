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
<!---JSQ--->
<script src="http://libs.baidu.com/jquery/1.9.0/jquery.min.js"></script>
<script src="../../JSQ/index.js"></script>
<title>报修详情</title>
</head>

<body>     
<div class="layui-header header header-doc">
    <ul class="layui-nav " style="text-align:center;">
    	<div class="layui-container ">
        	<?
			include("../../PHP/riqi.php");
			include("../../SQL/db/db.php");
			include("../../PHP/adminse.php");
			$time=$rqY.'-'.$rqmm.'-'.$rqd.'-'.$rqH.':'.$rqi.':'.$rqs;
			?>
            <li class="layui-nav-item">
				<a href="wxrw.php"><div class="xz-index">返回 </div></a>	
            </li>
            
        </div>
    </ul>
</div><br><br>
<!------main------>
<div class="layui-container">
  <div class="layui-row">
  	 <div class="layui-col-md4 layui-col-md-offset4">
	 <?
     	$sql="select * from sch_repair_re where sid='".$_GET['id']."'";
		$rs=mysql_query($sql,$con);
		if($row=mysql_fetch_row($rs))
		{
		?>
     <form class="form-horizontal layui-form-pane" name="stu4" action="upycl.php" method="post" role="form">
     	<input name="id" type="hidden" value="<?=$row[0]?>" />
    	<input name="bxzdl" type="hidden" value="" />
        			<div class="layui-form-item">
                        <label class="layui-form-label">报修地址</label>
                        <div class="layui-input-block">
                          <input name="trdz" type="text" disabled required class="layui-input" placeholder="地址" autocomplete="off" value="<?=$row[1].$row[2]?>" readonly  lay-verify="required"> 
                      	</div>
                    </div>
                	<div class="layui-form-item">
                        <label class="layui-form-label">姓名</label>
                        <div class="layui-input-block">
                          <input name="trxm" type="text" disabled required class="layui-input" placeholder="姓名" autocomplete="off" value="<?=$row[3]?>" readonly  lay-verify="required"> 
                      	</div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">电话</label>
                        <div class="layui-input-block">
                          <input name="trdh" type="text" disabled required class="layui-input" placeholder="电话" autocomplete="off" value="<?=($row[5]+1)/2?>" readonly  lay-verify="required"> 
                      	</div>
                    </div>
                    
                    <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">损坏描述</label>
                        <div class="layui-input-block">
                          <textarea name="twxxq" readonly placeholder="如：桌子腿坏了或水管裂开了" class="layui-textarea"><?=$row[14]?></textarea>
                        </div>
                     </div>
                    <table class="layui-table">
                      <colgroup>
                        <col width="110">
                        <col width="60">
                        <col >
                      </colgroup>
                      <thead>
                        <tr>
                        	<th align="left">物件</th>
                          	<th align="left">数量</th>
                       	  	<th align="left">操作</th>
                        </tr> 
                      </thead>
                      <tbody>
                      <?
					  	$sqlwj="select * from sch_repair_rea where s_add='".$row[1]."' and s_name='".$row[3]."' and s_time='".$row[10]."'";
						$rswj=mysql_query($sqlwj,$con);
						while($rowwj=mysql_fetch_row($rswj))
						{
					  ?>
                        <tr>
                        	<td><?=$rowwj[1]?></td>
                            <td><?=$rowwj[2]?></td>
                            <td>
                            <?
                            if($rowwj[11]=="已处理")
                            {
                            ?>
                            完成
                            <?
                            }
                            else
                            {
                            ?>
                            <a href="upycl.php?wj=<?=$rowwj[1]?>&id=<?=$_GET['id']?>"><button  onclick="return confirm('确定<?=$rowwj[1]?>已处理？');" type="button" class="layui-btn">完成</button></a>
                            <button type="button" class="layui-btn bncl_btn<?=$rowwj[0]?>">暂停</button>
                            
                            <?
                            }
                            ?>
                            </td>
                        </tr>
                      <?
					  }
					  ?>
                      </tbody>
                    </table>
        </form>
        <!--原因-->
		<?
		}
		
		$sql1="select * from sch_repair_re where sid='".$_GET['id']."'";
				$rs1=mysql_query($sql1,$con);
				if($row1=mysql_fetch_row($rs1))
				{
					
					$sqlwj1="select * from sch_repair_rea where s_add='".$row1[1]."' and s_name='".$row1[3]."' and s_time='".$row1[10]."'";
					$rswj1=mysql_query($sqlwj1,$con);
					while($rowwj1=mysql_fetch_row($rswj1))
					{
		?>
        
        <form name="tjyy_a" id="tjyy_a<?=$rowwj1[0]?>" action="" method="get">
            <input name="tresm" class="tresm" type="hidden" value="" />
            <input name="tjyy" type="hidden" value="" />
            <input name="id" type="hidden" value="<?=$row1[0]?>" />
 			<input name="sid" type="hidden" value="<?=$rowwj1[0]?>" />
        </form>
		<script>
							layui.use('layer', function(){
							  var layer = layui.layer;
								//原因
								$(".bncl_btn<?=$rowwj1[0]?>").click(function(e) {
                            	layer.prompt({
								  formType: 2,
								  title: '不能处理的原因',
								  value:'<?=$rowwj1[5]?>'
								}, function(value, index, elem){
									
									var pattern = new RegExp("[`~!@#$^&*()=|{}';'\\[\\]<>/?~！@#￥……&*（）——|{}‘”“'、]");//特殊字符判断
									if(value=="" || pattern.test(value) || value.length>200)
									{
										layer.msg('原因为200字内不含特殊字符');
								  	}
									else
									{
										$(".tresm").val(value);
										$("#tjyy_a<?=$rowwj1[0]?>").submit();
										layer.close(index);
									}
										
								  
								});
								});
							});
                            </script>
        <?
					}
				}
            if(isset($_GET['tjyy']))
			{
				$sqlyy="update sch_repair_rea set s_settime='".$time."',s_jg='不能处理',s_nor='".$_GET['tresm']."' where sid='".$_GET['sid']."'";
				$rsyy=mysql_query($sqlyy,$con);
				if($rsyy>0)
				{
					$sqlsyy="update sch_repair_re set s_jg='不能处理' where sid='".$_GET['id']."'";
					$rssyy=mysql_query($sqlsyy,$con);
					if($rssyy>0)
					{
						?>
						<script language="javascript">
                            $(document).ready(function(e) {
							layui.use('layer', function(){
							var index = parent.layer.getFrameIndex(window.name);
							var layer = layui.layer;
							parent.layer.msg('提交原因成功<br>点击暂停查看', {
							  title: false,
							  closeBtn: 0,
							  time:4000,
							  maxWidth:160,
							  offset: '240px',
								
									});
								});
							});
                            location.href="czxq.php?id=<?=$_GET['id']?>";
                        </script>
                        <?
					}
					else
					{
						?>
						<script language="javascript">
							$(document).ready(function(e) {
							layui.use('layer', function(){
							var index = parent.layer.getFrameIndex(window.name);
							var layer = layui.layer;
							parent.layer.msg('提交原因失败<br>#1请告知技术人员', {
							  title: false,
							  closeBtn: 0,
							  time:4000,
							  maxWidth:160,
							  offset: '240px',
								
									});
								});
							});
                            location.href="czxq.php?id=<?=$_GET['id']?>";
                        </script>
                        <?
					}
				}
				else
				{
					?>
					<script language="javascript">
                        $(document).ready(function(e) {
							layui.use('layer', function(){
							var index = parent.layer.getFrameIndex(window.name);
							var layer = layui.layer;
							parent.layer.msg('提交原因失败<br>请告知技术人员', {
							  title: false,
							  closeBtn: 0,
							  time:4000,
							  maxWidth:160,
							  offset: '240px',
								
									});
								});
							});
                        location.href="czxq.php?id=<?=$_GET['id']?>";
                    </script>
                    <?
				}
			}
			?>
  	</div>
  </div>
</div> 
            
</body>
</html>