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
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,161,58,2,ps01703">
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
<div class="met-position  pattern-show">
	<div class="container">
		<div class="row">
			<ol class="breadcrumb">
			<?php echo GetPosStr($cid,$id); ?>

			</ol>
		</div>
	</div>
</div>
<section class="met-shownews animsition">
	<div class="container">
		<div class="row">
			<div class="col-md-9 met-shownews-body">
			<?php

			//检测文档正确性
			$r = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE id=$id");
			if(@$r)
			{
			//增加一次点击量
			$dosql->ExecNoneQuery("UPDATE `#@__infoimg` SET hits=hits+1 WHERE id=$id");
			$row = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE id=$id");
			?>
				<div class="row">
					<div class="met-shownews-header">
						<h1><?php echo $row['title']; ?></h1>
						<div class="info">
							<span>
								<?php echo GetDateTime($row['posttime']); ?>
							</span>
							<span>
								<?php echo $row['author']; ?>
							</span>
							<span>
								<i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $row['hits']; ?>
							</span>
						</div>
					</div>
					<div class="met-editor lazyload clearfix"><div class="editorlightgallery">
						<div>
						<?php
				if($row['content'] != '')
					echo GetContPage($row['content']);
				else
					echo '网站资料更新中...';
				?>
						<p><br></p>
						<div class="archive-header">
						 <div class="mbx-dh">
							 本文地址：<span style="font-family:Cambria; text-align: center;font-weight:bold;"><?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?></span>,转载请注明地址！
						 </div>
					 </div>
						<div id="metinfo_additional"></div></div>
						<div class="center-block met_tools_code"></div>
					</div></div>
			<?php }?>
					<div class="met-shownews-footer">

	<ul class="pager pager-round">
	<?php

				//获取上一篇信息
				$r = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE classid=".$row['classid']." AND orderid<".$row['orderid']." AND delstate='' AND checkinfo=true ORDER BY orderid DESC");
				if($r < 1)
				{?>
			<li class="previous disabled">
			<a href="#" title="没有了">上一篇<span aria-hidden="true" class='hidden-xs'>：没有了</span>
			</a>
		    </li>
				<?php
				}
				else
				{
					if($cfg_isreurl != 'Y')
						$rowourl = 'caseshow.php?cid='.$r['classid'].'&id='.$r['id'];
					else
						$rowourl = 'caseshow-'.$r['classid'].'-'.$r['id'].'-1.html';
                ?>

			<li class="previous ">
			<a href="<?php echo $rowourl;?>" title="<?php echo $r['title'];?>">
				上一篇
				<span aria-hidden="true" class='hidden-xs'>：<?php echo $r['title'];?></span>
			</a>
		    </li>
		    <?php } ?>

		 <?php
		//获取下一篇信息
				$r = $dosql->GetOne("SELECT * FROM `#@__infoimg` WHERE classid=".$row['classid']." AND orderid>".$row['orderid']." AND delstate='' AND checkinfo=true ORDER BY orderid ASC");
				if($r < 1)
				{
				?>
			<li class="next disabled">
			<a href="#" title="没有了">
				下一篇
				<span aria-hidden="true" class='hidden-xs'>：没有了</span>
			</a>
		</li>
				<?php }
				else
				{
					if($cfg_isreurl != 'Y')
						$rowourl = 'caseshow.php?cid='.$r['classid'].'&id='.$r['id'];
					else
						$rowourl = 'caseshow-'.$r['classid'].'-'.$r['id'].'-1.html';
                ?>
			<li class="next ">
			<a href="<?php echo $rowourl;?>" title="<?php echo $r['title'];?>">
				下一篇
				<span aria-hidden="true" class='hidden-xs'>：<?php echo $r['title'];?></span>
			</a>
		</li>
				<?php
				}
				?>

	</ul>

					</div>
				</div>
			</div>
<?php include("caselist_right.php");?>
		</div>
	</div>
</section>
<?php include("footer.php");?>
</body>
</html>
