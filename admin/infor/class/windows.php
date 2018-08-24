<?
header("Content-type: text/html; charset=utf-8");
class SystemInfoWindows
{

  # 已运行时长
    public function getruntime(){
      $out = '';
      $info = exec('wmic os get lastBootUpTime,LocalDateTime',$out,$status);
      $datetime_array = explode('.',$out[1]);
      $dt_array = explode(' ',$datetime_array[1]);
      $localtime = substr($datetime_array[1],-14);
      $boottime = $datetime_array[0];
      $uptime = strtotime($localtime) - strtotime($datetime_array[0]);
       
      $day=floor(($uptime)/86400);
      $hour=floor(($uptime)%86400/3600);
      $minute=floor(($uptime)%86400/60);
      $second=floor(($uptime)%86400%60);
      echo $day."天".$hour."小时\r\n\r\n";
    } 

    # 硬盘用量
    public function getcp(){
      $out = '';
      $info = exec('wmic logicaldisk get FreeSpace,size /format:list',$out,$status);
      $hd = '';
      foreach($out as $vaule){
        $hd .= $vaule . ' ';;
      }
      $hd_array = explode('   ', trim($hd));
      $key = 'CDEFGHIJKLMNOPQRSTUVWXYZ';
      foreach($hd_array as $k => $v){
        $s_array = explode('Size=', $v);
        $fs_array = explode('FreeSpace=', $s_array[0]);
        $size = round(trim($s_array[1])/(1024*1024*1024), 1);
        $freespace = round(trim($fs_array[1])/(1024*1024*1024), 1);
        $drive = $key[$k];
        echo $drive . "盘,\r\n空间: " . ($size - $freespace) . "GB/" . $size . "GB<br>";
      }
    }




  }
?>