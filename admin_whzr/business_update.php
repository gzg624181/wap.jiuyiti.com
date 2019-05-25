<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改用户信息</title>
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
function message(Id){
 //  alert(Id);
   layer.ready(function(){ //为了layer.ext.js加载完毕再执行
   layer.photos({
    photos: '#layer-photos-demo_'+Id,
	//area:['500px','300px'],  //图片的宽度和高度
    shift: 0 ,//0-6的选择，指定弹出图片动画类型，默认随机
	closeBtn:1,
	offset:'40px',  //离上方的距离
	shadeClose:true
  });
});
}
function business_update(){
 var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel!=1){
	  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
	  $("#username").focus();
	 return false;
  }
	}
</script>
</head>
<body>

<div class="formHeader"> <span class="title">修改商户信息</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<?php
$row = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE `Id`='$id'");
$username=$row['username'];
if($row['CommercialImg']==""){
			$CommercialImg="../uploads/image/20170605/1496658299.png";
		}else{
			$CommercialImg="../".$row['CommercialImg'];
			}
?>
<form name="form" id="form" method="post" action="business_save.php" onsubmit="return business_update();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">商户账号：</td>
		  <td colspan="5"><input type="text" name="Commercial" readonly="readonly" id="Commercial" class="input" value="<?php echo $row['Commercial']; ?>"/></td>
    </tr>
		<tr>
			<td width="6%" height="40" align="right">账号密码：</td>
			<td colspan="5"><input type="password" name="PassWord"  id="PassWord" class="input"/></td>
		</tr>
		<tr>
			<td height="40" align="right">商户图片：</td>
			<td colspan="5" valign="middle">
            <div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo" style="margin:10px;">
   <input type="hidden" id="Id" value="<?php echo $row['Id'];?>" />
     <img  width="100px;" layer-src="<?php echo $CommercialImg;?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="<?php echo $CommercialImg;?>" alt="<?php echo $row['CommercialName']; ?>" />
       </div>
            <input type="text" name="picurl" id="picurl" class="input" value="<?php echo $row['CommercialImg'];?>" />
				<span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
				<input type="checkbox" name="rempic" id="rempic" value="true" />
				远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span> </span>
           </td>
	  </tr>
		<tr>
			<td height="40" align="right">商户名称：</td>
			<td width="19%"><input type="text" name="CommercialName" id="CommercialName" class="input"  value="<?php echo $row['CommercialName']; ?>"/></td>
			<td width="6%" align="right">联系人：</td>
			<td colspan="3"><input name="Linkman" type="text" class="input" id="Linkman" value="<?php echo $row['Linkman']; ?>" /></td>
		</tr>
		<tr>
		  <td height="40" align="right">商户地址：</td>
		  <td><input type="text" name="CommercialSite" id="CommercialSite" class="input" value="<?php echo $row['CommercialSite']; ?>" /></td>
		  <td align="right"> 联系电话：</td>
		  <td colspan="3"><input type="text"  name="Phone" id="Phone" class="input" value="<?php echo $row['Phone']; ?>" />
		  <div id="pro" style="font-size:12px; color:#ffa8a8;display:inline;"></div></td>
	  </tr>
		<tr>
		  <td height="40" align="right">地图定位 经度：</td>
		  <td><input type="text" name="Lng" id="Lng" class="input" value="<?php echo $row['Lng']; ?>"/></td>
		  <td align="right">地图定位 纬度：</td>
		  <td colspan="3"><input type="text" name="Lat" id="Lat" class="input" value="<?php echo $row['Lat']; ?>"/></td>
    </tr>

		<tr>
		  <td height="40" align="right">账号酒钱：</td>
		  <td><input type="text" name="JiuQian" id="JiuQian" class="input" value="<?php echo $row['JiuQian']; ?>"/></td>
		  <td align="right">商户昵称：</td>
		  <td width="18%"><input type="text" name="NickName" id="NickName" class="input" value="<?php echo $row['NickName']; ?>"/></td>
		  <td width="4%" align="right">性别：</td>
		  <td width="47%"><div id="fenlei2" style="font-size:12px; color:#ffa8a8;display:inline;">
		    <select name="sex" id="sex">
		      <option <?php if($row['Sex']=="男"){echo "selected='selected'";}?> value="男">男</option>
		      <option <?php if($row['Sex']=="女"){echo "selected='selected'";}?> value="女">女</option>
	        </select>
		  </div></td>
    </tr>
    <tr>
		  <td height="40" align="right">排列排序：</td>
		  <td><input type="text" name="orderid" id="orderid" class="inputos" value="<?php echo $row['orderid']; ?>" /></td>
		  <td align="right">是否上线：</td>
		  <td><span style="font-size:12px; color:#ffa8a8;display:inline;">
		    <select name="online" id="online">
		      <option <?php if($row['online']=="1"){echo "selected='selected'";}?> value="1">是</option>
		      <option <?php if($row['online']=="0"){echo "selected='selected'";}?> value="0">否</option>
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
		while($rows = $dosql->GetArray())
		{
			switch($rows['levelname']){
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
		    <option  <?php if($username==$rows['username']){echo "selected='selected'";}?> value="<?php echo $rows['username'];?>"><?php echo $rows['username'];?>（<?php echo $rows['live_prov'];?><?php echo $rows['live_city'];?> ： <?php echo $rows['nickname'];?>,<?php echo $levelname;?>）</option>
		   <?php }?>

	      </select></td>
          <td align="right">商品分类：</td>
          <td><select name="fenlei" id="fenlei" class="input"  style="width:285px;">
            <option value="-1">请选择商品分类</option>
            <?php
		$dosql->Execute("SELECT * FROM `#@__fenlei`");
		while($rows = $dosql->GetArray())
		{
		?>
            <option <?php if($row['fenlei']==$rows['fenlei']){echo "selected='selected'";}?> value="<?php echo $rows['fenlei'];?>"><?php echo $rows['fenlei'];?></option>
            <?php }?>
          </select></td>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
    </tr>
  </table>
	<div class="formSubBtn" style="float:left; margin-left:35px;">
         <input type="submit" class="submit" value="提交" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update" />
        <input type="hidden" name="id" id="id" value="<?php echo $row['Id'];?>" />
        <input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $_SESSION['adminlevel'];?>" />
        <input type="hidden" name="CreatTime" id="CreatTime" value="<?php echo date("Y-m-d h:i:s");?>" />
        <input type="hidden" name="recommand" id="recommand" value="<?php echo $row['Recommand'];?>" />
  </div>
</form>
</body>
</html>
