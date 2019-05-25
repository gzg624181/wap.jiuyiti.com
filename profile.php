<?php require_once(dirname(__FILE__).'/include/config.inc.php');
$cid = empty($cid) ? 1 : intval($cid);
 ?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,10001,,10001,ps01703" />
<?php echo GetHeader(); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="templates/default/style/shop.css">
<script src="templates/default/js/jquery.max.js"></script>
<script src="templates/default/js/bootstrap.min.js"></script>
<style>
<script>
window.alert = function(name){
                        var iframe = document.createElement("IFRAME");
                        iframe.style.display="none";
                        iframe.setAttribute("src", 'data:text/plain,');
                        document.documentElement.appendChild(iframe);
                        window.frames[0].window.alert(name);
                        iframe.parentNode.removeChild(iframe);
                    }
</script>
#num{
	font-size:14px;
    font-family:Verdana, Geneva, sans-serif;
	font-weight: bold;
}
.erweima{
	padding: 28px;
   font-size: 12px;
   font-family: Verdana, Geneva, sans-serif;
}
</style>
</head>
<body>
<?php include("nav.php");?>
<div class="page">
	<div class="container">
	<div class="page-content">

	<div class="row">
		<?php include("left.php");?>
	<div class="col-md-9 shop-order shop-profile">
     <div class="widget margin-bottom-0" style="margin-top: 1px;
}">
    <?php
	$commercial=$_SESSION['commercial'];
    $strk = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
	?>
	<div class="widget-header bg-blue-600 text-center padding-30 padding-bottom-15" style="padding: 19px !important;">
		<a class="avatar avatar-100 img-bordered margin-bottom-10 bg-white" href="#" style="width:67px;">
			<img src="templates/default/images/user.png" alt="">
		</a>
		<div class="font-size-20 white"> <?php echo $_SESSION['commercialname'];?></div>

		<div class="grey-300 font-size-14 margin-bottom-20" style="font-size:12px;margin-bottom:0px !important; margin-top:9px;">
		我的酒钱：<span class="counter-number cyan-600" id="num"><a>￥<?php if($strk['JiuQian']==""){echo 0.00;}else{ echo sprintf("%.2f",$strk['JiuQian']);}?></a></span>
		</div>
	</div>
	<?php if($cid==1){ ?>

    <div class="shop-order-keyword">
      <form method="post" action="save.php?action=search">
      <div class="form-group">
        <div class="input-search">
          <button type="submit" class="input-search-btn"><i  class="fa fa-search" aria-hidden="true"></i></button>
          <input  id='num' style="width:100%" type="text" class="form-control" name="tiquma" data-table-search="true" placeholder="请输入提取码">
          <input type="hidden" name="commercial" id="commercial" value="<?php echo $commercial;?>"
        </div>
      </div>
        </form>
    </div>

	<div class="widget-content">
	<ul class="list-group list-group-bordered">
	    <a href="basic-1-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbsp;&nbsp;个人信息<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>

		<a href="profile-2-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-qrcode" aria-hidden="true"></i>&nbsp;&nbsp;推荐二维码<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>
		<a href="basic-2-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-key" aria-hidden="true"></i>&nbsp;&nbsp;账号密码<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>
		<a href="address-1-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;收货地址<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>
		<a href="basic-3-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-cc-visa"></i>&nbsp;&nbsp;申请提现<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>
		<a href="order-1-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-th-list"></i>&nbsp;&nbsp;进货订单<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>
		<a href="basic-4-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-cart-plus" aria-hidden="true"></i>&nbsp;&nbsp;购物车<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>
		<a href="order-3-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-shopping-bag"></i>&nbsp;&nbsp;发货订单<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>
		<a href="order-2-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-bars" aria-hidden="true"></i>&nbsp;&nbsp;发货记录<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>
		<a href="order-2-1.html" class="list-group-item padding-vertical-15">
			<i class="fa fa-share-alt-square" aria-hidden="true"></i>&nbsp;&nbsp;推荐提成<span class="site-menu-arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
		</a>

	</ul>
	</div>
    <?php }else{ ?>
		<div class="widget-content">
		<div class="row no-space padding-vertical-20 padding-horizontal-30 text-center">
			二维码
		</div>
		<?php
		$erweima=$strk['erweima'];
		?>
		<div style="text-align:center"><img style="width:300px; height:300px;" src="<?php echo $erweima;?>"></div>
		<div style="text-align:center;padding:61px;" class="erweima">
		<p>通过微信扫描以上二维码注册的用户即为您的业务员</p>
		<p>您的分享ID为：<span class="erweima" style="font-weight:bold; color:red;"><?php echo $strk['Recommand'];?></span></P>
		<p>用户注册时填写此推荐人ID,即可成为您的业务员</P>
		</div>

	</div>

	<?php }?>
	</div>
			</div>
		</div>
	</div>
	</div>
</div>


<?php include("footer.php");?>

</body>
</html>
