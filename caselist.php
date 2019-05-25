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
<meta name="generator" content="MetInfo 5.3.19" data-variable="https://show.metinfo.cn/muban/ps01703/277/,cn,159,,2,ps01703">
<?php echo GetHeader(1,$cid); ?>
<link rel="stylesheet" href="templates/default/style/metinfo.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.css">
<link rel="stylesheet" href="templates/default/style/font-awesome-4.3.0/css/font-awesome.min.css">
<script src="templates/default/js/shop_lang_cn.js"></script>
<script src="templates/default/js/metinfo.js"></script>
<script src="templates/default/js/shop_v3.js"></script>
<body class="met-navfixed">
<nav class="navbar navbar-default met-nav navbar-fixed-top navbar-ny navbar-shadow animated fadeInDown" role="navigation">
<?php include("head.php");?>
</nav>
<div class="met-banner " data-height="300||" style="height: auto;">
<?php include("banner_case.php");?>
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

					$sql = "SELECT * FROM `#@__infoimg` WHERE (classid=$cid OR parentstr LIKE '%,$cid,%') AND title LIKE '%$keyword%' AND delstate='' AND checkinfo=true ORDER BY orderid DESC";
				}
				else
				{
					$sql = "SELECT * FROM `#@__infoimg` WHERE (classid=$cid OR parentstr LIKE '%,$cid,%') AND delstate='' AND checkinfo=true ORDER BY orderid DESC";
				}

				$dopage->GetPage($sql,5);
				while($row = $dosql->GetArray())
				{
				 $gourl = 'caseshow-'.$row['classid'].'-'.$row['id'].'-1.html';
                 ?>
					<li>
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
            $con = mb_substr($contents, 0, 200,"utf-8");//返回字符串中的前100字符串长度的字符
            echo $con; ?>...</p>
						<p class="info">
							<span><?php echo GetDateTime($row['posttime']); ?></span>
							<span><?php echo $row['author']; ?></span>
							<span><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $row['hits']; ?></span>
						</p>
					</li>

				<?php }?>
                        </ul>
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
<?php include("caselist_right.php");?>
        </div>
    </div>
</section>
<?php include("footer.php");?>
</body>
</html>
