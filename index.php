<?php require_once(dirname(__FILE__).'/include/config.inc.php'); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19"  data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,10001,,10001,ps01703" />
<link rel="shortcut icon" href="favicon.ico" />
<meta name="360-site-verification" content="5abe4e52a1c1f1f848607b91e5064990" />
<meta name="baidu-site-verification" content="1mL4A9FdJk" />
<?php echo GetHeader(); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/baidu.js"></script>
</head>
<body class="met-navfixed-index">
<nav class="navbar navbar-default met-nav navbar-fixed-top " role="navigation">
<?php include("head.php");?>
</nav>
<!-- 首页轮播图片  -->
<div class="met-banner " data-height='||'>
    <?php
			$dosql->Execute("SELECT * FROM `#@__infoimg` WHERE classid=13 AND delstate='' AND checkinfo=true ORDER BY orderid DESC LIMIT 0,5");
			while($row = $dosql->GetArray())
			{
				if($row['linkurl'] != '')
				$gourl = $row['linkurl'];
				else $gourl = 'javascript:;';
			?>
		<div class="slick-slide">

			<a href="<?php echo $gourl; ?>"  target='_self'>

			<img title="<?php echo $row['title'];?>" class="cover-image" src="<?php echo $row['picurl']; ?>" srcset='<?php echo $row['picurl']; ?>' sizes="(max-width: 767px) 500px">

			</a>

		</div>
			<?php }?>
</div>
<!-- END首页轮播图片  -->
<!-- 红酒学院  -->
	<div class="met-index-service met-index-body">
		<div class="container">
			<h3 class="invisible" data-plugin="appear" data-animate="fade" data-repeat="false">红酒学院</h3>
      <p class="desc invisible animation-delay-100" data-plugin="appear" data-animate="fadeInDown" data-repeat="false">—  school  —</p>

                  <div class="slider invisible animation-delay-300" data-plugin="appear" data-animate="slide-bottom" data-repeat="false" id="serviceSlick" data-show="1 2 4 4 ">
        <?php
	$pid=8;
	$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
	while($show = $dosql->GetArray()){
	$gourls=$show['linkurl'];
	?>
                    <div class="service_item">

    <a target="_blank" href="<?php echo $gourls;?>" title="<?php echo $show['classname'];?>">

                      <img class="img-responsive" alt="<?php echo $show['classname'];?>" src="<?php echo $show['picurl'];?>"
                      />

                      <h4><?php echo $show['classname'];?></h4>
                      <p><?php echo $show['description'];?></p>

                    </a>

                    </div>
	<?php }?>
                  </div>

		</div>
	</div>
<!-- END红酒学院  -->
<!-- 产品展示  -->
	<div class="met-index-product met-index-body">
		<div class="container">
			<h3 class="invisible" data-plugin="appear" data-animate="fade" data-repeat="false">代理产品展示</h3>
				<p class="desc invisible animation-delay-100" data-plugin="appear" data-animate="fadeInDown" data-repeat="false">—  product  —</p>
				<div class='invisible animation-delay-300' data-plugin="appear" data-animate="fadeInUp" data-repeat="false">
				<ul class="nav nav-tabs">
               <?php
				$dosql->Execute("SELECT id,classname FROM `pmw_maintype` where parentid=0 and checkinfo='true' order by orderid asc ");
				while($row=$dosql->GetArray()){
				$classname=$row['classname'];
        if($classname=="酒具"){
          $classname="红酒杯";
        }else{
          $classname.= "代理";
        }
				$gourls = 'product-'.$row['id'].'-1.html';
				?>
				<li>
				<a rel="nofollow" target="_blank" href="<?php echo $gourls;?>" title="<?php echo $classname;?>"><?php echo $classname;?></a>
				</li>
				<?php }?>

				</ul>
				</div>
                  <div class="slider index_product animation-delay-400" id="product_list" data-show="2 2 5 5 " data-plugin="appear" data-animate="slide-bottom" data-repeat="false" >
			<?php

			     $dosql->Execute("SELECT * FROM `commodity` WHERE del='0' order by orderid desc limit 0,6");
                $i=0;
				while($i<$dosql->GetTotalRow())
				{
				$row=$dosql->GetArray();
				 $picurl=$row['Images'];
				 $gourl = 'productshow-'.$row['CommodityClass'].'-'.$row['Id'].'-'.$i.'-1.html';
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
                   <div data-type="list_6" >
                   <div class="widget widget-shadow">
                   <figure class="widget-header cover">
					<a target="_blank" href="<?php echo $gourl; ?>" title="<?php echo $row['Title']; ?>" >
					<div class="mask">
					</div>
                    <img class="img-responsive" alt="<?php echo $row['Title']; ?>" src="<?php echo $picurl; ?>"/>
                    </a>
					</figure>
					<h4 class="widget-title" style="text-align: left;height: 110px;">
					<a href="<?php echo $gourl; ?>" title="<?php echo $row['Title']; ?>" target="_blank"><?php echo ReStrLen($row['Title'],15); ?>代理价格</a>
					<p style="padding-top: 9px;line-height: 16px;"><?php echo $CommodityClass;?>&nbsp;|&nbsp;<?php echo $row['Pinpai']; ?> &nbsp;|&nbsp;<?php echo $row['Types']; ?></p>
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
                    </div>

			<?php  }?>

              <!-- End Example Lazy Loading -->
		</div>

		<a href="product-5-1.html" class="index_more"></a>
		<a href="product-5-1.html" class="more">MORE</a>
	</div>
</div>
    <!-- End 产品展示 -->
	 <!-- 关于我们 -->
	<div class="met-index-about met-index-body">
		<div class="container ">
        <div class="about_img col-sm-12 col-md-4 col-lg-4" data-animate="zoomIn"  data-plugin="appear" data-repeat="false">
        <img style="border-radius:3px; padding-bottom:0px;" data-original="<?php echo Pic(2);?>" /></div>
        <div class="about_cont col-sm-12 col-md-8 col-lg-8">
			<h3 class="invisible" data-plugin="appear" data-animate="fade" data-repeat="false">关于我们</h3>
            <p class="desc invisible animation-delay-100" data-plugin="appear" data-animate="fadeInDown" data-repeat="false" >About us</p>
			<div class="met-editor no-gallery lazyload clearfix invisible animation-delay-300" data-plugin="appear" data-animate="fadeInDown" data-repeat="false">
				<?php echo Info(2);?>
			</div>
            <a target="_blank" href="about-3-1.html" class="more" data-animate="bounceIn"></a>
            </div>
		</div>
	</div>
  <!-- End 关于我们 -->
  <!-- 品酒师 -->
    <div class="met-index-team met-index-body">
        <div class="team_bg">
        <img src="templates/default/images/1502351472.jpg" class="bg_img">
        <div class="container ">
         <div class="slider" id="exampleResponsive">
<?php
			$dosql->Execute("SELECT * FROM `#@__infoimg` WHERE classid=14 AND delstate='' AND checkinfo=true ORDER BY orderid DESC");
			while($row = $dosql->GetArray())
			{
         if($row['picurl'] != '') $picurl = $row['picurl'];
		else $picurl = 'templates/default/images/nofoundpic.gif';
		if($row['linkurl']=='' and $cfg_isreurl!='Y') $gourl = 'aboutshow.php?cid='.$row['classid'].'&id='.$row['id'];
				else if($cfg_isreurl=='Y') $gourl = 'aboutshow-'.$row['classid'].'-'.$row['id'].'-1.html';
				else $gourl = $row['linkurl'];
			?>
            <div class="team_item"   >
            <a href="<?php echo $gourl; ?>" style="background-image:url(<?php echo $picurl; ?>)"></a>
            <div class="team_mask" style="background-image:url(<?php echo $picurl; ?>)"></div>
            <div class="team_cont">
            <p class="team_title"><?php echo $row['title']; ?></p>
            <p class="team_desc"><?php echo $row['description']; ?></p>
            <a target="_blank" href="<?php echo $gourl; ?>" class="team_more">MORE</a>

            </div>
            </div>
				<?php }?>

                  </div>

        </div>
    </div>
    </div>
<!--End 品酒师 -->
<!--新闻资讯 -->
	<div class="met-index-news met-index-body">
		<div class="container">
			<h3 class="invisible" data-plugin="appear" data-animate="fade" data-repeat="false">红酒资讯</h3>
			<p class="desc invisible animation-delay-100" data-plugin="appear" data-animate="fadeInDown" data-repeat="false">—  News  —</p>
			<ul class="blocks-2" data-scale='0.6'>
<?php
			$dosql->Execute("SELECT * FROM `#@__infolist` WHERE (classid=4 OR parentstr LIKE '%,4,%') AND delstate='' AND checkinfo=true  and flag like '%c%'  ORDER BY orderid DESC limit 0,6");
			while($row = $dosql->GetArray())
			{
         if($row['picurl'] != '') $picurl = $row['picurl'];
					else $picurl = 'templates/default/images/nofoundpic.gif';
		if($row['linkurl']=='' and $cfg_isreurl!='Y') $gourl = 'newsshow.php?cid='.$row['classid'].'&id='.$row['id'];
				else if($cfg_isreurl=='Y') $gourl = 'newsshow-'.$row['classid'].'-'.$row['id'].'-1.html';
				else $gourl = $row['linkurl'];
				if($row['id']%2==1){
			?>
				<li class="invisible animation-delay-300" data-plugin="appear" data-animate="fadeInRight" data-repeat="false">
					<div class="media media-lg">

						<div class="media-body">
							<h4 class="media-heading">
							<span class="news_time"><?php echo MyDate('Y-m-d',$row['posttime']); ?></span>
								<a href="<?php echo $gourl; ?>" title="<?php echo $row['title']; ?>" target="_blank" >
									<?php echo $row['title']; ?>
								</a>
							</h4>
								<p class="des" style="line-height:24px;"><?php
$content_01 = $row["content"];//从数据库获取富文本content
$content_02 = htmlspecialchars_decode($content_01);//把一些预定义的 HTML 实体转换为字符
$content_03 = str_replace("&nbsp;","",$content_02);//将空格替换成空
$contents = strip_tags($content_03);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
$con = mb_substr($contents, 0, 100,"utf-8");//返回字符串中的前100字符串长度的字符
echo $con; ?></p>
								<p class="info">
								</p>
						</div>
					</div>
				</li>
			<?php }else{?>
				<li class="invisible animation-delay-300" data-plugin="appear" data-animate="fadeInLeft" data-repeat="false">
					<div class="media media-lg">

						<div class="media-body">
							<h4 class="media-heading">
							<span class="news_time"><?php echo MyDate('Y-m-d',$row['posttime']); ?></span>
								<a href="<?php echo $gourl; ?>" title="<?php echo $row['title']; ?>" target="_blank" >
									<?php echo $row['title']; ?>
								</a>
							</h4>
								<p class="des"><?php
$content_01 = $row["content"];//从数据库获取富文本content
$content_02 = htmlspecialchars_decode($content_01);//把一些预定义的 HTML 实体转换为字符
$content_03 = str_replace("&nbsp;","",$content_02);//将空格替换成空
$contents = strip_tags($content_03);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
$con = mb_substr($contents, 0, 100,"utf-8");//返回字符串中的前100字符串长度的字符
echo $con; ?></p>
								<p class="info">
								</p>
						</div>
					</div>
				</li>
			<?php }}?>
			</ul>
			<a href="news-4-1.html"  class="more" title="新闻资讯" target="_blank"></a>
		</div>
	</div>
<!--End 新闻资讯 -->
<?php include("footer.php");?>
</body>
</html>
