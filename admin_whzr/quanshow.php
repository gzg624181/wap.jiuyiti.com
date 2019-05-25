<?php
 require_once(dirname(__FILE__).'/inc/config.inc.php');
  error_reporting(E_ALL & ~E_NOTICE);  //屏蔽注意提示
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>购物券列表</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
function message(Id){
  // alert(Id);
   layer.ready(function(){ //为了layer.ext.js加载完毕再执行
   layer.photos({
   photos: '#layer-photos-demo_'+Id,
	//area:['500px','300px'],  //图片的宽度和高度
   shift: 0 ,//0-6的选择，指定弹出图片动画类型，默认随机
   closeBtn:1,
   offset:'40px',  //离上方的距离
   shadeClose:false
  });
});
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
<input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $adminlevel;?>" />
<div class="topToolbar"> <span class="title">优惠券列表</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="promotion_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="6%" height="36" align="center">商品LOGO</td>
			<td width="15%" align="center">商品店铺名称</td>
			<td width="15%" align="center">店铺地址</td>
			<td width="9%" align="center">购物券金额</td>
			<td width="10%" align="center">商品件数</td>
			<td width="10%" align="center">购物券类型</td>
			<td width="12%" align="center">使用状态</td>
			<td width="10%" align="center">过期时间</td>
			<td width="10%" align="center">获得时间</td>
			<td width="3%" align="center">操作</td>
		</tr>
		<?php
		$idd=1;
		$ids=0;
	$dosql->Execute("SELECT * FROM coupons,couponslist where coupons.id=couponslist.gid and couponslist.account='$account'",$idd);
	//未使用的购物券
	$dosql->Execute("SELECT * FROM coupons,couponslist where coupons.id=couponslist.gid and couponslist.account='$account' and couponslist.state=0",$ids);
	$num=$dosql->GetTotalRow($idd);
	$unnum=$dosql->GetTotalRow($ids);
	//使用的购物券
	$nums=$num-$unnum;
	while($row=$dosql->GetArray($idd)){

	if(is_array($row)){
	$commercial=$row['commercial'];  //商家账号
	if($commercial=="0"){
	$CommercialName  = "<font color='#930'><b>"."通用优惠券"."</b></font>";
	$CommercialSite  = "<font color='#930'><b>"."所有店铺通用"."</b></font>";
  $type  = "<font color='#930'><b>"."通用优惠券"."</b></font>";
	}else{
	$r=$dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
    $CommercialName  =$r['CommercialName'];
	$CommercialSite  =$r['CommercialSite'];
	}
	switch($row['state']){
		case 0:
		$state = "<font color='#0099FF'><b>".'未使用'."</b></font>";
		break;
		case 1:
		$state = "<font color='red'><b>".'已使用'."</b></font>";
		break;
		}
	switch($row['type']){
		case 1:
		$type = "<font color='#0099FF'><b>".'系统默认优惠券'."</b></font>";
		break;
		case 2:
		$type = "<font color='red'><b>".'商家自定义优惠券'."</b></font>";
		break;
		}
		?>
		<tr align="left" class="<?php if($row['state']==0){echo "dataTr";}else{echo "dataTrOn";}?>">
			<td height="101" align="center">
            <div id="layer-photos-demo_<?php  echo $row['id'];?>" class="layer-photos-demo">
            <img layer-src="../<?php echo $row['logo']; ?>" style="cursor:pointer" onclick="message('<?php  echo $row['id']; ?>');"  src="../<?php echo $row['logo']; ?>" alt="<?php  echo $CommercialName; ?>" width="100px" />
            </div>
            </td>
			<td align="center"><?php  echo $CommercialName;?></td>
			<td align="center"><?php  echo $CommercialSite;?></td>
			<td align="center" style="font-family: Verdana, Geneva, sans-serif;font-weight:bold; color:#36F"><?php  echo $row['money'];?></td>
			<td align="center" style="font-family: Verdana, Geneva, sans-serif;font-weight:bold;"><?php  echo $row['num'];?> </td>
			<td align="center"><?php  echo $type;?></td>
			<td align="center"><?php  echo $state;?></td>
			<td align="center"><?php  echo $row['creatime']; ?></td>
			<td align="center"><?php if($row['gettime']!="0000-00-00") {echo $row['gettime'];} ?></td>
			<td align="center">
            <?php
			if($adminlevel==1){
			?>
            <div id="jsddm"><a title="删除" href="quan_save.php?action=del3&id=<?php echo $row['id']; ?>&account=<?php echo $account;?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a></div>
            <?php  }else{?>
            <div id="jsddm"><a style="cursor:pointer" title="删除" onclick="return del_quanshow();"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a></div>
            <?php }?>
            </td>
		</tr>
		<?php
		}}
		?>
        <tr align="left" class="head">
			<td width="6%" height="36" align="center">&nbsp;</td>
			<td width="15%">&nbsp;</td>
			<td width="15%">&nbsp;</td>
			<td width="9%">&nbsp;</td>
			<td colspan="6"  style="text-align:right;">共有优惠券<font color="#FF0000"><B><?php echo $num;?></B></font>张，已使用<font color="#00CCFF"><B><?php echo $nums;?></B></font>张，未使用<font color="#0099FF"><B><?php echo $unnum;?></B></font>张
			     &nbsp;&nbsp;</td>
		</tr>

	</table>
</form>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="formSubBtn" style="text-align:left; margin-left:50px; margin-top:20px;">
<input type="button" class="back" value="返回" onclick="history.go(-1);" />
	</div>

</body>
</html>
