<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品分类</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">商品分类</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="promotion_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
		  <td width="5%" align="center">商品分类</td>
		  <td height="35" colspan="2" align="center">二级类别</td>
		  <td width="61%" height="36" align="left">&nbsp;</td>
			<td width="11%">&nbsp;</td>
			<td width="3%" align="center">操作</td>
		</tr>
		<?php
		$first=0;
		$second=1;
		$three=2;
		$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=0 and checkinfo='true'",$first);
		while($row = $dosql->GetArray($first))
		{
		?>
		<tr align="left" class="dataTr">
		  <td align="center"><B><?php echo $row['classname'];?></B></td>
		  <td colspan="2" align="center">&nbsp;</td>
		  <td height="35" align="center">&nbsp;</td>
			<td>&nbsp;</td>
			<td align="center">
            <div id="jsddm"><a href="maintype_update.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil-square-o fa-2x fa-fw" aria-hidden="true"></i></a></div>
            </td>
		</tr>
        <?php
		$pid=$row['id'];
		$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$pid and parentstr like '%$pid%' and checkinfo='true'",$second);
		while($show = $dosql->GetArray($second))
		{
		?>
		<tr align="left" class="dataTr">
		    <td align="center">&nbsp;</td>
		    <td width="4%" align="left">&nbsp;</td>
		    <td width="16%" align="left">&nbsp;&nbsp;<img src="templates/images/subTypeBg.gif" width="22" height="11" />&nbsp;&nbsp;<?php echo $show['classname'];?></td>
			<td height="35" align="center">&nbsp;</td>
			<td>&nbsp;</td>
			<td align="center">
        
            </td>
		</tr>
        <?php
		$cid=$show['id'];
		$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$cid and parentstr like '%$cid%' and checkinfo='true'",$three);
		while($r = $dosql->GetArray($three))
		{
		?>
		<tr align="left" class="dataTr">
		    <td align="center">&nbsp;</td>
		    <td align="center" valign="middle"><img style="margin-top:2px; margin-left:2px;" src="../<?php if($r['picurl']==""){echo "templates/default/images/noimage.gif";}else{echo $r['picurl'];}?>" width="50" height="50" /></td>
	      <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="templates/images/subTypeBg.gif" alt="" width="22" height="11" />&nbsp;&nbsp;<?php echo $r['classname'];?></td>
			<td height="35" align="left">&nbsp;</td>
			<td>&nbsp;</td>
			<td align="center">
            <div id="jsddm"><a href="maintype_update.php?id=<?php echo $r['id']; ?>"><i class="fa fa-pencil-square-o fa-2x fa-fw" aria-hidden="true"></i></a></div>
            </td>
		</tr>
		<?php
		}}}
		?>
	</table>
</form>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
</body>
</html>