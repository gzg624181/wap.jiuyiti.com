<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>已报名商户列表</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">活动时间：<?php echo $firsttime;?>--<?php echo $endtime;?></span> <a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="7%" align="center">商户账号</td>
			<td width="6%" align="left">商户名称</td>
			<td width="19%" align="left">商户地址</td>
			<td width="7%" align="center">推荐码</td>
			<td width="9%" align="center">商户推荐人数</td>
			<td width="9%" align="center">商家支付金额</td>
			<td width="11%" align="center">支付类型</td>
			<td width="11%" align="center">支付状态</td>
			<td width="15%" align="center">报名时间</td>
			<td colspan="2" align="center">操作</td>
		</tr>
		<?php

		$dopage->GetPage("SELECT * FROM `pmw_signup` where daima='1'",8);	
		while($row = $dosql->GetArray())
		{
		$zhanghu=$row['zhanghu'];
		$recommand=trim($row['recommand']);
		?>
		<tr align="left" class="dataTr">
			<td height="51" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
			<td align="center"><?php echo $zhanghu; ?></td>
			<td align="center">
            <?php
			$s=$dosql->GetOne("SELECT * FROM `commercialuser` where recommand='$recommand'");
			if(is_array($s)){
			echo $s['CommercialName'];
			}
			?>
            </td>
			<td align="center"><?php if(is_array($s)){ echo $s['CommercialSite'];}?></td>
			<td align="center"><?php echo $recommand; ?></td>
			<td align="center" class="num"><?php 
			$k=$dosql->GetOne("SELECT * FROM `pmw_active` where recommand='$recommand' and daima='1'");
			if(is_array($k)){
			 echo $k['num']; 
			}else{
			 echo 0;	
				}
			?></td>
			<td align="center"><?php echo $row['money']; ?></td>
			<td align="center"><span id="sj_<?php echo $row['id']; ?>">
			<?php 
			if($row['type']=='0'){
			echo "<font color='#339933'><B>"."酒钱支付"."</b></font>";
			}elseif($row['type']=='1'){
			echo "<font color='#993333'><B>"."支付宝支付"."</b></font>";
			}elseif($row['type']=='2'){
			echo "<font color='#6600CC'><B>"."微信支付"."</b></font>";
			}
			?></span></td>
			<td align="center"><?php 
			if($row['pay']=='0'){
			echo "<font color='#FF0000'><B>"."支付失败"."</b></font>";
			}elseif($row['pay']=='1'){
			echo "<font color='#0066FF'><B>"."支付成功"."</b></font>";
			}
			?></td>
			<td align="center"><span class="number"><?php echo $row['baomingtime']; ?></span></td>
			<td width="3%" align="center">
            <div id="jsddm"><a title="删除" href="active_save.php?action=del4&id=<?php echo $row['id']; ?>&daima=<?php echo $row['daima'];?>&firsttime=<?php echo $firsttime;?>&endtime=<?php echo $endtime;?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-lg fa-fw" aria-hidden="true"></i></a></div></td>
			<td width="2%" align="center">
             <div id="jsddm"><a title="查看推荐会员列表" href="recommand_huiyuanlist.php?recommand=<?php echo $recommand; ?>&daima=<?php echo $row['daima'];?>&firsttime=<?php echo $firsttime;?>&endtime=<?php echo $endtime;?>"><i class="fa fa-align-justify"></i></a></div>
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
<div class="bottomToolbar">  
<a href="javascript:history.back();"style="cursor:pointer"  class="dataBtn">返回</a> 
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
</div>
<?php
//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea">
  <a href="javascript:history.back();"style="cursor:pointer"  class="dataBtn">返回</a> 
        </div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>