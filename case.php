<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
//初始化参数检测正确性
$cid = empty($cid) ? 8 : intval($cid);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,153,,2,ps01703">
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
<?php include("banner_case.php");?>    
</div>

<section class="met-news animsition ">
    <div class="container">
        <div class="about_img" data-animate="zoomIn"  data-plugin="appear" data-repeat="false">

<ul class="service_list blocks-100 blocks-sm-2 blocks-md-3 blocks-xlg-3  clearfix">
<?php
	$pid=$cid;
	$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
	while($show = $dosql->GetArray()){
	$gourls=$show['linkurl'];
	?>
<li class="service_item">
<a href="<?php echo $gourls;?>" title="<?php echo $show['classname'];?>" target="_self">
<img src="<?php echo $show['picurl'];?>" alt="<?php echo $show['classname'];?>">
<h4><?php echo $show['classname'];?></h4>
<p><?php echo $show['description'];?></p>
</a>
</li>
<?php }?>
</ul>
        </div>
    </div>
</section>
<?php include("footer.php");?>
</body>
</html>