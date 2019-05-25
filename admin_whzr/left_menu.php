<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧菜单</title>
<link href="templates/style/menu.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<!-- 左侧菜单 -->
<link rel="stylesheet" type="text/css" href="templates/memnu/css/nav.css">
<link rel="stylesheet" type="text/css" href="templates/memnu/font/iconfont.css">

<script type="text/javascript" src="templates/memnu/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/memnu/js/nav.js"></script>

</head>
<body>


<div class="tGradient"></div>
<div id="scrollmenu">

	<div class="viewport">

		<div class="nav">
			<!-- <div class="nav-top">
				<div id="mini" style="border-bottom:1px solid rgba(255,255,255,.1)"><img src="templates/memnu/images/mini.png" ></div>
			</div> -->
			<ul>
				<?php
			$parentid=0;
			$idi=0;
			$ids=1;
			$dosql->Execute("select * from `#@__infoclass_left` where parentid='$parentid' and checkinfo=true order by orderid asc",$idi);
			while($row = $dosql->GetArray($idi)){
			$gourl=$row['linkurl'];
			?>
				<li class="nav-item">
					<a href="javascript:;"><i style="font-size:16px;" class="<?php echo $row['keywords'];?>"></i><span><?php echo $row['classname'];?></span><i class="my-icon nav-more"></i></a>
					<ul>
						<?php
					$pid=$row['id'];
					$dosql->Execute("select * from `#@__infoclass_left` where parentid='$pid' and checkinfo=true order by orderid asc",$ids);
					while($show = $dosql->GetArray($ids)){
					$gourls=$show['linkurl'];
					?>
						<li><a href="<?php echo $gourls;?>" target="main"><span><?php echo $show['classname'];?></span></a></li>
					<?php }?>
					</ul>
				</li>
    <?php }?>

			</ul>
		</div>

	</div>
</div>
<div class="bGradient"></div>
<div class="copyright">@<?php echo $cfg_shortname;?>
</div>

<div class="tabMenu">
	<a href="left_menu_user_simple.php" title="切换到用户菜单" class="model"></a>
</div>
</body>
</html>
