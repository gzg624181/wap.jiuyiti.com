<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>左侧菜单</title>
<link href="templates/style/menu.css" rel="stylesheet" type="text/css" />
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/tinyscrollbar.js"></script>
<script type="text/javascript" src="templates/js/leftmenu.js"></script>
</head>
<body>
<div class="quickBtn"> <span class="quickBtnLeft"><a href="infolist_add.php" target="main">添列表</a></span> <span class="quickBtnRight"><a href="infoimg_add.php" target="main">添图片</a></span> </div>

<div class="tGradient"></div>
<div id="scrollmenu">
	<div class="scrollbar">
		<div class="track">
			<div class="thumb">
				<div class="end"></div>
			</div>
		</div>
	</div>
	<div class="viewport">
		<div class="overview">
			<!--scrollbar start-->
			<div class="menubox">
				<div class="title on" id="t1" onclick="DisplayMenu('leftmenu01');" title="点击切换显示或隐藏"> 网站系统管理 </div>
				<div id="leftmenu01"> 
				<a href="admin.php" target="main">管理员管理</a>
				<a href="web_config.php" target="main">网站信息配置</a>
				</div>
			</div>
			<div class="hr_5"></div>
			<div class="menubox">
				<div class="title" onclick="DisplayMenu('leftmenu02');" title="点击切换显示或隐藏"> 栏目内容管理 </div>
				<div id="leftmenu02" style="display:none"> 
                <a href="infoclass.php" target="main">栏目管理</a>
                <?php
				//权限验证
	if($cfg_adminlevel != 1)
	{
		//初始化参数
		$catgoryListPriv   = array();
		$catgoryAddPriv    = array();
		$catgoryUpdatePriv = array();
		$catgoryDelPriv    = array();

		$dosql->Execute("SELECT * FROM `#@__adminprivacy` WHERE `groupid`=".$cfg_adminlevel." AND `model`='category'");
		while($row = $dosql->GetArray())
		{
			//查看权限
			if($row['action'] == 'list')
				$catgoryListPriv[]   = $row['classid'];

			//添加权限
			if($row['action'] == 'add')
				$catgoryAddPriv[]    = $row['classid'];

			//修改权限
			if($row['action'] == 'update')
				$catgoryUpdatePriv[] = $row['classid'];

			//删除权限
			if($row['action'] == 'del')
				$catgoryDelPriv[]    = $row['classid'];

		}
	}

		//循环栏目函数
	function Show($id=0, $i=0)
	{
		global $dosql,$cfg_siteid,$cfg_adminlevel,
		       $catgoryListPriv,$catgoryAddPriv,
			   $catgoryUpdatePriv,$catgoryDelPriv;

		$i++;

		 $dosql->Execute("SELECT * FROM `#@__infoclass` WHERE `siteid`='$cfg_siteid' AND `parentid`=$id and infotype <> 0 ORDER BY `orderid` ASC", $id);
		while($row = $dosql->GetArray($id))
		{

			switch($row['infotype'])
			{
				case 1:
					$gourl   = 'infolist.php?cid='.$row['id'];
					break;
				case 2:
					$gourl   = 'infoimg.php?cid='.$row['id'];
					break;
				case 3:
					$gourl   = 'soft.php?cid='.$row['id'];
					break;
				case 4:
					$gourl   = 'goods.php?cid='.$row['id'];
					break;
					
			}


			//设置$classname
			$classname = '';


			//设置空格
			for($n = 1; $n < $i; $n++)
				$classname .= '&nbsp;&nbsp;';


			//设置折叠
			if($row['parentid'] == '0')
		$classname .= '<span id="rowid_'.$row['id'].'" onclick="DisplayRows('.$row['id'].');">';
			else
				$classname .= '<span class="subType">';


			//添加权限
			if($cfg_adminlevel != 1)
			{
				if(in_array($row['id'], $catgoryAddPriv))
				{
	$classname .=  '<a target="main" href="'.$gourl.'" title="点击添加内容">'.$row['classname'].'</a></span>';
				}
				else
				{
	$classname .= '<span title="暂无添加权限哦~">'.$row['classname'].'</span></span>';
				}
			}
			else
			{
				$classname .= $row['classname'].'</span>';
				
			}
	?>
				<a href="<?php echo $gourl;?>" target="main"><?php echo $classname; ?></a>
              <?php
			Show($row['id'], $i+2);
		}
	}
	Show();


	//判断无记录样式
	if($dosql->GetTotalRow(0) == 0)
	{
		echo '<div class="dataEmpty">暂时没有相关的记录</div>';
	}
	
	
	//判断类别页是否折叠
	if($cfg_typefold == 'Y')
	{
		echo '<script>HideAllRows();</script>';
	}
	?>
               <a href="infosrc.php" target="main">信息来源管理</a>
				</div>
			</div>
			<div class="hr_5"></div>
			<div class="menubox">
				<div class="title" onclick="DisplayMenu('leftmenu03');" title="点击切换显示或隐藏"> 模块扩展管理 </div>
				<div id="leftmenu03" style="display:none">
				<!--<a href="member.php" target="main">用户管理</a>-->
				<a href="message_zp.php" target="main">应聘模块管理</a> 
				<a href="weblink.php" target="main">友情链接管理</a>
				<a href="job.php" target="main">招聘模块管理</a> 
				</div>
			</div>
			<!--scrollbar end-->
		</div>
	</div>
</div>
<div class="bGradient"></div>

<div class="copyright"> © 2017 <a href="http://<?php echo $cfg_weburl;?>" target="_blank"><?php echo  $cfg_weburl;?></a><br />
	All Rights Reserved. </div>
<div class="tabMenu">
	<a href="left_menu.php" title="切换到程序菜单" class="name"></a>
</div>
</body>
</html>
