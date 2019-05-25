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
	window.location.href='selectmember.php?check='+v;
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
  window.location.href='selectmember.php?keyword='+keyword;
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
 <li class="<?php if($check==""){echo "on";}?>"><a href="selectmember.php">全部</a></li> <li class="line">-</li> 
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
			<td width="11%" align="left">用户账号</td>
			<td width="12%" align="center">姓名</td>
			<td width="13%" align="center">昵称</td>
			<td width="10%" align="center">性别</td>
			<td width="37%" align="center">设备码</td>
			<td width="9%" align="center">余额</td>
			<td width="5%" align="center">操作</td>
		</tr>
		<?php
		if($check=="man"){
		$dosql->Execute("SELECT * FROM `memberuser` where sex='男'");	
			}elseif($check=="woman"){
		$dosql->Execute("SELECT * FROM `memberuser` where sex='女'");		
	     	}elseif($keyword!=""){
		$dosql->Execute("SELECT * FROM `memberuser` where Account like '%$keyword%' or Alias  like '%$keyword%' ");		
				}else{
		$dosql->Execute("SELECT * FROM `memberuser`");
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
			<td align="left"><?php echo $row['Account']; ?></td>
			<td align="center"><?php echo $row['UserName']; ?></td>
			<td align="center"><?php echo $row['Alias']; ?></td>
			<td align="center"><?php echo $row['Sex']; ?></td>
			<td align="center"><?php echo $row['clientid']; ?></td>
			<td align="center" class="num" style="color:red;"><?php if($row['Balance']!=""){echo $row['Balance']; }else{echo 0;}?></td>
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