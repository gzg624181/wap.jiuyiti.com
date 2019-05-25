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
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<script>
function fn(Id){
      if(confirm("您确定要上架这个产品吗?")){
        var ajax_url='pt_ajax.php?Id='+Id;
  // alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
     document.getElementById("sj_"+Id).innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
      }
}
function fd(Id){
      if(confirm("您确定要下架这个产品吗?")){
        var ajax_url='pd_ajax.php?Id='+Id;
  // alert(ajax_url);
	$.ajax({
    url:ajax_url,
    type:'get',
	data: "data" ,
	dataType:'html',
    success:function(data){
     document.getElementById("sj_"+Id).innerHTML = data;
    } ,
	error:function(){
       alert('error');
    }
	});
      }
}
//审核，未审，功能
  function checkinfo(key){
     var v= key;
	// alert(v)
	window.location.href='product.php?check='+v;
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
  window.location.href='product.php?keyword='+keyword;
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
</script>
</head>
<body>

<?php
//初始化参数
$action  = isset($action)  ? $action  : '';
$keyword = isset($keyword) ? $keyword : '';
$check = isset($check) ? $check : '';

?>
<div class="topToolbar"> <span class="title">商品信息管理</span>
<a href="javascript:location.reload();" class="reload">刷新</a>
<a onClick="return confirm('确认更新所有商品缓存？');"   style="width:100px; color:#e44410;font-weight: bold;" href="product_save.php?action=update_cache" class="reload">更新商品缓存</a>
</div>
<div class="toolbarTab">
	<ul>
 <li class="<?php if($check==""){echo "on";}?>"><a href="product.php">全部</a></li> <li class="line">-</li>
 <li class="<?php if($check=="alltrue"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('alltrue')">已上架</a></li> <li class="line">-</li>
 <li class="<?php if($check=="allnull_1"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('allnull_1')">已下架</a></li>
 <li class="line">-</li>
 <li class="<?php if($check=="gd"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('gd')">首页广告位显示</a></li>
 <li class="line">-</li>
 <li class="<?php if($check=="yy"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('yy')">需要预约</a></li>
 <li class="line">-</li>
 <li class="<?php if($check=="unyy"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('unyy')">不需要预约</a></li>
	</ul>
	<div id="search" class="search"> <span class="s">
<input name="keyword" id="keyword" type="text" class="number" placeholder="请输入商品名进行搜索" title="请输入商品名进行搜索" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="6%" align="center">图片</td>
			<td width="19%" align="left">商品名称</td>
			<td width="4%" align="center">酒品分类</td>
			<td width="4%" align="center">热门品牌</td>
			<td width="4%" align="center">类型</td>
			<td width="5%" align="center">国家</td>
			<td width="4%" align="center">商品现价</td>
			<td width="4%" align="center">商品原价</td>
			<td width="5%" align="center">商户价格</td>
			<td width="6%" align="center">所属城市</td>
			<td width="5%" align="center">所属账号</td>
			<td width="5%" align="center">总销量</td>
			<td width="5%" align="center"><?php echo date("m",time());?>月销量</td>
			<td width="4%" align="center">状态</td>
			<td width="4%" align="center">首页广告位</td>
			<td width="6%" align="center">是否需要预约</td>
			<td width="6%" align="center">创建时间</td>
			<td width="3%" align="center">操作</td>
		</tr>
		<?php
		$username=$_SESSION['admin'];
		$adminlevel=$_SESSION['adminlevel'];
		if($_SESSION['adminlevel']==1){
		  if($check=="alltrue"){
		$dopage->GetPage("SELECT * FROM `commodity` where del='0'",10);
		  }elseif($check=="allnull_1"){
		$dopage->GetPage("SELECT * FROM `commodity` where del='1'",10);
		  }elseif($check=="gd"){
		$dopage->GetPage("SELECT * FROM `commodity` where gd=1",10);
		  }elseif($check=="yy"){
		$dopage->GetPage("SELECT * FROM `commodity` where yuyue='1'",10);
		  }elseif($check=="unyy"){
		$dopage->GetPage("SELECT * FROM `commodity` where yuyue='0'",10);
		  }elseif($keyword!=""){
		$dopage->GetPage("SELECT * FROM `commodity` where title like '%$keyword%'",10);
		  }else{
		$dopage->GetPage("SELECT * FROM `commodity`",10);
		  }
		}else{
		  $username=$_SESSION['admin'];
		  if($check=="alltrue"){
		$dopage->GetPage("SELECT * FROM `commodity` where del='0' and UserName='$username' and adminlevel=$adminlevel",10);
		  }elseif($check=="allnull_1"){
		$dopage->GetPage("SELECT * FROM `commodity` where del='1' and UserName='$username' and adminlevel=$adminlevel",10);
		  }elseif($check=="gd"){
		$dopage->GetPage("SELECT * FROM `commodity` where gd=1 and UserName='$username' and adminlevel=$adminlevel",10);
		  }elseif($check=="yy"){
		$dopage->GetPage("SELECT * FROM `commodity` where yuyue='1' and UserName='$username' and adminlevel=$adminlevel",10);
		  }elseif($check=="unyy"){
		$dopage->GetPage("SELECT * FROM `commodity` where yuyue='0' and UserName='$username' and adminlevel=$adminlevel",10);
		  }elseif($keyword!=""){
		$dopage->GetPage("SELECT * FROM `commodity` where title like '%$keyword%' and UserName='$username' and adminlevel=$adminlevel",10);
		  }else{
		$dopage->GetPage("SELECT * FROM `commodity` where UserName='$username' and adminlevel=$adminlevel",10);
		  }
		}
		while($row = $dosql->GetArray())
		{
			switch($row['CommodityClass'])
			{
				case '1':
					$CommodityClass = '白酒';
					break;
				case '18':
					$CommodityClass = '红酒';
					break;
				case '39':
					$CommodityClass = '洋酒';
					break;
				case '56':
					$CommodityClass = '啤酒';
					break;
				case '72':
					$CommodityClass = '酒具';
					break;
				default:
                    $CommodityClass = '暂无分类';
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
			if($row['Num']!=""){
				$Num=$row['Num'];
				}else{
				$Num=0;
					}
		?>
		<tr align="left" class="dataTr">
			<td height="50" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td align="center">
   <div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
   <input type="hidden" id="Id" value="<?php echo $row['Id'];?>" />
     <img  width="100px" height="65px" layer-src="../<?php echo $row['Images']; ?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="../<?php echo $row['Images']; ?>" alt="<?php echo $row['Title']; ?>" />
       </div>
            </td>
			<td align="center"><?php echo $row['Title']; ?></td>
			<td align="center"><?php echo $CommodityClass;?></td>
			<td align="center"><?php echo $row['Pinpai'];?></td>
			<td align="center"><?php echo $row['Types'];?></td>
			<td align="center"><?php echo $row['Country'];?></td>
			<td align="center" class="num"><?php echo $row['NewPrice']; ?></td>
			<td align="center"><?php echo $row['OldPrice']; ?></td>
			<td align="center"><?php echo $row['shprice']; ?></td>
			<td align="center"><?php echo $row['live_prov']; ?><?php echo $row['live_city']; ?></td>
			<td align="center"><?php echo $row['UserName']; ?></td>
			<td align="center"><?php echo $Num; ?></td>
			<td align="center">
            <?php
			$commodityid_id=$row['Id'];
			$thisyear=date("Y",time());
			$thismonth=date("m",time());
			$s=$dosql->GetOne("select * from commodity_month_nums where commodityid_id='$commodityid_id' and year=$thisyear and month=$thismonth");
			if(is_array($s)){
				echo $s['month_nums'];
			}else{
				echo 0;
				}

			?>+<?php 
			if(is_array($s)){
				echo "<font color='red'>".$s['new_nums']."</font>";
			}else{
				echo 0;
				}?>
            </td>
			<td align="center"><span id="sj_<?php echo $row['Id']; ?>">
			<?php
			if($row['del']=='0'){
			echo "<font color='#339933'><B>"."<i class='fa fa-arrow-circle-o-up fa-lg fa-fw' aria-hidden='true'></i>"."</b></font>";
			}else{
			echo "<font color='#FF0000'><B>"."<i class='fa fa-arrow-circle-o-down fa-lg fa-fw' aria-hidden='true'></i>"."</b></font>";
			}
			?></span></td>
			<td align="center"><?php
			if($row['gd']==1){
			echo "<font color='#339933'><B>"."<i class='fa fa-check' aria-hidden='true'></i>"."</b></font>";
			}else{
			echo "<font color='#FF0000'><B>"."<i class='fa fa-times' aria-hidden='true'></i>"."</b></font>";
			}
			?></td>
			<td align="center"><?php echo $yuyue;?></td>
			<td align="center"><span class="number"><?php echo substr($row['CreatTime'],0,10); ?></span></td>
			<td align="center">
 <div id="jsddm"><a title="删除" href="product_save.php?action=del3&id=<?php echo $row['Id'];?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
            <div id="jsddm"><a title="编辑" href="product_update.php?id=<?php echo $row['Id'];?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
            <div id="jsddm"><a href="javascript:fn('<?php echo $row['Id']; ?>')" title="点击进行上架操作"><i class="fa fa-caret-square-o-up" aria-hidden="true"></i></a></div>
            <div id="jsddm"><a href="javascript:fd('<?php echo $row['Id']; ?>')" title="点击进行下架操作"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></i></a></div>
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
<div class="bottomToolbar"> <span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('product_save.php');" onclick="return ConfDelAll(0);">删除</a></span> <a href="product_add.php" class="dataBtn">新增商品</a> </div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php
//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea">
        <a href="product_add.php" class="dataBtn">新增商品</a> <span class="pageSmall"><?php echo $dopage->GetList(); ?></span>
        </div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
</body>
</html>
