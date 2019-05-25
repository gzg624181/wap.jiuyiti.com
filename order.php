<?php require_once(dirname(__FILE__).'/include/config.inc.php');
$cid = empty($cid) ? 1 : intval($cid);
error_reporting(E_ALL ^ E_NOTICE);
include("session.php");
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
<link rel="stylesheet" type="text/css" href="templates/default/style/metinfo.new.css" />
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="templates/default/style/shop.css">
<script src="templates/default/js/jquery.max.js"></script>
<script src="templates/default/js/bootstrap.min.js"></script>
<script>
function tab(state,orderid)
{
   //alert(state);
  var ajax_url='tab.php?tab='+state+'&orderid='+orderid;
 //  alert(ajax_url);
	$.ajax({     
    url:ajax_url,     
    type:'get',  
	data: "data" ,  
	dataType:'html', 
    success:function(data){  
     document.getElementById("tabs").innerHTML = data; 
    } ,
	error:function(){     
       alert('error');     
    }    
	}); 
	
}
function order_del(orderid,action) { 
var msg = "确定要删除吗？"; 
if (confirm(msg)==true){ 
window.location.href="productshow_save.php?orderid="+orderid+"&action="+action;
}else{ 
return false; 
} 
}
</script>
</head>
<body>
<?php include("nav.php");?>
<div class="page">
	<div class="container">
	<div class="page-content">

	<div class="row">
	<?php include("left.php");?>
	<?php
	                    if($cid==1){  //type(1已付款 2已提取  3未付款  0全部订单)
	                    $get_name="GetorderList_Client_Pc";
						$userid=$_SESSION['commercial'];
						$type=0;
					    $ssrg=get_orderList_Client($get_name,$type,$userid); 
                        if($ssrg==""){
						$num=0;
						}else{
						$num= count($ssrg);
						}
						
	         ?>
			<div class="col-md-9 shop-order">
				<div class="panel">
					<div class="panel-body shop-order-body">
						<ul class="nav nav-tabs nav-tabs-line shop-order-search">
							<li class="active"><a data-toggle="tab" style="cursor:pointer;" onclick="tab(0,'<?php echo $userid;?>')" data-state="all">全部有效订单（<?php echo $num;?>）</a></li>
							<li ><a data-toggle="tab" style="cursor:pointer;" onclick="tab(1,'<?php echo $userid;?>')" data-state="1">待付款（<?php
                            $type=3;
							$ssr=get_orderList_Client($get_name,$type,$userid); 
							if($ssr==""){
							$num=0;
							}else{
							$num= count($ssr);
							}
							echo $num;
							?>）</a></li>
							<li ><a data-toggle="tab" style="cursor:pointer;" onclick="tab(2,'<?php echo $userid;?>')" data-state="3">已发货（<?php
                            $type=2;
							$ssr=get_orderList_Client($get_name,$type,$userid); 
							if($ssr==""){
							$num=0;
							}else{
							$num= count($ssr);
							}
							echo $num;
							?>）</a></li>
							<li ><a data-toggle="tab" style="cursor:pointer;" onclick="tab(3,'<?php echo $userid;?>')" data-state="0">已付款（<?php
                            $type=1;
							$ssr=get_orderList_Client($get_name,$type,$userid); 
							if($ssr==""){
							$num=0;
							}else{
							$num= count($ssr);
							}
							echo $num;
							?>）</a></li>
						</ul>
						<div class="shop-order-keyword">
							<div class="form-group">
								<div class="input-search">
									<button type="submit" class="input-search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
									<input style="width:100%" type="text" class="form-control" name="keyword" data-table-search="true" placeholder="订单号、商品名称">
								</div>
							</div>		
						</div>
						
						
						
						<?php if($ssrg!=""){?>
						<div class="shop-order-more-body" id="tabs">
						<?php 
						
						for($i=0;$i<count($ssrg);$i++){
						 switch($ssrg[$i]['State'])
			{
				case 1: 
					$state = "<font color='#1f8c71'>".'已付款'."</font>";
					break;  
				case 5:
					$state = "<font color=red>".'待付款'."</font>";
					break;
				case 8:
					$state = "<font color='#2e61b9'>".'已发货'."</font>";
					break;
			}
			switch($ssrg[$i]['PaymentType'])
			{
				case 1: 
					$paymenttype = '酒钱支付';
					break;  
				case 2:
					$paymenttype = '现金支付';
					break;
				case 3:
					$paymenttype = '混合支付';
					break;
				case 4:
					$paymenttype = '未支付';
					break;
			}
					    ?>
						<div class="shop-order-list state-1" style="border-radius: 3px;">
						<div class="row shop-order-top">
						<div class="col-md-8 col-sm-8 ting" style='padding-top: 25px;'>
						<h4><?php echo $state;?></h4>
						<span class="info"><?php echo $ssrg[$i]['CreatTime'];?></span>
						<span class="info">订单号 : <?php echo $ssrg[$i]['OrderId'];?></span>
						<span class="info"><?php echo $paymenttype;?></span></div>
						<div class="col-md-4 col-sm-4 ting text-right">
						订单金额 ：<span class="price grey-800" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"><?php echo sprintf("%.2f",($ssrg[$i]['PayAmount']+$ssrg[$i]['PayJiuQian']+$ssrg[$i]['PayKdMoney']));?></span></div>
						</div>
						<div class="row shop-order-bottom">
                        
						<div class="col-md-7 col-sm-6">
						<?php
						$row=$ssrg[$i]['Commodity'];
						for($j=0;$j<count($row);$j++){
							$gourl = 'productshow-'.$row[$j]['CommodityClass'].'-'.$row[$j]['CommodityId'].'-'.$j.'-1.html';
							$picurl=$cfg_geturl.$row[$j]['picurl2'];
						?>
						<div class="media media-xs margin-top-5">
						<div class="media-left">
						<a href="<?php echo $gourl;?>" target="_blank">
						<img class="media-object" src="<?php echo $picurl;?>" alt="<?php echo $row[$j]['Title'];?>"></a>
						</div>
						<div class="media-body"><h4 class="media-heading"><a href="<?php echo $gourl;?>" target="_blank"><?php echo $row[$j]['Title'];?></a></h4><p><?php echo sprintf("%.2f",$row[$j]['shprice']);?>元 x <?php echo $row[$j]['Quantity'];?></p></div></div>
						<?php }?>
						
						</div>
						
						<div  class="col-md-5 col-sm-6 text-right btn-box">
						<p style="display:<?php if($ssrg[$i]['State']==5){echo 'block';}else{echo 'none';}  ?>"><a style="border-radius:3px;" href="pay-1-<?php echo $ssrg[$i]['Id'];?>-1.html" class="btn btn-danger btn-squared">立即付款</a></p>
						
						<p class="margin-bottom-0" style="margin-top: 0px;"><a style="border-radius:3px;" href="order-<?php echo $ssrg[$i]['Id']; ?>-1.html" class="btn btn-outline btn-default btn-squared">订单详情</a></p>
						
						<p class="margin-bottom-0" style="margin-top: 11px;"><a style="border-radius:3px; background-color: #d4a13f;color: white;" onclick="order_del('<?php echo $ssrg[$i]['OrderId']; ?>','del_orderid')" class="btn btn-outline btn-default btn-squared">删除订单</a></p>
						</div>
						</div>
						
						</div>
						<?php }?>
						</div>
					   <?php }else{ ?>
					   <div class="shop-order-more-body"><div class="height-100 vertical-align text-center order-null animation-fade"><div class="vertical-align-middle font-size-18">没有符合条件的订单</div></div></div>
					   <?php }?>
						</div>
					</div>
				</div>
			
						<?php }elseif($cid==2){ ?>
			<?php 
                        $get_name="pickUpList";
						//type(1已付款 2已提取  3未付款  0全部订单)
						$commercial=$_SESSION['commercial'];
						$ssr=GetCommercialUser($get_name,$commercial); 
                        if($ssr==""){
						$num=0;
						}else{
						$num= count($ssr);
						}
	        ?>
			<div class="col-md-9 shop-order">
				<div class="panel">
					<div class="panel-body shop-order-body">
						<ul class="nav nav-tabs nav-tabs-line shop-order-search">
							<li class="active"><a data-toggle="tab" style="cursor:pointer;" data-state="all">全部发货记录（<?php echo $num;?>）</a></li>
						</ul>
						<div class="shop-order-keyword">
							<div class="form-group">
								<div class="input-search">
									<button type="submit" class="input-search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
									<input style="width:100%" type="text" class="form-control" name="keyword" data-table-search="true" placeholder="订单号、商品名称">
								</div>
							</div>		
						</div>
						<?php  if($ssr!="") {?>
						<div class="shop-order-more-body" id="tabs">
						<?php 
						
						for($i=0;$i<count($ssr);$i++){
						 
					    ?>
						<div class="shop-order-list state-1" style="border-radius: 3px;">
						<div class="row shop-order-top">
						<div class="col-md-8 col-sm-8 ting">
						<h4 style='color:#62a8ea;'>已提取</h4>
						<span class="info">提取订单号 : <?php echo $ssr[$i]['orderId'];?></span>
						<span class="info"><?php echo $paymenttype;?></span></div>
						<div class="col-md-4 col-sm-4 ting text-right">
						提取时间 ：<span class="price grey-800"><?php echo $ssr[$i]['pickUpTime'];?></span></div>
						</div>
						<div class="row shop-order-bottom">
                        
						<div class="col-md-6 col-sm-6">
						<?php
						$row=$ssr[$i]['Commodity'];
						
						for($j=0;$j<=count($ssr[$i]['Commodity']);$j++){
							foreach ($ssr as $key=>$value)
							{
							  if (!isset($ssr[$key]['Commodity']))
								unset($ssr[$key]);
							}
							$picurl=$row[$j]['picurl2'];
						switch($row[$j]['CommodityClass'])
						{
							case 1: 
								$CommodityClass = '白酒';
								break;  
							case 18:
								$CommodityClass = '红酒';
								break;
							case 39:
								$CommodityClass = '洋酒';
								break;
							case 56:
								$CommodityClass = '啤酒';
								break;
							case 72:
								$CommodityClass = '酒具';
								break;
						}
						if($row[$j]['Title']!=""){

						?>
						<div class="media media-xs margin-top-5">
						<div class="media-left">
						<a href="<?php echo $gourl;?>" target="_blank">
						<img class="media-object" src="<?php echo $picurl;?>" alt="<?php echo $row[$j]['Title'];?>"></a>
						</div>

						<div class="media-body">
						<h4 class="media-heading" style="line-height: 24px;"><a href="<?php echo $gourl;?>" target="_blank"><?php echo $row[$j]['Title'];?></a></h4>
						<p style="padding-top: 9px;line-height: 16px;">
						<?php echo $CommodityClass;?>&nbsp;|&nbsp;<?php echo $row[$j]['Pinpai']; ?> &nbsp;|&nbsp;<?php echo $row[$j]['Types']; ?></p>
						<p><?php echo sprintf("%.2f",$row[$j]['shprice']);?>元 x <?php echo $row[$j]['Quantity'];?></p></div>
						</div>
						<?php }}?>
						
						</div>
						
						<div  class="col-md-6 col-sm-6 text-right btn-box">
						
						<!--<p class="margin-bottom-0" style="margin-top: 0px;"><a style="border-radius:3px;" href="order-<?php echo $ssr[$i]['Id']; ?>-1.html" class="btn btn-outline btn-default btn-squared">订单详情</a></p>-->
						
						<p class="margin-bottom-0" style="margin-top: 11px;"><a style="border-radius:3px; background-color: #d4a13f;color: white;" onclick="order_del('<?php echo $ssr[$i]['orderId']; ?>','del_pickuplist')" class="btn btn-outline btn-default btn-squared">删除记录</a></p>
						</div>
						</div>
						
						</div>
						<?php }?>
						</div>
					    <?php }else{ ?>
						<div class="shop-order-more-body"><div class="height-100 vertical-align text-center order-null animation-fade"><div class="vertical-align-middle font-size-18">没有符合条件的订单</div></div></div>
						<?php }?>
						</div>
							<div class="shop-order-more-btn">
							<button type="button" class="btn btn-primary btn-block btn-squared hide" id="shop-order-more"><i class="icon wb-chevron-down margin-right-5" aria-hidden="true"></i>查看更多订单</button>
						</div>
						
					</div>
				</div>
			
			<?php }elseif($cid==3){ ?>
			<?php
	                $id="me";
                    $ids="we";
					$userid=$_SESSION['commercial'];
					$dosql->Execute("SELECT * FROM `orderform` a inner join commercialuser b on a.address=b.CommercialSite where  b.Commercial='$userid' and a.State='1' order by a.CreatTime desc",$id);
					
                    for($i=0;$i<$dosql->GetTotalRow($id);$i++){
					$row = $dosql->GetArray($id);
					$ssrg[$i]=$row;
					$orderid=$row['OrderId'];//一个订单号对应着多件商品		
                    $dosql->Execute("select * from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid' and a.tag=0",$ids);
					for($j=0;$j<$dosql->GetTotalRow($ids);$j++) { 
					  $r = $dosql->GetArray($ids);
					  $ssrg[$i]["Commodity"][$j]=$r;
					} 
					}
					if(is_array($ssrg)){
					foreach ($ssrg as $key=>$value)
					{
					  if (!isset($ssrg[$key]['Commodity']))
						unset($ssrg[$key]);
					}
                    }
					
	         ?>
			<div class="col-md-9 shop-order">
				<div class="panel">
					<div class="panel-body shop-order-body">
						<ul class="nav nav-tabs nav-tabs-line shop-order-search">
							<li class="active"><a data-toggle="tab" style="cursor:pointer;">全部有效订单（<?php echo count($ssrg);?>）</a></li>
						</ul>
						<div class="shop-order-keyword">
							<div class="form-group">
								<div class="input-search">
									<button type="submit" class="input-search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
									<input style="width:100%" type="text" class="form-control" name="keyword" data-table-search="true" placeholder="订单号、商品名称">
								</div>
							</div>		
						</div>
						
						<?php if($ssrg!=""){?>
						<div class="shop-order-more-body" id="tabs">
						<?php 
						
						for($i=0;$i<=count($ssrg);$i++){
						 switch($ssrg[$i]['State'])
			{
				case 1: 
					$state = "<font color='#1f8c71'>".'已预约'."</font>";
					break;  
				case 5:
					$state = "<font color=red>".'待付款'."</font>";
					break;
				case 8:
					$state = "<font color='#2e61b9'>".'已发货'."</font>";
					break;
			}
			switch($ssrg[$i]['PaymentType'])
			{
				case 1: 
					$paymenttype = '酒钱支付';
					break;  
				case 2:
					$paymenttype = '现金支付';
					break;
				case 3:
					$paymenttype = '混合支付';
					break;
				case 4:
					$paymenttype = '未支付';
					break;
			}
			if($ssrg[$i]['address']!=""){
					    ?>
						<div class="shop-order-list state-1" style="border-radius: 3px;">
						<div class="row shop-order-top">
						<div class="col-md-8 col-sm-8 ting" style='padding-top: 25px;'>
						<h4><?php echo $state;?>&nbsp;&nbsp;(<?php echo $ssrg[$i]['address'];?>)</h4>
						<span class="info">订单金额 ：<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"><?php echo sprintf("%.2f",($ssrg[$i]['PayAmount']+$ssrg[$i]['PayJiuQian']));?></span>	</span>
						<span class="info">订单号 : <?php echo $ssrg[$i]['OrderId'];?></span>
						<span class="info"><?php echo $paymenttype;?></span></div>
						<div class="col-md-4 col-sm-4 ting text-right">
						预约时间：<span class="price grey-800" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"><?php echo $ssrg[$i]['posttime'];?></span></div>
						</div>
						<div class="row shop-order-bottom">
                        
						<div class="col-md-7 col-sm-6">
						<?php
						$row=$ssrg[$i]['Commodity'];
						for($j=0;$j<count($row);$j++){
							$gourl = 'productshow-'.$row[$j]['CommodityClass'].'-'.$row[$j]['CommodityId'].'-'.$j.'-1.html';
							$picurl=$cfg_geturl.$row[$j]['picurl2'];
						?>
						<div class="media media-xs margin-top-5">
						<div class="media-left">
						<a href="<?php echo $gourl;?>" target="_blank">
						<img class="media-object" src="<?php echo $picurl;?>" alt="<?php echo $row[$j]['Title'];?>"></a>
						</div>
						<div class="media-body"><h4 class="media-heading"><a href="<?php echo $gourl;?>" target="_blank"><?php echo $row[$j]['Title'];?></a></h4><p><?php echo sprintf("%.2f",$row[$j]['shprice']);?>元 x <?php echo $row[$j]['Quantity'];?></p></div></div>
						<?php }?>
						
						</div>
						
						<div  class="col-md-5 col-sm-6 text-right btn-box">
						<p style="display:block"><a style="border-radius:3px;" href="ordershow-3-<?php echo $ssrg[$i]['OrderId'];?>-1.html" class="btn btn-danger btn-squared">我要补货</a></p>
						</div>
						</div>
						
						</div>
			<?php }}?>
						</div>
					   <?php }else{ ?>
					   <div class="shop-order-more-body"><div class="height-100 vertical-align text-center order-null animation-fade"><div class="vertical-align-middle font-size-18">没有符合条件的订单</div></div></div>
					   <?php }?>
						</div>
						
					</div>
				</div>
			<?php }elseif($cid==4){ ?>
			<?php
			$ons=1;
			$commercial=$_SESSION['commercial'];
			$dosql->Execute("SELECT account,commercial,money,gettime,picurl FROM `record` WHERE commercial='$commercial' order by id desc",$ons);
			$num=$dosql->GetTotalRow($ons);
			?>
			<div class="col-md-9 shop-order">
				<div class="panel">
					<div class="panel-body shop-order-body">
						<ul class="nav nav-tabs nav-tabs-line shop-order-search">
							<li class="active"><a data-toggle="tab" style="cursor:pointer;" data-state="all">现金券列表（<?php echo $num;?>）</a></li>
						</ul>
						<div class="shop-order-keyword">
							<div class="form-group">
								<div class="input-search">
									<button type="submit" class="input-search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
									<input style="width:100%" type="text" class="form-control" name="keyword" data-table-search="true" placeholder="订单号、商品名称">
								</div>
							</div>		
						</div>
						<?php  if($num!=0) {?>
						<div class="shop-order-more-body" id="tabs">
						<div class="shop-order-list state-1" style="border-radius: 3px;">
						<div class="row shop-order-bottom">
						<?php
						while($row=$dosql->GetArray($ons)){
						?>
						<div class="col-md-6 col-sm-6">
						
						<div class="media media-xs margin-top-5" style="margin-top: 20px !important;">
						<div class="media-left" style="vertical-align: middle;">
						<img style="border-radius:3px;" class="media-object" src="<?php echo $row['picurl'];?>" alt="<?php echo $row['Title'];?>">
						</div>

						<div class="media-body">
						<h4 class="media-heading" style="line-height: 24px;">会员昵称：<?php echo $row['account'];?></h4>
						<p style="padding-top: 9px;line-height: 16px;">金额：<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"><?php echo $row['money'];?></span>元</p>
						<p>时间：<?php echo $row['gettime'];?></p></div>
						</div>
						
						
						</div>
						<?php }?>
						</div>
						
						</div>
						
						</div>
					    <?php }else{ ?>
						<div class="shop-order-more-body"><div class="height-100 vertical-align text-center order-null animation-fade"><div class="vertical-align-middle font-size-18">没有符合条件的订单</div></div></div>
						<?php }?>
						</div>
					</div>
				</div>
			
			
			<?php }else{?>
			<?php 
						$ssr = $dosql->GetOne("SELECT * FROM `orderform_commercial` WHERE Id='$cid'");
						$states=$ssr['State'];
                        switch($states)
			{
				case 1: 
					$state = "<font color='#1f8c71'>".'已付款'."</font>";
					break;  
				case 5:
					$state = "<font color=red>".'待付款'."</font>";
					break;
				case 8:
					$state = "<font color='#2e61b9'>".'已发货'."</font>";
					break;
			}
			switch($ssr['PaymentType'])
			{
				case 1: 
					$paymenttype = '酒钱支付';
					break;  
				case 2:
					$paymenttype = '现金支付';
					break;
				case 3:
					$paymenttype = '混合支付';
					break;
				case 4:
					$paymenttype = '未支付';
					break;
			}
	        ?>
            <div class="col-md-9 shop-order shop-order-check">
				<div class="panel">
					<div class="panel-body">
					<div class="row order-state-1">
						<div class="col-md-8 shop-order-type">
							<h4 class="state_txt"><i class="fa fa-credit-card-alt" aria-hidden="true" style="font-size:30px;color:#8c703a;"></i><span style="margin-left: 10px;"><?php echo $state;?></span></h4>
                             <?php
							if($states==1){
								echo "<font color='#62a8ea'>订单已付款，请待商家发货！</font>";
							}elseif($states==5){
								echo "<font color='#62a8ea'>请及时完成支付，超时将跳转到未付款订单！</font>";
							}elseif($states==8){
								echo "<font color='#62a8ea'>订单快递已发货，请注意及时查收！</font>";
							}
							 ?>
		
						</div>	
						<div class="col-md-4 text-right shop-order-type-btn">

						<a onclick="order_del('<?php echo $ssr['OrderId']; ?>','del_orderid')"  style="border-radius: 3px;" class="btn btn-default btn-squared btn-outline shop-order-close">删除订单</a>
						<?php if($states==5){?>
						<a href="pay.php?id=<?php echo $cid;?>" style="border-radius: 3px;"  class="btn btn-danger btn-squared">立即付款</a>
	                    <?php }?>
						</div>	
					</div>
					</div>
				</div>
	
				<div class="panel hidden-xs">
					<div class="panel-body padding-bottom-20">
	<div class="pearls row">
		<div class="pearl current col-xs-4">
			<div class="pearl-icon"><i class="fa fa-clone"></i></div>
			<span class="pearl-title">下单<p class="blue-grey-400 hidden-xs margin-bottom-0" style="margin-top: 21px;"><?php echo $ssr['CreatTime'];?></p></span>
		</div>
		<div class="pearl <?php if($states==1 || $states==8){echo 'current';}else{ 'disabled';}?> col-xs-4">
			<div class="pearl-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
			<span class="pearl-title">付款<p class="blue-grey-400 hidden-xs margin-bottom-0" style="margin-top: 21px;"></p></span>
		</div>
		<div class="pearl <?php if($states==8){echo 'current';}else{ 'disabled';}?> col-xs-4">
			<div class="pearl-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
			<span class="pearl-title">发货<p class="blue-grey-400 hidden-xs margin-bottom-0" style="margin-top: 21px;"></p></span>
		</div>
	</div>
					</div>
				</div>
		
				<div class="panel">
					<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped margin-bottom-0" style="margin-top: 2px;">
						<thead>
							<tr>
								<th class="text-center">酒钱支付</th>
								<th class="text-center"></th>
								<th class="text-center">现金支付</th>
								<th class="text-center"></th>
								<th class="text-center">运费</th>
								<th class="text-center"></th>
								<th class="text-center">涨价/减免</th>
								<th class="text-center"></th>
								<th class="text-center">实付金额</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><span class="label label-default"><?php echo sprintf("%.2f",$ssr['PayJiuQian']);?>元</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default"><?php echo sprintf("%.2f",$ssr['PayAmount']);?>元</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default"><?php echo sprintf("%.2f",$ssr['PayKdMoney']);?>元</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default"><span id="edit_price" data-url="a=doeditorsave_price&id=24">0.00元</span></span></td>
								<td class="text-center">=</td>
								<td class="text-center"><span class="label label-default"><?php echo sprintf("%.2f",($ssr['PayAmount']+$ssr['PayJiuQian']+$ssr['PayKdMoney']));?>元</span></td>
							</tr>
						</tbody>
					</table>
				</div>
					</div>
				</div>
			
				<div class="panel">
					<div class="panel-body" style="padding: 20px 20px">
				<div class="table-responsive">
					<table class="table table-striped margin-bottom-0" style="margin-top: 2px;">
                    <thead>
                      <tr>
                        <th width="300">商品名称</th>
                        <th class="text-center">单价</th>
                        <th class="text-center">数量</th>
                        <th class="text-center">小计</th>
                      </tr>
                    </thead>
                    <tbody>
						<?php
						$orderid=$ssr['OrderId'];
						$dosql->Execute("select Title,CommodityId,Images,picurl2,NewPrice,shprice,Quantity,OldPrice,JiuQian,Colour,Standard,Pinpai,CommodityClass from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'");
						$i=0;
						while($i<$dosql->GetTotalRow())
						{
						$show=$dosql->GetArray();
						$picurl=$show['picurl2'];
						$gourl = 'productshow-'.$show['CommodityClass'].'-'.$show['CommodityId'].'-'.$i.'-1.html';
						$i++;
						?>
						<tr>
							<td>
								<div class="media media-xs">
									<div class="media-left">
									  <a target="_blank" href="<?php echo $gourl;?>" title="<?php echo $show['Title'];?>">
										<img style="border-radius:3px;" src="<?php echo $picurl;?>" class="media-object" />
									  </a>
									</div>
									<div class="media-body" style="vertical-align: middle">
									  <h4 class="media-heading" >
										<a target="_blank" href="<?php echo $gourl;?>" class="blue-grey-600 font-size-14" title="<?php echo $show['Title'];?>"><?php echo $show['Title'];?></a>
									  </h4>
									  <div> <ul class="goods-message-list"></ul></div>
									</div>
								</div>
							</td>
							<td class="text-center" style="vertical-align: middle;font-weight: bold;"><?php echo  sprintf("%.2f",($show['shprice']));?></td>
							<td class="text-center" style="vertical-align: middle;font-weight: bold;" ><?php echo $show['Quantity'];?></td>
							<td class="text-center" style="vertical-align: middle;font-weight: bold;"><?php echo sprintf("%.2f",($show['shprice']* $show['Quantity']));?></td>
						</tr>
                        <?php }?>
                    </tbody>
                  </table>
				</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-body order-info">

				<div class="row padding-bottom-10">
					<div class="pull-left width-100 text-right margin-right-20">订单号 : </div>
					<div class="pull-left"><?php echo $ssr['OrderId'];?></div>
				</div>
				<div class="row">
					<div class="pull-left width-100 text-right margin-right-20">支付方式 : </div>
					<div class="pull-left"><?php echo $paymenttype;?></div>
				</div>
				<hr />
				<div class="row padding-bottom-10">
					<div class="pull-left width-100 text-right margin-right-20">配送方式 : </div>
					<div class="pull-left">快递配送</div>
				</div>
				<?php
				$commercial=$_SESSION['commercial'];
				$strrs = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
				?>
				<div class="row padding-bottom-10">
					<div class="pull-left width-100 text-right margin-right-20">收货人 : </div>
					<div class="pull-left"><?php echo $strrs['kd_name'];?>&nbsp;<?php echo $strrs['kd_phone'];?></div>
				</div>
				<div class="row">
					<div class="pull-left width-100 text-right margin-right-20">收货信息 : </div>
					<div class="pull-left"><? echo $strrs['kd_area']."&nbsp;".$strrs['kd_address'];?></div>
				</div>
				<hr />
				<div class="row">
					<div class="pull-left width-100 text-right margin-right-20">买家留言 : </div>
					<div class="pull-left"></div>
				</div>
					</div>
					<hr />
				</div>
		
			</div>
            <?php }?>			
			</div>
			
	</div>
			</div>
		</div>

<?php include("footer.php");?> 

</body>
</html>
