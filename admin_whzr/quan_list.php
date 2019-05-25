<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>购物券管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">购物券管理</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="promotion_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="8%" height="36" align="center">购物券LOGO</td>
		  <td width="18%" align="center">商家名称</td>
		  <td width="8%" align="center">商家账号</td>
		  <td width="17%" align="center">商家地址</td>
		  <td width="14%" align="center">消费额度</td>
			<td width="10%" align="center">金额</td>
			<td width="11%" align="center">有效时间</td>
			<td width="7%" align="center">是否上线</td>
			<td width="7%" align="center">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Id='$id' and a.type=1" ,15);
		while($row = $dosql->GetArray())
		{
			switch($row['play']){
			case 1:
			$play="<font color='#339933'><B>"."<i class='fa fa-check' aria-hidden='true'></i>"."</b></font>";
			break;
			
			case 0:
			$play="<font color='#FF0000'><B>"."<i class='fa fa-times' aria-hidden='true'></i>"."</b></font>";
			break;
			}
		?>
		<tr align="left" class="dataTr">
			<td height="69" align="center"><img style="padding:5px; border-radius:8px;" src="../<?php echo $row['logo'];?>" width="120px" height="50px" /></td>
			<td align="center"><?php echo $row['CommercialName'];?></td>
			<td align="center"><?php echo $row['Commercial'];?></td>
			<td align="center"><?php echo $row['CommercialSite'];?></td>
			<td align="center"><?php echo $row['fanwei'];?></td>
			<td align="center"><font color="red"><B><?php echo $row['money'];?></B></font></td>
			<td align="center"><?php echo $row['usetime'];?></td>
			<td align="center"><?php echo $play;?></td>
			<td align="center">
            <div id="jsddm"><a title="编辑"  href="quan_update.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil-square-o fa-lg fa-fw" aria-hidden="true"></i></a></div>
            <div id="jsddm" style="margin-top:10px;"><a title="删除" href="quan_save.php?action=del4&id=<?php echo $row['id']; ?>&gid=<?php echo $id;?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-lg fa-fw" aria-hidden="true"></i></a></div>
            </td>
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
<div class="formSubBtn" style="text-align:left; margin-left:35px; margin-top:20px;">
<input type="button" class="back" value="返回" onclick="history.go(-1);" />
	</div>
</body>
</html>