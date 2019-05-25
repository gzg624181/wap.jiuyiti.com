<?php require_once(dirname(__FILE__).'/inc/config.product.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商户活动详情</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">商户活动详情</span> <a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<?php
$r=$dosql->GetOne("SELECT * FROM `#@__activelist` where id='$id'");
?>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="right">
			<td width="11%" height="40">活动标题：</td>
			<td width="89%" style="padding:6px;" align="left"><?php echo $r['title'];?></td>
		</tr>
		
		<tr align="right">
		  <td height="40">活动代码：</td>
		  <td align="left" style="padding:6px;"><?php echo $r['daima'];?></td>
	  </tr>
		<tr align="right">
		  <td height="40">活动起始时间：</td>
		  <td align="left" style="padding:6px;"><?php echo $r['firsttime'];?></td>
	  </tr>
		<tr align="right" >
		  <td height="40">活动结束时间：</td>
		  <td align="left" style="padding:6px;"><?php echo $r['endtime'];?></td>
	  </tr>
		<tr align="right">
		  <td height="40" >活动简介：</td>
		  <td align="left" style="line-height:30px; padding:6px;"><?php echo $r['introduction'];?></td>
	  </tr>
		<tr align="right" >
		  <td height="40">活动内容：</td>
		  <td align="left" style="line-height:30px; padding:10px; border-radius:5px;"><?php echo $r['content'];?></td>
	  </tr>
		<tr align="right" >
		  <td height="40" >活动协议:</td>
		  <td align="left" style="line-height:30px; padding:6px;"><?php echo $r['xieyi'];?></td>
	  </tr>
		<tr align="right" >
			<td height="40">是否开启：</td>
			<td align="left"  style="padding:6px;"><?php 
			$play= $r['play'];
			if($play==1){
				echo "<font color='#0066FF'><b>开启</b></font>";
				}else{
				echo "<font color='#FF0000'><b>不开启</b></font>";	
					}
			?></td>
		</tr>

	</table>
</form>

</body>
</html>