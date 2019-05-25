<?php require_once(dirname(__FILE__).'/include/config.inc.php');
$cid = empty($cid) ? 1 : intval($cid);
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
<link rel="stylesheet" type="text/css" href="http://www.ay91.com.au/app/system/web/user/templates/met/css/metinfo.css" />
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="templates/default/style/site.min.css">




<link rel="stylesheet" href="templates/default/style/shop.css">
<script src="templates/default/js/jquery.max.js"></script>
<script src="templates/default/js/bootstrap.min.js"></script>
<script src="templates/default/js/member.js"></script>
</head>
<body>
     <?php include("nav.php");?>
<div class="page">
	<div class="container">
	<div class="page-content">

	<div class="row">
	<?php include("left.php");?>
	   <?php
		$commercial=$_SESSION['commercial'];
		$ssr = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'");
		?>
		<?php if($cid==1){ ?>
		<div class="col-xs-12 col-sm-9 met-member-index met-member-profile">
<div class="panel panel-default basic">
  <div class="panel-heading" style="height: 40px;padding-top: 0px;line-height: 39px;padding-left:37px;border-top-left-radius: 3px;border-top-right-radius: 3px;">个人信息</div>
  <div class="panel-body" style="padding-bottom:7px;border-bottom-left-radius: 3px;border-bottom-right-radius: 3px;line-height: 50px;">
		<div class="row">
			<div class="col-xs-3">
				会员账号
			</div>
			<div class="col-xs-9">
				<?php echo $ssr['Commercial'];?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				商户名称
			</div>
			<div class="col-xs-9">
				<?php echo $ssr['CommercialName'];?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				会员类型
			</div>
			<div class="col-xs-9">
				<?php echo $ssr['username'];?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				推荐码
			</div>
			<div class="col-xs-9">
				<?php echo $ssr['Recommand'];?>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3">
				自提点类型
			</div>
			<div class="col-xs-9">
				<?php echo $ssr['fenlei'];?>
			</div>
		</div>

  </div>
</div>

<form class="met-form" method="post" action="productshow_save.php">
<div class="panel panel-default">
  <div class="panel-heading"style="height: 40px;padding-top: 0px;line-height: 39px;padding-left:37px;border-top-left-radius: 3px;border-top-right-radius: 3px;">更多资料</div>
    <div class="panel-body" style="padding-bottom:7px;border-bottom-left-radius: 3px;border-bottom-right-radius: 3px;line-height: 50px;">

		<div class="row">
			<div class="col-xs-3" style="padding-top: 5px;">
				店铺地址
			</div>
			<div class="col-xs-9">
				<input type="text" style="margin-top: 15px;" name="CommercialSite" class="form-control" value="<?php echo $ssr['CommercialSite'];?>"  placeholder="店铺地址">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3" style="padding-top: 5px;">
				联系人
			</div>
			<div class="col-xs-9">
				<input type="text" style="margin-top: 15px;" name="Linkman" class="form-control" value="<?php echo $ssr['Linkman'];?>"  placeholder="联系人">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3" style="padding-top: 5px;">
				联系电话
			</div>
			<div class="col-xs-9">
			<input type="text" style="margin-top: 15px;" name="Phone" class="form-control" value="<?php echo $ssr['Phone'];?>"  placeholder="联系电话">
			</div>
		</div>
		<div class="row" style="border-bottom:none;" style="padding:10px;">
			<div class="col-xs-3">
			</div>
			<input type="hidden" name="action" value="update_commercialuser">
			<input type="hidden" name="commercial" value="<?php echo $commercial;?>">
			<div class="col-xs-9">
				<button class="btn btn-primary" type="submit">保存资料</button>
			</div>
		</div>
  </div>

  </div>
</form>
				</div>
		<?php }elseif($cid==2){ ?>
		<div class="col-xs-12 col-sm-9 met-member-safety met-member-profile" style="width:79%;background: #fff;padding: 15px;min-height: 758px;border-radius: 3px;">
<div class="media" style="margin-top: 22px;margin-left: 30px;">
  <div class="media-left media-middle">
    <i class="fa fa-unlock-alt"></i>
  </div>
  <div class="media-body">
		<div class="row">
			<div class="col-xs-8 col-sm-10">
				<h4 class="media-heading">帐号密码</h4>
				用于保护帐号信息和登录安全
			</div>
			<div class="col-xs-4 col-sm-2">
				<button type="button" class="btn btn-default" data-toggle="modal" data-target=".safety-modal-pass">修改</button>
			</div>
		</div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade safety-modal-pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
		<form class="met-form" method="post" action="productshow_save.php">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">密码修改</h4>
      </div>
      <div class="modal-body">
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
				<input type="password"  name="oldpassword" required class="form-control" placeholder="原密码"
					data-bv-notempty="true"
					data-bv-notempty-message="此项不能为空"
				>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
				<input type="password"  name="password" required class="form-control" placeholder="新密码"
					data-bv-notempty="true"
					data-bv-notempty-message="此项不能为空"

					data-bv-identical="true"
					data-bv-identical-field="confirmpassword"
					data-bv-identical-message="两次密码输入不一致"

					data-bv-stringlength="true"
					data-bv-stringlength-min="3"
					data-bv-stringlength-max="30"
					data-bv-stringlength-message="密码必须在6-30个字符之间"
				>
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-unlock-alt"></i></span>
					<input type="password"  name="confirmpassword" required data-password="password" class="form-control" placeholder="重复密码"


					data-bv-identical="true"
					data-bv-identical-field="password"
					data-bv-identical-message="两次密码输入不一致"
					>
				</div>
			</div>
      </div>
      <div class="modal-footer" style="padding: 6px 70px 20px;">
	   <input type="hidden" name="action" value="update_commerpwd">
	   <input type="hidden" name="commercial" value="<?php echo $_SESSION['commercial'];?>">
        <button type="submit" class="btn btn-primary">确定</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
      </div>
		</form>
    </div>
  </div>
</div>
</div>
        <?php }elseif($cid==3){?>
<div class="col-xs-12 col-sm-9 met-member-safety met-member-profile" style="width:79%;background: #fff;padding: 15px;min-height: 758px;border-radius: 3px;">
<form class="met-form" method="post" action="productshow_save.php" >
<div class="panel panel-default">
  <div class="panel-heading"style="height: 40px;padding-top: 0px;line-height: 39px;padding-left:37px;border-radius:3px;">申请提现&nbsp;&nbsp;&nbsp;（账户余额：<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"><?php echo sprintf("%.2f",$ssr['JiuQian']);?></span>元）</div>
    <div class="panel-body" style="padding-bottom:7px;border-bottom-left-radius: 3px;border-bottom-right-radius: 3px;line-height: 50px;">

		<div class="row">
			<div class="col-xs-3" style="padding-top: 5px; padding-left:33px;">
				银行名称
			</div>
			<div class="col-xs-9">
				<input type="text" style="margin-top: 15px;" name="bankname" required class="form-control" value=""  placeholder="银行名称"
				data-bv-notempty="true"
				data-bv-notempty-message="此项不能为空"
				>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3" style="padding-top: 5px; padding-left:33px;">
				银行卡号
			</div>
			<div class="col-xs-9">
				<input type="text" style="margin-top: 15px;" name="bankno" required class="form-control" value=""  placeholder="银行卡号"
				data-bv-notempty="true"
				data-bv-notempty-message="此项不能为空"
				>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3" style="padding-top: 5px; padding-left:33px;">
				开户人名
			</div>
			<div class="col-xs-9">
			<input type="text" style="margin-top: 15px;" name="realname" required class="form-control" value=""  placeholder="开户人名"
			data-bv-notempty="true"
			data-bv-notempty-message="此项不能为空"
			>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-3" style="padding-top: 5px; padding-left:33px;">
				提现金额
			</div>
			<div class="col-xs-9">
			<input type="text" style="margin-top: 15px;" name="applymonery" required class="form-control" value=""  placeholder="提现金额（提现金额必须为10的倍数！）">
			</div>
		</div>
		<div class="row" style="border-bottom:none;" style="padding:10px;">
			<div class="col-xs-3">
			</div>
			<input type="hidden" name="action" value="apply_money">
			<input type="hidden" name="applytime" value="<?php echo date("Y-m-d H:i:s");?>">
			<input type="hidden" name="commercial" value="<?php echo $_SESSION['commercial'];?>">
			<div class="col-xs-9">
				<button class="btn btn-primary" type="submit">确认提交</button>
			</div>
		</div>
  </div>

  </div>
</form>
</div>

		<?php }elseif($cid==4){
			        $userid=$_SESSION["Id"];
					$idd=1;
					$r=$dosql->GetOne("SELECT * FROM `shoppingcart` WHERE UserId='$userid'");
				    $dosql->Execute("SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'",$idd);
					while($row=$dosql->GetArray($idd)){
                    $num_sl[] = floatval($row['CommodityNumber']);//商品数量
	                $sums_sl[]= $row['shprice'] * $row['CommodityNumber'];	 //商品总价格
                    }

			?>
<div class="col-xs-12 col-sm-9 met-member-safety met-member-profile" style="width:79%;background: #fff;padding: 15px;min-height: 758px;border-radius: 3px;">
<?php  if(is_array($r)){?>
<form class="met-form" method="post" action="productshow_save.php" >
<div class="panel panel-default">
  <div class="panel-heading"style="height: 40px;padding-top: 0px;line-height: 39px;padding-left:37px;border-radius:3px;">购物车&nbsp;&nbsp;&nbsp;（共<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"><?php
						$numer="";
						foreach($num_sl as $key => $va)
						{
						   $numer += $va;
						}
						echo $numer;
						?></span>件商品）</div>

						<div class="shop-order-more-body" id="tabs" style="margin-top:20px;">
						<div class="shop-order-list state-1" style="border-radius: 3px;">
						<div class="row shop-order-top" style="margin-top:0px;">
						<div class="col-md-8 col-sm-8 ting" style='padding-top: 1px;'>
						<h4><?php // echo $state;?></h4>
						<span class="info"><?php // echo $ssrg[$i]['CreatTime'];?></span>
						<span class="info">订单总金额 :<span class="price grey-800" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;">￥&nbsp;<?php
						$sumer="";
						foreach($sums_sl as $key => $item)
						{
						   $sumer+=$item;
						}
						echo sprintf("%.2f",$sumer);
						?></span></span>
						<span class="info"><?php // echo  $paymenttype;?></span></div>
						</div>
						<div class="row shop-order-bottom">
						<div class="col-md-7 col-sm-6">
						<?php
					    $ids=2;
					    $dosql->Execute("SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'",$ids);
						$i=0;
				        while($i<$dosql->GetTotalRow($ids))
				        {
						$str=$dosql->GetArray($ids);
						$gourl = 'productshow-'.$str['CommodityClass'].'-'.$str['CommodityId'].'-'.$i.'-1.html';
						$i++;
				        ?>
						<div class="media media-xs margin-top-5">
						<div class="media-left">
						<a href="<?php echo $gourl;?>" target="_blank">
						<img class="media-object" src="<?php  echo $str['picurl2'];?>" alt="<?php echo $str['Title']; ?>"></a>
						</div>
						<div class="media-body"><h4 class="media-heading"><a href="<?php echo $gourl;?>" target="_blank"><?php echo $str['Title']; ?></a></h4><p><?php echo sprintf("%.2f", $str['shprice']);?>元 x <?php echo $str['CommodityNumber']; ?></p></div></div>
						<?php }?>

						</div>
						<div  class="col-md-5 col-sm-6 text-right btn-box">
						<p style="display:block"><a style="border-radius:3px;" href="getlist-1-1.html" class="btn btn-danger btn-squared">立即付款</a></p>
						</div>
						</div>
						</div>

  </div>
</form>
                      <?php }else{ ?>
					  <div class="col-xs-12 col-sm-9 met-member-safety met-member-profile" style="width:100%;background: #fff;padding: 15px;min-height: 758px;border-radius: 3px;">
					  <div class="panel panel-default">
					  <div class="panel-heading"style="height: 40px;padding-top: 0px;line-height: 39px;padding-left:37px;border-radius:3px;">购物车&nbsp;&nbsp;&nbsp;（共<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;">0</span>件商品）</div>
					   <div class="shop-order-more-body"><div class="height-100 vertical-align text-center order-null animation-fade"><div class="vertical-align-middle font-size-18"><a href="product-5-1.html">购物车中还没有商品，赶紧选购吧！</a></div></div></div>
					   </div>
					   </div>
					   <?php }?>
</div>
		<?php }?>

			</div>
		</div>
	</div>
</div>
		</div>
	</div>
	</div>
</div>

<?php include("footer.php");?>
</body>
</html>
