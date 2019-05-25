<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>选择接收人</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
//男，女，搜索
  function checkinfo(key){
     var v= key;
	// alert(v)
	window.location.href='shanghu.php?check='+v;
	}
//标题搜索
   function GetSearchs(){
	 var keyword= document.getElementById("keyword").value;
	if($("#keyword").val() == "")
	{
		alert("请输入搜索内容！");
		$("#keyword").focus();
		return false;
	}
  window.location.href='shanghu.php?keyword='+keyword;
}
 function sel(Account){
	 alert(Account);
 }
function fun(){
    obj = document.getElementsByName("checkid[]");
    check_val = [];
    for(k in obj){
        if(obj[k].checked)
            check_val.push(obj[k].value);
    }
	alert("选中的接收人为："+check_val);
	parent.$('#Account').val(check_val);
	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    parent.layer.close(index);//关闭窗口
}
	

</script>


<?php
//初始化参数
$action  = isset($action)  ? $action  : ''; 
$keyword = isset($keyword) ? $keyword : '';
$check = isset($check) ? $check : '';
?>
</head>
<body>
<div class="toolbarTab">
	<ul>
 <li class="<?php if($check==""){echo "on";}?>"><a href="shanghu.php">全部</a></li> <li class="line">-</li> 
 <li class="<?php if($check=="man"){echo "on";}?>"><a title="男" href="javascript:;" onclick="checkinfo('man')"><i class="fa fa-male" aria-hidden="true"></i></a></li> <li class="line">-</li> 
 <li class="<?php if($check=="woman"){echo "on";}?>"><a title="女" href="javascript:;" onclick="checkinfo('woman')"><i class="fa fa-female" aria-hidden="true"></i></a></li>
	</ul>
	<div id="search" class="search"> <span class="s">
<input name="keyword" id="keyword" type="text" class="number" style="font-size:11px;" placeholder="请输入用户账号或者昵称" title="请输入用户账号或者昵称" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>
<form name="form" id="form" method="post" action="member_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="3%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="11%" align="left">商户账号</td>
			<td width="12%" align="center">商户名称</td>
			<td width="29%" align="center">商户地址</td>
			<td width="7%" align="center">联系人</td>
			<td width="24%" align="center">设备码</td>
			<td width="9%" align="center">酒钱</td>
			<td width="5%" align="center">操作</td>
		</tr>
		<?php
		if($check=="man"){
		$dosql->Execute("SELECT * FROM `commercialuser` where sex='男'");	
			}elseif($check=="woman"){
		$dosql->Execute("SELECT * FROM `commercialuser` where sex='女'");		
	     	}elseif($keyword!=""){
		$dosql->Execute("SELECT * FROM `commercialuser` where Commercial like '%$keyword%' or CommercialName  like '%$keyword%' ");		
				}else{
		$dosql->Execute("SELECT * FROM `commercialuser`");
				}
		while($row = $dosql->GetArray())
		{
			
		?>
		<tr align="left" class="dataTr">
			<td height="40" align="center">
            <?php
			if($row['clientid']!=""){
			?>
            <input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['clientid']; ?>" />
            <?php }?>
            </td>
			<td align="left"><span style="text-align:center"><?php echo $row['Commercial']; ?></span></td>
			<td align="center"><?php echo $row['CommercialName']; ?></td>
			<td align="center"><?php echo $row['CommercialSite']; ?></td>
			<td align="center"><?php echo $row['Linkman']; ?></td>
			<td align="center"><?php echo $row['clientid']; ?></td>
			<td align="center" class="num" style="color:red;"><span class="num" style="color:red;">
			  <?php if($row['JiuQian']==""){echo 0;}else{ echo $row['JiuQian'];} ?>
			</span></td>
			<td align="center">
            <?php
			if($row['clientid']!=""){
			?>
            <div id="jsddm" style="cursor:pointer"><a style="width:60px;" onclick="return fun();">确认选择</a>
            </div>
            <?php }?>
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
<div class="bottomToolbar">
<span class="selArea">
<span>选择：</span> 
<a href="javascript:CheckAll(true);">全部</a> 
- <a href="javascript:CheckAll(false);">无</a>
- <a style="cursor:pointer" onclick="return fun();">确认选择</a>
</span></div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea">
        <span class="selArea"><span>选择：</span> 
        <a href="javascript:CheckAll(true);">全部</a> -
        <a href="javascript:CheckAll(false);">无</a> - 
        <a style="cursor:pointer"  onclick="return fun();">确认选择</a></span> 
</div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>