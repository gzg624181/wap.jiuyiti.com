
		<div class="moregoods">
			<div class="moregoods-head">
				<h4 class="moregoods-title">购买该商品的用户还购买了</h4>
			</div>
			<div class="moregoods-body">
<div class="row">
<?php
				$dosql->Execute("SELECT * FROM `commodity` WHERE del='0' order by orderid desc limit 0,12");
				$i=0;
				while($i<$dosql->GetTotalRow()){
				$str=$dosql->GetArray();
				$gourl = 'productshow-'.$str['CommodityClass'].'-'.$str['Id'].'-'.$i.'-1.html';
				$picurl=$str['Images'];
				switch($str['CommodityClass'])
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
			$i++;
				?>
<div class="col-md-3 col-sm-4 col-xs-6 moregoods-list" data-plugin="appear" data-animate="fade">
	<div class="text-center box" style="height:250px;">
		<a href="<?php echo $gourl; ?>" target="_blank" class="img" title="<?php echo $str['Title']; ?>"><img style="margin-bottom: 13px; border-radius:3px;" src="<?php echo  $picurl; ?>" class="img-responsive" alt="<?php echo $str['Title']; ?>"></a>
		<a style="line-height:25px; font-weight:bold;color:#987d4a" href="<?php echo $gourl; ?>" target="_blank" class="txt" title="<?php echo $str['Title']; ?>"><?php echo $str['Title']; ?></a>
		<p style="line-height:25px; font-family: Verdana, Geneva, sans-serif;font-weight: bold; color:#f96868;margin-top: 2px;" class="red-600 margin-bottom-0">￥<?php 
					$shprice=$str['shprice'];
					if($shprice!=""){
					echo sprintf("%.2f", $shprice);
					}else{
					echo 0;
					}?>元</p>
	</div>
</div>
				<?php }?>
</div>
			</div>
		</div>
