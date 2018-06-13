<?php
//ele_accounts_re 的表导出excel
  include("../../PHP/riqi.php");
  include("../../SQL/db/db.php");
  include("../../PHP/adminse.php");
  include("../adminse/admin_se.php");
  //当页导出
  if(isset($_GET['dcby']))
  {
  	//表上传时间
  	$lstt=$_GET['timesql'];
  	//数据
  	for($i=1;$i<=5;$i++)
	{
		$sqlre="select sushe_date,sum(sushe_money),count(sushe_dor),sum(sushe_ele),sum(sushe_excess) from sushe_user where sushe_m='已上缴' and sushe_Y='".$lstt."' and sushe_dor like '".$i."%'";
		$rsre=mysql_query($sqlre,$con);
		if($rowre=mysql_fetch_row($rsre))
		{
			
			//抄表时间
			${"cbsj".$i}=$rowre[0]!=""?$rowre[0]:"暂无数据";
			//已轧账费用
			${"yfy".$i}=$rowre[1]!=""?$rowre[1]:"暂无数据";
			//已轧账寝室
			${"ydor".$i}=$rowre[2]!=0?$rowre[2]:"暂无数据";
			//已轧账用电量
			${"yele".$i}=$rowre[3]!=""?$rowre[3]:"暂无数据";
			//已轧账超额量
			${"yexc".$i}=$rowre[4]!=""?$rowre[4]:"暂无数据";

			$sqlrew="select sushe_date,sum(sushe_money),count(sushe_dor),sum(sushe_ele),sum(sushe_excess) from sushe_user where sushe_m!='已上缴' and sushe_Y='".$lstt."' and sushe_dor like '".$i."%'";
			$rsrew=mysql_query($sqlrew,$con);
			if($rowrew=mysql_fetch_row($rsrew))
			{
				//未轧账用电量
				${"wele".$i}=$rowrew[3]!=""?$rowrew[3]:"暂无数据";
				//未轧账超额量
				${"wexc".$i}=$rowrew[4]!=""?$rowrew[4]:"暂无数据";
				//未轧账费用
				${"wfy".$i}=$rowrew[1]!=""?$rowrew[1]:"暂无数据";
				//未轧账寝室
				${"wdor".$i}=$rowrew[2]!=0?$rowrew[2]:"暂无数据";
			}
		} 
	}
		 
		//excel
		/** 
		 * 数据导出 
		 * @param array $title   标题行名称 
		 * @param array $data   导出数据 
		 * @param string $fileName 文件名 
		 * @param string $savePath 保存路径 
		 * @param $type   是否下载  false--保存   true--下载 
		 * @return string   返回文件全路径 
		 * @throws PHPExcel_Exception 
		 * @throws PHPExcel_Reader_Exception 
		 */
		function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){  
			//表时间
			global $lstt;
		    include('PHPExcel/PHPExcel.php');  
		    $obj = new PHPExcel();  
		  
		    //横向单元格标识  
		    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');  
		      
		    $obj->getActiveSheet(0)->setTitle("1");   //设置sheet名称  
		    $_row = 1;   //设置纵向单元格标识  
		    if($title){  
		        $_cnt = count($title);  
		        $obj->getActiveSheet(0)->mergeCells('A'.$_row.':'.$cellName[$_cnt-1].$_row);   //合并单元格  
		        $obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, $lstt.'电费财务详情');  //设置合并后的单元格内容  
		        $_row++;  
		        $i = 0;  
		        foreach($title AS $v){   //设置列标题  
		            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);  
		            $i++;  
		        }  
		        $_row++;  
		    }  
		  
		    //填写数据  
		    if($data){  
		        $i = 0;  
		        foreach($data AS $_v){  
		            $j = 0;  
		            foreach($_v AS $_cell){  
		                $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);  
		                $j++;  
		            }  
		            $i++;  
		        }  
		    }  
		      
		    //文件名处理  
		    if(!$fileName){  
		        $fileName = uniqid(time(),true);  
		    }  
		  
		    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');  
		  
		    if($isDown){ 
		    	ob_end_clean();//清除缓冲区,避免乱码
		      //网页下载  
		        header('pragma:public');  
		        header("Content-Disposition:attachment;filename=$fileName.xls");  
		        $objWrite->save('php://output');
		        exit();  
		    }  
		  
		    $_fileName = iconv("utf-8", "utf-8", $fileName);   //转码  
		    $_savePath = $savePath.$_fileName.'.xlsx';  
		     $objWrite->save($_savePath);  
		  
		     return $savePath.$fileName.'.xlsx';  
		}  
		// $data = array(
		// 	array('抄表时间',"".$cbsj1,$cbsj2,$cbsj3,$cbsj4,$cbsj5),
		// 	array('已轧账费用（元）',$yfy1,$yfy2,$yfy3,$yfy4,$yfy5),
		// 	array('已轧账寝室（间）',$ydor1,$ydor2,$ydor3,$ydor4,$ydor5),
		// 	array('已轧账用电量（元）',$yele1,$yele2,$yele3,$yele4,$yele5),
		// 	array('已轧账超额量',$yexc1,$yexc2,$yexc3,$yexc4,$yexc5),
		// 	array('未轧账费用（元）',$wfy1,$wfy2,$wfy3,$wfy4,$wfy5),
		// 	array('未轧账寝室（间）',$wdor1,$wdor2,$wdor3,$wdor4,$wdor5),
		// 	array('未轧账用电量',$wele1,$wele2,$wele3,$wele4,$wele5),
		// 	array('未轧账超额量',$wexc1,$wexc2,$wexc3,$wexc4,$wexc5)
	 //    );
		//调用
		exportExcel(array('详情','1号楼','2号楼','3号楼','4号楼','5号楼'), 
			array(
				array('抄表时间',"".$cbsj1,$cbsj2,$cbsj3,$cbsj4,$cbsj5),
				array('已轧账费用（元）',$yfy1,$yfy2,$yfy3,$yfy4,$yfy5),
				array('已轧账寝室（间）',$ydor1,$ydor2,$ydor3,$ydor4,$ydor5),
				array('已轧账用电量（元）',$yele1,$yele2,$yele3,$yele4,$yele5),
				array('已轧账超额量',$yexc1,$yexc2,$yexc3,$yexc4,$yexc5),
				array('未轧账费用（元）',$wfy1,$wfy2,$wfy3,$wfy4,$wfy5),
				array('未轧账寝室（间）',$wdor1,$wdor2,$wdor3,$wdor4,$wdor5),
				array('未轧账用电量',$wele1,$wele2,$wele3,$wele4,$wele5),
				array('未轧账超额量',$wexc1,$wexc2,$wexc3,$wexc4,$wexc5)), $lstt.'电费财务详情'.date('Y-m-d H_i_s'), './', true);

  }
  //整页导出
  if(isset($_GET['dczb']))
  {
  	$i=0;
  	$data1=array();
  	//表上传时间
  	$lstt=$_GET['timesql'];

  	$sql="select * from sushe_user where sushe_Y='".$lstt."' and sushe_m='已上缴'";
  	$rs=mysql_query($sql,$con);
  	while($row=mysql_fetch_row($rs))
	{
		$data1[$i]=array($row[2],$row[3],$row[5],$row[6],$row[7],$row[8],$row[9],$row[10],$row[11],$row[12],$row[16]);
		$i++;
  	}
  	//寝室，表号，电表基数，本次抄表数，用电量，定额量，超额量，电价，电费，抄表日期，状态

  	//excel
	/** 
	 * 数据导出 
	 * @param array $title   标题行名称 
	 * @param array $data   导出数据 
	 * @param string $fileName 文件名 
	 * @param string $savePath 保存路径 
	 * @param $type   是否下载  false--保存   true--下载 
	 * @return string   返回文件全路径 
	 * @throws PHPExcel_Exception 
	 * @throws PHPExcel_Reader_Exception 
	 */
  	function exportExcel($title=array(), $data=array(), $fileName='', $savePath='./', $isDown=false){  
			//表时间
			global $lstt;
		    include('PHPExcel/PHPExcel.php');  
		    $obj = new PHPExcel();  
		  
		    //横向单元格标识  
		    $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');  
		      
		    $obj->getActiveSheet(0)->setTitle("1");   //设置sheet名称  
		    $_row = 1;   //设置纵向单元格标识  
		    if($title){  
		        $_cnt = count($title);  
		        $obj->getActiveSheet(0)->mergeCells('A'.$_row.':'.$cellName[$_cnt-1].$_row);   //合并单元格  
		        $obj->setActiveSheetIndex(0)->setCellValue('A'.$_row, $lstt.'已缴费寝室详情');  //设置合并后的单元格内容  
		        $_row++;  
		        $i = 0;  
		        foreach($title AS $v){   //设置列标题  
		            $obj->setActiveSheetIndex(0)->setCellValue($cellName[$i].$_row, $v);  
		            $i++;  
		        }  
		        $_row++;  
		    }  
		  
		    //填写数据  
		    if($data){  
		        $i = 0;  
		        foreach($data AS $_v){  
		            $j = 0;  
		            foreach($_v AS $_cell){  
		                $obj->getActiveSheet(0)->setCellValue($cellName[$j] . ($i+$_row), $_cell);  
		                $j++;  
		            }  
		            $i++;  
		        }  
		    }  
		      
		    //文件名处理  
		    if(!$fileName){  
		        $fileName = uniqid(time(),true);  
		    }  
		  
		    $objWrite = PHPExcel_IOFactory::createWriter($obj, 'Excel2007');  
		  
		    if($isDown){ 
		    	ob_end_clean();//清除缓冲区,避免乱码
		      //网页下载  
		        header('pragma:public');  
		        header("Content-Disposition:attachment;filename=$fileName.xls");  
		        $objWrite->save('php://output');
		        exit();  
		    }  
		  
		    $_fileName = iconv("utf-8", "utf-8", $fileName);   //转码  
		    $_savePath = $savePath.$_fileName.'.xlsx';  
		     $objWrite->save($_savePath);  
		  
		     return $savePath.$fileName.'.xlsx';  
		}  
		//调用
		exportExcel(array('寝室','表号','电表基数','本次抄表数','用电量','定额量','超额量','电价','电费','抄表日期','状态'), $data1, $lstt.'已缴费寝室详情'.date('Y-m-d H_i_s'), './', true);
  }
?>