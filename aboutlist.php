<?php
require_once(dirname(__FILE__).'/include/config.inc.php');
//初始化参数检测正确性
$cid = empty($cid) ? 2 : intval($cid);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,98,98,1,ps01703">
<?php echo GetHeader(1,$cid); ?>
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

		<?php include("banner.php");?>

</div>

		<div class="met-column-nav  ">
			<div class="container">
				<div class="row">

					<div class="col-md-12 sidebar_tile overflow-visible">
						<ul class="met-column-nav-ul">


							<li>

								<a target="_blank" href="about-3-1.html" title="公司简介" class="link ">公司简介</a>

							</li>

							<li class="dropdown">

								<a  target="_blank" href="aboutlist-14-1.html" title="合作伙伴" class="dropdown-toggle link active" data-toggle="dropdown">
									合作伙伴 <span class="caret"></span>
								</a>
								<ul class="dropdown-menu ">


<?php
			$dosql->Execute("SELECT * FROM `#@__infoimg` WHERE classid=14 AND delstate='' AND checkinfo=true ORDER BY orderid DESC");
			while($row = $dosql->GetArray())
			{
         if($row['picurl'] != '') $picurl = $row['picurl'];
		else $picurl = 'templates/default/images/nofoundpic.gif';
		if($row['linkurl']=='' and $cfg_isreurl!='Y') $gourl = 'productshow.php?cid='.$row['classid'].'&id='.$row['id'];
				else if($cfg_isreurl=='Y') $gourl = 'aboutshow-'.$row['classid'].'-'.$row['id'].'-1.html';
				else $gourl = $row['linkurl'];
			?>

									<li><a  target="_blank" href="<?php echo $gourl;?>" title="<?php echo $row['title'];?>"><?php echo $row['title'];?></a></li>
			<?php }?>

								</ul>

							</li>

							<li>

								<a  target="_blank" href="aboutjoin-15-1.html" title="加入我们" class="link ">加入我们</a>

							</li>

						</ul>
					</div>


				</div>
			</div>
		</div>

<section class="met-show animsition">
	<div class="container">
		<div class="about_img" data-animate="zoomIn"  data-plugin="appear" data-repeat="false">

<ul class="team_list blocks-100 blocks-sm-2 blocks-md-3 blocks-xlg-3  clearfix">
 <?php
			$sql = "SELECT * FROM `#@__infoimg` WHERE (classid=$cid OR parentstr LIKE '%,$cid,%') AND delstate='' AND checkinfo=true ORDER BY orderid DESC";
			$dopage->GetPage($sql,6);
				while($row = $dosql->GetArray())
				{
				$gourl = 'aboutshow-'.$row['classid'].'-'.$row['id'].'-1.html';
                ?>
<li class="team_item">
<a href="<?php echo $gourl;?>" title="<?php echo $row['title'];?>" target="_blank">
<div class="team_img">
<img style="border-radius:3px;" src="<?php echo $row['picurl'];?>" alt="<?php echo $row['title'];?>">
</div>
<div class="wrap">
<div><span class="h"></span><span class="v"></span></div>
</div>
</a>
<div class="team_info">
<p class="title"><?php echo $row['title'];?></a></p>
<p class="subtitle"></p>
<p class="desc"><?php echo $row['description'];?></p>
</div>
</li>
			<?php }?>

</ul>
<div class="hidden-xs">
		<?php echo $dopage->GetList(); ?>
		</div>
			<div class="met-editor lazyload clearfix">
				<div></div>
			</div>
		</div>
	</div>
</section>
<?php include("footer.php");?>
</body></html>
