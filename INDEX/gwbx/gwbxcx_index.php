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
<!---CSS以往版本的样式
<link media="(max-width:650px)" href="CSS/mobile-ly-admin-index.css" rel="stylesheet" type="text/css" />
<link media="(max-width:500px)" href="../../CSS/mobile-top.css" rel="stylesheet" type="text/css" />
<link href="http://cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet" type="text/css">
<link media="(min-width:500px)" href="CSS/ly-admin-index.css" rel="stylesheet" type="text/css"/>
<link media="(min-width:500px)" href="../../CSS/top-index.css" rel="stylesheet" type="text/css" />
--->
<title>报修查询</title>

</head>

<body bgcolor="#F0F0F0">

<!------导航------>
<div class="layui-header header header-doc">
    <ul class="layui-nav layui-icon" lay-filter="">
        <div class="layui-container">  
        	<li class="layui-nav-item layui-icon" style="z-index:1;"><a href="../../index.php"><img class="layui-icon" src="../../UI/logo/呕吐-1.png"></a>
            <span class="layui-nav-bar" style=" display:none"></span>
            </li>
        </div> 
    </ul>
<?
include("../../SQL/db/db.php");
include("../../PHP/adminse.php");
//已处理
$countsql="select count(*) from sch_repair_re where s_schid='".$_SESSION['user']."' and s_jg='已处理'";
$countrs=mysql_query($countsql,$con);
if($countrow=mysql_fetch_row($countrs))
	$countnum=$countrow[0];
else
	$countnum=0;
//在路上
$countsql="select count(*) from sch_repair_re where s_schid='".$_SESSION['user']."' and s_repair!='未分配' and s_jg='未处理'";
$countrs=mysql_query($countsql,$con);
if($zlsrow=mysql_fetch_row($countrs))
	$zlscount=$zlsrow[0];
else
	$zlscount=0;
if($zlscount==0)
	$zlst='暂无记录';
//未分配
$countsql="select count(*) from sch_repair_re where s_schid='".$_SESSION['user']."' and s_repair='未分配'";
$countrs=mysql_query($countsql,$con);
if($wfprow=mysql_fetch_row($countrs))
	$wfpcount=$wfprow[0];
else
	$wfpcount=0;
if($wfpcount==0)
	$wfpt='暂无记录';
//不能处理
$countsql="select count(*) from sch_repair_re where s_schid='".$_SESSION['user']."' and s_jg='不能处理'";
$countrs=mysql_query($countsql,$con);
if($bnclrow=mysql_fetch_row($countrs))
	$bnclcount=$bnclrow[0];
else
	$bnclcount=0;
if($bnclcount==0)
	$bnclt='暂无记录';
?>
    <ul class="layui-nav layui-layout-right" style="text-align:center;">
    	<div class="layui-container ">
        	
            <li class="layui-nav-item ">
            	<?
				if($_SESSION['utype']=="教师")
				{
				?>
				<a href="../../tea_i.php">
				<div class="xz-index">菜单</div></a>
				<?
				}
				else
				{
				?>
				<a href="../../stu_i.php">
				<div class="xz-index">菜单</div></a>
				<?
				}
				?>
            </li>
     		<li class="layui-nav-item "><a href="bxall.php">已处理<span class="layui-badge"><?=$countnum?></span></a></li>
            
        </div>
    </ul>
</div><br><br>
<!------main------>
<div class="layui-container">
  <div class="layui-row">
  	<div class="layui-col-md8">
	
    	<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
          <ul class="layui-tab-title">
            <li class="layui-this">在路上<span class="layui-badge"><?=$zlscount?></span></li>
            <li>未分配<span class="layui-badge"><?=$wfpcount?></span></li>
            <li>暂停处理<span class="layui-badge"><?=$bnclcount?></span></li>
          </ul>
          <div class="layui-tab-content">
          	<!--在路上-->
          	<div class="layui-tab-item layui-show">
            	<?	
					echo $zlst;//暂无记录
					$sql="select * from sch_repair_re a where s_schid='".$_SESSION['user']."' and s_repair!='未分配' and s_jg='未处理' order by s_settime desc";
				  $rs=mysql_query($sql,$con);
				  while($row=mysql_fetch_row($rs))
				  {
				?>


                <div class="layui-collapse">
                  <div class="layui-colla-item">
                    <h2 class="layui-colla-title">
                        <p>
                        
                        <?=substr($row[10],0,10)?>
                            <?
                            if($row[7]=='未分配')
                            {
                            ?>
                            <span style="color:#F63">未分配维修员</span>
                            <?
                            }
                            else if($row[11]=='未处理' && $row[7]!='未分配')
                            {
                            ?>
                            <span>维修员：<span style="color:#F63"><?=$row[7]?></span></span>
                            <?
                            }
                            else if($row[11]=='不能处理')
                            {	
                            ?>
                            <span><span style="color:#F63"><?=$row[7]?></span>暂停维修中</span>
                            <?
                            }
                            else
                            {
                            ?>
                            <span><span style="color:#F63"><?=$row[7]?></span>维修完成</span>
                            <?
                            }
                            ?>
                        </p>
                    </h2>
                    <div class="layui-colla-content">
                        <table class="layui-table" lay-even lay-skin="nob" >
                            <colgroup>
                                <col width="100">
                                <col>
                            </colgroup>
                          <tbody bgcolor="#F0F0F0">
                            <tr>
                              <td align="right">地点：</td>
                              <td><?=$row[1].$row[2]?></td>
                            </tr>
                            <tr>
                              <td align="right">姓名：</td>
                              <td><?=$row[3]?></td>
                            </tr>
                            <tr>
                              <td align="right">电话：</td>
                              <td><?=($row[5]+1)/2?></td>
                            </tr>
                            <tr>
                              <td align="right">
                                <?
                                if($_SESSION['utype']=="教师")
                                {
                                    echo "部门：";
                                }
                                else
                                {
                                    echo "专业：";
                                }
                                
                                ?>
                              </td>
                              <td><?=$row[4]?></td>
                            </tr>
                            <tr>
                              <td align="right">报修时间：</td>
                              <td><?=$row[10]?></td>
                            </tr>
                            <tr>
                            <td align="right">损坏描述：</td>
                              <td align="left"><?=$row[14]?></td>
                            </tr> 
                            <tr>
                              <td align="right" style="color:#FF5722;">物件：</td>
                              <td>
                              <?
                                
                                    $sqlrea="select * from sch_repair_rea where s_time='".$row[10]."' and s_schid='".$_SESSION['user']."' and s_add='".$row[1]."'";
                                $rsrea=mysql_query($sqlrea,$con);
                                while($rowrea=mysql_fetch_row($rsrea))
                                {
                                ?>
                                <p><?=$rowrea[1]?> <?=$rowrea[2]?>件</p>
                                <?
                                }
                                ?>
                              </td>
                            </tr>
                            
                            
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                        <?
                          }
                        ?>
            </div>
            <!--未分配-->
            <div class="layui-tab-item">
            	<?	
					echo $wfpt;//暂无记录
					$sql="select * from sch_repair_re a where s_schid='".$_SESSION['user']."' and s_repair='未分配' order by s_settime desc";
				  $rs=mysql_query($sql,$con);
				  while($row=mysql_fetch_row($rs))
				  {
				?>


                <div class="layui-collapse">
                  <div class="layui-colla-item">
                    <h2 class="layui-colla-title">
                        <p>
                        
                        <?=substr($row[10],0,10)?>
                            <?
                            if($row[7]=='未分配')
                            {
                            ?>
                            <span style="color:#F63">未分配维修员</span>
                            <?
                            }
                            else if($row[11]=='未处理' && $row[7]!='未分配')
                            {
                            ?>
                            <span>维修员：<span style="color:#F63"><?=$row[7]?></span></span>
                            <?
                            }
                            else if($row[11]=='不能处理')
                            {	
                            ?>
                            <span><span style="color:#F63"><?=$row[7]?></span>暂停维修中</span>
                            <?
                            }
                            else
                            {
                            ?>
                            <span><span style="color:#F63"><?=$row[7]?></span>维修完成</span>
                            <?
                            }
                            ?>
                        </p>
                    </h2>
                    <div class="layui-colla-content">
                        <table class="layui-table" lay-even lay-skin="nob" >
                            <colgroup>
                                <col width="100">
                                <col>
                            </colgroup>
                          <tbody bgcolor="#F0F0F0">
                            <tr>
                              <td align="right">地点：</td>
                              <td><?=$row[1].$row[2]?></td>
                            </tr>
                            <tr>
                              <td align="right">姓名：</td>
                              <td><?=$row[3]?></td>
                            </tr>
                            <tr>
                              <td align="right">电话：</td>
                              <td><?=($row[5]+1)/2?></td>
                            </tr>
                            <tr>
                              <td align="right">
                                <?
                                if($_SESSION['utype']=="教师")
                                {
                                    echo "部门：";
                                }
                                else
                                {
                                    echo "专业：";
                                }
                                
                                ?>
                              </td>
                              <td><?=$row[4]?></td>
                            </tr>
                            <tr>
                              <td align="right">报修时间：</td>
                              <td><?=$row[10]?></td>
                            </tr>
                            <td align="right">损坏描述：</td>
                              <td align="left"><?=$row[14]?></td>
                            </tr> 
                            <tr>
                              <td align="right" style="color:#FF5722;">物件：</td>
                              <td>
                              <?
                                
                                    $sqlrea="select * from sch_repair_rea where s_time='".$row[10]."' and s_schid='".$_SESSION['user']."' and s_add='".$row[1]."'";
                                $rsrea=mysql_query($sqlrea,$con);
                                while($rowrea=mysql_fetch_row($rsrea))
                                {
                                ?>
                                <p><?=$rowrea[1]?> <?=$rowrea[2]?>件</p>
                                <?
                                }
                                ?>
                              </td>
                            </tr>
                            
                            
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                        <?
                          }
                        ?>
            </div>
            <!--不能处理-->
            <div class="layui-tab-item">
            	<?	
					echo $bnclt;//暂无记录
					$sql="select * from sch_repair_re a where s_schid='".$_SESSION['user']."' and s_jg='不能处理' order by s_settime desc";
				  $rs=mysql_query($sql,$con);
				  while($row=mysql_fetch_row($rs))
				  {
				?>


                <div class="layui-collapse">
                  <div class="layui-colla-item">
                    <h2 class="layui-colla-title">
                        <p>
                        
                        <?=substr($row[10],0,10)?>
                            <?
                            if($row[7]=='未分配')
                            {
                            ?>
                            <span style="color:#F63">未分配维修员</span>
                            <?
                            }
                            else if($row[11]=='未处理' && $row[7]!='未分配')
                            {
                            ?>
                            <span>维修员：<span style="color:#F63"><?=$row[7]?></span></span>
                            <?
                            }
                            else if($row[11]=='不能处理')
                            {	
                            ?>
                            <span><span style="color:#F63"><?=$row[7]?></span>暂停维修中</span>
                            <?
                            }
                            else
                            {
                            ?>
                            <span><span style="color:#F63"><?=$row[7]?></span>维修完成</span>
                            <?
                            }
                            ?>
                        </p>
                    </h2>
                    <div class="layui-colla-content">
                        <table class="layui-table" lay-even lay-skin="nob" >
                            <colgroup>
                                <col width="100">
                                <col>
                            </colgroup>
                          <tbody bgcolor="#F0F0F0">
                            <tr>
                              <td align="right">地点：</td>
                              <td><?=$row[1].$row[2]?></td>
                            </tr>
                            <tr>
                              <td align="right">姓名：</td>
                              <td><?=$row[3]?></td>
                            </tr>
                            <tr>
                              <td align="right">电话：</td>
                              <td><?=($row[5]+1)/2?></td>
                            </tr>
                            <tr>
                              <td align="right">
                                <?
                                if($_SESSION['utype']=="教师")
                                {
                                    echo "部门：";
                                }
                                else
                                {
                                    echo "专业：";
                                }
                                
                                ?>
                              </td>
                              <td><?=$row[4]?></td>
                            </tr>
                            <tr>
                              <td align="right">报修时间：</td>
                              <td><?=$row[10]?></td>
                            </tr>
                            <td align="right">损坏描述：</td>
                              <td align="left"><?=$row[14]?></td>
                            </tr> 
                            <tr>
                              <td align="right" style="color:#FF5722;">物件：</td>
                              <td>
                              <?
                                
                                    $sqlrea="select * from sch_repair_rea where s_time='".$row[10]."' and s_schid='".$_SESSION['user']."' and s_add='".$row[1]."'";
                                $rsrea=mysql_query($sqlrea,$con);
                                while($rowrea=mysql_fetch_row($rsrea))
                                {
                                ?>
                                <p><?=$rowrea[1]?> <?=$rowrea[2]?>件</p>
                                <?
                                }
                                ?>
                              </td>
                            </tr>
                            
                            
                          </tbody>
                        </table>
                    </div>
                  </div>
                </div>
                        <?
                          }
                        ?>
            </div>
            
            
          </div>
        </div>
  </div>
</div>  
<script>
layui.use('element', function(){
  var element = layui.element;
   element.init();	
});
</script>

    
    
    
    
    
    
    
    
    
    <div class="cxxq">
    
                <!-- 下面是评分 上面完成暂时先用<div class="container">
				<div class="row clearfix">
					<div class="col-md-4 column">
					</div>
					<div class="col-md-4 column">
                    <p>
                    <?
                    //if($row[8]==0)
//					{
					?>
                    <h3>请及时给<span style="color:#F63"><? //$row[7]?></span>评分呐</h3>
                    <form name="fstu" action="sc.php" class="form-horizontal" method="post" role="form">
                        <input name="id" type="hidden" value="<? //$row[0]?>"/>
                        <div class="form-group">
    					<label for="firstname" class="col-sm-3 control-label">评分</label>
    					<div class="col-sm-9">
    					 <label class="checkbox-inline">
                            <input type="radio" name="rsc" id="optionsRadios3" value="1">很差
                          </label>
                          <label class="checkbox-inline">
                            <input type="radio" name="rsc" id="optionsRadios4" value="2">差
                          </label>
                          <label class="checkbox-inline">
                          <input type="radio" name="rsc" id="optionsRadios3" value="3" checked>好
                          </label>
                          <label class="checkbox-inline">
                          <input type="radio" name="rsc" id="optionsRadios3" value="4">很好
                          </label>
                        </div>
  					</div>
                        
                    <div class="form-group">
    					<label for="firstname" class="col-sm-3 control-label">评价</label>
    					<div class="col-sm-9">
                          <textarea name="tcom" rows="3" maxlength="40" class="form-control" id="tcom" placeholder="如：修得非常的好"></textarea>
			          </div>
  					</div>
                    <div class="form-group">
    					<div class="col-sm-offset-3 col-sm-9">
      					<button onclick="return confirm('确定提交？');" type="submit" class="btn btn-default">提交</button>
    					</div>
  					</div>
  					</form>
                    <?
					//}
//					else
//					{
					?>
                    <p>已评价<span style="color:#F63"><? //$row[7]?></span>此次维修</p>
                    <p>
                    评分:
                    <?
                    //if($row[8]==1)
//					echo "很差";
//					if($row[8]==2)
//					echo "差";
//					if($row[8]==3)
//					echo "好";
//					if($row[8]==4)
//					echo "很好";
					?>
                    </p>
                    <p>评价：<? //$row[9]?></p>
                    <?
					//}
					?>
                    </p>
					</div>
					<div class="col-md-4 column">
					</div>
				</div>
        		</div>-->
</div>

</body>
</html>