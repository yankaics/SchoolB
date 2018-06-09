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
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" href="../../layui/css/layui.css">
  <script src="../../layui/layui.js"></script>
  <link rel="shortcut icon" href="../../favicon.ico" />
  <!--JSQ-->
  <script src="../../JSQ/jquery-2.1.1.min.js"></script>
  <script src="../../JSQ/index.js"></script>
  <title>电费缴费记录</title>
  <style>
  body{ padding-bottom:100px;}
  </style>
</head>

<body>
<!--导航-->
<div class="layui-header header header-doc">
    <ul class="layui-nav " style="text-align:center;">
    	<div class="layui-container ">
        	<?
			include("../../PHP/riqi.php");
			include("../../SQL/db/db.php");
			include("../../PHP/adminse.php");
      include("../adminse/admin_se.php");
			$time=$rqY.'-'.$rqmm.'-'.$rqd;
			?>
            <li class="layui-nav-item">
				<a href="sg_zhgl.php"><div class="xz-index">返回 </div></a>	
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
			$sql="select count(*) from sch_dfre where s_time='".$_GET['da1'].'-'.$_GET['da2']."' and s_username='".$_GET['nid']."'";
      $tjg="所选时间段内记录";
		}
		else
		{
			$sql="select count(*) from sch_dfre where s_username='".$_GET['nid']."'";
      $tjg="总记录";
		}
		$rs=mysql_query($sql,$con);
		if($rowre=mysql_fetch_row($rs))
		{
			?>
    		<p style="color:#FF5722; font-size:20px;">
            	<?=$_GET['nid'].$tjg.$rowre[0]?>条  
            </p> 
        	 <br>
            <p>
            <form class="layui-form" method="get" action="">
              <input name="nid" type="hidden" value="<?=$_GET['nid']?>" />
                <div class="layui-input-inline">
                  <input type="text" name="tlsh" required  lay-verify="required" placeholder="请输入流水号" autocomplete="off" class="layui-input">
                </div>
                <button class="layui-btn" name="lsh" lay-submit type="submit">查询流水号</button>
              
            </form>
            <form class="layui-form" method="get" action="">
                <input name="nid" type="hidden" value="<?=$_GET['nid']?>" />
                  <div class="layui-row">
                    <div class="layui-col-md6">
					           <div class="layui-inline">
                        <select name="da1" id="sadminY" lay-verify="required">
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
                        <select name="da2" id="sadminm" lay-verify="required">
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
                          <button class="layui-btn" name="button" id="button" lay-submit lay-filter="form">操作</button>
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
          <th lay-data="{field:'serial',width:300}" align="left">流水号</th>
          <th lay-data="{field:'dor',width:200}" align="left">寝室号</th>
          <th lay-data="{field:'yjf',width:100}" align="left">已缴费</th>
          <th lay-data="{field:'loadt',width:150}" align="left">电费上传时间</th>
          <th lay-data="{field:'jft',width:150}" align="left">缴费时间</th>
          <th lay-data="{field:'accounts',width:300}" align="left">是否扎帐</th>
        </tr> 
      </thead>
      <tbody>
      	<?
      	if(isset($_GET['button']))
    		{
    			$sql="select * from sch_dfre where s_time='".$_GET['da1'].'-'.$_GET['da2']."' and s_username='".$_GET['nid']."'";
          ?>
          <script type="text/javascript">
              //时间
              document.getElementById("sadminY").value = "<?=$_GET['da1']?>";
              document.getElementById("sadminm").value = "<?=$_GET['da2']?>";
            </script>
          <?
    		}
        else if(isset($_GET['lsh']))
        {
          $sql="select * from sch_dfre where s_username='".$_GET['nid']."' and s_serial='".$_GET['tlsh']."'";
        }
		$rs=mysql_query($sql,$con);
		while($rowre=mysql_fetch_row($rs))
		{
		?>
        <tr>
          <td align="left"><?=$rowre[8]?></td>
          <td align="left"><?=$rowre[4]?></td>
          <td align="left"><?=$rowre[5]?></td>
          <td align="left"><?=$rowre[6]?></td>
          <td align="left"><?=$rowre[7]?></td>
          <td align="left"><?=$rowre[9]?></td>
          
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

</script>

</body>
</html>