<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
//初始化参数检测正确性
$cid = empty($cid) ? 2 : intval($cid);
?>
<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths tablesaw-enhanced"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style type="text/css" id="alertifyCSS">/* style.css */</style>
<meta name="renderer" content="webkit">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,19,19,1,ps01703">
<?php echo GetHeader(1,$cid); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>
</head>
<body class="met-navfixed">
<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny" role="navigation">
<?php include("head.php");?>
</nav>
<div class="met-banner " data-height="300||" style="height: auto;">
<?php include("banner.php");?>
</div>
<?php include("about_top.php");?>
<?php
if($cid==2){
 ?>
<section class="met-show animsition">
	<div class="container">
		<div class="row">

			<div class="met-editor lazyload clearfix"><div class="editorlightgallery">
				<div><p><img class="imgloading" data-original="<?php echo Pic(3); ?>"  src="<?php echo Pic(3); ?>" style="display: inline;" height="200"></p>

				<p style="line-height: 1.5em;">
				<span style="font-size:14px;"><?php echo Info(3); ?></span></p>
				</div>
			</div></div>
		</div>
	</div>
</section>
<?php }else{
	?>
	<section class="met-show animsition">
		<div class="container">
			<div class="row">

				<div class="met-editor lazyload clearfix"><div class="editorlightgallery">
					<div><p><img class="imgloading" data-original="<?php echo Pic($cid); ?>" src="<?php echo Pic($cid); ?>" style="display: inline;" height="200"></p>

					<p style="line-height: 1.5em;">
					<span style="font-size:14px;"><?php echo Info($cid); ?></span></p>
					</div>
				</div></div>
			</div>
		</div>
	</section>
<?php } ?>
<?php include("footer.php");?>


</body></html>
