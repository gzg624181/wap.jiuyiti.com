<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>购物券管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
function GetSearchs(){
	 var keyword= document.getElementById("keyword").value;
	if($("#keyword").val() == "")
	{
		alert("请输入搜索内容！");
		$("#keyword").focus();
		return false;
	}
  window.location.href='quan.php?keyword='+keyword;
}
</script>
<?php
$keyword = isset($keyword) ? $keyword : '';
?>
</head>
<body>
<div class="topToolbar"> 
  <p><span class="title">购物券列表</span> <a href="javascript:location.reload();" class="reload">刷新</a></p>
</div>
<div class="toolbarTab" style=" margin-bottom:0px;">
	<div id="search" class="search"> <span class="s">
<input name="keyword" id="keyword" type="text" class="number" placeholder="请输入商户账号/商户名称/商户地址/联系人进行搜索" title="请输入商户账号/商户名称/商户地址/联系人进行搜索" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>
<form name="form" id="form" method="post" action="promotion_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="9%" height="36" align="center">商家LOGO</td>
		  <td width="20%" align="center">商家名称</td>
		  <td width="7%" align="center">商家昵称</td>
		  <td width="20%" align="center">商家地址</td>
			<td width="11%" align="center">联系人</td>
			<td width="12%" align="center">联系电话</td>
			<td width="7%" align="center">是否上线</td>
			<td width="10%" align="center">加盟日期</td>
			<td width="4%" align="center">操作</td>
		</tr>
		<?php
if($keyword!=""){
		  $dopage->GetPage("SELECT * FROM `commercialuser` where Commercial like '%$keyword%' or CommercialName like '%$keyword%' or CommercialSite like '%$keyword%' or Linkman like '%$keyword%'",15);		
		  }else{
		$dopage->GetPage("SELECT * FROM commercialuser" ,15);
		  }
		while($row = $dosql->GetArray())
		{
			switch($row['online']){
			case 1:
			$online="<i class='fa fa-caret-square-o-up' aria-hidden='true'></i>";
			break;
			
			case 0:
			$online="<font color='red'><i class='fa fa-2x fa-caret-square-o-down' aria-hidden='true'></i></font>";
			break;
			}
		?>
		<tr align="left" class="dataTr">
			<td height="69" align="center"><img style="padding:5px; border-radius:8px;" src="../<?php echo $row['CommercialImg'];?>" width="120px" height="50px" /></td>
			<td align="center"><?php echo $row['CommercialName'];?></td>
			<td align="center"><?php echo $row['NickName'];?></td>
			<td align="center"><?php echo $row['CommercialSite'];?></td>
			<td align="center"><?php echo $row['Linkman'];?></td>
			<td align="center"><?php echo $row['Phone'];?></td>
			<td align="center"><?php echo $online;?></td>
			<td align="center"><?php echo $row['CreatTime'];?></td>
			<td align="center">
            <div id="jsddm"><a style="width: 20px;' title="购物券" href="quan_list.php?id=<?php echo $row['Id']; ?>"><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i></a></div>
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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('quan_save.php');" onclick="return ConfDelAll(0);">删除</a></span></div>
<div class="page"> <?php  echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('quan_save.php');" onclick="return ConfDelAll(0);">删除</a></span> <span class="pageSmall"> <?php echo $dopage->GetList(); ?> </span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>