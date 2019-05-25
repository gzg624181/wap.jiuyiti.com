<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增商户</title>
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
function cfm_member(){
	if($("#username").val()==-1){
		alert("请选择商户区域代理！");
		this.focus;
		return false;
		}

	if($("#fenlei").val()==-1){
		alert("请选择商品分类！");
		this.focus;
		return false;
		}
}
function business()
{
  // alert(Commercial);
  layer.open({
  type: 2,
  title: '<span style="color:#000"><b>新增商家分类</b></span>',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['488px' , '445px'],
  content: 'fenlei_add.php',
  });

}
</script>
</head>
<body>
<div class="formHeader"> <span class="title">添加商户</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="business_save.php" onsubmit="return cfm_member()">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">商户账号：</td>
		  <td colspan="5"><input type="text" name="Commercial" id="Commercial" class="input"/></td>
    </tr>
		<tr>
			<td width="7%" height="40" align="right">账号密码：</td>
			<td colspan="5"><input type="text" name="PassWord" id="PassWord" class="input"/></td>
		</tr>
		<tr>
			<td height="40" align="right">商户图片：</td>
			<td colspan="5" valign="middle">
            <input type="text" name="picurl" id="picurl" class="input" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
				<input type="checkbox" name="rempic" id="rempic" value="true" />
				远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span> </span>
           </td>
	  </tr>
		<tr>
			<td height="40" align="right">商户名称：</td>
			<td width="32%"><input type="text" name="CommercialName" id="CommercialName" class="input"/></td>
			<td width="6%" align="right">联系人：</td>
			<td colspan="3"><input name="Linkman" type="text" class="input" id="Linkman" /></td>
		</tr>
		<tr>
		  <td height="40" align="right">商户地址：</td>
		  <td><input type="text" name="CommercialSite" id="CommercialSite" class="input" /></td>
		  <td align="right"> 联系电话：</td>
		  <td colspan="3"><input type="text"  name="Phone" id="Phone" class="input" />
		  <div id="pro" style="font-size:12px; color:#ffa8a8;display:inline;"></div></td>
	  </tr>
		<tr>
		  <td height="40" align="right">地图定位 经度：</td>
		  <td><input type="text" name="Lng" id="Lng" class="input"/></td>
		  <td align="right">地图定位 纬度：</td>
		  <td colspan="3"><input type="text" name="Lat" id="Lat" class="input"/>
		  （<a target="_blank" href="http://api.map.baidu.com/lbsapi/getpoint/index.html">百度地图坐标拾取系统</a>）</td>
    </tr>
		<tr>
		  <td height="40" align="right">账号酒钱：</td>
		  <td><input type="text" name="JiuQian" id="JiuQian" class="input"/></td>
		  <td align="right">商户昵称：</td>
		  <td width="32%"><input type="text" name="NickName" id="NickName" class="input"/></td>
		  <td width="3%" align="right">性别：</td>
		  <td width="20%"><div id="fenlei2" style="font-size:12px; color:#ffa8a8;display:inline;">
		    <span style="text-align: left"></span>
		    <span style="text-align: left"></span>
		    <select name="sex" class="input" id="sex" style="width:46px;">
		      <option value="男">男</option>
		      <option value="女">女</option>
	        </select>
		  </div></td>
    </tr>
    <tr>
		  <td height="40" align="right">排列排序：</td>
		  <td><input type="text" name="orderid" id="orderid" class="input" value="<?php echo GetOrderID('commercialuser'); ?>" /></td>
		  <td align="right">是否上线：</td>
		  <td><span style="font-size:12px; color:#ffa8a8;display:inline;">
		    <select name="online" class="input" id="online"  style="width:46px;">
		      <option  value="1">是</option>
		      <option  value="0">否</option>
	      </select>
	  （是否在地图上面显示店铺）</span></td>
		  <td align="right">&nbsp;</td>
		  <td>&nbsp;</td>
    </tr>
      <tr>
          <td height="40" align="right">商户所属代理：</td>
          <td><select name="username" id="username" class="input"  style="width:285px;">
            <option value="-1">请选择商户区域代理</option>
            <?php
		$dosql->Execute("SELECT * FROM `#@__admin`");
		while($row = $dosql->GetArray())
		{
			switch($row['levelname']){
				case 1:
				$levelname="超级管理员";
				break;
				case 2:
				$levelname="城市管理员";
				break;
				case 4:
				$levelname="区域管理员";
				break;
				}
		?>
		    <option value="<?php echo $row['username'];?>"><?php echo $row['username'];?>（<?php echo $row['live_prov'];?><?php echo $row['live_city'];?> ： <?php echo $row['nickname'];?>,<?php echo $levelname;?>）</option>
		   <?php }?>
        </select></td>
          <td align="right">商家分类：</td>
          <td><select name="fenlei" id="fenlei" class="input"  style="width:285px;">
            <option value="-1">请选择商家分类</option>
            <?php
		$dosql->Execute("SELECT * FROM `#@__fenlei`");
		while($row = $dosql->GetArray())
		{
		?>
            <option value="<?php echo $row['fenlei'];?>"><?php echo $row['fenlei'];?></option>
            <?php }?>
          </select>
            &nbsp;&nbsp;&nbsp;<a style="cursor:pointer;" onclick="business();"><font color="#CCCCCC">新增分类</font></td>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
    </tr>
      
  </table>
	<div class="formSubBtn" style="float:left; margin-left:35px;">
         <input type="submit" class="submit" value="保存" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="add" />
        <input type="hidden" name="Id" id="Id" value="<?php echo getrandomstring(20);?>" />
        <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d h:i:s");?>" />
  </div>
</form>
</body>
</html>