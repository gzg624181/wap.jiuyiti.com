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
<link rel="stylesheet" type="text/css" href="htemplates/default/style/metinfo.new.css" />
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="templates/default/style/shop.css">
<script src="templates/default/js/jquery.max.js"></script>
<script src="templates/default/js/bootstrap.min.js"></script>
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
<body>
<?php include("nav.php");?>
<div class="page">
	<div class="container">
	<div class="page-content">

	<div class="row">
	<?php include("left.php");?>
			<div class="col-md-9 shop-order shop-address">
				<div class="panel">
					<div class="panel-body shop-order-body">
				<button type="button" class="btn btn-success addr-btn btn-squared" style="border-radius:3px;">收货地址</button>
				<div class="row addr-body shop-address-body" >
				<div class="example-wrap margin-bottom-30">
						<div class="example margin-bottom-0">
							<div class="form-group  margin-bottom-0">
								<?php
								$commercial=$_SESSION['commercial'];
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
							<div class="row addr-body list-group margin-bottom-0" style="margin-top: 15px; margin-left: 18px;">
							 <div class="col-md-3 col-sm-6 addr-list-box margin-top-15" style="margin-left: -20px;margin-top: 0px !important;">
								<a class="list-group-item addr-list hover" data-toggle="modal" data-target="#addr-edit-modal" style="height: 129px;border-color: #e7e7e7;width: 330px;" href="javascript:void(0)">
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
				</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade modal-primary" id="addr-edit-modal" aria-hidden="true" aria-labelledby="addr-edit-modal" role="dialog" tabindex="-1">
	<div class="modal-dialog modal-center modal-sm">
		<div class="modal-content">
			<form action="save.php?action=address_update" method="post" class="addr-edit-form">
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
