<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('weblink'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>职业编码管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/loadimage.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>

</head>
<body>
<div class="topToolbar"> <span class="title">职业编码管理</span>  
<a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="3%" height="36" align="center" class="firstCol"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="5%" align="center">ID</td>
			<td width="16%" align="center">职业明细类级</td>
			<td width="10%" align="center">职业编码</td>
			<td width="56%" align="center">职业说明</td>
			<td width="10%" align="center">操作</td>
	  </tr>
		<?php
		$sql = "SELECT * FROM `#@__weblink` WHERE `siteid`='$cfg_siteid'";

		if(isset($tid))
			$sql .= " AND classid=$tid";

		$dopage->GetPage($sql);
		while($row = $dosql->GetArray())
		{
			$row2 = $dosql->GetOne("SELECT `classname` FROM `#@__weblinktype` WHERE `id`=".$row['classid']);

			if(isset($row2['classname']))
				$classname = $row2['classname'].' ['.$row['classid'].']';
			else
				$classname = '<span class="red">分类已删除 ['.$row['classid'].']</span>';
			
			switch($row['checkinfo'])
			{
				case 'true':
					$checkinfo = '已审';
					break;  
				case 'false':
					$checkinfo = '未审';
					break;
				default:
					$checkinfo = '没有获取到参数';
			}
		?>
		<tr align="left" class="dataTr">
			<td height="70" align="center" class="firstCol"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
			<td align="center"><?php echo $row['id']; ?></td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center">&nbsp;</td>
			<td align="center"> <span><a href="weblink_update.php?id=<?php echo $row['id']; ?>">修改</a></span> | <span class="nb"><a href="weblink_save.php?action=del2&id=<?php echo $row['id'] ?>" onclick="return ConfDel(2);">删除</a></span></td>
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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAll('weblink_save.php');" onclick="return ConfDel(0);">删除</a></span> <a href="weblink_add.php" class="dataBtn">添加职业编码</a> </div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAll('weblink_save.php');" onclick="return ConfDel(0);">删除</a></span> <a href="weblink_add.php" class="dataBtn">添加友情链接</a><span class="pageSmall">
			<?php echo $dopage->GetList(); ?>
			</span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>