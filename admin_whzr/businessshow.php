<?php require_once(dirname(__FILE__).'/inc/config.product.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品信息管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<script>
function fu(id,ku_number){
//	alert(ku_number);
if(ku_number==1){
layer.open({
  type: 2,
  title: '修改商品库存,预警：',
  area: ['500px', '240px'],
  fixed: false, //不固定
  maxmin: true,
  offset:'200px',  //离上方的距离
  content: 'productclass_stock.php?id='+id,
}); 
}else if(ku_number==0){
layer.open({
  type: 2,
  title: '添加商品库存,预警：',
  area: ['500px', '200px'],
  fixed: false, //不固定
  maxmin: true,
  offset:'200px',  //离上方的距离
  content: 'productclass_stock.php?id='+id,
});		
}
}
function del_quanshow(){
 var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel!=1){
	  alert("亲，您还没有操作本模块的权限，请联系超级管理员！"); 	
  }
	}
</script>
<?php
$adminlevel=$_SESSION['adminlevel'];
?>
</head>
<body>
<?php
//初始化参数
$Commercial  = isset($Commercial)  ? $Commercial  : '';
?>
<input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $adminlevel;?>" />
<div class="topToolbar" style="text-align:center"> 
<span class="title"  style="text-align:left;">商品信息管理<font color="red" style="text-align:left;font-size:12px;"><b>（黄色背景显示商品达到预警库存）</b></font></span>
<a href="javascript:location.reload();" class="reload">刷新</a><font size="+1" style="margin-left:-200px;"><B><?php echo $name;?></B></font>
</div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="7%" height="36" align="center">图片</td>
			<td colspan="3" align="left">商品名称</td>
			<td width="10%" align="center">商品预警</td>
			<td width="11%" align="center">商品销量</td>
			<td width="11%" align="center">商品库存</td>
			<td width="6%" align="center">操作</td>
		</tr>
		<?php
		//select a.字段1,b.字段2 from 表a,表b where 表a.相同字段=表b.相同字段
	$dosql->Execute("SELECT * FROM commoditystock,commodity where commoditystock.CommodityId=commodity.Id and commoditystock.CommercialUser='$Commercial'");	
		while($show = $dosql->GetArray())
		{
		if(is_array($show)){
			if($show['Stock']==NULL){
				$ku_number=0;
				}else{
			    $ku_number=1;	
					}
		?>
		<tr align="left" class="<?php if($show['Warn']>$show['Stock']){echo "dataTrRed";}else{echo "dataTr";}?>">
			<td height="50" align="left" style="padding:5px;">
			  <img  width="100" height="65"  src="../<?php  echo $show['Images']; ?>"/>		    </td>
			<td width="34%" align="left"><?php  echo $show['Title']; ?></td>
			<td width="11%" align="center"><?php  echo $show['NewPrice']; ?></td>
			<td width="10%" align="center"><?php if($show['Warn']>$show['Stock']){echo "库存预警";}?></td>
			<td align="center"><?php  echo $show['Warn']; ?></td>
			<td align="center"><?php echo $show['salenum']; ?></td>
			<td align="center"><?php echo $show['Stock']; ?></td>
			<td align="center">
            <?php
			if($adminlevel==1){
			?>
              <div id="jsddm"><a style="cursor:pointer; width:86px;" href="businessshow_save.php?action=del2&id=<?php echo $show['id']; ?>&Commercial=<?php echo $show['CommercialUser'];?>&name=<?php echo $name;?>" onclick="return ConfDel(0);">删&nbsp;&nbsp;除</a></div>
           <?php  }else{?>
            <div id="jsddm"><a style="cursor:pointer; width:86px;" title="删除" onclick="return del_quanshow();">删&nbsp;&nbsp;除</a></div>
            <?php }?>
              
			  <div id="jsddm"><a style="cursor:pointer; width:86px;" onclick="return fu('<?php echo $show['id']; ?>','<?php echo $ku_number;?>');"><?php if($ku_number==1){echo "修改库存,预警";}else{echo "添加库存,预警";}?></a></div>
		    </td>
		</tr>
        <?php }else{
		echo '<div class="dataEmpty">暂时没有相关的记录</div>';	
			}
		?>
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
<div class="bottomToolbar"> <span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> </span>
 <a onclick="history.go(-1);" style="cursor:pointer" class="dataBtn">返回</a> 
 <a href="business.php?keyword=<?php echo $name;?>"  style="cursor:pointer; margin-right:5px;" class="dataBtn">返回添加商品类别</a>
 </div>
<?php
//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea">
         <a onclick="history.go(-1);"  style="cursor:pointer" class="dataBtn">返回</a> 
         <a href="business.php?keyword=<?php echo $name;?>"  style="cursor:pointer" class="dataBtn">返回添加商品类别</a> 
        <span class="pageSmall"><?php echo $dopage->GetList(); ?></span> 
        </div>
        
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>