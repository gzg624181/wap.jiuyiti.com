<?php
session_start();

   if(!isset($_SESSION['commercial'])){
    header("Location: login-1-1.html");         //跳到登录界面
   }else{
   return true;
    }
?>
