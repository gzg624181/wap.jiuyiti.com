<?php
require_once(dirname(__FILE__).'/inc/config.inc.php');
$id=$_GET['Id'];
$sql = "UPDATE `commodity` SET del='0' WHERE Id='$id'";
$dosql->ExecNoneQuery($sql);
echo "<font color='#339933'><B>"."已上架"."</b></font>";
?>