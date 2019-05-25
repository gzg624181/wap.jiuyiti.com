<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>推荐活动统计-月份</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php 
$r = $dosql->GetOne("SELECT Recommand,CommercialName FROM `commercialuser` WHERE Commercial='$commercial'");
$recommand=$r['Recommand'];
$one=1;
$dosql->Execute("SELECT * FROM `recommand` where year='$year' and month='$month' and tjm='$recommand'",$one);
$num=$dosql->GetTotalRow($one);
?>
<div class="topToolbar"> <span class="title">推荐人名称：<?php echo $r['CommercialName'];?>&nbsp;&nbsp;&nbsp;合计统计会员：<span class="num" style="color:#F0F"><?php echo $num;?></span></span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="number_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
		  <td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="7%" height="36" align="center">推荐日期</td>
		  <td width="20%" align="center">会员昵称</td>
		  <td width="28%" align="center">酒钱余额</td>
		  <td width="19%" align="center">联系电话</td>
		  <td width="19%" align="center">注册时间</td>
		  <td width="6%" align="center">操作</td>
		</tr>
		<?php
$r = $dosql->GetOne("SELECT Recommand FROM `commercialuser` WHERE Commercial='$commercial'");
$recommand=$r['Recommand'];
$dopage->GetPage("SELECT * FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$recommand' and a.year='$year' and a.month='$month'",10,'desc');
		while($row = $dosql->GetArray())
		{
		?>
		<tr align="left" class="dataTr">
		  <td align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
			<td height="54" align="center"><?php  echo $year;?>-
			  <?php  echo $month;?>
			</td>
			<td align="center" class="num">
			  <?php  echo $row['Alias'];?>
			</td>
			<td align="center"><span class="num" style="color:red;">
			  <?php  echo $row['JiuQian'];?>
			</span></td>
			<td align="center"><span class="num"><?php  echo $row['Account'];?></span></td>
			<td align="center"><?php   echo $row['CreatTime'];?></td>
			<td align="center">
             <div id="jsddm" style=" margin-top:3px;"><a title="删除" href="member_save.php?action=del2_tuijian&id=<?php echo $row['id']; ?>&year=<?php echo $year;?>&month=<?php echo $month;?>&commercial=<?php echo $commercial;?>&recommand=<?php echo $recommand;?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
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
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"> <input type="button" class="back" value="返回" onclick="history.go(-1);" /> <span class="pageSmall">
			<?php echo $dopage->GetList(); ?>
			</span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}?>
<div class="formSubBtn" style="text-align:left; margin-left:50px; margin-top:20px;">
<input type="button" class="back" value="返回" onclick="history.go(-1);" />
	</div>
</body>
</html>