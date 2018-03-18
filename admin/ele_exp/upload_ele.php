<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html"; charset="gb2312">
  <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
  <link rel="stylesheet" href="../../layui/css/layui.css">
  <script src="../../layui/layui.js"></script>
  <link rel="shortcut icon" href="../../favicon.ico" />
  <!--JSQ-->
  <script src="../../JSQ/jquery-2.1.1.min.js"></script>
  <script src="../../JSQ/index.js"></script>
  <title>����ϴ�excel.csv�ļ�</title>
</head>

<body>
<?
  header("Content-Type: text/html;charset=gb2312");
  include("../../PHP/riqi.php");
  include("../../SQL/db/db.php");
  include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
?>
<!--main-->
<div class="layui-container">
  <div class="layui-row layui-col-space10 ">
    <div class="layui-col-md6 layui-col-xs12 layui-col-md-offset3">
      <blockquote class="layui-elem-quote">
          <p>�ϴ�excel.csv��ѱ�</p>
          <p style="color:#FF5722;">Excel���ϴ���ʽ����Ϊcsv</p>
          <p style="color:#FF5722;">Excel������汣��Ϊcsv��ʽ</p>
          <p style="color:#FF5722;">������˵�ѱ��ٽ����ϴ�</p>
          <p style="color:#FF5722;">�����ظ��ϴ������г�������ϵ������Ա</p>
      </blockquote>
      <p style="font-size: 32px; padding-bottom: 40px; padding-top: 40px" align="center">��ʼ�ϴ�</p>
      <form action="uploadok_ele.php" class="layui-form layui-form-pane fromload" enctype="multipart/form-data" name="admin" method="post" onsubmit="return checkload();">
        <div class="layui-form-item">
          <label class="layui-form-label">���</label>
          <div class="layui-input-block">
            <select name="sadminY" id="sadminY" lay-verify="required">
              <?
              for($j=2017;$j<=$rqY;$j++)
              {
              ?>
                <option value="<?=$j?>"><?=$j?>��</option>
              <?
              }
              ?>
            </select>
          </div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">�·�</label>
          <div class="layui-input-block">
            <select name="sadminm" id="sadminm" lay-verify="required">
              <?
              for($j=1;$j<=12;$j++)
              {
              ?>
                <option value="<?=$j?>"><?=$j?>��</option>
              <?
              }
              ?>
            </select>
          </div>
        </div>

        <div class="layui-form-item">
          <label class="layui-form-label">csv�ϴ�</label>
          <div class="layui-input-block">
            <input  name="ttupload" type="file" id="ttupload" accept=".csv" style="padding: 5px;"/>
          </div>
        </div>
        
        <div class="layui-form-item">
          <div class="layui-input-block">
            <div class="layui-btn okbtn" lay-filter="formb">��ʼ�ϴ�</div>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>

<script>
function checkload()
{
  var load=admin.ttupload.value;
  if(load=="")
  {
    $(document).ready(function(e) {
      layui.use('layer', function(){
          var layer = layui.layer;
        layer.msg('��ѡ��CSV�ļ�', {
          title: false,
          closeBtn: 0,
          time:2000,
          maxWidth:200,
          anim: 6,
          offset: '240px',
        });
        
      });
    });
    return false;
  }
}

document.getElementById("sadminY").value = "<?=$rqY?>";

layui.use('form', function(){
  var form = layui.form;
});

$(document).ready(function(e) {
  $(".okbtn").click(function(e) {
              layui.use('layer', function(){
                var layer = layui.layer;
                  layer.confirm('<center>ȷ����ʼ�ϴ���</center>', {
                  btn: ['ȷ��|��_��)','ȡ��'],
                  title: false,
                  btnAlign: 'c',
                  closeBtn: 0,
                }, function(){
                  layer.close(layer.index);
                  $(".fromload").submit();
                  
                },function(){
                  //code
                    });
                  });
                });
              });
</script>

</body>
</html>