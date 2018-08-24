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
  <title>校园宝后台</title>
  <style type="text/css">
    p{
      margin:16px 16px 0 0;
    }
    .sj{
      margin:16px 16px 0 0;
    }
  </style>
</head>
<body>
<?
	include("../../PHP/riqi.php");
	include("../../SQL/db/db.php");
	include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");

  
?>
    	<div class="layui-container">  
          <div class="layui-row layui-col-space10">

          	<div class="layui-col-md8">
            	<blockquote class="layui-elem-quote">
                  <h2>校园宝后台</h2>
                  <p>欢迎<?=$_SESSION['name']?></p>
              </blockquote>

              <blockquote class="layui-elem-quote">
                  <h2>菜单及修改密码</h2>
                  <p>点击左上角【校园宝后台】呼出菜单<br>点击右上角【姓名】修改密码<br>还没有修改密码的管理员请及时【修改密码】</p>
              </blockquote>
              
          	</div>
            
            <?
              if($_SESSION['cg']==1)
              {
            ?>
            <div class="layui-col-md4">
              <?
                include("class/windows.php");//windows数据类
                $info = new SystemInfoWindows();
                
              ?>
            
              <blockquote class="layui-elem-quote">

                <h2>服务器数据</h2>
                <div class="sj">
                  <p>服务器类型版本：</p>
                  <div><?=php_uname();?></div>
                </div>

                <div class="sj">
                  <p>PHP版本：<?=PHP_VERSION;?></p>
    
                </div>
                
                <div class="sj">
                  <p>磁盘数据：</p>
                  <div><?=$info->getcp()?></div>
                </div>

                

              </blockquote>

              
            </div>
            <?
              }
            ?>


          </div>
        </div>
        
<script>
//
layui.use('element', function(){
  var element = layui.element;
});
</script>

</body>
</html>