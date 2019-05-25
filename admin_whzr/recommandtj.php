<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>推荐活动统计</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">推荐统计列表</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<?php if($daima==1){ ?>
<form name="form" id="form" method="post" action="number_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center">&nbsp;</td>
		  <td width="30%" align="center">推荐年份</td>
		  <td width="32%" align="center">合计推荐人数</td>
		  <td width="34%" align="center">&nbsp;</td>
		  <td width="3%" align="center">操作</td>
		</tr>
		<?php
		$num=0;
		$year=date("Y");
		$dosql->Execute("SELECT *,count(distinct year), sum(num) as sumnumber from `#@__active` where year='$year'  group by year order by year asc");
		while($row = $dosql->GetArray())
		{
		?>
		<tr align="left" class="dataTr">
			<td height="54" align="center">&nbsp;</td>
			<td align="center"><?php  echo $row['year'];?></td>
			<td align="center"><?php   echo $row['sumnumber'];?></td>
			<td align="center">&nbsp;</td>
			<td align="center">
            <div id="jsddm"><a title="查看详情"  href="recommandtj_year.php?year=<?php echo $row['year']; ?>"><i class="fa fa-folder-open"></i></a></div>
           </td>
		</tr>
		<?php
		}
		?>
	</table>
</form>
<?php }elseif($daima==2){?>
<div class="dataEmpty">暂时没有相关的记录</div>
<?php }?>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="formSubBtn" style="text-align:left; margin-left:50px; margin-top:20px;">
<input type="button" class="back" value="返回" onclick="history.go(-1);" />
	</div>
</body>
</html>
