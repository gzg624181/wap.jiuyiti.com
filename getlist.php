<?php require_once(dirname(__FILE__).'/include/config.inc.php');
$cid = empty($cid) ? 1 : $cid;
include('session.php');
$userid=$_SESSION["Id"];
$commercial=$_SESSION["commercial"];
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
<link rel="stylesheet" href="templates/default/style/shop.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>

<script>
/*
 * 级联获取城市
 *
 * @access   public
 * @val      string  选择的省枚举值
 * @input    string  返回的select
 * @return   string  返回的option
 */

function SelProv(val,input)
{
	//alert(val);
	$("#"+input+"_country").html("<option>--</option>");

	$.ajax({
		url : "productshow_save.php?action=getarea&datagroup=area&level=1&areaval="+val,
		type:'get',
		dataType:'html',
		success:function(data){
			$("#"+input+"_city").html(data);
		}
	});
}


/*
 * 级联选择区县
 *
 * @access   public
 * @val      string  选择的市枚举值
 * @input    string  返回的select
 * @return   string  返回的option
 */

function SelCity(val,input)
{
	$.ajax({
		url : "productshow_save.php?action=getarea&datagroup=area&level=2&areaval="+val,
		type:'get',
		dataType:'html',
		success:function(data){
			$("#"+input+"_country").html(data);
		}
	});
}

</script>

</head>
<body class="met-navfixed met-white-lightGallery" style="padding-top: 40px;">
<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny" role="navigation">
<?php include("head.php");?>
</nav>
<?php
if($cid==1){
?>
<div class="page animsition">
	<div class="container">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body pay-body">
				<form action="productshow_save.php" class="pay-form" method="post" >
					<div class="example-wrap margin-bottom-30">
						<div class="example margin-bottom-0">
							<div class="form-group  margin-bottom-0">
							
								<label style="margin-top:54px; width: 92px;" class="pull-left example-title control-label width-150 margin-bottom-15">收货地址</label>
								<?php
							    $strr = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'"); 
								if($strr['kd_name']=="" && $strr['kd_phone']=="" && $strr['kd_area']=="" && $strr['kd_address']==""){
								$prov="湖北省";  //默认湖北省 
								?>
								<input type="hidden" name="get_address" value="000">  <!--  当值为0的时候，则提示添加新的地址         -->
								<div class="pull-left pay-set-body">
									<button data-toggle="modal" data-target="#addr-edit-modal" style="border-radius:3px;" type="button" class="btn btn-outline btn-success btn-squared addr-btn">添加收货地址</button>
								</div>
								<?php }else{
                                $prov=$strr['prov'];								
									?>
								<input type="hidden" name="get_address" value="1">  <!--  当值为1的时候，则提示不需要添加新的地址         -->
							<div class="row addr-body list-group margin-bottom-0">
							 <div class="col-md-3 col-sm-6 addr-list-box margin-top-15" style="margin-left: -20px;margin-top: 0px !important;">
								<a class="list-group-item addr-list hover" data-toggle="modal" data-target="#addr-edit-modal" style="height: 125px;border-color: #deddcf;" href="javascript:void(0)">
								<div class="addr-set btn-group btn-group-xs">
								<h4 class="list-group-item-heading">
									<?php echo $strr['kd_name'];?> <i style="float:right;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</h4>
								<p class="list-group-item-text margin-bottom-5 addr-info">
									<?php echo $strr['kd_phone'];?>
								</p>
								<p class="list-group-item-text addr-info" style="widht:300px;">
									 <?php echo $strr['kd_area']."&nbsp;".$strr['kd_address'];?>
								</p>
								</div>
								</a>
							</div>
                              </div>
		                  <?php }?>
							</div>
			                  
						</div>
					</div>
                  <hr>

					<div class="example-wrap margin-vertical-40">
						<div class="example">
							<div class="form-group">
								<label class="pull-left example-title control-label width-150">支付方式</label>
								<div class="pull-left pay-set-body">

			<div class="pull-left">
            <label for="labelauty-490709"><span class="labelauty-unchecked" style="">在线支付</span></label>
             </div>


								</div>
							</div>
						</div>
					</div>
					<hr>

					<div class="example-wrap margin-vertical-40">
						<div class="example">
							<div class="form-group">
								<label class="pull-left example-title control-label width-150">配送方式</label>
								<div class="pull-left pay-set-body red-600">
									快递配送（<span id="pay-freight">
									<?php
						$srr=$dosql->GetOne("SELECT costmoney FROM `pmw_cascadedata` WHERE dataname='$prov' and datagroup='area' AND level=0");
						if(is_array($srr))
						{
						$kdprice=$srr['costmoney'];
						echo $kdprice;
						}
	                   ?>
									元</span>）
								</div>
							</div>
						</div>
					</div>
					<hr>


					<div class="example-wrap margin-vertical-40">
						<h3 class="example-title"><a href="shoppingcart-1-1.html" class="pull-right padding-right-30 grey-400 font-size-16">返回购物车<span class="site-menu-arrow"></span></a>商品列表</h3>
						<div class="example bg-blue-grey-100">
    <?php
						$dosql->Execute(" SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'");
						$i=0;
				        while($i<$dosql->GetTotalRow())
				        {
						$str=$dosql->GetArray();
						$sl[] = floatval($str['CommodityNumber']);//商品数量
	                    $jg[]= $str['shprice'] * $str['CommodityNumber'];	 //商品总价格
						$gourl = 'productshow-'.$str['CommodityClass'].'-'.$str['CommodityId'].'-'.$i.'-1.html';
						$i++;
				?>	
	<div class="pay-goods-body">
		<div class="row">
			<div class="col-sm-5 col-xs-8">
				<div class="media media-xs">
					<div class="media-left">
						<a href="<?php echo $gourl;?>" target="_blank">
							<img style="border-radius: 4px; vertical-align: middle;" class="media-object" src="<?php echo $str['picurl2']; ?>" alt="<?php echo $str['Title']; ?>">
						</a>
					</div>
					<div class="media-body">
						<h4 style="font-size: 13px; margin-top: 18px;line-height: 23px;" class="media-heading"><a href="<?php echo $gourl;?>" target="_blank"><?php echo $str['Title']; ?></a></h4>
						
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-xs-4 text-nowrap text-right" style="margin-top: 20px;">
				<?php echo sprintf("%.2f", $str['shprice']);?>元 <span class="p-num">x <?php echo $str['CommodityNumber']; ?></span>
			</div>
			<div class="col-sm-3 red-600 text-right hidden-xs" style="margin-top: 20px;">
				<?php 
				$money=$str['shprice'] * $str['CommodityNumber'];
				echo sprintf("%.2f", $money);
				?>元
			</div>
		</div>

	</div>
				<?php }?>
					</div>
					</div>
					<hr>
					<div class="message form-group">
						<textarea style="width: 100%;" class="form-control" rows="3" name="message" placeholder="给商家留言，选填"></textarea>
					</div>
					<hr>
					<div style="float:right;font-size:11px;color:#959595; font-family:Verdana, Geneva, sans-serif;font-weight: bold; padding:5px 0">快递费用：<?php echo sprintf("%.2f", $kdprice);?></div><Br style="clear:both">
					<div style="float:right;font-size:11px;color:#959595; font-family:Verdana, Geneva, sans-serif;font-weight: bold; padding:5px 0">商品总计：<?php 
						$sumers="";
						foreach($jg as $key => $item)
						{
						   $sumers+=$item;	
						}
						echo sprintf("%.2f",$sumers);
						?></div><Br style="clear:both">
						
					<div style="float:right;font-size:11px;color:#959595; font-family:Verdana, Geneva, sans-serif;font-weight: bold; padding:5px 0">商品折扣：-<?php 
					    $dosql->Execute("SELECT * FROM `pmw_discout` order by orderid desc");
						while($s=$dosql->GetArray()){
							if($sumers>$s['rulefirst'] && $sumers<=$s['ruleend']){
								$discout=  sprintf("%.2f",($sumers * $s['ruletubiao'] * 0.01));
							}
						}
						echo $discout;
						?></div>
						
					<div class="pay-submit">
						<div class="row">
							<div class="col-md-9 col-sm-7 text-right" style="width: 100%;float:right;">
								共 <span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;" id="pay-amount" class="red-600"><?php 
						$numers="";
						foreach($sl as $key => $va)
						{
						   $numers += $va;	
						}
						echo $numers;
						?></span> 件商品，合计 : <span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;" id="pay-total" class="red-600">
						<?php echo sprintf("%.2f", ($sumers+$kdprice-$discout));?>
						</span>元
							</div>
							<input type="hidden" name="action" value="get_pay">
							<input type="hidden" name="kdmoney" value="<?php  echo sprintf("%.2f", ($kdprice));?>">
							<input type="hidden" name="payamount" value="<?php  echo sprintf("%.2f", ($sumers+$kdprice-$discout));?>">
						    <input type="hidden" name="userid" value="<?php echo $userid;?>">
							<input type="hidden" name="commercial" value="<?php echo $_SESSION['commercial'];?>">
							<div class="col-md-3 col-sm-5 text-right" style="width: 100%;">
								<button style="border-radius:3px; margin-top: 6px;float:right" type="submit" class="btn btn-lg btn-squared btn-danger padding-horizontal-30">提交订单</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
</div>
<?php }else{ ?>
<div class="page animsition">
	<div class="container">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body pay-body">
				<form action="productshow_save.php" class="pay-form" method="post" >
					<div class="example-wrap margin-bottom-30">
						<div class="example margin-bottom-0">
							<div class="form-group  margin-bottom-0">
							
								<label style="margin-top:54px; width: 92px;" class="pull-left example-title control-label width-150 margin-bottom-15">收货地址</label>
								<?php
							    $strr = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$commercial'"); 
								if($strr['kd_name']=="" && $strr['kd_phone']=="" && $strr['kd_area']=="" && $strr['kd_address']==""){
								$prov="湖北省";  //默认湖北省 
								?>
								<input type="hidden" name="get_address" value="000">  <!--  当值为0的时候，则提示添加新的地址         -->
								<div class="pull-left pay-set-body">
									<button data-toggle="modal" data-target="#addr-edit-modal" style="border-radius:3px;" type="button" class="btn btn-outline btn-success btn-squared addr-btn">添加收货地址</button>
								</div>
								<?php }else{
                                $prov=$strr['prov'];								
									?>
								<input type="hidden" name="get_address" value="1">  <!--  当值为1的时候，则提示不需要添加新的地址         -->
							<div class="row addr-body list-group margin-bottom-0">
							 <div class="col-md-3 col-sm-6 addr-list-box margin-top-15" style="margin-left: -20px;margin-top: 0px !important;">
								<a class="list-group-item addr-list hover" data-toggle="modal" data-target="#addr-edit-modal" style="height: 125px;border-color: #deddcf;" href="javascript:void(0)">
								<div class="addr-set btn-group btn-group-xs">
								<h4 class="list-group-item-heading">
									<?php echo $strr['kd_name'];?> <i style="float:right;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
								</h4>
								<p class="list-group-item-text margin-bottom-5 addr-info">
									<?php echo $strr['kd_phone'];?>
								</p>
								<p class="list-group-item-text addr-info" style="widht:300px;">
									 <?php echo $strr['kd_area']."&nbsp;".$strr['kd_address'];?>
								</p>
								</div>
								</a>
							</div>
                              </div>
		                  <?php }?>
							</div>
			                  
						</div>
					</div>
                  <hr>

					<div class="example-wrap margin-vertical-40">
						<div class="example">
							<div class="form-group">
								<label class="pull-left example-title control-label width-150">支付方式</label>
								<div class="pull-left pay-set-body">

			<div class="pull-left">
            <label for="labelauty-490709"><span class="labelauty-unchecked" style="">在线支付</span></label>
             </div>


								</div>
							</div>
						</div>
					</div>
					<hr>

					<div class="example-wrap margin-vertical-40">
						<div class="example">
							<div class="form-group">
								<label class="pull-left example-title control-label width-150">配送方式</label>
								<div class="pull-left pay-set-body red-600">
									快递配送（<span id="pay-freight">
									<?php
						$srr=$dosql->GetOne("SELECT costmoney FROM `pmw_cascadedata` WHERE dataname='$prov' and datagroup='area' AND level=0");
						if(is_array($srr))
						{
						$kdprice=$srr['costmoney'];
						echo $kdprice;
						}
	                   ?>
									元</span>）
								</div>
							</div>
						</div>
					</div>
					<hr>


					<div class="example-wrap margin-vertical-40">
						<h3 class="example-title"><a href="ordershow-3-<?php echo $cid;?>-1.html" class="pull-right padding-right-30 grey-400 font-size-16">返回补货列表<span class="site-menu-arrow"></span></a>补货商品列表</h3>
						<div class="example bg-blue-grey-100">
    <?php
						$dosql->Execute(" SELECT * FROM `commodity` a inner join pmw_lsshoppingcart b on a.Id=b.spid WHERE b.orderid='$cid'");
						$i=0;
				        while($i<$dosql->GetTotalRow())
				        {
						$str=$dosql->GetArray();
						$sl[] = floatval($str['sl']);//商品数量
	                    $jg[]= $str['shprice'] * $str['sl'];	 //商品总价格
						$gourl = 'productshow-'.$str['CommodityClass'].'-'.$str['spid'].'-'.$i.'-1.html';
						$i++;
				?>	
	<div class="pay-goods-body">
		<div class="row">
			<div class="col-sm-5 col-xs-8">
				<div class="media media-xs">
					<div class="media-left">
						<a href="<?php echo $gourl;?>" target="_blank">
							<img style="border-radius: 4px; vertical-align: middle;" class="media-object" src="<?php echo $str['picurl2']; ?>" alt="<?php echo $str['Title']; ?>">
						</a>
					</div>
					<div class="media-body">
						<h4 style="font-size: 13px; margin-top: 18px;line-height: 23px;" class="media-heading"><a href="<?php echo $gourl;?>" target="_blank"><?php echo $str['Title']; ?></a></h4>
						
					</div>
				</div>
			</div>
			<div class="col-sm-4 col-xs-4 text-nowrap text-right" style="margin-top: 20px;">
				<?php echo sprintf("%.2f", $str['shprice']);?>元 <span class="p-num">x <?php echo $str['sl']; ?></span>
			</div>
			<div class="col-sm-3 red-600 text-right hidden-xs" style="margin-top: 20px;">
				<?php 
				$money=$str['shprice'] * $str['sl'];
				echo sprintf("%.2f", $money);
				?>元
			</div>
		</div>

	</div>
				<?php }?>
					</div>
					</div>
					<hr>
					<div class="message form-group">
						<textarea style="width: 100%;" class="form-control" rows="3" name="message" placeholder="给商家留言，选填"></textarea>
					</div>
					<hr>
					<div style="float:right;font-size:11px;color:#959595; font-family:Verdana, Geneva, sans-serif;font-weight: bold; padding:5px 0">快递费用：<?php echo sprintf("%.2f", $kdprice);?></div><Br style="clear:both">
					<div style="float:right;font-size:11px;color:#959595; font-family:Verdana, Geneva, sans-serif;font-weight: bold; padding:5px 0">商品总计：<?php 
						$sumers="";
						foreach($jg as $key => $item)
						{
						   $sumers+=$item;	
						}
						echo sprintf("%.2f",$sumers);
						?></div><Br style="clear:both">
						
					<div  style="float:right;font-size:11px;color:#959595; font-family:Verdana, Geneva, sans-serif;font-weight: bold; padding:5px 0">商品折扣：-<?php 
					    $dosql->Execute("SELECT * FROM `pmw_discout` order by orderid desc");
						while($s=$dosql->GetArray()){
							if($sumers>$s['rulefirst'] && $sumers<=$s['ruleend']){
								$discout=  sprintf("%.2f",($sumers * $s['ruletubiao'] * 0.01));
							}
						}
						echo $discout;
						?></div>
						
					<div class="pay-submit">
						<div class="row">
							<div class="col-md-9 col-sm-7 text-right" style="width: 100%;float:right;">
								共 <span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;" id="pay-amount" class="red-600"><?php 
						$numers="";
						foreach($sl as $key => $va)
						{
						   $numers += $va;	
						}
						echo $numers;
						?></span> 件商品，合计 : <span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;" id="pay-total" class="red-600">
						<?php echo sprintf("%.2f", ($sumers+$kdprice-$discout));?>
						</span>元
							</div>
							<input type="hidden" name="action" value="get_payshoppingcart">
							<input type="hidden" name="kdmoney" value="<?php  echo sprintf("%.2f", ($kdprice));?>">
							<input type="hidden" name="payamount" value="<?php  echo sprintf("%.2f", ($sumers+$kdprice-$discout));?>">
						    <input type="hidden" name="userid" value="<?php echo $userid;?>">
							<input type="hidden" name="orderids" value="<?php echo $cid;?>">
							<input type="hidden" name="commercial" value="<?php echo $_SESSION['commercial'];?>">
							<div class="col-md-3 col-sm-5 text-right" style="width: 100%;">
								<button style="border-radius:3px; margin-top: 6px;float:right" type="submit" class="btn btn-lg btn-squared btn-danger padding-horizontal-30">提交订单</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
</div>
<?php }?>

<!-- Modal -->
<div class="modal fade modal-primary" id="addr-edit-modal" aria-hidden="true" aria-labelledby="addr-edit-modal" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="modal-content">
			<form action="save.php?action=address_ediet" method="post" class="addr-edit-form">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
					<h4 class="modal-title">修改收货地址</h4>
				</div>
				<div class="modal-body">
				    <input type="hidden" name="userid" value="<?php echo $strr['Commercial'];?>">
					<div class="form-group">
						<input type="text" class="form-control" value="<?php echo $strr['kd_name'];?>" name="kd_name" data-fv-notempty="true" placeholder="收货人姓名">
					</div>
					
					<div class="form-group">
						<input type="text" class="form-control" value="<?php echo $strr['kd_phone'];?>" name="kd_phone" data-fv-notempty="true" placeholder="收货人电话">
					</div>
					<div class="form-group select-linkage">
					
						<select class="form-control prov" name="live_prov" id="live_prov" onchange="SelProv(this.value,'live');"data-fv-notempty="true">
						<option value="-1">请选择</option>
		             <?php
					$dosql->Execute("SELECT * FROM `#@__cascadedata` WHERE `datagroup`='area' AND level=0 ORDER BY orderid ASC, datavalue ASC");
					while($row2 = $dosql->GetArray())
					{
						if($strr['prov']=== $row2['dataname'])
							$selected = 'selected="selected"';
						else
							$selected = '';

						echo '<option value="'.$row2['datavalue'].'" '.$selected.'>'.$row2['dataname'].'</option>';
					}
					?></select>
						<select class="form-control city margin-top-10" name="live_city" id="live_city" onchange="SelCity(this.value,'live');">
						<option value="-1">--</option>
					<?php
					$dosql->Execute("SELECT * FROM `#@__cascadedata` WHERE `datagroup`='area' AND level=1 AND datavalue>".$strr['live_prov']." AND datavalue<".($strr['live_prov'] + 500)." ORDER BY orderid ASC, datavalue ASC");
					while($row2 = $dosql->GetArray())
					{
						if($strr['city'] === $row2['dataname'])
							$selected = 'selected="selected"';
						else
							$selected = '';

						echo '<option value="'.$row2['datavalue'].'" '.$selected.'>'.$row2['dataname'].'</option>';
					}
					?>
						</select>
						<select class="form-control dist margin-top-10" name="live_country" id="live_country">
						<option value="-1">--</option>
					<?php
					$dosql->Execute("SELECT * FROM `#@__cascadedata` WHERE `datagroup`='area' AND level=2 AND datavalue LIKE '".$strr['live_city'].".%%%' ORDER BY orderid ASC, datavalue ASC");
					while($row2 = $dosql->GetArray())
					{
						if($strr['live_street'] === $row2['datavalue'])
							$selected = 'selected="selected"';
						else
							$selected = '';

						echo '<option value="'.$row2['datavalue'].'" '.$selected.'>'.$row2['dataname'].'</option>';
					}
					?>
						</select>
						
					</div>
					<div class="form-group">
<textarea class="form-control" rows="3" name="kd_address" placeholder="详细地址"><?php echo $strr['kd_address'];?></textarea>
					</div>
				</div>
				
				<div class="modal-footer">
				    <input type="hidden" name="orderid" value="<?php echo $cid;?>">
					<button type="submit" class="btn btn-primary">保存</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End Modal -->

<?php include("footer.php");?> 

</body>
</html>
