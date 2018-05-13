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
<!--对src获取 class="ann" id="src"  这样进行跳转-->
  <div class="layui-header">
    <div class="layui-logo" style="color:#FFF;"><a style="color:#FFF;" href="javascript:;"><i class="layui-icon" >&#xe671;</i>校园宝后台</a></div>
    <!-- 头部区域 -->
	<?
	include("../../PHP/riqi.php");
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
	?>
    <script>	
	layui.use('layer', function(){
	  var layer = layui.layer;
		//修改密码弹出
		$(".updatepass").click(function(e) {
			layer.open({
			  type: 2,
			  title: '修改密码',
			  shadeClose: true,
			  shade: 0.8,
			  shadeClose:true,
			  scrollbar:false,
			  area: ['320px', '320px'],
			  content: '../xgmm/admin_uplogin.php' //iframe的url
			}); 
		});
	});

  //退出
$(document).ready(function(e) {
  $(".del_login").click(function(e) {
    layui.use('layer', function(){
      var layer = layui.layer;
      parent.layer.confirm('<center>确定退出？<br>下次将不会自动登陆</center>', {
        btn: ['确定|·_·)','取消'],
        title: false,
        btnAlign: 'c',
        closeBtn: 0,
      }, function(){
        location.href="../../del_login.php";
      },function(){
        
          });
        });
      });
    });
	</script>
    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a href="javascript:;">
          <?=$_SESSION['name']?>
        </a>
        <dl class="layui-nav-child">
          <dd><a class="updatepass" href="javascript:;">修改密码</a></dd>
          <dd><a href="javascript:;" class="del_login">退出</a></dd>
          <dd></dd>
        </dl>
      </li>
      
    </ul>
  </div>
  
  <div class="layui-side layui-bg-black dynamic-navigation">
    <div class="layui-side-scroll">
      <!-- 左侧导航 -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
      	<li class="layui-nav-item"><a class="ann" id="admin_index.php" href="javascript:;">后台首页</a></li>
    <!--账号管理-->
    <?
    	if($_SESSION['cg']==1 || $_SESSION['zw']=='维修主管' || $_SESSION['zw']=='宿管员' || $_SESSION['zw']=='宿管主管')
		{
		?>
        <li class="layui-nav-item layui-nav-itemed">
          <a href="javascript:;">账号管理</a>
          <dl class="layui-nav-child">
            <?
              if($_SESSION['cg']==1 || $_SESSION['zw']=='宿管员' || $_SESSION['zw']=='宿管主管')
              {
            ?>
            <dd><a class="ann" id="../zhgl/stu_all.php" href="javascript:;">学生管理</a></dd>
            <dd><a class="ann" id="../zhgl/stu_whole.php" href="javascript:;">学生整体管理</a></dd>
            <?
                if($_SESSION['cg']==1 || $_SESSION['zw']=='宿管主管')
                {
            ?>
            <dd><a class="ann" id="../zhgl/sginsert.php" href="javascript:;">增加宿管员</a></dd>
            <dd><a class="ann" id="../zhgl/sg_zhgl.php" href="javascript:;">管理宿管员</a></dd>
            <?
                }
              }
            ?>
            <?
              if($_SESSION['cg']==1 || $_SESSION['zw']=='维修主管')
              {
            ?>
            <dd><a class="ann" id="../zhgl/wxinsert.php" href="javascript:;">增加维修员</a></dd>
            <dd><a class="ann" id="../zhgl/zhgl.php?n=维修员" href="javascript:;">管理维修员</a></dd>
          	<?
              }
            ?>
            
          </dl>
        </li>
        <?
		}
		?>
    <!--报修管理-->
        <?
		if($_SESSION['cg']==1 || $_SESSION['zw']=='维修主管')
		{
		?>
        <li class="layui-nav-item layui-nav-itemed">
          <a href="javascript:;">报修管理</a>
          <dl class="layui-nav-child">
            <dd><a class="ann" id="../bxgl/admin_ly.php" href="javascript:;">报修分配</a></dd>
            <dd><a class="ann" id="../bxgl/bx_re.php" href="javascript:;">报修前统计</a></dd>
            <dd><a class="ann" id="../bxgl/bxztcx.php" href="javascript:;">报修状态查询</a></dd>
            <dd><a class="ann" id="../bxgl/bx_re_af.php" href="javascript:;">报修后统计</a></dd>
            <dd><a class="ann" id="../bxgl/inbxre.php" href="javascript:;">物件增加</a></dd>
          </dl>
        </li>
        <?
		}
		?>
    <!--维修员任务-->
    <?
		if($_SESSION['zw']=='维修员')
		{
		?>
        <li class="layui-nav-item layui-nav-itemed">
          <a href="javascript:;">维修员</a>
          <dl class="layui-nav-child">
            <dd><a class="ann" id="../bxgl/wxrw.php" href="javascript:;">任务</a></dd>
            
          </dl>
        </li>
        <?
		}
		?>
    
    <!--水电费管理-->
    <?
    if($_SESSION['cg']==1 || $_SESSION['zw']=='宿管主管' || $_SESSION['zw']=='宿管员')
    {
    ?>
        <li class="layui-nav-item layui-nav-itemed">
          <a href="javascript:;">水电费管理</a>
          <dl class="layui-nav-child">
            <dd><a class="ann" id="../ele_exp/ele_pay.php" href="javascript:;">电费缴费</a></dd>
            <?
            if($_SESSION['cg']==1 || $_SESSION['zw']=='宿管主管')
            {
            ?>
            <dd><a class="ann" id="../ele_exp/upload_ele.php" href="javascript:;">电费表excel.csv上传</a></dd>
            <?
            }
            ?>
            <dd><a class="ann" id="../ele_exp/ele_re.php" href="javascript:;">电费详情统计</a></dd>
          </dl>
        </li>
        <?
    }
    ?>

        <?
		if($_SESSION['cg']==1)
		{
		?>
        <li class="layui-nav-item"><a class="ann" id="../logincount/lindex.php" href="javascript:;">登陆记录</a></li>
        <?
		}
		?>
        <li class="layui-nav-item"><a class="ann" id="copy.php" href="javascript:;">关于及更新</a></li>
      </ul>
    </div>
  </div>