<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>未付订单</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script>
//男，女，搜索
  function checkinfo(key){
     var v= key;
	// alert(v)
	window.location.href='allorder.php?check='+v;
	}
//标题搜索
   function GetSearchs(){
	 var keyword= document.getElementById("keyword").value;
	if($("#keyword").val() == "")
	{
		alert("请输入搜索内容！");
		$("#keyword").focus();
		return false;
	}
  window.location.href='allorder.php?keyword='+keyword;
}
</script>


<?php
//初始化参数
$action  = isset($action)  ? $action  : '';
$keyword = isset($keyword) ? $keyword : '';
$check = isset($check) ? $check : '';
?>
</head>
<body>
<div class="topToolbar"> <span class="title">所有订单</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="order_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="2%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="15%" align="left">订单号</td>
			<td width="9%" align="center">商户</td>
		  <td width="15%">商品名称</td>
			<td width="5%">是否需要发票</td>
			<td width="8%" align="center">下单人</td>
		  <td width="10%">手机</td>
			<td width="10%">付款状态</td>
			<td width="10%">订单状态</td>
			<td width="10%" align="center">下单时间</td>
			<td width="6%" align="left">操作</td>
		</tr>
		<?php
		    if($keyword!=""){
		    $dopage->GetPage("SELECT * FROM `orderform` where UserName like '%$keyword%'",15);		
			        }else{
			 $dopage->GetPage("SELECT * FROM `orderform` where PaymentType is Null",15);				 
						 }
		while($row = $dosql->GetArray())
		   {
			switch($row['PaymentType'])
			{
				case '':
				$PaymentType="<font color='#FF0000'><B>".'未付'."</b></font>";
				break;
			}
			switch($row['Invoice'])
			{
				case '1':
				$Invoice="<font color='#FF0000'><B>".'YES'."</b></font>";
				break;
				
				case '';
				$Invoice="<font color='#339933'><B>".'NO'."</b></font>";
				break;
	
			}
			switch($row['State'])
			{
				case 1:
				$State="<font color='#339933'><B>".'待提取'."</b></font>";
				break;
				
				case 2;
				$State="<font color='#6699FF'><B>".'换购单'."</b></font>";
				break;
	        
				case 3;
				$State="待付款";
				break;
				
				case 4;
				$State="已退款";
				break;
				
				case 5;
				$State="<font color='#FF0000'><B>".'已提取'."</b></font>";
				break;
			}
		?>
		<tr align="left" class="dataTr">
			<td height="40" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td align="left"><?php echo $row['OrderId']; ?></td>
			<td align="center"><?php echo $row['Commercial']; ?></td>
		  <td>2222</td>
			<td align="center"><?php echo $Invoice; ?></td>
		  <td align="center"><?php
			 $UserId= $row['UserId']; 
			 $rows = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$UserId'");
			 if(!empty($rows))
			 echo $rows['UserName'];
			 ?></td>
		  <td><?php  if(!empty($rows)) echo $rows['Phone']; ?></td>
			<td><?php echo $PaymentType; ?></td>
			<td><?php echo $State; ?></td>
			<td align="center"><?php echo $row['CreatTime']; ?></td>
		  <td align="center">
          <div id="jsddm"><a href="ordershow.php?OrderId=<?php echo $row['OrderId'];?>&CreatTime=<?php echo $row['CreatTime'];?>">订单详情</a></div>
          <div id="jsddm"><a href="order_save.php?action=del2&id=<?php echo $row['Id']; ?>" onclick="return ConfDel(0);">删除</a></div></td>
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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('member_save.php');" onclick="return ConfDelAll(0);">删除</a></span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('member_save.php');" onclick="return ConfDelAll(0);">删除</a></span> <span class="pageSmall"> <?php echo $dopage->GetList(); ?> </span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>