<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增购物券</title>
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
	if($("#name").val() == -1)
	{
		alert("请选择商家！");
		$("#name").focus();
		return false;
	}
	
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
function bao(s){
	//alert(s);
var ajax_url='address_ajax.php?id='+s;
   //alert(ajax_url);
	$.ajax({     
    url:ajax_url,     
    type:'get',  
	data: "data" ,  
	dataType:'html', 
    success:function(data){  
     document.getElementById("address").value = data; 
    } ,
	error:function(){     
       alert('error');     
    }    
	});   
	
}

</script>
</head>
<body>
<div class="formHeader"> <span class="title">添加购物券</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="quan_save.php" onsubmit="return quan();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">商家店名：</td>
		  <td>
          <select class="input" style="width:288px;" onchange="bao(this.options[this.options.selectedIndex].value)" name="name" id="name">
          <option value="-1">请选择商家</option>
          <option value="0">通用优惠券</option>
          <?php
		$dosql->Execute("SELECT * FROM `commercialuser`");
		while($row = $dosql->GetArray())
		{
		?>
	<option value="<?php echo $row['Id'];?>"><?php echo $row['CommercialName'];?></option>
      <?php
		}
		?>
	      </select></td>
    </tr>
	<tr>
			<td width="9%" height="40" align="right">商家地址：</td>
			<td><input type="text" name="address" id="address" readonly="readonly" class="input"/></td>
	    </tr>
		<tr>
			<td height="40" align="right">商家logo：</td>
			<td valign="middle">
            <input type="text" name="picurl" id="picurl" class="input" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
				<input type="checkbox" name="rempic" id="rempic" value="true" />
				远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span> </span>
           </td>
	  </tr>
		
		<tr>
			<td height="40" align="right">是否启用：</td>
			<td><label>
		    <input type="radio" name="play" value="1" checked="checked" id="play"/>
		    是</label>
&nbsp;&nbsp;
<label>
            <input name="play" type="radio" id="play" value="0"   />
  否</label>
&nbsp;&nbsp;</td>
			<td>
          </td>
		</tr>
      
  </table>
	<div class="formSubBtn" style="float:left; margin-left:95px;">
         <input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="add" />
       <input type="hidden" name="date" id="date" value="<?php echo date("Y-m-d");?>" />
        <input type="hidden" name="usetime" id="usetime" value="<?php echo date("Y-m-d h:i:s");?>" />
  </div>
</form>
</body>
</html>