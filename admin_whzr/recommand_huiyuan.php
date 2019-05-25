<?php require_once(dirname(__FILE__).'/inc/config.huiyuan.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员推荐列表</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
//初始化参数
$Commercial = isset($Commercial) ? $Commercial : '';
$adminlevel=$_SESSION['adminlevel'];
?>
<div class="topToolbar"> <span class="title">推荐类型：</span><span class="num" style="color:red;">
<?php if($classes==1){echo "商户";}else{echo "会员";}
echo "&nbsp;&nbsp;&nbsp;";
echo $Account;
echo "&nbsp;&nbsp;&nbsp;";
echo $Recommand;
?>
<a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<?php
if($classes==0){
?>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="15%" height="36" align="center">会员账号</td>
			<td width="14%" align="left">昵称</td>
			<td width="22%" align="center">酒钱余额</td>
			<td width="22%" align="center">登陆设备</td>
			<td width="19%" align="center">注册时间</td>
		  <td width="8%" align="center">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$Recommand' and a.type=0",6);	
		
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
			<td align="center"><span class="number"><?php echo $row['rec_time']; ?></span></td>
			 <?php
			if($adminlevel==1){
				?>
			<td align="center"><a  title="删除" href="member_save.php?action=hytjlb_del&id=<?php echo $row['id']; ?>&Account=<?php echo $row['Account'];?>&Recommand=<?php echo $row['tjm'];?>&classes=<?php echo $row['type'];?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
            <?php }?>
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
会员合计获取的酒钱：<a class="num" style="color:red;"><?php $dosql->Execute("SELECT * FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$Recommand' and a.type=0");
echo $dosql->GetTotalRow();?></a>元
</span>
</div>
<?php }else{ ?>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="15%" height="36" align="center">会员账号</td>
			<td width="14%" align="left">昵称</td>
			<td width="22%" align="center">酒钱余额</td>
			<td width="22%" align="center">登陆设备</td>
			<td width="19%" align="center">注册时间</td>
		  <td width="8%" align="center">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$Recommand' and a.type=1",6);	
		
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
			<td align="center"><span class="number"><?php echo $row['rec_time']; ?></span></td>
			<td align="center"><a  title="删除" href="member_save.php?action=hytjlb_del&id=<?php echo $row['id']; ?>&Account=<?php echo $row['Account'];?>&Recommand=<?php echo $row['tjm'];?>&classes=<?php echo $row['type'];?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
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
会员合计获取的酒钱：<a class="num" style="color:red;"><?php
$dosql->Execute("SELECT * FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$Recommand' and a.type=1");
echo $dosql->GetTotalRow();?></a>元
</span>
</div>
<?php }?>
</body>
</html>