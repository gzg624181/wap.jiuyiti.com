<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
//初始化参数检测正确性
$cid = empty($cid) ? 15 : intval($cid);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,130,,6,ps01703">
<?php echo GetHeader(1,0,0,'人才招聘'); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script>
function join(title,types)
{
  //alert(title);
  if(types == "PC"){
  layer.open({
  type: 2,
  title: '在线应聘',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['500px' , '680px'],
  content: 'aboutjoin_add_pc.php?title='+title,
  });
  }else if(types=="iphone"){
  layer.open({
  type: 2,
  title: '在线应聘',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['60%' , '600px'],
  content: 'aboutjoin_add.php?title='+title,
  });
  }
}
</script>

</head>
<body class="met-navfixed">
	<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny navbar-shadow animated fadeInDown" role="navigation">
<?php include("head.php");?>
	</nav>

<div class="met-banner " data-height="300||" style="height: auto;">
<?php include("banner.php");?>
</div>

<?php include("about_top.php");?>

<section class="met-job animsition">
	<div class="container">
		<div class="row">
			<div class="met-job-list met-page-ajax">
<?php
					$dopage->GetPage("SELECT * FROM `#@__job` WHERE checkinfo=true ORDER BY orderid DESC",2);
					while($row = $dosql->GetArray())
					{
					$gourl = 'joinshow-'.$row['id'].'.html';

					?>
<div class="about_img" data-animate="zoomIn"  data-plugin="appear" data-repeat="false">
	<div class="widget-body">
		<h3 class="widget-title">
			<?php echo $row['title']; ?>
		</h3>
		<p class="widget-metas">
			<span><?php echo GetDateMk($row['posttime']); ?></span>
			<span><i class="fa fa-map-marker" aria-hidden="true"></i></i>&nbsp;<?php echo $row['jobplace']; ?></span>
			<span><i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;<?php echo $row['employ']; ?></span>
			<span><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;<?php echo $row['treatment']; ?></span>
		</p>
		<hr>
		<div class="met-editor lazyload clearfix" style=" border-radius:5px;"><p>岗位职责：</p><ol class=" list-paddingleft-2" style="list-style-type: decimal;">
		<?php echo $row['workdesc']; ?>
		</ol><p>任职要求：</p>
		<ol class=" list-paddingleft-2" style="list-style-type: decimal;"><?php echo $row['content']; ?></ol></div>
		<hr>
		<div class="widget-body-footer margin-top-0">
			<a class="btn btn-outline btn-squared btn-primary met-job-cvbtn" onclick="return join('<?php echo $row['title'];?>','<?php echo  pc();?>')">在线应聘</a>
		</div>
	</div>
</div>
					<?php }?>

			</div>

<div class="hidden-xs">
		    	<?php echo $dopage->GetList(); ?>
		</div>
		</div>
	</div>
</section>


<?php include("footer.php");?>

</body></html>
<?php
function pc(){
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($userAgent,"iPhone") || strpos($userAgent,"iPad") || strpos($userAgent,"iPod") || strpos($userAgent,"Android")){
return  "iphone";
}else {
return "PC";
}
}
?>
