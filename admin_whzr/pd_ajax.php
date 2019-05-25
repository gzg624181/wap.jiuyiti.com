<?php
require_once(dirname(__FILE__).'/inc/config.inc.php');
$id=$_GET['Id'];
$sql = "UPDATE `commodity` SET del='1' WHERE Id='$id'";
$dosql->ExecNoneQuery($sql);
echo "<font color='#FF0000'><B>"."已下架"."</b></font>";
?>