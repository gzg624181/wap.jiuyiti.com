<?php require_once(dirname(__FILE__).'/inc/config.product.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商户添加的商品列表</title>
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
	window.location.href='business_product.php?check='+v;
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
  window.location.href='business_product.php?keyword='+keyword;
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
function fun(Commercial){
  var  obj = document.getElementsByName("checkid[]");
    check_val = [];
	
    for(k in obj){
        if(obj[k].checked)
            check_val.push(obj[k].value);
    }
	if(check_val==""){
		alert("请确认选择的商品！");
	 $("#checkid")[0].focus();
		return false;
		}else{
	
	alert("选择的酒品ID："+check_val);
	}
	var url="business_product_ajax.php?Id="+check_val+'&Commercial='+Commercial;

    window.location.href=url;
	alert("添加商品类别成功！")
	var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
    parent.layer.close(index);///关闭窗口
	
}
</script>
</head>
<body>
<?php
//初始化参数
$action  = isset($action)  ? $action  : '';
$keyword = isset($keyword) ? $keyword : '';
$check = isset($check) ? $check : '';
$Commercial = isset($Commercial) ? $Commercial : '';

?>
<div class="topToolbar"> <span class="title">商品信息管理</span> <a title="刷新" href="javascript:location.reload();" class="reload"><i class="fa fa-refresh" aria-hidden="true"></i></a></div>
<div class="toolbarTab" style="margin-bottom:0px;">
	<ul>
 <li class="<?php if($check==""){echo "on";}?>"><a href="business_product.php">全部</a></li>
	</ul>
	<div id="search" class="search"> <span class="s">
    
    <input name="keyword" id="keyword" type="text" class="number" placeholder="请输入商品名进行搜索" title="请输入商品名进行搜索" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>
<form name="form" id="form" method="post" action="product_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="3%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="10%" align="center">图片</td>
			<td width="29%" align="left">商品名称</td>
			<td width="8%" align="center">现提</td>
			<td width="9%" align="center">商品现价</td>
			<td width="10%" align="center">商品原价</td>
			<td width="10%" align="center">状态</td>
			<td width="13%" align="center">创建时间</td>
			<td width="8%" align="center">操作</td>
		</tr>
		<?php
       if($keyword!=""){
		$dosql->Execute("SELECT * FROM `commodity` where title like '%$keyword%' and del='0'");	
		}else{
		$dosql->Execute("SELECT * FROM `commodity` where del='0'");	
		}
		while($row = $dosql->GetArray())
		{
			switch($row['yuyue']){
				case 0:
				$yuyue="<font color='red'><b>现提</b></font>";
				break;
				case 1:
				$yuyue="";
				break;
				}
		?>
		<tr align="left" class="dataTr">
			<td height="70" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td align="center">
   <div id="layer-photos-demo_<?php echo $row['Id'];?>" class="layer-photos-demo">
   <input type="hidden" id="Id" value="<?php echo $row['Id'];?>" />
     <img  width="100px;" height="60px;" layer-src="../<?php echo $row['Images']; ?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="../<?php echo $row['Images']; ?>" alt="<?php echo $row['Title']; ?>" />
       </div>
            </td>
			<td align="left"><?php echo $row['Title']; ?></td>
			<td align="center"><?php echo $yuyue;?></td>
			<td align="center"><?php echo $row['NewPrice']; ?></td>
			<td align="center"><?php echo $row['OldPrice']; ?></td>
			<td align="center"><span id="sj_<?php echo $row['Id']; ?>">
			<?php 
			if($row['del']=='0'){
			echo "<font color='#339933'><B>"."已上架"."</b></font>";
			}else{
			echo "<font color='#FF0000'><B>"."已下架"."</b></font>";
			}
			?></span></td>
			<td align="center"><span class="number"><?php echo $row['CreatTime']; ?></span></td>
			<td align="center">
            <div id="jsddm" style="cursor:pointer"><a title="确认选择" style="cursor:pointer" onclick="return fun('<?php echo $Commercial; ?>');"><i class="fa fa-2x fa-check-circle" aria-hidden="true"></i></a>
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
<span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">
全部</a> - <a href="javascript:CheckAll(false);">无</a> - 
<a href="javascript:DelAllNone('product_save.php');" onclick="return ConfDelAll(0);">删除</a></span> 
<a style="cursor:pointer"  onclick="return fun('<?php echo $Commercial; ?>');" class="dataBtn">确认选择</a> 
</div>
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
}
?>
</body>
</html>