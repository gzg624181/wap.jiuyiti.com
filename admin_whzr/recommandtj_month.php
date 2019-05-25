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
$one=1;
$dosql->Execute("SELECT * FROM `#@__active` where year='$year' and month='$month' and daima='0'",$one);
$num=$dosql->GetTotalRow($one);
?>
<div class="topToolbar"> <span class="title">合计统计商户：<span class="num" style="color:#F0F"><?php echo $num;?></span></span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="number_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
        <td width="1%" height="36" align="center">
        <input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);">
        </td>
		<td width="4%" height="36" align="center">推荐日期</td>
		  <td width="19%" align="center">商户账号</td>
		  <td width="23%" align="center">商户名称</td>
		  <td width="22%" align="center">联系电话</td>
		  <td width="18%" align="center">推荐人数</td>
		  <td width="10%" align="center">&nbsp;</td>
		  <td width="3%" align="center">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT b.CommercialName,b.Commercial,a.num,a.recommand,b.Phone,a.id,a.checkplay FROM `#@__active` a inner join commercialuser b on a.recommand=b.Recommand and a.year='$year' and a.month='$month' and a.daima='0'",10,'asc');
		while($row = $dosql->GetArray())
		{
		?>
		<tr align="left" class="dataTr">
        <td align="center">
        <?php if($row['checkplay']==0) {?>
        <input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" />
        <?php }?>
        </td>
			<td height="54" align="center"><?php  echo $year;?>-
			  <?php  echo $month;?>
			</td>
			<td align="center" class="num">
			  <?php  echo $row['Commercial'];?>
			</td>
			<td align="center"><span class="num">
			  <?php  echo $row['CommercialName'];?>
			</span></td>
			<td align="center"><span class="num">
		    <?php  echo $row['Phone'];?></span></td>
			<td align="center"><span class="num" style="color:red;">
			  <?php   echo $row['num'];?>
			</span></td>
			<td align="center"><span class="num" style="color:#06F">
			  <?php if($row['checkplay']==1){echo "已发放";}?>
			</span></td>
			<td align="center">
            <div id="jsddm"><a title="查看详情"  href="recommandtj_xiangqing.php?year=<?php echo $year; ?>&month=<?php echo $month; ?>&commercial=<?php  echo $row['Commercial'];?>"><i class="fa fa-clone"></i></a></div>
             <?php if($row['checkplay']==0) {?>
            <div id="jsddm"><a title="发放推荐奖励" href="member_save.php?action=sendnone&id=<?php echo $row['id'];?>" onclick="return ConfSend(0);"><i class="fa fa-star-o" aria-hidden="true"></i></a></div>
            <?php }?>

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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> 
 -<a href="javascript:SendAllNone('member_save.php');" onclick="return ConfSend(0);">发放推荐奖励</a>
</span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><input type="button" class="back" value="返回" onclick="history.go(-1);" /> <span class="pageSmall">
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