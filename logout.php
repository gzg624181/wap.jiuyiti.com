<?php

//正确的注销session方法：
//1开启session
session_start();
  
//2、清空session信息
$_SESSION = array();
  
//3、清除客户端sessionid
if(isset($_COOKIE[session_name()]))
{
  setCookie(session_name(),'',time()-3600,'/');
}
//4、彻底销毁session
//session_destroy();	

unset($_SESSION['commercial']);
header('location:index.html'); 
	 


?>
