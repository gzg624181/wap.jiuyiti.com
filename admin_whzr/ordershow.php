<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>活动管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<script>
function message(Id){
  // alert(Id);
   layer.ready(function(){ //为了layer.ext.js加载完毕再执行
   layer.photos({
    photos: '#layer-photos-demo_'+Id,
	//area:['500px','300px'],  //图片的宽度和高度
    shift: 0 ,//0-6的选择，指定弹出图片动画类型，默认随机
	closeBtn:1,
	offset:'40px',  //离上方的距离
	shadeClose:false
  });
});
}
</script>
</head>
<body>
<div class="topToolbar" style="margin-bottom: 0px;"> <span class="title">订单详情</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="promotion_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="8%" height="36" align="center">商品图片</td>
			<td width="24%">商品名称</td>
			<td width="22%">商品现价</td>
			<td width="22%">商品原价</td>
			<td width="14%">商品件数</td>
			<td width="10%" align="center">下单时间</td>
		</tr>
		<?php
	$sum_price=0;
	$jiuqian_price=0;
	$sjsum_price=0;
	$dosql->Execute("SELECT *,a.CreatTime FROM ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$OrderId'");
	while($row=$dosql->GetArray()){
		if(is_array($row)){
		$price[]=$row['Quantity']*$row['NewPrice'];
		$jiuqian[]=$row['Quantity']*$row['JiuQian'];
		$sjjiuqian[]=$row['Quantity']*$row['SJJiuQian'];
		?>
		<tr align="center" class="dataTr">
			<td height="101" align="center">
            <div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
            <img layer-src="../<?php echo $row['Images']; ?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="../<?php echo $row['Images']; ?>" alt="<?php echo $row['Title']; ?>" width="100px" />
            </div>
            </td>
			<td><?php  echo $row['Title'];?></td>
			<td><?php  echo $row['NewPrice'];?></td>
			<td><?php  echo $row['OldPrice'];?></td>
			<td><?php  echo $row['Quantity'];?></td>
			<td align="center"><?php  echo $row['CreatTime']; ?></td>
		</tr>
		<?php
		}}
		?>
        <tr align="right" class="head">
			<td width="8%" height="36" align="right">&nbsp;</td>
			<td width="24%">&nbsp;</td>
			<td width="22%">&nbsp;</td>
			<td width="22%">&nbsp;</td>
			<td colspan="2" style="text-align:right;">商品合计金额：
			<span class="num" style="color:red;">¥      <?php
		//商品的总价格
        foreach($price as $val){
	    $jiuqian_price += $val;
         }
		    echo $jiuqian_price;
		 ?></span>&nbsp;&nbsp;</td>
		</tr>
        <tr align="left" class="head">
			<td width="8%" height="36" align="center">&nbsp;</td>
			<td width="24%">&nbsp;</td>
			<td width="22%">&nbsp;</td>
			<td width="22%">&nbsp;</td>
			<td colspan="2" style="text-align:right;">赠送会员酒钱：
			<span class="num" style="color:red;">¥      <?php
		//商品的总价格
        foreach($jiuqian as $val){
	    $sum_price += $val;
         }
		    echo $sum_price;
		 ?></span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
        <tr align="left" class="head">
			<td width="8%" height="36" align="center">&nbsp;</td>
			<td width="24%">&nbsp;</td>
			<td width="22%">&nbsp;</td>
			<td width="22%">&nbsp;</td>
			<td colspan="2" style="text-align:right;">赠送商家酒钱：
			<span class="num" style="color:red;">¥      <?php
		//商品的总价格
        foreach($sjjiuqian as $val){
	    $sjsum_price += $val;
         }
		    echo $sjsum_price;
		 ?></span>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</table>
</form>
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
