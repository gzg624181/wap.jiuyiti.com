<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('infoclass'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>栏目管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
</head>
<body>
<div class="topToolbar"> <span class="title">栏目管理</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="5%" height="36" class="firstCol"><input type="checkbox" name="checkid" onclick="CheckAll(this.checked);" /></td>
			<td width="4%">ID</td>
			<td width="81%">栏目名称</td>
			<td width="10%" align="center">操作</td>
		</tr>
	</table>
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

		$dosql->Execute("SELECT * FROM `#@__infoclass` WHERE `siteid`='$cfg_siteid' AND `parentid`=$id ORDER BY `orderid` ASC", $id);
		while($row = $dosql->GetArray($id))
		{

			switch($row['infotype'])
			{
				case 0:
					$addurl   = 'info_update.php?id='.$row['id'];
					$infotype = ' <i title="栏目属于[单页]类型">[单页]</i>';
					break;  
				case 1:
					$addurl   = 'infolist_add.php?cid='.$row['id'];
					$infotype = ' <i title="栏目属于[列表]类型">[列表]</i>';
					break;
				case 2:
					$addurl   = 'infoimg_add.php?cid='.$row['id'];
					$infotype = ' <i title="栏目属于[图片]类型">[图片]</i>';
					break;
				case 3:
					$addurl   = 'soft_add.php?cid='.$row['id'];
					$infotype = ' <i title="栏目属于[下载]类型">[下载]</i>';
					break;
				case 4:
					$addurl   = 'goods_add.php?cid='.$row['id'];
					$infotype = ' <i title="栏目属于[商品]类型">[商品]</i>';
					break;
				default:
					$r = $dosql->GetOne("SELECT * FROM `#@__diymodel` WHERE `id`=".$row['infotype']);
					if(isset($r) && is_array($r))
					{
						$addurl   = 'modeldata_add.php?m='.$r['modelname'].'&cid='.$row['id'];
						$infotype = ' <i title="栏目属于['.$r['modeltitle'].']类型">['.$r['modeltitle'].']</i>';
					}
					else
					{
						$addurl   = 'javascript:;';
						$infotype = ' 没有获取到类型';
					}
					
			}
            //修改权限
			if($cfg_adminlevel != 1)
			{
				if(in_array($row['id'], $catgoryUpdatePriv))
					$updateStr = '<a href="infoclass_update.php?id='.$row['id'].'">修改</a>';
				else
					$updateStr = '修改';
			}
			else
			{
				$updateStr = '<a href="infoclass_update.php?id='.$row['id'].'">修改</a>';
			}

			//设置$classname
			$classname = '';


			//设置空格
			for($n = 1; $n < $i; $n++)
				$classname .= '&nbsp;&nbsp;';


			//设置折叠
			if($row['parentid'] == '0')
				$classname .= '<span class="minusSign" id="rowid_'.$row['id'].'" onclick="DisplayRows('.$row['id'].');">';
			else
				$classname .= '<span class="subType">';


			//添加权限
			if($cfg_adminlevel != 1)
			{
				if(in_array($row['id'], $catgoryAddPriv))
				{
					$classname .= $row['classname'].'</span>';
					$addStr = '<a href="infoclass_add.php?infotype='.$row['infotype'].'&id='.$row['id'].'">添加子栏目</a>';
				}
				else
				{
					$classname .= '<span title="暂无添加权限哦~">'.$row['classname'].'</span></span>';
					$addStr = '添加子栏目';
				}
			}
			else
			{
				$classname .= $row['classname'].'</span>';
				$addStr = '<a href="infoclass_add.php?infotype='.$row['infotype'].'&id='.$row['id'].'">添加子栏目</a>';
			}
			
			
			//信息类型
			$classname .= '<span class="infoTypeTxt">'.$infotype.'</span>';
	?>
	<div rel="rowpid_<?php echo GetTopID($row['parentstr']); ?>">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
			<tr align="left" class="dataTr">
				<td width="5%" height="36" class="firstCol"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
				<td width="4%"><?php echo $row['id']; ?>
					<input type="hidden" name="id[]" id="id[]" value="<?php echo $row['id']; ?>" /></td>
				<td width="81%"><?php echo $classname; ?></td>
				<td width="10%" align="center">
                <span class="nb">
                <?php if($row['infotype']==0){;?>
                <a href="<?php echo $addurl;?>">编辑内容</a>  | 
                <?php echo $updateStr; ?>  
                <?php }else{;?>
                <a href="<?php echo $addurl;?>">添加内容</a> | 
                <?php echo $updateStr; ?>
                <?php }?>
                </span>
                </td>
			</tr>
		</table>
	</div>
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
</form>
</body>
</html>