<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
//初始化参数检测正确性
$cid = empty($cid) ? 5 : $cid;
$kid = empty($kid) ? 5 : intval($kid);
switch($cid)
			{
				case 1:
					$kid = '7';
					break;
				case 18:
					$kid = '6';
					break;
				case 39:
					$kid = '18';
					break;
				case 56:
					$kid = '19';
					break;
				case 72:
					$kid = '20';
					break;
			}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,3,,3,ps01703" />
<?php echo GetHeader(1,$kid); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>

<style>
.ho{
	background-color:#e4eaec;
}
</style>
</head>
<body class="met-navfixed">
<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny navbar-shadow animated fadeInDown" role="navigation">
<?php include("head.php");?>
</nav>
<div class="met-banner " data-height="300||" style="height: auto;">
<?php include("banner_product.php");?>
</div>
		<div class="met-column-nav product-search-body bordernone">
			<div class="container">
				<div class="row">

					<div class='invisible animation-delay-100' style="width:75%; float:left;" data-plugin="appear" data-animate="fadeInUp" data-repeat="false">
						<ul class="nav nav-tabs">

							<li><a href="product-5-1.html" class="<?php if($url=="product-5-1.html"){echo "ho";}else{echo "link";}?>" title="全部">全部</a></li>
			    <?php
				$dosql->Execute("SELECT id,classname FROM `pmw_maintype` where parentid=0 and checkinfo='true' order by orderid asc ");
				while($row=$dosql->GetArray()){
				$classname=$row['classname'];
				$gourls = 'product-'.$row['id'].'-1.html';
				?>
							<li>
								<a href="<?php echo $gourls;?>" title="<?php echo $classname;?>" class="<?php if($gourls==$url){echo "ho";}else{echo "link";}?>"><?php echo $classname;?>代理</a>

							</li>
						<?php }?>
						</ul>
					</div>
					<div class="col-md-3 product_search ">
						 <form method="post" action="product-5-1.html">
							<div class="form-group" style="margin-top: 4px;">
								<div class="input-search">
									<button type="submit" class="input-search-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
									<input class="form-control" name="keyword" id="keyword" placeholder="Search" type="text">
								</div>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>

<div class="met-product animsition type-1">
	<div class="container">
        <div class="slider index_product animation-delay-100" id="product_list" data-plugin="appear" data-animate="slide-bottom" data-repeat="false">
            <ul class="blocks-2 blocks-sm-2 blocks-md-4 blocks-xlg-4  met-page-ajax met-grid" id="met-grid" data-scale="1" style="position: relative; height: auto; perspective-origin: 50% 951.5px;">
            <?php
				if(!empty($keyword))
				{
					$keyword = htmlspecialchars($keyword);
					$sql = "SELECT * FROM `commodity` WHERE CommodityClass='$cid' and del='0'   AND title LIKE '%$keyword%' ORDER BY orderid DESC";
				}
				else
				{
					if($cid=='5'){
					$sql = "SELECT * FROM `commodity` WHERE  del='0'  ORDER BY orderid DESC";
					}else{
					$sql = "SELECT * FROM `commodity` WHERE CommodityClass='$cid' and  del='0'  ORDER BY orderid DESC";
					}
				}

				$dopage->GetPage($sql,12);
				$i=0;
				while($i<$dosql->GetTotalRow())
				{
					$row = $dosql->GetArray();
					if($row['Images'] != '') $picurl = $row['Images'];
					else $picurl = 'templates/default/images/nofoundpic.gif';
					switch($row['CommodityClass'])
					{
					case '1':
					 $CommodityClass = '7';
					 break;
					case '18':
					 $CommodityClass = '6';
					 break;
					case '39':
					 $CommodityClass = '18';
					 break;
					case '56':
					 $CommodityClass = '19';
					 break;
					case '72':
					 $CommodityClass = '20';
					 break;
					default:
										 $CommodityClass = '暂无分类';
					}
					$gourl = 'productshow-'.$CommodityClass.'-'.$row['Id'].'-'.$i.'-1.html';
				switch($row['CommodityClass'])
			{
				case '1':
					$CommodityClass = '白酒代理';
					break;
				case '18':
					$CommodityClass = '红酒代理';
					break;
				case '39':
					$CommodityClass = '洋酒代理';
					break;
				case '56':
					$CommodityClass = '啤酒代理';
					break;
				case '72':
					$CommodityClass = '红酒杯';
					break;
				default:
                    $CommodityClass = '暂无分类';

			}
			$i++;
                ?>
				<li class="shown" style="animation-duration: 0.61561s;">
					<div class="widget widget-shadow">
						<figure class="widget-header cover">
							<a href="<?php echo $gourl;?>" title="<?php echo $row['Title']; ?>" target="_blank">
							<div class="mask">
							</div>
								<img class="cover-image" src="<?php echo $picurl;?>" alt="<?php echo $row['Title']; ?>" style="border-radius:3px;">
							</a>
						</figure>
						<h4 class="widget-title" style="text-align: left;height: 110px;">
							<a href="<?php echo $gourl;?>" title="<?php echo $row['Title']; ?>" ><?php echo ReStrLen($row['Title'],14); ?>代理价格</a>
						<p style="padding-top: 9px;line-height:16px; width:280px;"><?php echo $CommodityClass;?>&nbsp;|&nbsp;<?php echo ReStrLen($row['Pinpai'],6); ?> &nbsp;|&nbsp;<?php echo $row['Types']; ?></p>
					<p class="margin-bottom-0 margin-top-5 red-600" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;">￥<?php
					$shprice=$row['shprice'];
					if($shprice!=""){
					echo sprintf("%.2f", $shprice);
					}else{
					echo 0;
					}?>
					元</p>
						</h4>
					</div>
				</li>
                <?php }?>
            </ul>

<div class="hidden-xs" style="text-align:center;">
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}else{
?>
 <div class="hidden-xs">
		    	<?php echo $dopage->GetList(); ?>
</div>
<?php }?>
		</div>
        </div>
	</div>
</div>

<?php include("footer.php");?>
</body></html>
