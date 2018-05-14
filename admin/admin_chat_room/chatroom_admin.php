<!--
/**
 * This file is part of online_chat_room.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    AmosHuKe<amoshuke@qq.com>
 * @copyright AmosHuKe<amoshuke@qq.com>
 * @link      https://github.com/AmosHuKe/Hi/tree/master/Online_Chat_Room
 * @license   http://www.opensource.org/licenses/mit-license.php (MIT License)
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
  <title>房间管理</title>
  
</head>
<body>
	<?php
    include("../../PHP/riqi.php");
    include("../../SQL/db/db.php");
    include("../../PHP/adminse.php");
    include("../adminse/admin_se.php");
		include("chatroom_admin_class.php");//房间管理类
    include("chatroom_config.php");//聊天室配置文件
		$chat_class=new chatroom_admin_class();//实例化
    $room=$chat_class->chatroom_all();//接收房间数组
    
	?>
  <!--main-->
  <div class="layui-container">
    <div class="layui-row">
      <!--标题-->
      <blockquote class="layui-elem-quote">
        <p>房间管理</p>
        <p>房间总数：<?=count($room)?>个房间</p>
        <p>房间号只能是数字，字母</p>
        <p>
          <form class="layui-form layui-form-pane" method="get" action="">
            <div class="layui-form-item">
              <label class="layui-form-label">房间号</label>
              <div class="layui-input-inline">
                <input type="text" name="roomid" required lay-verify="required" placeholder="请输入房间号" autocomplete="off" class="layui-input">
              </div>
              <button class="layui-btn " lay-submit>&nbsp;进&nbsp;入&nbsp;</button>
              <button class="layui-btn " onclick="document.location.reload();" type="button">&nbsp;刷&nbsp;新&nbsp;</button>
            </div>
            
          </form>
        </p>
      </blockquote>
      <!--房间主要显示入口-->
      <table lay-filter="chatroom" id="chatroom">
        <thead>
          <tr>
            <th lay-data="{field:'chatroom'}">房间号</th>
            <th lay-data="{field:'chatcount', sort:true}">聊天数</th>
            <th lay-data="{field:'chattime', sort:true}">创建时间</th>
            <th lay-data="{fixed: 'right', width:120, align:'center', toolbar: '#bartools'}">操作</th>
          </tr> 
        </thead>
        <tbody>
          <?php
            //循环输出
            for($i=0;$i<count($room);$i++)
            {
          ?>
          <tr>
            <td><?=substr($room[$i],0,-4);?></td>
            <td><?=$chat_class->chatroom_count($room[$i])-1;?></td>
            <td><?=$chat_class->chatroom_time($room[$i])?></td>
            <td>
              
            </td>
          </tr>
          <?php
            }
          ?>
        </tbody>
      </table>

      <script type="text/html" id="bartools">
        <!--操作-->
        <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="ck">查看</a>
        <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
      </script>
      <script type="text/javascript">
        //表格渲染
        layui.use('table', function(){
          var table = layui.table;
          //执行渲染
          table.init('chatroom', {
            limit: 10 //注意：请务必确保 limit 参数（默认：10)
            ,page: true //开启分页
            //支持所有基础参数
          });

          //监听工具条
          table.on('tool(chatroom)', function(obj){
            var data = obj.data;
            if(obj.event === 'ck'){
              //iframe窗
             layer.open({
                type: 2,
                title: data.chatroom+'房间',
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['340px', '400px'],
                content: 'chatroom_index.php?room='+data.chatroom+''
              });
            } else if(obj.event === 'del'){
              layer.confirm('真的删除'+data.chatroom+'房间么', function(index){
                location.href="chatroom_admin_class.php?delroom="+data.chatroom+"";
                layer.close(index);
              });
            } 

          });

        }); 
      </script>



    </div>
  </div>

<?php
if(isset($_GET['del']))
{
  if($_GET['del']=="ok")
  {
    ?>
      <script type="text/javascript">
        layui.use('layer', function(){
          var layer = layui.layer;
          layer.msg('删除房间成功', {
          time: 2000,
          });
        });
        </script>
    <?
  }
  if($_GET['del']=="error")
  {
    ?>
      <script type="text/javascript">
        layui.use('layer', function(){
          var layer = layui.layer;
          layer.msg('删除房间失败', {
          time: 2000,
          });
        });
        </script>
    <?
  }
}
//后台进入或创建房间
if(isset($_GET['roomid']))
{
  ?>
  <script type="text/javascript">
  layui.use('layer', function(){
    var layer = layui.layer;
    layer.open({
      type: 2,
      title: <?=$_GET['roomid']?>+'房间',
      shade: false,
      maxmin: true, //开启最大化最小化按钮
      area: ['340px', '400px'],
      content: 'chatroom_index.php?room='+<?=$_GET['roomid']?>+''
    });
  });
  </script>
  <?
}
?>

</body>
</html>