<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商家进货列表</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/getuploadify.js"></script>
<script type="text/javascript" src="templates/js/checkf.func.js"></script>
<script type="text/javascript" src="templates/js/getjcrop.js"></script>
<script type="text/javascript" src="templates/js/getinfosrc.js"></script>
<script type="text/javascript" src="plugin/colorpicker/colorpicker.js"></script>
<script type="text/javascript" src="plugin/calendar/calendar.js"></script>
<script type="text/javascript" src="editor/kindeditor-min.js"></script>
<script type="text/javascript" src="editor/lang/zh_CN.js"></script>
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
<div class="topToolbar"> <span class="title">商家自定义现金券：</span> <a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<?php
$s=$dosql->GetOne("select * from commercialuser where Commercial='$Commercial'");
$id=$s['Id']; //商户id
if($s['CommercialImg']==""){
			$CommercialImg="../uploads/image/20170605/1496658299.png";
		}else{
			$CommercialImg="../".$s['CommercialImg'];
			}
$dosql->Execute("select * from coupons where Commodityid='$id' and type=2");
$num=$dosql->GetTotalRow();
if($num==0){
?>
<form name="form" id="form" method="post" action="quan_save.php" onsubmit="return quan();">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="formTable">
		<tr>
		  <td height="40" align="right">商家店名：</td>
		  <td width="30%"><select class="input" style="width:288px;" onchange="bao(this.options[this.options.selectedIndex].value)" name="name" id="name">
		    <option value="<?php echo $s['Id'];?>"><?php echo $s['CommercialName'];?></option>
	      </select></td>
		  <td width="61%">&nbsp;</td>
    </tr>
	<tr>
			<td width="9%" height="40" align="right">商家地址：</td>
			<td><input type="text" name="address" id="address" value="<?php echo $s['CommercialSite'];?>" readonly="readonly" class="input"/></td>
			<td>&nbsp;</td>
    </tr>
		<tr>
			<td height="95" align="right">商家logo：</td>
			<td valign="middle" align="left"><div id="layer-photos-demo_<?php echo $s['Id'];?>" class="layer-photos-demo"> <img  width="120" height="80" layer-src="<?php echo $CommercialImg;?>" style="cursor:pointer" onclick="message('<?php echo $s['Id']; ?>');"  src="<?php echo $CommercialImg;?>" alt="<?php echo $s['CommercialName']; ?>" /> </div></td>
			<td valign="middle" align="left">&nbsp;</td>
    </tr>
		<tr>
			<td height="40" align="right">是否启用：</td>
			<td><label>
		    <input type="radio" name="play" value="1"  id="play"/>
		    是</label>
&nbsp;&nbsp;
<label>
            <input name="play" type="radio" id="play" checked="checked" value="0"   />
  否</label>
&nbsp;&nbsp;</td>
			<td>
          </td>
		</tr>
      
  </table>
	<div class="formSubBtn" style="float:left; margin-left:80px;">
        <input style="border-radius:2px;" type="submit" class="submit" value="提交" />
		<input style="border-radius:2px;" type="button" class="back" value="返回" onclick="history.go(-1);" />
		<input type="hidden" name="action" id="action" value="xianjin_add" />
        <input type="hidden" name="date" id="date" value="<?php echo date("Y-m-d");?>" />
        <input type="hidden" name="usetime" id="usetime" value="<?php echo date("Y-m-d h:i:s");?>" />
        <input type="hidden" name="logo" id="logo" value="<?php echo $s['CommercialImg'];?>" />
        <input type="hidden" name="Commercial" id="Commercial" value="<?php echo $Commercial;?>" />
  </div>
</form>
<?php
}else{
?>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="center" class="head">
			<td width="7%" height="36" align="center">购物券LOGO</td>
			<td width="19%" align="left">商家名称</td>
			<td width="15%" align="center">商家账号</td>
			<td width="17%" align="center">消费额度范围</td>
			<td width="12%" align="center">金额</td>
			<td width="15%" align="center">有效日期</td>
			<td width="12%" align="center">是否启用</td>
		  <td width="3%" align="center">操作</td>
		</tr>
		<?php
		
		$dosql->Execute("SELECT * FROM coupons a inner join commercialuser b on a.Commodityid=b.Id where b.Commercial='$Commercial' and a.type=2");
		while($row = $dosql->GetArray())
		{
			switch($row['play']){
			case 1:
			$play="<font color='#339933'><B>"."<i class='fa fa-check' aria-hidden='true'></i>"."</b></font>";
			break;
			
			case 0:
			$play="<font color='#FF0000'><B>"."<i class='fa fa-times' aria-hidden='true'></i>"."</b></font>";
			break;
			}
		?>
		<tr align="left" class="dataTr">
			<td height="70" align="center"><div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
   <input type="hidden" id="Id" value="<?php echo $row['Id'];?>" />
     <img  width="70" height="70" layer-src="../<?php echo $row['CommercialImg']; ?>" style="cursor:pointer; border-radius:40px; padding:3px;" onclick="message('<?php echo $row['Id']; ?>');"  src="../<?php echo $row['CommercialImg']; ?>" alt="<?php echo $row['CommercialName']; ?>" />
       </div></td>
			<td align="center"><?php echo $row['CommercialName']; ?></td>
			<td align="center"><?php echo $Commercial; ?></td>
			<td align="center"><?php echo $row['fanwei']; ?></td>
			<td align="center"><span class="num"><?php echo $row['money']; ?></span></td>
			<td align="center"><?php echo $row['usetime']; ?></td>
			<td align="center"><?php echo $play;?></td>
			<td align="center">
            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a  title="编辑" href="quan_update.php?id=<?php echo $row['id']; ?>"><i class="fa fa-pencil-square-o fa-lg fa-fw" aria-hidden="true"></i></a></div>
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