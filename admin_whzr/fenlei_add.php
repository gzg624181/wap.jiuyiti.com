<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); 
$page = empty($page) ? 1 : intval($page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增分类来源</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="layer/layer.js"></script>
<script type="text/javascript">

function fun(){
	if($("#fenlei").val()==""){
		alert("添加内容不能为空！");
		this.focus;
		return false;
		}	
	
  var  obj = document.getElementById("fenlei").value;
  var  actions = document.getElementById("actions").value;
  var url="member_save.php?action="+actions+'&fenlei='+obj;

    window.location.href=url;
	alert("商品分类添加成功！")
	//var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
   // parent.layer.close(index);///关闭窗口
}

function conf_del(id,action){
  var url="member_save.php?action="+action+'&id='+id;
    window.location.href=url;
	alert("删除成功！")
//	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
//    parent.layer.close(index);///关闭窗口
}
function conf_update(id,action){
	//alert(id);
  var fenlei=$("#fenlei"+id).val();
  //alert(fenlei);
  var url="member_save.php?id="+id+"&fenlei="+fenlei+"&action="+action;
    window.location.href=url;
//	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
//    parent.layer.close(index);///关闭窗口
}
function conf_play(id,play){
    var ajax_url="fenlei_ajax.php?play="+play+'&id='+id;
    window.location.href=ajax_url;
//	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
//    parent.layer.close(index);///关闭窗口
}
</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td width="20%" height="40" align="center">来源：</td>
		  <td width="17%"><input type="text" name="fenlei" id="fenlei" style="width:280px;" class="input"/></td>
		  <td align="center"><div class="formSubBtn" style="text-align:center; margin-top:0px;">
		    <a style="cursor:pointer" onclick="return fun();"><input type="submit" class="submit" style="height:32px;" value="确&nbsp;定" /></a>
            <input type="hidden" name="actions" id="actions" value="fenlei_add" />
	      </div></td>
        </tr>
  </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="dataTable">
		<tr>
		  <td height="40" align="center">I D</td>
		  <td width="74%" align="center">商家分类</td>
		  <td width="17%" align="center">操作</td>
    </tr>
    <?php
    $pagesize=5;
	$tbname = '#@__fenlei';
	$dopage->GetPage("SELECT * FROM $tbname",$pagesize);	
	$i=0;
		while($i<$dosql->GetTotalRow())
		{
	     $row = $dosql->GetArray();
		 $i++;
		 $play=$row['play'];
	?>
		  <tr align="center" class="dataTr">
		  <td width="9%" height="40" align="center"><?php echo $i+($page-1)*$pagesize ;?></td>
		  <td align="center"><input type="text" style="border: 0px solid;text-align: center;width:90%;" name="fenlei" id="fenlei<?php echo $row['id'];?>" class="input" value="<?php echo $row['fenlei'] ?>" /></td>
	 <td align="center">
     <span>
     <?php
     if($play==1){
	 ?>
    <a title="显示" onclick="return conf_play('<?php echo $row['id'];?>','<?php echo $play;?>')" style="cursor:pointer">
     <i id="play" class="fa fa-eye" aria-hidden="true"></i></a>
     <?php }else{?>
    <a title="隐藏" onclick="return conf_play('<?php echo $row['id'];?>','<?php echo $play;?>')" style="cursor:pointer">
     <i id="play" class="fa fa-eye-slash" aria-hidden="true"></i></a>
     <?php  }?>
     </span> &nbsp;&nbsp;
     <span><a title="编辑" onclick="return conf_update('<?php echo $row['id'];?>','fenlei_update')" style="cursor:pointer"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></span> &nbsp;&nbsp;
     <span class="nb"><a style="cursor:pointer" title="删除" onclick="return conf_del('<?php echo $row['id'];?>','del4')"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span>
     </td>
  </tr>
    <?php }?>
    <?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>

</table>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
</body>
</html>