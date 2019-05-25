<?php require_once(dirname(__FILE__).'/inc/config.huiyuan.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家推荐会员列表</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">推荐类型：</span><span class="num" style="color:red;">
<a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>

<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td height="36" align="center">会员账号</td>
			<td width="18%" align="left">昵称</td>
			<td width="20%" align="center">酒钱余额</td>
			<td width="23%" align="center">登陆设备</td>
		  <td width="21%" align="center">注册时间</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$recommand' and a.type=1 and rec_time>='$firsttime' and rec_time<='$endtime'",6);	
		
		$num=$dosql->GetTotalRow();
		while($row = $dosql->GetArray())
		{
			switch($row['devicetype'])
			{
				case '1':
					$devicetype = '小程序';
					break;  
				case '0':
					$devicetype = 'Android';
					break;
                                                   
			}
		?>
		<tr align="left" class="dataTr">
			<td height="70" align="center"><?php echo $row['account']; ?></td>
			<td align="center"><?php echo $row['Alias']; ?></td>
			<td align="center"><?php echo $row['JiuQian']; ?></td>
			<td align="center"><?php echo $devicetype; ?></td>
			<td align="center"><span class="number"><?php echo $row['rec_time']; ?></span>
            </td>
		</tr>
		<?php
		}
		?>
	</table>
</form>
<?php
if($dosql->GetTotalRow() != 0){ ?>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php }?>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="bottomToolbar"> 
<span style="text-align:right; display:block">
会员合计获取的酒钱：<a class="num" style="color:red;"><?php $dosql->Execute("SELECT * FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$recommand' and a.type=1 and rec_time>='$firsttime' and rec_time<='$endtime'");
echo $dosql->GetTotalRow();?></a>元
</span>
</div>




</body>
</html>