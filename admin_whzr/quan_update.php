<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改购物券</title>
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

<script>
function quan()
{

	
	if($("#money").val() == "")
	{
		alert("购物券金额不能为空！");
		$("#money").focus();
		return false;
	}
	
	if($("#date").val() == "")
	{
		alert("购物券有效期不能为空！");
		$("#date").focus();
		return false;
	}
}
</script>
</head>
<body>
<div class="formHeader"> <span class="title">修改购物券</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<?php
$show = $dosql->GetOne("SELECT * FROM `coupons` a inner join `commercialuser` b on a.Commodityid=b.Id WHERE a.id='$id'");
$type=$show['type'];
?>
<form name="form" id="form" method="post" action="quan_save.php" onsubmit="return quan();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">商家店名：</td>
		  <td colspan="2">
          <input type="text" name="name" id="name" readonly="readonly" value="<?php echo $show['CommercialName'];?>" class="input"/></td>
    </tr>
		<tr>
		  <td height="40" align="right">商家地址：</td>
		  <td colspan="2"><input type="text" name="address" readonly="readonly" id="address" value="<?php echo $show['CommercialSite'];?>" class="input"/></td>
    </tr>
		<tr>
		  <td height="40" align="right">金额：</td>
          <?php
		  if($type==2){?>
	<td colspan="2"><input type="text" name="money" id="money" value="<?php echo $show['money'];?>" class="input"/>
    （系统自定义购物券，可修改）
       <?php }else{?>
          <td width="18%" colspan="2"><input type="text" name="money" readonly="readonly" id="money" value="<?php echo $show['money'];?>" class="input"/> （系统默认购物券，不可修改）   
         <?php }?>
			  
</td>
    </tr>
		<tr>
			<td width="10%" height="40" align="right">消费额度：</td>
			<td colspan="2"><input type="text" name="fanwei" readonly="readonly"  id="fanwei" value="<?php echo $show['fanwei'];?>" class="input"/></td>
		</tr>
		<tr>
			<td height="40" align="right">商家logo：</td>
			<td colspan="2" valign="middle">
            <div id="layer-photos-demo" class="layer-photos-demo">
     <img  width="100px;" style="padding:5px; border-radius:8px;cursor:pointer" layer-src="../<?php echo $show['logo']; ?>"  src="../<?php echo $show['logo']; ?>" />
       </div>
            <input type="text" name="picurl" id="picurl" class="input" value="<?php echo $show['logo']; ?>" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span></span>
           </td>
	  </tr>
      <tr>
      <td height="40" align="right">排列排序：</td>
      <td width="71%"><input style="width:140px;" type="text" name="orderid" id="orderid" class="inputos" value="<?php echo $show['orderid']; ?>" /></td>
    </tr>
		<tr>
			<td height="40" align="right">是否启用：</td>
			<td colspan="2">
            <?php
			if($show['play']==1){
			?>
            <label>
		    <input type="radio" name="play" value="1" <?php if($show['play']==1){echo "checked='checked'";}?> id="play"/>
		    是</label>
&nbsp;&nbsp;
            <?php }else{?>
<label>
            <input name="play" type="radio" id="play" <?php if($show['play']==0){echo "checked='checked'";}?> value="0"   />
  否</label>
         <?php }?>
&nbsp;&nbsp;</td>
		</tr>
      
  </table>
	<div class="formSubBtn" style="float:left; margin-left:35px;">
         <input style="border-radius:2px;" type="submit" class="submit" value="提交" />
		<input style="border-radius:2px;" type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update" />
        <input type="hidden" name="id" id="id" value="<?php echo $show['id']; ?>" />
         <input type="hidden" name="usetime" id="usetime" value="<?php echo date("Y-m-d h:i:s");?>" />
        <input type="hidden" name="type" id="type" value="<?php echo $type; ?>" />
      <input type="hidden" name="gid" id="gid" value="<?php echo $show['Commodityid']; ?>" />
      <input type="hidden" name="Commercial" id="Commercial" value="<?php echo $show['Commercial']; ?>" />
  </div>
</form>
</body>
</html>