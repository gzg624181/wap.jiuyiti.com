<?php
    /**  
	 * 链接地址：Editmemberuser
	 *
     * 下面直接来连接操作数据库进而得到json串
     * 
     * 按json方式输出通信数据
     * 
     * @param unknown $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *     
	 * @param string $Version  操作时间
	       
     * @param array $Data 数据
     *            
     * @return string
     *           
     * @修改会员信息 提供返回参数账号 username, alias, age, sex, phone, idnumber, account, password, image, balance
     */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();
    
	 if(isset($alias)){
	//修改昵称
	$sql = "UPDATE `memberuser` SET  Alias='$alias' WHERE `Id`='$id'";
	$dosql->ExecNoneQuery($sql);
	include("../../admin_whzr/api/Api_GetMemberUserInfo.php");       //更新会员的缓存
     }elseif(isset($username)){
     //修改姓名
	$sql = "UPDATE `memberuser` SET  UserName='$username' WHERE `Id`='$id'";
	$dosql->ExecNoneQuery($sql);
	include("../../admin_whzr/api/Api_GetMemberUserInfo.php");       //更新会员的缓存
	 }elseif(isset($sex)){
    //修改性别
	$sql = "UPDATE `memberuser` SET  Sex='$sex' WHERE Id='$id'";
	$dosql->ExecNoneQuery($sql);
	include("../../admin_whzr/api/Api_GetMemberUserInfo.php");       //更新会员的缓存
    }elseif(isset($age)){
    //修改年龄
	$sql = "UPDATE `memberuser` SET  Age='$age' WHERE Id='$id'";
	$dosql->ExecNoneQuery($sql);
	include("../../admin_whzr/api/Api_GetMemberUserInfo.php");       //更新会员的缓存
	}elseif(isset($password)){
    //修改密码
	$password = isset($password) ? md5(md5($password)) : '' ;
	$sql = "UPDATE `memberuser` SET  Password='$password' WHERE Id='$id'";
	$dosql->ExecNoneQuery($sql);
	include("../../admin_whzr/api/Api_GetMemberUserInfo.php");       //更新会员的缓存
    }elseif(isset($bgimage)){
    //修改背景图片
	$sql = "UPDATE `memberuser` SET  BgImage='$bgimage' WHERE Id='$id'";
	$dosql->ExecNoneQuery($sql);
	include("../../admin_whzr/api/Api_GetMemberUserInfo.php");       //更新会员的缓存
	//修改头像
	}elseif(isset($image)){
	$sql = "UPDATE `memberuser` SET  Image='$image' WHERE Id='$id'";
	$dosql->ExecNoneQuery($sql);
	include("../../admin_whzr/api/Api_GetMemberUserInfo.php");       //更新会员的缓存
	}
	//生成自动文件名
	/*$rand1=rand(0,9);
	$rand2=rand(0,9);
	$rand3=rand(0,9);
	$filename=date("Ymdhms").$rand1.$rand2.$rand3;
	    //图片上传
	$oldfilename=$_FILES['image']['name'];
	$filetype=substr($oldfilename,strrpos($oldfilename,"."),strlen($oldfilename)-strrpos($oldfilename,"."));
	if($_FILES['image']['error']==4){
		 $savedir=""; 
		  }else{
	  if(($filetype!='.jpg')&&($filetype!='.gif')&&($filetype!='.jpg')&&($filetype!='.png')&&($filetype!='.JPG')&&($filetype!='.GIF')&&($filetype!='.PNG')){
		  echo"<script>alert('文件类型或地址错误！');location.href=index.php;</script>"; 
		  exit;
	   }  
	if($_FILES['image']['size']>1000){
		  echo"<script>alert('文件太大，不能上传！');location.href=index.php;</script>"; 
		  exit;
	 }
	// 取得保存文件的临时文件名（含路径）
	$filename=$filename.$filetype;
	$savedir="uploads/image/20170828/".$filename;     //上传文件后相对路径	
	 if(move_uploaded_file($_FILES['image']['tmp_name'],$savedir)){	
	  $file_name=basename($savedir);
	   }else{
	   echo "<script language=javascript>";	
	   echo "alert('错误，无法将附件写入服务器！\n本次发布失败！');";
	   echo "location.href='index.php';";
	   echo "</script>";
	   exit;
	   }
	$sql = "UPDATE `memberuser` SET  Image='$image' WHERE Id='$id'";
	$dosql->ExecNoneQuery($sql);
	 }
    $row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Id='$id'");
	  }
	*/
$file = "../../cache/".$cachename.".txt";  
$msg = Readf($file);  
$Data = unserialize($msg); 
if(count($Data)>0){
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