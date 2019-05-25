<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>评论管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
function message(id){
 //  alert(Id);
   layer.ready(function(){ //为了layer.ext.js加载完毕再执行
   layer.photos({
    photos: '#layer-photos-demo_'+id,
	//area:['500px','300px'],  //图片的宽度和高度
    shift: 0 ,//0-6的选择，指定弹出图片动画类型，默认随机
	closeBtn:1,
	offset:'40px',  //离上方的距离
	shadeClose:true
  });
});  
}

</script>
</head>
<body>
<div class="topToolbar"> <span class="title">所有评论</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="comment_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr class="head">
			<td width="1%" height="31" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="22%" align="center">banner图片</td>
			<td width="40%">名称</td>
			<td width="34%">链接地址</td>
			<td width="3%">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `#@__banner`",15);
		while($row = $dosql->GetArray())
		{

		?>
		<tr class="dataTr">
			<td height="93" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php  echo $row['id']; ?>" /></td>
			<td align="center" valign="middle"> <div id="layer-photos-demo_<?php echo $row['id'];?>" class="layer-photos-demo">
     <img  width="100px" height="65px" layer-src="../<?php echo $row['lnkico']; ?>" style="cursor:pointer" onclick="message('<?php echo $row['id']; ?>');"  src="../<?php echo $row['lnkico']; ?>" alt="<?php echo $row['lnkname']; ?>" />
       </div></td>
            <td align="center"><?php  echo $row['lnkname'];?></td>
			<td align="center"><?php  echo $row['lnklink'];?></td>
			<td align="center">
             <div id="jsddm"><a title="编辑" href="business_banner_update.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o fa-lg fa-fw" aria-hidden="true"></i></a></div>
             
            <div id="jsddm"><a title="删除" href="business_banner_save.php?action=del2&id=<?php echo $row['id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-lg fa-fw" aria-hidden="true"></i></a></div>
            
            </td>
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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('business_banner_save.php');" onclick="return ConfDelAll(0);">删除</a></span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
</body>
</html>