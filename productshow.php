<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
//初始化参数检测正确性
$cid = empty($cid) ? 5 : intval($cid);
$id  = empty($id)  ? 0 : $id;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,161,58,2,ps01703">
<?php echo GetHeader_product(1,$cid,$id); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>
<script>

  function shopping(commodityid,userid,action)
  {
	var commoditynumber=$("#buynum").val();
	window.location.href="productshow_save.php?commodityid="+commodityid+"&userid="+userid+"&commoditynumber="+ commoditynumber+"&action="+action;
  }

</script>
</head>
</head>
<body class="met-navfixed met-white-lightGallery">
	<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny" role="navigation">
<?php include("head.php");?>
	</nav>

<div class="met-position  pattern-show">
	<div class="container">
		<div class="row">
			<ol class="breadcrumb"><i class="fa fa-home" aria-hidden="true"></i>
			<?php echo GetPosStr($cid,$id); ?>
			</ol>
		</div>
	</div>
</div>

<div class="page met-showproduct pagetype1 animsition">
<?php
$str = $dosql->GetOne("SELECT * FROM `commodity` WHERE Id='$id'")
?>
     <div class="met-showproduct-head">
	<div class="container">
		<div class="row">

		<div class="col-md-7">
				<div class='met-showproduct-list text-center slick-dotted' id="showpro-gallery">
						<div class='slick-slide lg-item-box' style="border-radius: 4px;" data-src="<?php echo $str['Images'];?>" data-exthumbimage="<?php echo $str['Images'];?>">
                            <span>
                                <img style="width: 665px;border-radius: 4px;" src="<?php echo $str['Images'];?>" class="img-responsive" alt="<?php echo $str['Title'];?>"/>
                            </span>
                        </div>

						<?php
					   $pic=json_decode($str['picarr']);
					   for($i=0;$i<count($pic);$i++){
					   $picture=$pic[$i];
					   ?>
                        <div class='slick-slide lg-item-box'>
                        	<span>
                                <img src="<?php echo $picture;?>" class="img-responsive" alt="<?php echo $str['Title'];?>" />
                            </span>
                        </div>
					   <?php }?>

				</div>
			</div>

			<div class="visible-xs-block visible-sm-block height-20"></div>
			<div class="col-md-5 product-intro">
				<h1 style="line-height: 46px;"><?php echo $str['Title'];?></h1>

			<div class="shop-product-intro grey-500">
				<div class="padding-20 bg-grey-100">
					<span id="price" class="red-600">商户价：<?php echo sprintf("%.2f", $str['shprice'])?>元</span><p style="margin: 20px 0 4px">
					指导价：<del style="padding-left:0px;"><?php echo sprintf("%.2f", $str['OldPrice'])?>元</del></p>
				</div>

				<div class="form-group margin-top-15">
				<div>
					<label class="control-label font-weight-unset" style="float: left; line-height:36px;">数量:&nbsp;&nbsp;&nbsp;&nbsp;</label>
					<div class="width-150" style="float:left;">
						<input type="text" class="form-control text-center" data-min="1" data-max="100" data-plugin="touchSpin" name="buynum" id="buynum" autocomplete="off" value="1">
					</div>
					<div class="clearfix"></div>
					</div>
					<p style="line-height: 46px;">库存：1000</del></p>
					<p>销量：<?php echo $str['Num'];?></del></p>
				</div>
				<div class="form-group margin-top-30 purchase-btn">

					<?php
					if(isset($_SESSION['Id'])){
					?>
					<a style="border-radius: 3px;margin-bottom: 12px;" onclick="shopping('<?php echo $id;?>','<?php echo $_SESSION['Id'];?>','add_getlist');" class="btn btn-lg btn-squared btn-danger margin-right-20" >立即购买</a>
					<a style="border-radius: 3px;" onclick="shopping('<?php echo $id;?>','<?php echo $_SESSION['Id'];?>','add');" class="btn btn-lg btn-squared btn-primary"><i class="icon fa-cart-plus font-size-20" aria-hidden="true"></i>加入购物车</a>
					<?php }else{  ?>
					<a style="border-radius: 3px;margin-bottom: 12px;" href="login-1-1.html" class="btn btn-lg btn-squared btn-danger margin-right-20" >立即购买</a>
					<a style="border-radius: 3px;" href="login-1-1.html" class="btn btn-lg btn-squared btn-primary">
					<i class="icon fa-cart-plus font-size-20" aria-hidden="true"></i>加入购物车</a>
					<?php }?>

				</div>
			</div>

			</div>
		</div>
	</div>




	<div class="met-showproduct-body">
		<div class="container">
			<div class="row no-space">

				<div class="col-md-9 product-content-body">
					<div class="row">
					<div class="panel product-detail">

						<div class="panel-body">
						<div class="met-shownews-header" style="text-align:center;" >

					</div>
							<ul class="nav nav-tabs nav-tabs-line met-showproduct-navtabs affix-nav">
								<li class="active"><a data-toggle="tab" href="#product-details" data-get="product-details">详细信息</a></li>

								<li><a data-toggle="tab" href="#product-content1" data-get="product-content1">产品参数</a></li>

							</ul>
							<div class="tab-content">
								<div class="tab-pane met-editor lazyload clearfix  active" id="product-details"><div class="editorlightgallery">
									<div style="text-align:center;">
									<?php
				$content=$str['Details'];
				echo $content;
				?>
									<div id="metinfo_additional"></div></div>
								</div></div>

								<div class="tab-pane met-editor lazyload clearfix " id="product-content1"><div class="editorlightgallery">
									<div style="font-size:14px; color:#e69a09;font-weight:bold;">
									<?php
				$content=$str['canshu'];
				$str1 = $content;
                $str2 = 'src="';
				$str3 = 'src="http://wap.jiuyiti.zrcase.com';
               //strpos 大小写敏感  stripos大小写不敏感    两个函数都是返回str2 在str1 第一次出现的位置
             if(strpos($str1,$str2) === false){     //使用绝对等于
                echo $content;
           }else{
                $contents= str_replace($str2,$str3,$content);
				$c = preg_replace("/style=\"(.*)\"/","",$contents);
                echo $c;
              }
				?>
									<div id="metinfo_additional"></div></div>
								</div></div>

							</div>
						</div>
					</div>

					</div>
				</div>
			<?php //}?>
				<!--右侧开始-->
				<div class="col-md-3">
					<div class="row">
						<div class="panel product-hot" style="margin-top: 50px;">
							<div class="panel-body" style="padding: 11px 30px;">
								<h4 class="example-title">热门推荐</h4>
								<ul class="blocks-2 blocks-sm-3 mob-masonry" data-scale="1">
                <?php
			    $dosql->Execute("SELECT * FROM `commodity` where gd=1 and del='0'");
				$i=0;
				while($i<$dosql->GetTotalRow())
				{
				 $str = $dosql->GetArray();
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
									<li>
										<a href="<?php echo $gourl;?>" class="img" title="<?php echo $str['Title']; ?>">
											<img data-original="<?php echo $picurl; ?>?x-oss-process=image/resize,m_fill,h_250,w_250" class="cover-image" style="display: inline;" alt="<?php echo $str['Title']; ?>" src="<?php echo $picurl; ?>">
										</a>
										<a href="<?php echo $gourl;?>" target="_blank" class="txt" title="<?php echo $str['Title']; ?>"><?php echo $str['Title']; ?></a>
									</li>
<?php }?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<!--右侧结束-->

			</div>
		</div>
	</div>

	</div>
<?php include("footer.php");?>
</body>
</html>
