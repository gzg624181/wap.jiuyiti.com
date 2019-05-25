<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

//初始化参数检测正确性
$cid = empty($cid) ? 8 : intval($cid);
$id  = empty($id)  ? 0 : intval($id);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,124,124,1,ps01703">
<?php echo GetHeader(1,$cid,$id); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>
</head>
<body class="met-navfixed">
	<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny navbar-shadow animated fadeInDown" role="navigation">
<?php include("head.php");?>
	</nav>
<div class="met-banner " data-height="300||" style="height: auto;">

		       <?php
		$k=$dosql->GetOne("select * from `#@__infoclass` where id=2 and checkinfo=true");
		?>
<div class="slick-slide">
			<img class="cover-image" src="<?php echo $k['picurl'];?>" sizes="(max-width: 767px) 500px" alt="" style="height: auto;">

			<div class="banner-text p-5">
				<div class="container">
					<div class="banner-text-con">
						<div>
							<h1 style="color:;"><?php echo GetCatName($cid); ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>

</div>

	<?php include("about_top.php");?>

<section class="met-show animsition">
	<div class="container">
		<div class="row">
<?php

			//检测文档正确性
			$r = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE id=$id");
			if(@$r)
			{
			//增加一次点击量
			$dosql->ExecNoneQuery("UPDATE `#@__infoimg` SET hits=hits+1 WHERE id=$id");
			$row = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE id=$id");
			?>
			<div class="met-editor lazyload clearfix"><div class="editorlightgallery">
				<div>
				<p>
				<?php
				if($row['content'] != '')
					echo GetContPage($row['content']);
				else
					echo '网站资料更新中...';
				?>
				</p>
				</div>
			</div></div>
			<?php }	?>
		</div>
	</div>
</section>

<?php include("footer.php");?>
</body></html>
