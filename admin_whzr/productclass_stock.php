<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/getuploadify.js"></script>
<script type="text/javascript" src="templates/js/checkf.func.js"></script>
<script type="text/javascript" src="templates/js/getjcrop.js"></script>
<script type="text/javascript" src="templates/js/getinfosrc.js"></script>
<script type="text/javascript" src="plugin/colorpicker/colorpicker.js"></script>
<script type="text/javascript" src="plugin/calendar/calendar.js"></script>
<script type="text/javascript" src="editor/kindeditor-min.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
<script type="text/javascript" src="templates/js/ajax.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<script>
function tock(){
	 var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){
	if($("#Stock").val() == "")
	{
	 alert("商品库存数量不能为空！");
		$("#Stock").focus();
		return false;
	}
if($("#Warn").val()==""){
	alert("商品预警数量不能为空！");
	$("#Warn").focus();
	return false;
	}
parent.location.reload(); // 父页面刷新
var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
parent.layer.close(index); //再执行关闭层
  }else{
        alert("亲，您还没有操作本模块的权限，请联系超级管理员！");  
        $("#Warn").focus();
		return false;	
	  }
}
function tock_add(){
var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){	
if($("#newadd").val() == "")
	{
	 alert("新增库存不能为空！");
		$("#Stock").focus();
		return false;
	}
parent.location.reload(); // 父页面刷新
var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
parent.layer.close(index); //再执行关闭层
  }else{
        alert("亲，您还没有操作本模块的权限，请联系超级管理员！");  
        $("#Warn").focus();
		return false;	  
	  }
	}
</script>
</head>
<body>
<?php
$adminlevel=$_SESSION['adminlevel'];
?>
<input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $adminlevel;?>" />
<?php
$row = $dosql->GetOne("SELECT * FROM `commoditystock` WHERE `id`='$id'");
if($row['Stock']==NULL){
?>
<form name="form" id="form" method="post" action="productclass_save.php" onsubmit="return tock();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td width="25%" height="40" align="right">设置商品库存：</td>
		  <td width="75%"><input type="text" name="Stock" id="Stock" class="input"/></td>
    </tr>
        <tr>
		  <td width="25%" height="40" align="right">设置商品预警：</td>
		  <td width="75%"><input type="text" name="Warn" id="Warn" class="input"/></td>
    </tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:65px; margin-top:10px;">
        <input style="border-radius:3px;" type="submit" class="submit" value="添加" />(添加完毕之后，请刷新页面！)
		<input type="hidden" name="action" id="action" value="update_new" />
        <input type="hidden" name="Commercial" id="Commercial" value="<?php echo $row['CommercialUser'];?>" />
        <input type="hidden" name="CommodityId" id="CommodityId" value="<?php echo $row['CommodityId'];?>" />
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
  </div>
</form>
<?php }else{ ?>
<form name="form" id="form" method="post" action="productclass_save.php" onsubmit="return tock_add();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td width="25%" height="40" align="right">商品库存：</td>
		  <td width="75%"><input type="text" name="Stock" id="Stock" class="input" readonly="readonly" value="<?php  echo $row['Stock']; ?>"/></td>
    </tr>
    <tr>
		  <td width="25%" height="40" align="right">新增库存：</td> 
		  <td width="75%"><input type="text" name="newadd" id="newadd" class="input" /></td>
    </tr>
        <tr>
		  <td width="25%" height="40" align="right">设置商品预警：</td>
		  <td width="75%"><input type="text" name="Warn" id="Warn" class="input" value="<?php  echo $row['Warn']; ?>"/></td>
    </tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:35px; margin-top:10px;">
        <input style="border-radius:3px;" type="submit" class="submit" value="修改" />(修改完毕之后，请刷新页面！)
		<input type="hidden" name="action" id="action" value="update_old" />
        <input type="hidden" name="Commercial" id="Commercial" value="<?php echo $row['CommercialUser'];?>" />
        <input type="hidden" name="CommodityId" id="CommodityId" value="<?php echo $row['CommodityId'];?>" />
        <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
  </div>
</form>
<?php }?>
</body>
</html>