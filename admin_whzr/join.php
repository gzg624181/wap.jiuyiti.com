<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>加盟列表</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">加盟列表</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="join_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="6%" align="center">姓名</td>
			<td width="17%" align="center">类别</td>
		  <td width="25%" align="center">商家地址</td>
		  <td width="25%" align="center">留言内容</td>
			<td width="12%" align="center">联系电话</td>
			<td width="11%" align="center">申请日期</td>
			<td width="3%" align="left">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `join`",15);
		while($row = $dosql->GetArray())
		{
			switch($row['type']){
				case 'tg':
				$type= "<span style='color:red'>".'团购'."</span>";
				break;
				case 'ztd':
				$type= "<span style='color:green'>".'自提点'."</span>";
				break;
				
				}
		?>
		<tr align="left" class="dataTr">
			<td height="42" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
			<td align="center" valign="middle"><?php echo $row['joinname'];?></td>
			<td align="center"><?php echo $type;?></td>
			<td align="center"><?php echo $row['joinaddress'];?></td>
			<td align="center"><?php echo $row['joinmessage'];?></td>
			<td align="center"><?php echo $row['joinphone'];?></td>
			<td align="center"><?php echo $row['CreatTime'];?></td>
			<td align="center">
            <div id="jsddm"><a title="删除" href="join_save.php?action=del2&id=<?php echo $row['id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-lg fa-fw" aria-hidden="true"></i></a></div></td>
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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('join_save.php');" onclick="return ConfDelAll(0);">删除</a></span></div>
<div class="page"> <?php  echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('join_save.php');" onclick="return ConfDelAll(0);">删除</a></span> <span class="pageSmall"> <?php echo $dopage->GetList(); ?> </span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>