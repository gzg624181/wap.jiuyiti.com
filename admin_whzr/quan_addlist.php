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
 var account=document.getElementById("account").value;  //会员账号
 //拿到select 对象
 var myselect =document.getElementById("name");
 //拿到选中的索引
 var index = myselect.selectedIndex    //selectedIndex代表的是你所选中项的index
 //拿到选中项options的value
 var commercial=myselect.options[index].value;  //商户账号
 var creatime=document.getElementById("CreatTime").value;  //添加时间
 var money=document.getElementById("money").value;    //购物券金额
 var action=document.getElementById("action").value;    //执行添加购物券程序
 var url="quan_save.php?account="+account+'&commercial='+commercial+'&creatime='+creatime+'&money='+money+'&action='+action;
 //alert(url);
 window.location.href=url;
 alert("添加购物券成功！")
 var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
 parent.layer.close(index);///关闭窗口	
	
}
function quan_addlist(s){
	//alert(s);
var ajax_url='quanlist_ajax.php?id='+s;
 //  alert(ajax_url);
	$.ajax({     
    url:ajax_url,     
    type:'get',  
	data: "data" ,  
	dataType:'html', 
    success:function(data){  
     document.getElementById("money").innerHTML  = data; 
    } ,
	error:function(){     
       alert('error');     
    }    
	});   
	
}

</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">商家店名：</td>
		  <td width="81%">
          <select class="input" style="width:288px;" onchange="quan_addlist(this.options[this.options.selectedIndex].value)" name="name" id="name">
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
			<td width="19%" height="40" align="right">购物券金额：</td>
			<td><select name="money" id="money" class="input"  style="width:286px;">
	      </select></td>
	    </tr>
		<tr>
			<td height="40" align="right">数量：</td>
			<td>
                <input name="num" type="text" class="input" id="num" value="1" readonly="readonly" /></td>
		</tr>
      
  </table>
	<div class="formSubBtn" style="float:left; margin-left:95px;">
        <a style="cursor:pointer" onclick="return quan();"><input type="submit" class="submit" value="添加" /></a>
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="quan_addlist" />
        <input type="hidden" name="account" id="account" value="<?php echo $account;?>" />
        <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d h:i:s");?>" />
  </div>
</body>
</html>