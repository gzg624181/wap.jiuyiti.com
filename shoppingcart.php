<?php 
require_once(dirname(__FILE__).'/include/config.inc.php');
$cid = empty($cid) ? 1 : intval($cid);
include('session.php');
 ?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo"  data-variable="http://www.ay91.com.au/|cn||||ps01703" />
<?php echo GetHeader(); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/shop.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>

<SCRIPT LANGUAGE=javascript> 
function p_del(Id,userid) { 
var msg = "确定要删除吗？"; 
if (confirm(msg)==true){ 
window.location.href="productshow_save.php?id="+Id+"&action=del&userid="+userid;
}else{ 
return false; 
} 
} 
/*商品数量+1*/  
    function numAdd(id,kid,comid,userid){  
        var quantity = document.getElementById("num"+id).value; 
        var num_add = parseInt(quantity)+1; 
        if(quantity==""){  
            num_add = 1;  
        }  
         
         document.getElementById("num"+id).value=num_add;  
         var sumshprice=document.getElementById("shprice"+id).innerText * num_add ;
         document.getElementById("sumshprice"+id).innerHTML =sumshprice+"元"; 
		 
		 var ajax_url='productshow_save.php?commodityid='+comid+'&commoditynumber='+num_add+'&userid='+userid+'&id='+kid+'&action=numadd';
		 //  alert(ajax_url);
			$.ajax({     
			url:ajax_url,     
			type:'get',  
			data: "data" ,  
			dataType:'html', 
			success:function(data){  
			 document.getElementById("sum_shoppingcart").innerHTML = data; 
			} ,
			error:function(){     
			   alert('error');     
			}    
			});  
				 
			}  
/*商品数量-1*/  
    function numDec(id,kid,comid,userid){     
        var quantity = document.getElementById("num"+id).value;  
        var num_dec = parseInt(quantity)-1;  
        if(num_dec>0){  
            document.getElementById("num"+id).value=num_dec; 
            var sumshprice=document.getElementById("shprice"+id).innerText * num_dec ;
            document.getElementById("sumshprice"+id).innerHTML =sumshprice+"元";
             var ajax_url='productshow_save.php?commodityid='+comid+'&commoditynumber='+num_dec+'&userid='+userid+'&id='+kid+'&action=numadd';
		   //alert(ajax_url);
			$.ajax({     
			url:ajax_url,     
			type:'get',  
			data: "data" ,  
			dataType:'html', 
			success:function(data){  
			 document.getElementById("sum_shoppingcart").innerHTML = data; 
			} ,
			error:function(){     
			   alert('error');     
			}    
			}); 
           	
        }    
    }  
 
</SCRIPT> 
</head>
<body class="met-navfixed met-white-lightGallery" style="padding-top: 40px;">
<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny" role="navigation">
<?php include("head.php");?>
</nav>
<div class="page">
	<div class="container">
	<div class="page-content" data-selectable="selectable">
		<div class="panel" style="border-radius: 4px;">
			<div class="panel-body cart-list-body animation-fade">
			<div class="table-responsive">
			<table class="table table-hover table-striped">
			<thead>
    <tr>
    <th class="width-300">商品</th>
    <th class="text-center">单价</th>
    <th class="text-center width-150">数量</th>
    <th class="text-center">小计</th>
    <th class="text-center width-100">操作</th>
	</tr>
            </thead>
			<tbody>
	           <?php
			    $userid=$_SESSION["Id"];
				$dosql->Execute(" SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'");
				$i=0;
				while($i<$dosql->GetTotalRow())
				{
				$str=$dosql->GetArray();
				$num_shopping[] = floatval($str['CommodityNumber']);//商品数量
	            $sums_shopping[]= $str['shprice'] * $str['CommodityNumber'];	 //商品总价格
				$gourl = 'productshow-'.$str['CommodityClass'].'-'.$str['Id'].'-'.$i.'-1.html';
				$i++;
				?>
    <?php  if(is_array($str)){       ?>		
	<tr class="active">
  <td>
    <div class="media">
      <div class="media-left">
        <a class="avatar text-middle" href="<?php echo $gourl;?>" target="_blank">
          <img style="border-radius: 4px;" class="img-responsive" src="<?php echo $str['picurl2']; ?>" alt="<?php echo $str['Title']; ?>"></a>
      </div>
      <div class="media-body">
        <h4 class="media-heading font-weight-unset" style="font-size: 13px; margin-top: 26px;line-height: 23px;">
          <a style="color: #b68d41;transition: all 0.3s ease-out;font-weight: bold;" target="_blank" href="<?php echo $gourl;?>"><?php echo $str['Title']; ?></a></h4>
        <p>
        </p>
      </div>
    </div>
  </td>
  <td class="text-center"><span id="shprice<?php echo $i;?>"><?php echo sprintf("%.2f", $str['shprice']);?></span>元</td>
  <td>
        <div class="buynum">
      <div class="input-group bootstrap-touchspin input-group-sm">
        <span class="input-group-btn">
          <button class="btn btn-default bootstrap-touchspin-down"  onclick="numDec('<?php echo $i;?>','<?php echo $str['Id']; ?>','<?php echo $str['CommodityId']; ?>','<?php echo $userid;?>')" type="button">-</button></span>
        <span class="input-group-addon bootstrap-touchspin-prefix" style="display: none;"></span>
        <input class="form-control input-sm text-center buynum-input" data-min="1" data-max="100" data-plugin="touchSpin" data-id="100" name="buynum" id="num<?php echo $i;?>" autocomplete="off" value="<?php echo $str['CommodityNumber']; ?>" style="display: block; width: 41px;font-weight: bold;" type="text">
        <span class="input-group-addon bootstrap-touchspin-postfix" style="display: none;"></span>
        <span class="input-group-btn">
          <button class="btn btn-default bootstrap-touchspin-up"  onclick="numAdd('<?php echo $i;?>','<?php echo $str['Id']; ?>','<?php echo $str['CommodityId']; ?>','<?php echo $userid;?>')" type="button">+</button></span>
      </div>
    </div>
  </td>
  <td class="text-center">
    <span class="red-600 subtotal" data-id="10" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"id="sumshprice<?php echo $i;?>"><?php echo sprintf("%.2f", $str['shprice']) * $str['CommodityNumber'];?>元</span></td>
  <td class="text-center">
    <a onclick="p_del('<?php echo $str['Id']; ?>','<?php echo $userid;?>')" class="cart-remove">
      <i style="cursor:pointer;" class="fa fa-trash-o" aria-hidden="true"></i>
    </a>
  </td>
</tr>
	<?php
	}else{ 
    echo '<div class="dataEmpty">暂时没有相关的记录</div>';
	}}?>	


			</tbody></table></div></div>
		</div>
        <div class="panel" style="border-radius: 4px;">
			<div class="panel-body cart-total-body animation-fade">
				<div class="row">
					<div class="col-md-2 col-sm-2 col-xs-3 cart-all">
						    
							 
						
					</div>
					<div class="col-md-7 col-sm-6 col-xs-9 text-right" id="sum_shoppingcart">
						<span class="hidden-xs">共 <span class="cart-goodnum" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"><?php 
						$numer_shopping="";
						$num_shopping[]="";
						if($num_shopping!=""){
						foreach($num_shopping as $key => $va)
						{
						   $numer_shopping += $va;	
						}
						}else{
						   $numer_shopping=0;
						}
						echo $numer_shopping;
						?></span> 件商品， </span>
						合计 : 
						<span class="total-val red-600" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;">
						<?php 
						$sumer_shopping="";
						$sums_shopping[]="";
						if(is_array($sums_shopping)){
						foreach($sums_shopping as $key => $item)
						{
						   $sumer_shopping+=$item;	
						}
						}else{
						   $sumer_shopping=0;
						}
						echo sprintf("%.2f",$sumer_shopping);
						?></span>元
					</div>
					<div class="col-md-3 col-sm-4 col-xs-12 text-right">
					   <a style="border-radius:3px;margin-right: 0px !important;" class="btn btn-default btn-lg btn-squared margin-right-20" href="product-5-1.html">继续购物</a>
						<a style="border-radius:3px;" href="getlist-1-1.html" data-url="getlist-1-1.html" class="btn btn-lg btn-squared btn-danger padding-horizontal-30 cart-tocheck">去结算</a>
					</div>
				</div>
			</div>
		</div>
		<?php include("moregoods.php");?>
	</div>
	</div>
</div>
<?php include("footer.php");?> 
</body>
</html>