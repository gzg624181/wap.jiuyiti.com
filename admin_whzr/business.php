<?php require_once(dirname(__FILE__).'/inc/config.orderid.inc.php');IsModelPriv('nav');
$username=$_SESSION['admin'];
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>所有商户</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
function fn(Id,def){
  var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){
	if(def==1){ //当是1的时候，就说明要取消购物券
      if(confirm("您确定要取消默认优惠券吗?")){
        var ajax_url='def_ajax.php?Id='+Id+'&def='+def;
   //alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
     document.getElementById("def_"+Id).innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
    }
	}
   if(def==0){ //当是0的时候，就说明要取消购物券
      if(confirm("您确定要启用默认优惠券吗?")){
        var ajax_url='def_ajax.php?Id='+Id+'&def='+def;
  // alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
    document.getElementById("def_"+Id).innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
    }
	}
    }else{
	alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
		}

}
function zdy(Id,zdy){
var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){
	if(zdy==1){ //当是1的时候，就说明要取消购物券
      if(confirm("您确定要取消自定义优惠券吗?")){
        var ajax_url='zdy_ajax.php?Id='+Id+'&zdys='+zdy;
   //alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
     document.getElementById("zdy_"+Id).innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
    }
	}
   if(zdy==0){ //当是0的时候，就说明要取消购物券
      if(confirm("您确定要启用自定义优惠券吗?")){
        var ajax_url='zdy_ajax.php?Id='+Id+'&zdys='+zdy;
  // alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
    document.getElementById("zdy_"+Id).innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
    }
	}
	}else{
	alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
		}
}
function business(Commercial)
{
  var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){
  // alert(Commercial);
  layer.open({
  type: 2,
  title: '请选择商户拥有的酒品分类：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['1200px' , '700px'],
  content: 'business_product.php?Commercial='+Commercial,
  });
  }else{
  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
	  }
}
function fax(CommercialName,Commercial)
{
layer.open({
  type: 2,
  title: '商家发货记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['1200px' , '700px'],
  content: 'fax.php?Commercial='+Commercial+'&CommercialName='+CommercialName,
  });
}
function recommand(recommand,Commercial)
{
layer.open({
  type: 2,
  title: '商家推荐记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'recommand.php?Commercial='+Commercial+'&Recommand='+recommand,
  });
}
function jinhuo(Commercial)
{
layer.open({
  type: 2,
  title: '商家进货记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'jinhuo.php?Commercial='+Commercial,
  });
}
function def(Commercial)
{
  var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){
layer.open({
  type: 2,
  title: '系统默认优惠券：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'def.php?Commercial='+Commercial,
  });
    }else{
  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
	  }
}
function xianjin(Commercial)
{
	  var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){
layer.open({
  type: 2,
  title: '商家自定义现金券：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'xianjin.php?Commercial='+Commercial,
  });
      }else{
  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
	  }
}
function erweima(Commercial)
{

layer.open({
  type: 2,
  title: '推荐二维码：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['500px' , '385px'],
  content: 'erweima.php?Commercial='+Commercial,
  });
}
function tuijian_getting(recommand)
{
layer.open({
  type: 2,
  title: '商家推荐购买记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'tuijian_getting.php?Recommand='+recommand,
  });
}
function tuijian_jilu(recommand)
{
layer.open({
  type: 2,
  title: '商家推荐奖励记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'tuijian_jilu.php?Recommand='+recommand,
  });
}
function recommand_huiyuan(classes,Account,recommand)
{
layer.open({
  type: 2,
  title: '推荐记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'recommand_huiyuan.php?Account='+Account+'&Recommand='+recommand+'&classes='+classes,
  });
}
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
 function GetSearchs(){
	 var keyword= document.getElementById("keyword").value;
	if($("#keyword").val() == "")
	{
		alert("请输入搜索内容！");
		$("#keyword").focus();
		return false;
	}
  window.location.href='business.php?keyword='+keyword;
}
 function del_bus(){
 var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel!=1){
	  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
  }
	}
</script>
<?php
$adminlevel=$_SESSION['adminlevel'];
$keyword = isset($keyword) ? $keyword : '';
?>
</head>
<body>
<?php
$one=1;
$dosql->Execute("SELECT * FROM `commercialuser`",$one);
$num=$dosql->GetTotalRow($one);
$two=2;
$dosql->Execute("SELECT * FROM `commercialuser` where online=1",$two);
$nums=$dosql->GetTotalRow($two);
?>
<input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $adminlevel;?>" />
<div class="topToolbar"> <span class="title">所有商户合计：<span class="num" style="color:red;"><?php echo $num;?></span>&nbsp;&nbsp;&nbsp;已上线商家：<span class="num" style="color:#06F;"><?php echo $nums;?></span></span> <a href="javascript:location.reload();" class="reload">刷新</a>
<a onClick="return confirm('确认更新所有商户缓存？');"   style="width:100px; color:#e44410;font-weight: bold;" href="business_save.php?action=update_cache" class="reload">更新商户缓存</a>
</div>
<div class="toolbarTab" style="margin-bottom:-20px;">
	<div id="search" class="search"> <span class="s">
<input name="keyword" id="keyword" type="text" class="number" placeholder="请输入商户账号/商户名称/商户地址/联系人进行搜索" title="请输入商户账号/商户名称/商户地址/联系人进行搜索" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>
<form name="form" id="form" method="post" action="business_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="2%" height="36" class="firstCol"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="9%" align="center">商户图片</td>
			<td width="5%" style="text-align:center">商户账号</td>
			<td width="7%" align="center">商户名称</td>
			<td width="14%">商户地址</td>
			<td width="6%">推荐码</td>
			<td width="6%">联系人</td>
			<td width="4%">酒钱</td>
			<td width="6%">联系电话</td>
			<td width="4%" align="center">警告</td>
			<td width="5%" align="center">是否上线</td>
			<td width="6%" align="center">所属代理</td>
			<td width="7%" align="center">系统默认优惠券</td>
			<td width="5%" align="center">自定义优惠券</td>
			<td width="8%" align="center">添加时间</td>
			<td width="3%" align="center">&nbsp;</td>
			<td width="3%" align="center">操作</td>
		</tr>
		<?php
        $id=0;
        if($_SESSION['adminlevel']==1){
		if($keyword!=""){
		  $dopage->GetPage("SELECT * FROM `commercialuser` where Commercial like '%$keyword%' or CommercialName like '%$keyword%' or CommercialSite like '%$keyword%' or Linkman like '%$keyword%' and orderid <>182 ",15);
		  }else{
		$dopage->GetPage("SELECT * FROM `commercialuser` where orderid <>182",15);
		      }
		}else{
		 if($keyword!=""){
		  $dopage->GetPage("SELECT * FROM `commercialuser` where username='$username' and orderid <>182 and Commercial like '%$keyword%' or CommercialName like '%$keyword%' or CommercialSite like '%$keyword%' or Linkman like '%$keyword%'",15);
		  }else{
		$dopage->GetPage("SELECT * FROM `commercialuser` where username='$username' and orderid <>182",15);
		      }
			}
		while($row = $dosql->GetArray())
		{
		if($row['CommercialImg']==""){
			$CommercialImg="../uploads/image/20170605/1496658299.png";
		}else{
			$CommercialImg="../".$row['CommercialImg'];
			}
		switch($row['online']){

				case '0':
					$online = "<font color='#FF0000'><B>"."<i class='fa fa-times' aria-hidden='true'></i>"."</b></font>";
					break;
				case '1':
					$online = "<font color='#339933'><B>"."<i class='fa fa-check' aria-hidden='true'></i>"."</b></font>";
					break;
				default:
                    $online = '暂无分类';

				}
		switch($row['zdy']){
			case 1:
			$zdy="<font color='#339933'><B>"."<i class='fa fa-check' aria-hidden='true'></i>"."</b></font>";
			break;

			case 0:
			$zdy="<font color='#FF0000'><B>"."<i class='fa fa-times' aria-hidden='true'></i>"."</b></font>";
			break;
			}
          switch($row['defaults']){
			case 1:
			$defaults="<font color='#339933'><B>"."<i class='fa fa-check' aria-hidden='true'></i>"."</b></font>";
			break;

			case 0:
			$defaults="<font color='#FF0000'><B>"."<i class='fa fa-times' aria-hidden='true'></i>"."</b></font>";
			break;
			}
		?>
		<tr align="left" class="dataTr">
			<td height="36" class="firstCol"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td><div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
   <input type="hidden" id="Id" value="<?php echo $row['Id'];?>" />
     <img  width="150" height="100" layer-src="<?php echo $CommercialImg;?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="<?php echo $CommercialImg;?>" alt="<?php echo $row['CommercialName']; ?>" />
       </div></td>
			<td style="text-align:center"><?php echo $row['Commercial']; ?></td>
			<td align="center"><?php echo $row['CommercialName']; ?></td>
			<td align="center"><?php echo $row['CommercialSite']; ?></td>
			<td align="center" class="num"><a style="cursor:pointer" onclick="recommand_huiyuan('1','<?php echo $row['Phone']; ?>','<?php echo $row['Recommand']; ?>')" title="推荐人电话：<?php echo $row['Phone']; ?>"><?php echo $row['Recommand']; ?></a></td>
			<td align="center"><?php echo $row['Linkman']; ?></td>
			<td class="num" style="color:red;" align="center"><?php if($row['JiuQian']==""){echo 0;}else{ echo $row['JiuQian'];} ?></td>
			<td align="center"><?php echo $row['Phone']; ?></td>
			<td align="center">
            <?php
			$ids=1;
			$commercial=$row['Commercial'];
			//echo $commercial;
			$dosql->Execute("select jinggao from commoditystock where CommercialUser='$commercial'",$ids);
            while($rows=$dosql->GetArray($ids)){
				// $arr[]=$rows;
				$jinggao= $rows['jinggao'];
				//echo $jinggao;
				if(strpos($jinggao,"1") !== false){
				echo "<font color='red' size='+1'><B>"."警告！"."</font></b>";
					}
				}

            ?>
            </td>
			<td align="center"><?php echo $online;?></td>
			<td align="center"><?php echo $row['username'];?></td>
			<td align="center"><a title="点击切换启用或取消默认优惠券" href="javascript:;" onclick="fn('<?php echo $row['Id'];?>','<?php echo $row['defaults'];?>')"><span id='def_<?php echo $row['Id'];?>'><?php echo $defaults;?></span></a></td>
			<td align="center"><a title="点击切换启用或取消自定义优惠券" href="javascript:;" onclick="zdy('<?php echo $row['Id'];?>','<?php echo $row['zdy'];?>')"><span id='zdy_<?php echo $row['Id'];?>'><?php echo $zdy;?></span></a></td>
			<td align="center"><?php echo substr($row['CreatTime'],0,10); ?></td>

			<td align="center">
            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="所有商品" href="businessshow.php?Commercial=<?php echo $row['Commercial'];?>&name=<?php echo $row['CommercialName']; ?>"><i class="fa fa-database"></i></a></div>

             <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐记录" style="cursor:pointer" onclick="recommand('<?php echo $row['Recommand'];?>','<?php echo $row['Commercial'];?>');"><i class="fa fa-share-alt" aria-hidden="true"></i></a></div>

            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="发货记录" style="cursor:pointer" onclick="fax('<?php echo $row['CommercialName'];?>','<?php echo $row['Commercial'];?>');"><i class="fa fa-cloud-upload" aria-hidden="true"></i> </a></div>


   <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐二维码" style="cursor:pointer" onclick="erweima('<?php echo $row['Commercial'];?>');"><i class="fa fa-qrcode" aria-hidden="true"></i></a></div>


             <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="系统默认优惠券" style="cursor:pointer" onclick="def('<?php echo $row['Commercial'];?>');"><i class="fa fa-adn" aria-hidden="true"></i></a></div>

            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a  title="编辑" href="business_update.php?id=<?php echo $row['Id']; ?>"><i class="fa fa-pencil-square-o fa-lg fa-fw" aria-hidden="true"></i></a></div>

            </td>
			<td align="center">
       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="新增商品" style="cursor:pointer" onclick="business('<?php echo $row['Commercial'];?>');"><i class="fa fa-plus" aria-hidden="true"></i></a></div>


        <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐会员提成记录" style="cursor:pointer" onclick="tuijian_getting('<?php echo $row['Recommand'];?>');"><i class="fa fa-share" aria-hidden="true"></i> </a></div>

        <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="进货记录" style="cursor:pointer" onclick="jinhuo('<?php echo $row['Commercial'];?>');"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i></a></div>

       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐奖励记录" style="cursor:pointer" onclick="tuijian_jilu('<?php echo $row['Recommand'];?>');"><i class="fa fa-bars" aria-hidden="true"></i> </a></div>

       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a  title="商家自定义现金券" style="cursor:pointer" onclick="xianjin('<?php echo $row['Commercial'];?>');"><i class="fa fa-jpy" aria-hidden="true"></i></a></div>

       <?php
	   if($adminlevel==1){?>
       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a  title="删除" href="business_save.php?action=del2&id=<?php echo $row['Id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
     <?php }else{?>
   <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a style="cursor:pointer" title="删除" onclick="return del_bus();"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a></div>
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
<div class="bottomToolbar"> <span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('business_save.php');" onclick="return ConfDelAll(0);">删除</a></span>
<?php
if($adminlevel==1){?>
<a href="business_add.php" class="dataBtn">新增商户</a>
<?php }?>
<a onclick="history.go(-1);" style="cursor:pointer; margin-right:5px;" class="dataBtn" >返回</a>
</div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('business_save.php');" onclick="return ConfDelAll(0);">删除</a></span> <a href="business_add.php" class="dataBtn">新增商户</a> <span class="pageSmall"> <?php echo $dopage->GetList(); ?> </span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>
