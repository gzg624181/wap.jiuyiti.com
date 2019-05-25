<!--二级导航 -->
<div class="met-footnav text-center met-index-body">
    <div class="container">
		<div class="row mob-masonry">

			<div class="col-md-2 col-sm-3 col-xs-6 list masonry-item">
			<a href="about-2-1.html" title="企业介绍" rel="nofollow" target='_self'>
				<h4>企业介绍</h4>
				<ul>
		   <?php
			$pid=2;
			$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
			for($i=1;$i<=$dosql->GetTotalRow();$i++){
			$show = $dosql->GetArray();
			$gourls=$show['linkurl'];
			?>
					<li class="animation-delay-<?php echo $i*100;?>" data-plugin="appear" data-animate="fade" data-repeat="false"><a  rel="nofollow" href="<?php echo $gourls;?>"  title="<?php echo $show['classname'];?>"><?php echo $show['classname'];?></a></li>
            <?php }?>

				</ul>
				</a>
			</div>

			<div class="col-md-2 col-sm-3 col-xs-6 list masonry-item">
			<a rel="nofollow" href="news-4-1.html" title="红酒资讯" target='_self'>
				<h4>红酒资讯</h4>
				<ul>
<?php
			$pid=4;
			$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
			for($i=1;$i<=$dosql->GetTotalRow();$i++){
			$show = $dosql->GetArray();
			$gourls=$show['linkurl'];
			?>
					<li class="animation-delay-<?php echo $i*100;?>" data-plugin="appear" data-animate="fade" data-repeat="false"><a  rel="nofollow" href="<?php echo $gourls;?>"  title="<?php echo $show['classname'];?>"><?php echo $show['classname'];?></a></li>
<?php }?>
				</ul>
				</a>
			</div>

			<div class="col-md-2 col-sm-3 col-xs-6 list masonry-item">
			<a href="product-5-1.html" title="代理产品" target='_self'  rel="nofollow">
				<h4>代理产品</h4>
				<ul>
<?php
			$pid=5;
			$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
		    for($i=1;$i<=$dosql->GetTotalRow();$i++){
			$show = $dosql->GetArray();
			$gourls=$show['linkurl'];
			?>
					<li class="animation-delay-<?php echo ($i+1)*100;?>" data-plugin="appear" data-animate="fade" data-repeat="false"><a  rel="nofollow" href="<?php echo $gourls;?>"  title="<?php echo $show['classname'];?>"><?php echo $show['classname'];?></a></li>
<?php }?>
				</ul>
				</a>
			</div>

			<div class="col-md-2 col-sm-3 col-xs-6 list masonry-item">
			<a href="case-8-1.html" title="红酒学院" target='_self'  rel="nofollow">
				<h4>红酒学院</h4>
				<ul>
<?php
			$pid=8;
			$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
		    for($i=1;$i<=$dosql->GetTotalRow();$i++){
			$show = $dosql->GetArray();
			$gourls=$show['linkurl'];
			?>
<li  class="animation-delay-<?php echo $i*100;?>" data-plugin="appear" data-animate="fade" data-repeat="false" ><a  rel="nofollow" href="<?php echo $gourls;?>"  title="<?php echo $show['classname'];?>"><?php echo $show['classname'];?></a></li>
<?php }?>
				</ul>
				</a>
			</div>

				<div class="col-md-3 col-ms-12 col-xs-12 info masonry-item" style="width: 27%;">
				<h3 data-plugin="appear" data-animate="fade" data-repeat="false">
				 	<?php echo $cfg_webname;?></h3>
				<div class="clearfix">
				<p class="animation-delay-100" data-plugin="appear" data-animate="fade" data-repeat="false"><?php echo $cfg_address;?></p>
				<p class="animation-delay-200" data-plugin="appear" data-animate="fade" data-repeat="false"><?php echo $cfg_dianaddress;?></p>
				<p class="animation-delay-300" data-plugin="appear" data-animate="fade" data-repeat="false" style="font-family: Verdana, Geneva, sans-serif;">邮箱：<?php echo $cfg_email;?> </p>
				<p class="animation-delay-400" data-plugin="appear" data-animate="fade" data-repeat="false" style="font-family: Verdana, Geneva, sans-serif;">电话：<?php echo $cfg_hotline;?></p>
				<p class="animation-delay-500" data-plugin="appear" data-animate="fade" data-repeat="false" style="font-family: Verdana, Geneva, sans-serif;">周一至周五：9:00-18:00</p>
				<p class="animation-delay-600" data-plugin="appear" data-animate="fade" data-repeat="false"></p>
				<p class="animation-delay-700" data-plugin="appear" data-animate="fade" data-repeat="false"></p>
				</div>

<div class="foot_info_icon" style="margin-top:3px;">
               <?php
			   if(ismobiles()=="PC"){
			   ?>
				<a href="http://wpa.qq.com/msgrd?v=3&uin=546963097&site=oicqzone.com&menu=yes">
					<i class="fa fa-qq"></i>
				</a>
			   <?php }elseif(ismobiles()=="iphone"){
				?>
<a href="mqqwpa://im/chat?chat_type=wpa&uin=546963097 &version=1&src_type=web&web_src=oicqzone.com">
					<i class="fa fa-qq"></i>
				</a>
			   <?php }?>
				<a id="met-weixin"><i class="fa fa-weixin "></i></a>
				<div id="met-weixin-content" class="hide">
					<div class="text-center met-weixin-img"><img src="templates/default/images/xiaochengxu.jpg" /></div>
				</div>

</div>

			</div>
	</div>
</div>
</div>
<!--End 二级导航 -->
<!--友情链接 -->
<div class="met-links text-center">
    <div class="container">
		<ol class="breadcrumb">
			<li>友情链接 :</li>
<?php
	$dosql->Execute("SELECT * FROM `#@__weblink` WHERE classid=1 AND checkinfo=true ORDER BY orderid,id DESC");
	while($row = $dosql->GetArray())
	{
	?>
			<li><a href="<?php echo $row['linkurl']; ?>" title="" target="_blank"><?php echo $row['webname']; ?></a></li>
	<?php
	}
	?>

		</ol>
	</div>
</div>
<!--End 友情链接 -->
<!--版权 -->
<footer>
    <div class="container text-center">
		<p><?php echo $cfg_copyright;?> <?php echo $cfg_icp;?>   Powered by <a style="font-size:13px;color: #848484;" href="http://new.internet-kf.com/" target="_blank"><?php echo $cfg_jishu;?></a>&nbsp;<span style="font-size:13px;color: #848484;"><?php echo $cfg_countcode;?></span>
  <a href="http://webscan.360.cn/index/checkwebsite/url/www.zrcase.com">
    <img title="360网站安全监测" border="0" style="width:60px;" src="http://webscan.360.cn/status/pai/hash/1365c411268ad8e924a52ea65e906756"/></a>
    </p>

    </div>
</footer>
<script>(function(){
var src = (document.location.protocol == "http:") ? "http://js.passport.qihucdn.com/11.0.1.js?47b1b9f3eea630234b57accf388630cc":"https://jspassport.ssl.qhimg.com/11.0.1.js?47b1b9f3eea630234b57accf388630cc";
document.write('<script src="' + src + '" id="sozz"><\/script>');
})();
</script>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
<!--End 版权 -->
<!--回到前面 -->
<button type="button" class="btn btn-icon btn-primary btn-squared met-scroll-top hide">
<i class="fa fa-chevron-up" aria-hidden="true"></i>
</button>
<!-- End回到前面 -->

<?php
function ismobiles(){
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if(strpos($userAgent,"iPhone") || strpos($userAgent,"iPad") || strpos($userAgent,"iPod") || strpos($userAgent,"Android")){
return  "iphone";
}else {
return "PC";
}
}
?>
