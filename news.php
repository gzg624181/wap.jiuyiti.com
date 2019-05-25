<?php
require_once(dirname(__FILE__).'/include/config.inc.php');

//初始化参数检测正确性
$cid = empty($cid) ? 4 : intval($cid);
?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="renderer" content="webkit">
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,2,,2,ps01703">
<?php echo GetHeader(1,$cid); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>
<script src="https://use.fontawesome.com/86c2dd6c06.js"></script>
</head>
<body class="met-navfixed">
<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny" role="navigation">
<?php include("head.php");?>
</nav>
<div class="met-banner " data-height="300||" style="height: auto;">
<?php include("banner.php");?>
</div>
<section class="met-news animsition ">
    <div class="container">
        <div class="row">

            <div class="col-md-9 met-news-body">
                <div class="row">
                    <div class="met-news-list">

                        <ul class="met-page-ajax" data-scale="0.66666666666667">

				<?php
				if(!empty($keyword))
				{
					$keyword = htmlspecialchars($keyword);

					$sql = "SELECT * FROM `#@__infolist` WHERE (classid=$cid OR parentstr LIKE '%,$cid,%') AND title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY orderid DESC";
				}
				else
				{
					$sql = "SELECT * FROM `#@__infolist` WHERE (classid=$cid OR parentstr LIKE '%,$cid,%') AND delstate='' AND checkinfo=true ORDER BY orderid DESC";
				}

				$dopage->GetPage($sql,8);
				$i=0;
				while($i<$dosql->GetTotalRow())
				{
				$row = $dosql->GetArray();
				$i++;
				$gourl = 'newsshow-'.$row['classid'].'-'.$row['id'].'-1.html';
                 ?>
					<li class="animation-delay-<?php echo $i*100;?>" data-plugin="appear" data-animate="fade" data-repeat="false">
						<h4>
							<a href="<?php echo $gourl; ?>" title="<?php echo $row['title']; ?>"  target="_blank">
								<?php echo $row['title']; ?>
							</a>
						</h4>
						<p class="des"><?php
$content_01 = $row["content"];//从数据库获取富文本content
$content_02 = htmlspecialchars_decode($content_01);//把一些预定义的 HTML 实体转换为字符
$content_03 = str_replace("&nbsp;","",$content_02);//将空格替换成空
$contents = strip_tags($content_03);//函数剥去字符串中的 HTML、XML 以及 PHP 的标签,获取纯文本内容
$con = mb_substr($contents, 0, 100,"utf-8");//返回字符串中的前100字符串长度的字符
echo $con; ?>...</p>
						<p class="info">
							<span><?php echo GetDateTime($row['posttime']); ?></span>
							<span><?php echo $row['source']; ?></span>
							<span><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $row['hits']; ?></span>
						</p>
					</li>
				<?php }?>

                        </ul>

<div class="hidden-xs">
		<?php echo $dopage->GetList(); ?>
		</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="row">

					<div class="met-news-bar">

                        <form method="post" action="news-4-1.html">
                            <div class="form-group">
                                <div class="input-search">
                                    <button type="submit" class="input-search-btn"><i class="fa fa-search" aria-hidden="true"></i> </button>
                                    <input class="form-control" name="keyword" id="keyword" placeholder="Search" type="text">
                                </div>
                            </div>
                        </form>

						<div class="recommend news-list-md">
							<h3>为您推荐</h3>
							<ul class="list-group list-group-bordered">
                <?php

				$dosql->Execute("SELECT * FROM `#@__infolist` WHERE (classid=$cid OR parentstr LIKE '%,$cid,%') AND delstate='' AND checkinfo=true and flag like '%c%' ORDER BY orderid DESC limit 6");
				while($row = $dosql->GetArray())
				{
				 $gourl = 'newsshow-'.$row['classid'].'-'.$row['id'].'-1.html';
                 ?>
								<li class="list-group-item"><a href="<?php echo $gourl;?>" title="<?php echo $row['title'];?>"  target="_blank"><?php echo $row['title'];?></a></li>
				<?php }?>

							</ul>
						</div>

                        <ul class="column">
                            <li><a href="news-4-1.html" title="所有文章"  target="_blank">所有文章</a></li>
<?php
						$pid=4;
						$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
						while($show = $dosql->GetArray()){
						$gourls=$show['linkurl'];
						?>
      <li><a href="<?php echo $gourls;?>" title="<?php echo $show['classname'];?>"><?php echo $show['classname'];?></a></li>
						<?php }?>

                        </ul>

					</div>

                </div>
            </div>

        </div>
    </div>
</section>
<?php include("footer.php");?>
</body>
</html>
