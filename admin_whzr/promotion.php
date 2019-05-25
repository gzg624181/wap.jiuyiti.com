<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>活动管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
</head>
<body>
<div class="topToolbar"> <span class="title">会员管理</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="promotion_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="2%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="9%" align="center">活动图片</td>
			<td width="71%">活动地址</td>
			<td width="12%">添加时间</td>
			<td width="6%" align="left">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `activitys`",15);
		while($row = $dosql->GetArray())
		{
		?>
		<tr align="left" class="dataTr">
			<td height="101" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
			<td align="center" valign="middle"><img src="../<?php echo $row['Image'];?>" width="100px" /></td>
			<td><?php echo $row['Url'];?></td>
			<td><?php echo $row['CreatTime']; ?></td>
			<td align="center">
            <div id="jsddm"><a href="promotion_update.php?id=<?php echo $row['id']; ?>">编辑</a></div>
            <div id="jsddm"><a href="promotion_save.php?action=del2&id=<?php echo $row['id']; ?>" onclick="return ConfDel(0);">删除</a></div></td>
		</tr>
		<?php
		}
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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('promotion_save.php');" onclick="return ConfDelAll(0);">删除</a></span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('promotion_save.php');" onclick="return ConfDelAll(0);">删除</a></span> <span class="pageSmall"> <?php echo $dopage->GetList(); ?> </span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>