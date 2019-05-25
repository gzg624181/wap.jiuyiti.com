<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家快递订单详情</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/getuploadify.js"></script>
<script type="text/javascript" src="templates/js/checkf.func.js"></script>
<script type="text/javascript" src="templates/js/getjcrop.js"></script>
<script type="text/javascript" src="templates/js/getinfosrc.js"></script>
<script type="text/javascript" src="plugin/colorpicker/colorpicker.js"></script>
<script type="text/javascript" src="plugin/calendar/calendar.js"></script>
<script type="text/javascript" src="editor/kindeditor-min.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link rel="stylesheet" href="http://res.layui.com/layui/dist/css/layui.css"  media="all">
<script src="http://res.layui.com/layui/dist/layui.js" charset="utf-8"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
function quan() { 


if($("#sjkd_exp").val() == -1)
	{
		alert("请选择快递！");
		$("#sjkd_exp").focus();
		return false;
	}
	
if($("#sjkd_number").val() == "")
	{
		alert("请输入快递单号！");
		$("#sjkd_number").focus();
		return false;
	}
}
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
<div class="topToolbar"> <span class="title" style="margin-left: 14px;">商家快递单详情</span> <a title="刷新" href="javascript:location.reload();" class="reload"></a></div>
<?php
$s=$dosql->GetOne("select * from commercialuser where CommercialSite='$address'");
$r=$dosql->GetOne("select * from orderform where OrderId='$orderid' ");
$sjkd_state=$r['sjkd_state'];
$orderid=$r['OrderId'];
if(is_array($s)){
?>
<?php
if($sjkd_state==0){
?>
<form name="form" id="form" method="post" action="order_save.php" onsubmit="return quan();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="center">收货人：</td>
		  <td width="74%"><?php echo $s['Linkman'];?></td>
    </tr>
	<tr>
			<td width="26%" height="40" align="center">联系电话：</td>
			<td><?php echo $s['Phone'];?></td>
	</tr>
		<tr>
		  <td height="40" align="center">收货地址：</td>
		  <td><?php echo $s['CommercialSite'];?></td>
    </tr>
    <?php
	$sum_price=0;
	$jiuqian_price=0;
	$sjsum_price=0;
	$dosql->Execute("SELECT *,a.CreatTime FROM ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
	while($row=$dosql->GetArray()){
		if(is_array($row)){
		$price[]=$row['Quantity']*$row['NewPrice']; 
		$jiuqian[]=$row['Quantity']*$row['JiuQian']; 
		$sjjiuqian[]=$row['Quantity']*$row['SJJiuQian'];
		?>
	<tr>    </tr>
</table>
<span style="text-align: center" rowspan="2" align="center"></span>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
  <tr>
    <td width="26%" rowspan="2" align="center">
    <div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
    <img layer-src="../<?php echo $row['Images']; ?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="../<?php echo $row['Images']; ?>" alt="<?php echo $row['Title']; ?>" width="100px" /></div></td>
    <td width="74%" height="42"><?php  echo $row['Title'];?></td>
  </tr>
  <tr>
    <td height="43"><?php  echo $row['NewPrice'];?>元，
      <?php  echo $row['Quantity'];?>件</td>
  </tr>
  <?php
		}}
		?>
  <tr>
    <td height="40" align="center">客户下单时间：</td>
    <td><?php  echo $r['CreatTime']; ?></td>
  </tr>
  <tr>
    <td height="40" align="center">客户预约提货时间：</td>
    <td><?php  echo $r['time']; ?></td>
  </tr>
  <tr>
    <td height="40" align="center">商品合计：</td>
    <td>¥      <span class="num" style="color:red;"><?php 
		//商品的总价格
        foreach($price as $val){
	    $jiuqian_price += $val;	
         }  
		    echo $jiuqian_price;
		 ?></span>元</td>
  </tr>
  
  <tr>
    <td height="40" align="center">请选择快递：</td>
    <td><select name="sjkd_exp" id="sjkd_exp" class="input"  style="width:285px;">
      <option value="-1">请选择快递</option>
      <option value="中通快递">中通快递</option>
      <option value="韵达快递">韵达快递</option>
      </select></td>
  </tr>
  <tr>
    <td height="40" align="center">快递单号：</td>
    <td><input type="text" name="sjkd_number" id="sjkd_number"  class="input"/></td>
  </tr>
  
  
</table>
	<div class="formSubBtn" style="float:left; margin-left: 187px;margin-top: 9px;">
      <input style="width:230px;height: 34px;line-height: 30px;" class="layui-btn layui-btn-normal"  onclick="{if(confirm('确认要发送快递吗?')){this.document.formname.submit();return true;}return false;}" type="submit" value="确认发送快递,寄件短信" />
		
        <input type="hidden" name="action" id="action" value="sjkd_state" />
        <input type="hidden" name="orderid" id="orderid" value="<?php echo $orderid;?>" />
        <input type="hidden" name="address" id="address" value="<?php echo $address;?>" />
        <input type="hidden" name="alias" id="alias" value="<?php echo $s['Linkman'];?>" />
        <input type="hidden" name="creattime" id="creattime" value="<?php   echo $r['time']; ?>" />
        <input type="hidden" name="sjkd_phone" id="sjkd_phone" value="<?php echo $s['Phone'];?>" />
  </div>
</form>
<?php }else{ ?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="center">收货人：</td>
		  <td width="75%"><?php echo $s['Linkman'];?></td>
    </tr>
	<tr>
			<td width="25%" height="40" align="center">联系电话：</td>
			<td><?php echo $s['Phone'];?></td>
	</tr>
		<tr>
		  <td height="40" align="center">收货地址：</td>
		  <td><?php echo $s['CommercialSite'];?></td>
    </tr>
    <?php
	$sum_price=0;
	$jiuqian_price=0;
	$sjsum_price=0;
	$dosql->Execute("SELECT *,a.CreatTime FROM ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
	while($row=$dosql->GetArray()){
		if(is_array($row)){
		$price[]=$row['Quantity']*$row['NewPrice']; 
		$jiuqian[]=$row['Quantity']*$row['JiuQian']; 
		$sjjiuqian[]=$row['Quantity']*$row['SJJiuQian'];
		?>
	<tr>    </tr>
</table>
<span style="text-align: center" rowspan="2" align="center"></span>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
  <tr>
    <td width="26%" rowspan="2" align="center">
    <div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
    <img layer-src="../<?php echo $row['Images']; ?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="../<?php echo $row['Images']; ?>" alt="<?php echo $row['Title']; ?>" width="100px" /></div></td>
    <td width="74%" height="42"><?php  echo $row['Title'];?></td>
  </tr>
  <tr>
    <td height="43"><?php  echo $row['NewPrice'];?>元，
      <?php  echo $row['Quantity'];?>件</td>
  </tr>
  <?php
		}}
		?>
  <tr>
    <td height="40" align="center">客户下单时间：</td>
    <td><?php  echo $r['CreatTime']; ?></td>
  </tr>
  <tr>
    <td height="40" align="center">客户预约提货时间：</td>
    <td><?php  echo $r['time']; ?></td>
  </tr>
  <tr>
    <td height="40" align="center">商品合计：</td>
    <td>¥      <span class="num" style="color:red;"><?php 
		//商品的总价格
        foreach($price as $val){
	    $jiuqian_price += $val;	
         }  
		    echo $jiuqian_price;
		 ?></span>元</td>
  </tr>
		<tr>
		  <td height="40" align="center">快递名称：</td>
		  <td><?php echo $r['sjkd_exp'];?></td>
  </tr>
		<tr>
		  <td height="40" align="center">快递单号：</td>
		  <td><?php echo $r['sjkd_number'];?>  &nbsp;&nbsp;&nbsp;<a  target="_blank" href="https://www.kuaidi100.com/">快递查询</a></td>
  </tr>
		
      
</table>
	<div class="formSubBtn" style="float:left; margin-left: 187px;margin-top: 9px;">
     <input  style="width:117px;height: 34px;line-height: 30px;" class="layui-btn layui-btn-normal" type="submit" value="查看物流信息" />
	<input type="button" style="height: 34px;line-height: 30px;" class="layui-btn layui-btn-normal" value="发件短信已发" />
  </div>
<?php 
}}else{
  echo "&nbsp;&nbsp;&nbsp;&nbsp;<font color='red'><B>订单预约地址未选择或订单待付款！</b></font>";
}?>
</body>
</html>