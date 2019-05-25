<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('member'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改会员</title>
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
function cfm_up()
{

	if($("#Password").val() != $("#RePassword").val())
	{
        alert ("两次输入的密码不相同！");
        $("#RePassword").focus();
        return false;
    }
}

</script>
<script type="text/javascript">
var xmlHttp;

function xmlhttprequest(){
	if(window.ActiveXObject){
		xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
	}
	else if(window.XMLHttpRequest){
		xmlHttp = new XMLHttpRequest();
	}
	else{
		alert('您的浏览器不支持Ajax技术！');
	}
}

</script>
</head>
<body>
<?php
$row = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Id='$id'");
if($row['Image']==""){
			$Image="../templates/default/images/noimage.jpg";
		}else{
      if(strpos($row['Image'],'uploads') !== false){
      $Image="../".$row['Image'];
      }else{
     $Image=$row['Image'];
      }
      }
$adminlevel=$_SESSION['adminlevel'];
?>
<div class="formHeader"> <span class="title">修改会员</span> <a href="javascript:location.reload();" class="reload">刷新</a> </div>
<form name="form" id="form" method="post" action="member_save.php" onsubmit="return cfm_up();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
			<td width="25%" height="40" align="right">账　号：</td>
			<td width="75%"><strong><?php echo $row['Account']; ?></strong></td>
		</tr>
		<!--<tr>
			<td height="40" align="right">密　码：</td>
			<td><input name="Password" type="password" id="Password" class="input" />
				<span class="maroon">*</span><span class="cnote">若不修改密码请留空</span></td>
		</tr>
		<tr>
			<td height="40" align="right">确　认： </td>
			<td><input name="RePassword" type="password" id="RePassword" class="input" />
				<span class="maroon">*</span></td>
		</tr>-->
		<tr>
			<td height="40" align="right">姓　名：</td>
			<td><input name="UserName" type="text" class="input" id="UserName" value="<?php echo $row['UserName']; ?>" /></td>
		</tr>
		<tr class="nb">
			<td height="40" align="right">手机号：</td>
			<td><input type="text" name="Phone" id="Phone" class="input" value="<?php echo $row['Phone']; ?>" /></td>
		</tr>
		<tr>
			<td height="40" align="right">昵　称：</td>
			<td><input type="text" name="Alias" id="Alias" class="input" value="<?php echo $row['Alias']; ?>" /></td>
		</tr>
		<tr>
			<td height="40" align="right">年　龄：</td>
			<td><input type="text" name="Age" id="Age" class="input" value="<?php echo $row['Age']; ?>" /></td>
		</tr>
		<tr>
			<td height="143" align="right">头　像：</td>
			<td><div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
   <input type="hidden" id="Id" value="<?php echo $row['Id'];?>" />
     <img  width="100px;" layer-src="<?php echo $Image;?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="<?php echo $Image;?>" alt="<?php echo $row['Image']; ?>" />
       </div>
				<div class="hr_10"></div>
				<input type="text" name="picurl" id="picurl" class="input" value="<?php echo $row['Image'];?>" />
                <span class="cnote"><span class="grayBtn" onclick="GetUploadify('uploadify','缩略图上传','image','image',1,<?php echo $cfg_max_file_size; ?>,'picurl')">上 传</span> <span class="rePicTxt">
                <input type="checkbox" name="rempic" id="rempic" value="true" />
远程</span> <span class="cutPicTxt"><a href="javascript:;" onclick="GetJcrop('jcrop','picurl');return false;">裁剪</a></span></span></td>
		</tr>
		<tr>
			<td height="40" align="right">性　别：</td>
			<td><input name="Sex" type="radio" value="男" <?php if($row['Sex'] == '男') echo 'checked="checked"'; ?> />
				男&nbsp;
				<input name="Sex" type="radio" value="女" <?php if($row['Sex'] == '女') echo 'checked="checked"'; ?> />
				女</td>
		</tr>
		<tr>
			<td height="40" align="right">身份证号：</td>
			<td><input type="text" name="IdNumber" id="IdNumber" class="input"  value="<?php echo $row['IdNumber']; ?>"  /></td>
		</tr>
        <?php
		if($adminlevel==1){
		?>
		<tr>
			<td height="40" align="right">酒钱数：</td>
			<td><input type="text" name="JiuQian" id="JiuQian" class="input"  value="<?php echo $row['JiuQian']; ?>"  /></td>
		</tr>
        <?php }?>
	</table>
	<div class="formSubBtn">
		<input type="submit" class="submit" value="提交" />
		<input type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="update" />
    <input type="hidden" name="randtjm" id="randtjm" value="<?php echo $row['Recommand']; ?>" />
		<input type="hidden" name="id" id="id" value="<?php echo $row['Id']; ?>" />
  </div>
</form>
</body>
</html>
