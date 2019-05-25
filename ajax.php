<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

$r=$dosql->GetOne("select * from commercialuser where Commercial='$name'");
  if(is_array($r)){
  echo $r['Id'];
  }

 ?>
