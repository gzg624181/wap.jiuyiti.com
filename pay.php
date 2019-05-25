<?php require_once(dirname(__FILE__).'/include/config.inc.php');
$cid = empty($cid) ? 1 : $cid;
$id = empty($id) ? 1 : $id;
include('session.php');
$userid=$_SESSION["Id"];  //商户id
$commercial=$_SESSION["commercial"];
 ?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo"  data-variable="http://www.ay91.com.au/|cn||||ps01703" />
<title>订单付款 —— 武汉酒易提</title>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/shop.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>
<script type="text/javascript" src="admin_whzr/layer/layer.js"></script>
<script type="text/javascript">
    function creQr(pid,fee){
        var url = 'http://wap.jiuyiti.zrcase.com/pay/index2.php';
        new_url = url + '?pid=' + pid +'&fee=' + fee + '&' + Math.random();
      //  alert(new_url);
        document.getElementById('qr').src = new_url;
    }
    function my_monitor(){
        var pid=$('#WIDout_trade_no').val();
        var pay=$('#fee').val();
        $.ajax({
            url:'productshow_save.php?action=saomapay&orderid='+pid,
           dataType:'html',
           success:function(res) {
               if(res == 0){
                   $('#view').html('请打开微信扫一扫');
               }else if(res == 1){
                   $('#view').html('您已经扫码完成,请支付');
               }else if(res == 2){
                   document.getElementById("qr").parentNode.removeChild(document.getElementById("qr"));
                   $('#view').html('您已经支付成功,请等待发货');
               }
           }
       })
    }
  function clo(){
    var pid=$('#WIDout_trade_no').val();
    $.ajax({
        url:'productshow_save.php?action=saomapay&orderid='+pid,
       dataType:'html',
       success:function(res) {
           if(res == 2){
            window.location.href="order-1-1.html";
           }
       }
   })
  }
//Ajax定时访问服务端，2秒一次
window.setInterval('my_monitor()',2000);
</script>
</head>
<body class="met-navfixed met-white-lightGallery" style="padding-top: 40px;">
<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny" role="navigation">
<?php include("head.php");?>
</nav>
<?php
    if($cid==1)
	{
    $strs = $dosql->GetOne("SELECT * FROM `orderform_commercial` WHERE Id='$id'");
?>
<!--正常购物-->
<div class="page">
	<div class="container">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body pay-oder-top">
				<div class="row">
					<div class="col-md-2 col-sm-2 text-center">
						<i class="fa fa-check-circle fa-5x" style="font-size: 104px; color:#7dd3ae" aria-hidden="true"></i>
					</div>
					<div class="col-md-7 col-sm-6">
						<h1>订单提交成功！去付款咯~</h1>

						<p>请在 <span class="red-600">1小时30分钟</span> 内完成支付, 超时后将在个人中心订单列表查看</p>

						<p>订单号 : <span class="red-600"><?php echo $strs['OrderId'];?></span></p>
						<p><a href="javascript:void(0)" class="grey-600 visible-xs-block" data-toggle="collapse" data-target="#order-info">订单详情 <span class="caret"></span></a></p>
						<?php
						$strr = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
						?>
						<div class="collapse" id="order-info" style="margin-top: 31px;">
							<div class="well margin-bottom-0" style="margin-top: 0px;">
								<p class="margin-bottom-0" >收货 :<span style="margin-left:8px; font-size:12px; font-family: Verdana, Geneva, sans-serif;font-weight: bold;line-height:24px;color: #2f2d2d80;"><?php echo $strr['kd_name'];?> <?php echo $strr['kd_phone'];?>  <?php echo $strr['kd_area'];?>
                 <?php echo $strr['kd_address'];?></span>
               </p>
								<div>
								<p class="margin-bottom-0 margin-top-10" style="float:left;margin-top: 1px !important;">商品 :
								<div style="margin-left:40px; font-size:12px; font-family: Verdana, Geneva, sans-serif;font-weight: bold;line-height:24px;color: #2f2d2d80;margin-top: 15px;">
                                <?php
				        $dosql->Execute(" SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'");
								$i=0;
								while($i<$dosql->GetTotalRow())
								{
								$sows=$dosql->GetArray();
								$i++;
								echo ($i).".".$sows['Title']."&nbsp;<Br>";
								}
			          ?>
								 </div>
								</p>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 text-right pay-order-price">
						应付总额 : <span class="red-600 font-size-20"><?php echo $strs['PayAmount']+$strs['PayJiuQian']+$strs['PayKdMoney'];?>元</span>
						<p class="margin-top-10 hidden-xs"><a href="javascript:void(0)" class="grey-600 margin-left-20" data-toggle="collapse" data-target="#order-info">订单详情 <span class="caret"></span></a></p>
					</div>
          <input name="fee" id="fee" type="hidden" value="<?php echo $strs['PayAmount']+$strs['PayJiuQian']+$strs['PayKdMoney'];?>">
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-body pay-oder-mode">
				<h4 class="panel-title">选择以下支付方式付款</h4>
				<hr>
				<div class="pay-oder-mode-body">
				<!--提交到支付宝里面的数据 payment(0,正常购物 1,补货) -->
				<form name="myform" id="myform" target= "_blank" action="create_direct_pay_by_user-PHP-UTF-8/alipayapi.php" style="float:left;" method="post">
				<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-zhifubao" data-toggle="modal"data-target="#pay-oder-modal" style="border-radius:3px;">
				<input type="hidden" name="WIDout_trade_no" id="WIDout_trade_no" value="<?php echo $strs['OrderId'];?>" />
				<input type="hidden" name="WIDsubject" value="酒易提购买商品订单" />
				<input type="hidden" name="WIDtotal_fee" value="<?php echo $strs['PayAmount']+$strs['PayJiuQian']+$strs['PayKdMoney'];?>" />
        <input type="hidden" name="WIDbody" value="<?php echo $strr['kd_name'];?>的购物清单" />
        <input type="hidden" name="WIDshow_url" value="<?php echo $_SERVER['HTTP_HOST']; ?>/new.php" />
				<?php
				     //通过session将购买商品的方式，快递，补货订单
				   $_SESSION['payment']=0;
					 $_SESSION['orderids']=$cid;
					 $_SESSION['kdmoney']=$strs['PayKdMoney'];

				  ?>
				  <input style="height:56px; width:188px; border-radius:3px;" data-target="#addr-edit-modal" type="image" src="templates/default/images/payOnline_zfb.png" />
					</div>
				</form>

					<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-weixin">
						<a class="pay-online payment-weixin" data-toggle="modal" data-target="#payment-weixin-modal">
            <img style="border-radius:3px;" onclick="creQr($('#WIDout_trade_no').val(),$('#fee').val())" src="templates/default/images/weixinpay.png" /></a>
					</div>

<?php
$readypay=$strs['PayAmount']+$strs['PayJiuQian']+$strs['PayKdMoney'];
$wallet=$strr['JiuQian']; //账号里面的酒钱余额

if($wallet>=$readypay){
?>
<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-balance" data-toggle="collapse" data-target="#balanceinput" disabled>
						余额合计
						<span class="red-600"><?php echo sprintf("%.2f",$strr['JiuQian']);?>元</span>
						<span class="red-600 ">可选择酒钱支付</span>
</div>
<?php }else{?>
  <div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-balance">
  						余额合计
  						<span class="red-600"><?php echo sprintf("%.2f",$strr['JiuQian']);?>元</span>
  						<span class="red-600 ">余额不足</span>
  </div>
<?php }?>
<div class="collapse" id="balanceinput">
					<div class="well margin-bottom-0" style="margin-top: 4px;">
						<form method="post" action="save.php" id="pay-balance" >
							<input name="username" type="hidden" value="<?php echo $commercial;?>">
							<input name="ordertype" type="hidden" value="1">
              <input name="dingdantype" type="hidden" value="2">
              <input name="PaymentType" type="hidden" value="1">
              <input name="PayJiuQian" type="hidden" value="<?php echo $readypay;?>">
              <input name="orderid" type="hidden" value="<?php echo $strs['OrderId'];?>">
              <input name="action" type="hidden" value="walletpay">
              <input name="PayKdMoney" type="hidden" value="<?php echo $strr['KdMoney'];?>">
							<div class="form-group margin-bottom-0">
								<input type="password" name="password" class="form-control" data-fv-notempty="true" placeholder="请输入支付密码  (登录密码)">
							</div>
							<div class="form-group margin-bottom-0">
								<button style="margin-top: 23px;" type="submit" class="btn btn-primary">确定</button>
							</div>
						</form>
					</div>
</div>
					</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade modal-primary" id="payment-weixin-modal" aria-hidden="true" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="modal-content" style="border-top-left-radius: 4px;border-top-right-radius: 4px;">
			<div class="modal-header">
				<button type="button" onclick="return clo();" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">微信扫码支付</h4>
			</div>
			<div class="modal-body text-center">
      <img src="https://wap.jiuyiti.zrcase.com/templates/default/images/WePayLogo.png" style="display:block; margin:0px auto; margin-top:23px;margin-bottom:6px;" width="180px;"/>
    	<img id="qr" src="" style="width:150px;height:150px;"/>
      <span id='newqr' style="font-size: 14px;font-weight: bold;font-family: Verdana, Geneva, sans-serif;height: 500px;"></span>
    	<div id="view" style="margin-left: 10px;margin-top: 14px;color:#038c6f ;font-size:12px;font-weight:bolder;">请打开微信扫一扫</div>
			</div>
		</div>
	</div>
</div>






			</div>
		</div>
	</div>
	</div>
</div>
<!--商家补货--------------------------------------------------------------------------------------------->
<?php }else
 $strs = $dosql->GetOne("SELECT * FROM `orderform_commercial` WHERE Id='$id'");
{?>
<div class="page">
	<div class="container">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body pay-oder-top">
				<div class="row">
					<div class="col-md-2 col-sm-2 text-center">
						<i class="fa fa-check-circle fa-5x" style="font-size: 104px; color:#7dd3ae" aria-hidden="true"></i>
					</div>
					<div class="col-md-7 col-sm-6">
						<h1>补货订单提交成功！去付款咯~</h1>

						<p>请在 <span class="red-600">1小时30分钟</span> 内完成支付, 超时后将在个人中心订单列表查看</p>

						<p>订单号 : <span class="red-600"><?php echo $strs['OrderId'];?></span></p>
						<p><a href="javascript:void(0)" class="grey-600 visible-xs-block" data-toggle="collapse" data-target="#order-info">订单详情 <span class="caret"></span></a></p>
						<?php
						$strr = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
						?>
						<div class="collapse" id="order-info" style="margin-top: 31px;">
							<div class="well margin-bottom-0" style="margin-top: 0px;">
								<p class="margin-bottom-0" >收货 :<span style="margin-left:8px; font-size:12px; fonfont-family: Verdana, Geneva, sans-serif;font-weight: bold;line-height:24px;color: #2f2d2d80;"><?php echo $strr['kd_name'];?> <?php echo $strr['kd_phone'];?> <?php echo $strr['kd_area'];?>  <?php echo $strr['kd_address'];?></span></p>
								<div>
								<p class="margin-bottom-0 margin-top-10" style="float:left;margin-top: 1px !important;">商品 :
								<div style="margin-left:40px; font-size:12px; fonfont-family: Verdana, Geneva, sans-serif;font-weight: bold;line-height:24px;color: #2f2d2d80;margin-top: 15px;">
                                <?php

				                $dosql->Execute(" SELECT * FROM `commodity` a inner join pmw_lsshoppingcart b on a.Id=b.spid WHERE b.orderid='$cid'");
								$i=0;
								while($i<$dosql->GetTotalRow())
								{
								$sows=$dosql->GetArray();
								$i++;
								echo ($i).".".$sows['Title']."&nbsp;<Br>";
								}
			                	?>
								 </div>
								</p>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-4 text-right pay-order-price">
						应付总额 : <span class="red-600 font-size-20"><?php echo $strs['PayAmount']+$strs['PayJiuQian']+$strs['PayKdMoney'];?>元</span>
						<p class="margin-top-10 hidden-xs"><a href="javascript:void(0)" class="grey-600 margin-left-20" data-toggle="collapse" data-target="#order-info">订单详情 <span class="caret"></span></a></p>
					</div>
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-body pay-oder-mode">
				<h4 class="panel-title">选择以下支付方式付款</h4>
				<hr>
				<div class="pay-oder-mode-body">
				<!--提交到支付宝里面的数据 payment(0,正常购物 1,补货) -->
				<form name="myform" id="myform" target= "_blank" action="create_direct_pay_by_user-PHP-UTF-8/alipayapi.php" style="float:left;" method="post">
					<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-zhifubao" data-toggle="modal" data-target="#pay-oder-modal" style="border-radius:3px;">
				  <input type="hidden" name="WIDout_trade_no" value="<?php echo $strs['OrderId'];?>" />
				  <input type="hidden" name="WIDsubject" value="酒易提购买商品订单" />
				  <input type="hidden" name="WIDtotal_fee" value="<?php echo $strs['PayAmount']+$strs['PayJiuQian'];?>" />
                  <input type="hidden" name="WIDbody" value="<?php echo $strr['kd_name'];?>的购物清单" />
                  <input type="hidden" name="WIDshow_url" value="<?php echo $_SERVER['HTTP_HOST']; ?>/new.php" />
				  <?php
				     //通过session将购买商品的方式，快递，补货订单
				   $_SESSION['payment']=0;
					 $_SESSION['orderids']=$cid;
					 $_SESSION['kdmoney']=$strs['PayKdMoney'];
				  ?>
			      <input style="height:56px; width:188px; border-radius:3px;" data-target="#addr-edit-modal" type="image" src="templates/default/images/payOnline_zfb.png" />
					</div>
				</form>

					<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-weixin">
						<a class="pay-online payment-weixin" data-toggle="modal"
   data-target="#payment-weixin-modal">
   <img style="border-radius:3px;" src="templates/default/images/weixinpay.png" /></a>
					</div>
<div class="pay-div btn btn-lg btn-outline btn-default btn-squared pay-oder-balance" data-toggle="collapse" data-target="#balanceinput" disabled>
						余额支付
						<span class="red-600"><?php echo sprintf("%.2f",$strr['JiuQian']);?>元</span>
						<span class="red-600 ">余额不足</span>
					</div>
<div class="collapse" id="balanceinput">
					<div class="well margin-bottom-0" style="margin-top: 4px;">
						<form method="post" action="" id="pay-balance">
							<input name="type" type="hidden" value="balance">
							<input name="id" type="hidden" value="22">
							<div class="form-group margin-bottom-0">
								<input type="password" name="password" class="form-control" data-fv-notempty="true" placeholder="登录密码">
							</div>
							<div class="form-group margin-bottom-0">
								<button style="margin-top: 23px;" type="submit" class="btn btn-primary">确定</button>
							</div>
						</form>
					</div>
				</div>
					</div>
<!-- Modal -->

<!-- Modal -->
<div class="modal fade modal-primary" id="payment-weixin-modal" aria-hidden="true" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="modal-content" style="border-top-left-radius: 4px;border-top-right-radius: 4px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">微信扫码支付</h4>
			</div>
			<div class="modal-body text-center">
      <img src="https://wap.jiuyiti.zrcase.com/templates/default/images/WePayLogo.png" style="display:block; margin:0px auto; margin-top:23px;margin-bottom:6px;" width="180px;"/>
    	<img id="qr" src="" style="width:150px;height:150px;"/>
      <span id='newqr'></span>
    	<div id="view" style="margin-left: 10px;margin-top: 14px;color:#556B2F;font-size:12px;font-weight: bolder;">请打开微信扫一扫</div>
			</div>
		</div>
	</div>
</div>


			</div>
		</div>
	</div>
	</div>
</div>

<?php }?>
<!-- Modal -->
<div class="modal fade modal-default" id="pay-oder-modal" aria-hidden="true" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="modal-content" style="border-radius:3px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title">正在支付...</h4>
			</div>
			<div class="modal-body text-center padding-vertical-0 blue-grey-300">
			   <i class="fa fa-credit-card" aria-hidden="true"  style="font-size:215px"></i>
			</div>
			<div class="modal-footer text-center">
				<a class="btn btn-block btn-lg btn-success btn-squared margin-bottom-20" style="border-radius: 3px;" href="order-1-1.html">支付成功</a>
				<a class="btn btn-block btn-lg btn-danger btn-squared" data-dismiss="modal" style="border-radius: 3px;" href="getlist.php">支付失败</a>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<?php include("footer.php");?>

</body>
</html>
