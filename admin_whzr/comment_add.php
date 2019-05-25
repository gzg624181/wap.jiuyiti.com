<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加活动</title>
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
<script type="text/javascript" src="templates/js/getarea.js"></script>
<script>
//用户名检测
function CheckImage(orderid){

   var ajax_url='ajax_checkimage.php?orderid='+orderid;
   //alert(ajax_url);
	$.ajax({     
    url:ajax_url,     
    type:'get',  
	data: "data" ,  
	dataType:'html', 
    success:function(data){  
	var div1 = document.getElementById("checkimage");
       div1.style.display="";
     document.getElementById("checkimage").innerHTML = data; 
    } ,
	error:function(){     
       alert('error');     
    }    
	}); 
    }

</script>
</head>
<body>
<div class="formHeader"> <span class="title">添加评论</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="comment_save.php" onsubmit="return cfm_comments();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="7%" height="40" align="right">会员id：</td>
			<td colspan="10"><select name="userid" id="userid" class="input"  style="width:285px;">
            <option value="-1">请选择会员id</option>
            <?php
		$dosql->Execute("SELECT * FROM `memberuser`");
		while($row = $dosql->GetArray())
		{
		?>
            <option value="<?php echo $row['Account'];?>"><?php echo $row['Alias'];?></option>
            <?php }?>
          </select></td>
		</tr>
		<tr>
		  <td height="40" align="right">订单号：</td>
		  <td colspan="10"><select onchange="CheckImage(this.options[this.options.selectedIndex].value)" name="orderid" id="orderid" class="input"  style="width:285px;">
            <option value="-1">请选择评论订单号</option>
            <?php
		$dosql->Execute("SELECT * FROM `orderform` left join  `pmw_comment` on orderform.OrderId=pmw_comment.orderid where pmw_comment.orderid is null order by orderform.CreatTime desc");
		while($row = $dosql->GetArray())
		{
		?>
            <option value="<?php echo $row['OrderId'];?>"><?php echo $row['OrderId'];?></option>
            <?php }?>
          </select></td>
    </tr><!-- -->
        <tr style="display:none;" id="checkimage">
          <td height="64" align="right" >订单产品图片：</td>
          <td colspan="10"></td>
        </tr>
        <tr>
          <td height="64" align="right">评论内容：</td>
          <td colspan="10"><textarea style="width: 64.2%; height: 50px;" type="text" name="comment" id="comment" class="input"/></textarea></td>
        </tr>
        <tr>
		  <td height="64" align="right">回复内容：</td>
		  <td colspan="10"><textarea style="width: 64.2%; height: 50px;" type="text" name="recomment" id="recomment" class="input"/></textarea></td>
    </tr>

    <tr>
          <td height="40" align="right">是否审核：</td>
          <td width="18%"><label>
		      <input type="radio" name="status" value="1" id="status" checked="checked" />
		      是</label>
          &nbsp;&nbsp;
		    <label>
		      <input name="status" type="radio" id="status" value="0"  />
		      否</label>
           &nbsp;&nbsp;

		    （是否显示评论）</td>
          <td width="7%">&nbsp;</td>
          <td width="5%" align="right">&nbsp;</td>
          <td width="6%">&nbsp;</td>
          <td width="4%" align="right">&nbsp;</td>
          <td width="6%" id="hot">&nbsp;</td>
          <td align="right">&nbsp;</td>
          <td id="leixing">&nbsp;</td>
          <td width="4%" align="right">&nbsp;</td>
          <td width="6%"  id="countrys">&nbsp;</td>
    </tr>
    <tr>
      <td height="40" align="right">&nbsp;</td>
      <td><div class="formSubBtn" style="float:left; margin-left:1px; margin-bottom:20px;">
        <input type="submit" class="submit" value="添加" />
        <input type="button" class="back" value="返回" onclick="history.go(-1);" />
        <input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="timestamp" id="timestamp" value="<?php echo date("Y-m-d h:i:s");?>" />
      </div></td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td id="hot6">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td id="leixing6">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td  id="countrys6">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
