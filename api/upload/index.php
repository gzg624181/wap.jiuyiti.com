<?php	
	require_once('../../include/config.inc.php');	
	//生成自动文件名
	$rand1=rand(0,9);
	$rand2=rand(0,9);
	$rand3=rand(0,9);
	
	$filename=date("Ymdhms").$rand1.$rand2.$rand3;
	//图片上传
	 
	$oldfilename=$_POST['pic_name']['name'];
	
	$filetype=substr($oldfilename,strrpos($oldfilename,"."),strlen($oldfilename)-strrpos($oldfilename,"."));

	  if($_POST['pic_name']['error']==4){
		 $savedir=""; 
		  }else{
	  if(($filetype!='.jpg')&&($filetype!='.gif')&&($filetype!='.jpg')&&($filetype!='.png')&&($filetype!='.JPG')&&($filetype!='.GIF')&&($filetype!='.PNG')){
		  exit;
	       }  
	if($_POST['pic_name']['size']>10000000){
		  exit;
	      }
		  }
	// 取得保存文件的临时文件名（含路径）
	$filename=$filename.$filetype;
	$savedir="uploads/image/".$filename;     //上传文件后相对路径	 
	 if(move_uploaded_file($_POST['pic_name']['tmp_name'],$savedir)){	
	  $file_name=basename($savedir);
	   }
	 
	   
	
	$sql = "UPDATE `memberuser` SET  Image='$savedir' WHERE Account='$account'";
	$dosql->ExecNoneQuery($sql);
    $row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$account'");	
	
if(is_array($row)){
$State = 1;
$Descriptor = '修改成功！';	
$Data[]=$row;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '修改失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}

?>