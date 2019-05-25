<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('message');
//应聘内容
if(isset($action) and $action=='del3')
{

		$sql = "delete from `#@__join` where id=$id";
		if($dosql->ExecNoneQuery($sql))
		{
			ShowMsg('删除成功！','message.php');
			exit();
		}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>应聘管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script src="https://use.fontawesome.com/86c2dd6c06.js"></script>
</head>
<body>
<div class="topToolbar"> <span class="title">应聘管理</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="message_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="2%" height="36"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="2%" align="center">ID</td>
			<td width="11%" align="center">姓名</td>
			<td width="3%" align="center">性别</td>
			<td width="8%" align="center">籍贯</td>
			<td width="8%" align="center">出生年月</td>
			<td width="11%" align="center">联系电话</td>
			<td width="7%" align="center">Email</td>
			<td width="7%" align="center">学历</td>
			<td width="17%" align="center">工作经历</td>
			<td width="9%" align="center">时间</td>
			<td width="8%" align="center">应聘职位</td>
			<td width="7%" align="center">操作</td>
		</tr>
		<?php

		$dopage->GetPage("SELECT * FROM `#@__join`");
		while($row = $dosql->GetArray())
		{

			if($row['sex'] == 1)
				$sex = '男 ';

			if($row['sex'] == 0)
				$sex = '女 ';
		?>
		<tr align="left" class="dataTr">
			<td height="36" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
			<td align="center"><?php echo $row['id']; ?></td>
			<td align="center"><?php echo $row['name']; ?></td>
			<td align="center"><?php echo $sex; ?></td>
			<td align="center"><?php echo $row['jiguan']; ?></td>
			<td align="center"><?php echo $row['birth']; ?></td>
			<td align="center"><?php echo $row['tel']; ?></td>
			<td align="center"><?php echo $row['email']; ?></td>
			<td align="center"><?php echo $row['xueli']; ?></td>
			<td align="center"><?php echo $row['jingli']; ?></td>
			<td align="center"><?php echo $row['regtime']; ?></td>
			<td align="center"><?php echo $row['zhiwei']; ?></td>
			<td align="center"><span class="nb"><a href="message_save.php?action=del3&id=<?php echo $row['id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></span></td>
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
<div class="page"> <?php echo $dopage->GetList(); ?> </div>

</body>
</html>
