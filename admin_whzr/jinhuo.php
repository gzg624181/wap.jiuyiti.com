<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家进货列表</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
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
</script>
</head>
<body>
<?php
//初始化参数
$Commercial = isset($Commercial) ? $Commercial : '';
?>
<div class="topToolbar"> <span class="title">商家库存：</span> <a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="7%" height="36" align="center">商品图片</td>
			<td width="25%" align="left">商品名称</td>
			<td width="7%" align="center">商品现价</td>
			<td width="12%" align="center">所属城市</td>
			<td width="12%" align="center">进货数量</td>
			<td width="11%" align="center">所属账号</td>
			<td width="10%" align="center">是否需要预约</td>
		  <td width="16%" align="center">添加时间</td>
		</tr>
		<?php
	$one=1;
	$dosql->Execute("SELECT * FROM `stock_record` where name='$Commercial'",$one);
	$nums=$dosql->GetTotalRow($one);
	if($nums!=0){
	$sum_num=0;
	$dosql->Execute("SELECT * FROM `stock_record` a inner join commodity b on a.pid=b.Id where a.name='$Commercial'");	
	$num=$dosql->GetTotalRow();
		while($row = $dosql->GetArray())
		{
			if(is_array($row)){
			$NUM[]=$row['num']; 
			}
			switch($row['yuyue']){
				
				case '0':
					$yuyue= "<i class='fa fa-times' aria-hidden='true'></i>";
					break;  
				case '1':
					$yuyue= "<i class='fa fa-check' aria-hidden='true'></i>";
					break;
				default:
                    $yuyue = '暂无分类';
				
				}
		?>
		<tr align="left" class="dataTr">
			<td height="70" align="center"><div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
   <input type="hidden" id="Id" value="<?php echo $row['Id'];?>" />
     <img  width="100px" height="65px" layer-src="../<?php echo $row['Images']; ?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="../<?php echo $row['Images']; ?>" alt="<?php echo $row['Title']; ?>" />
       </div></td>
			<td align="center"><?php echo $row['Title']; ?></td>
			<td align="center"><span class="num"><?php echo $row['NewPrice']; ?></span></td>
			<td align="center"><?php echo $row['live_prov']; ?><?php echo $row['live_city']; ?></td>
			<td align="center"><span class="num"><?php echo $row['num']; ?></span></td>
			<td align="center"><?php echo $row['UserName']; ?></td>
			<td align="center"><?php echo $yuyue;?></td>
			<td align="center"><?php echo $row['add_time']; ?></td>
		</tr>
		<?php
		}}
		?>
	</table>
</form>
<?php

//判断无记录样式
if($nums == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<?php if($nums!=0){ ?>
<div class="bottomToolbar"> 
<span style="text-align:right; display:block">
商家目前库存：<a class="num" style="color:red;"><?php 
		//商品的总价格
        foreach($NUM as $val){
	    $sum_num += $val;	
         }  
		    echo $sum_num;
		 ?></a>件
</span>
</div>
<
<?php
//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea">
        <a onclick="return fun('<?php echo $Commercial; ?>');" style="cursor:pointer" class="dataBtn">确认选择</a>
      </div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}}
?>
</body>
</html>