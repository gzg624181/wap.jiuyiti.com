<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('admin'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<script>
function tixian(nickname,username)
{
  // alert(Commercial);
  var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel!=1){
  layer.open({
  type: 2,
  title: '<span style="color:#000;"><b>申请提现</b></span>',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['450px' , '280px'],
  content: 'tixian.php?nickname='+nickname+'&username='+username,
  });
  }
}

</script>
</head>
<body>
<input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $_SESSION['adminlevel'];?>" />
<div class="topToolbar"> <span class="title">管理员管理<?php // echo $_SESSION['adminlevel'];?></span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<?php 
if($_SESSION['adminlevel']==1){
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
	<tr align="left" class="head">
		<td width="2%" height="36">ID</td>
		<td width="11%">用户名</td>
		<td width="11%">管理组</td>
		<td width="10%">联系人</td>
		<td width="8%">酒钱</td>
		<td width="10%">联系电话</td>
		<td width="12%">登录时间</td>
		<td width="12%">登录IP</td>
		<td width="11%"  align="center">登陆城市</td>
		<td width="13%"  align="center">操作</td>
	</tr>
     <?php 
	 $sql = "SELECT * FROM `#@__admin`";
	 $dopage->GetPage($sql,$cfg_pagenum,'ASC');
	 while($row = $dosql->GetArray())
	{
		$r = $dosql->GetOne("SELECT `groupname` FROM `#@__admingroup` WHERE `id`=".$row['levelname']);
		$groupname = isset($r['groupname']) ? $r['groupname'] : '';

		switch($row['checkadmin'])
		{
			case 'true':
				$checkadmin = '已审';
				break;  
			case 'false':
				$checkadmin = '未审';
				break;
			default:
				$checkadmin = '没有获取到参数';
		}

	
		if($row['id'] == 1)
			$checkstr = '已审';
		else
			$checkstr = '<a href="admin_save.php?action=check&id='.$row['id'].'&checkadmin='.$row['checkadmin'].'" title="点击进行审核与未审操">'.$checkadmin.'</a>';


		if($row['id'] == 1)
			$delstr = '删除';
		else
			$delstr = '<a href="admin_save.php?action=del&id='.$row['id'].'" onclick="return ConfDel(0);">删除</a>';
	?>
	 <tr align="left" class="dataTr">
		<td height="36"  align="center"><?php echo $row['id']; ?></td>
		<td align="center"><?php echo $row['username']; ?></td>
		<td  align="center"><?php echo $groupname; ?></td>
		<td  align="center"><?php echo $row['nickname']; ?></td>
		<td  align="center" class="num"><font color="red"><?php echo $row['jiuqian']; ?></font></td>
		<td  align="center"><?php echo $row['phone']; ?></td>
		<td  align="center"><?php echo GetDateTime($row['logintime']); ?></td>
		<td  align="center"><?php echo $row['loginip']; ?></td>
		<td  align="center"><?php echo get_area($row['loginip']);?></td>
		<td  align="center">
        <span><a href="member_admin.php?username=<?php echo $row['username']; ?>">所属会员</a></span> | 
        <span><?php echo $checkstr; ?></span> | 
        <span><a href="admin_update.php?id=<?php echo $row['id']; ?>">修改</a></span> | 
        <span class="nb"><?php echo $delstr; ?></span>
        </td>
	</tr>
	<?php } ?>
</table>

<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="bottomToolbar"> <a href="admin_add.php" class="dataBtn">添加管理员</a> </div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"> <a href="admin_add.php" class="dataBtn">添加管理员</a> <span class="pageSmall">
			<?php echo $dopage->GetList(); ?>
			</span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}}elseif($_SESSION['adminlevel']==2 || $_SESSION['adminlevel']==4){?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
	<tr align="left" class="head">
		<td width="2%" height="36">ID</td>
		<td width="15%">用户名</td>
		<td width="12%">管理组</td>
		<td width="11%">联系人</td>
		<td width="11%">酒钱</td>
		<td width="10%">联系电话</td>
		<td width="14%">登录时间</td>
		<td width="11%">登录IP</td>
		<td width="14%"  align="center">操作</td>
	</tr>
<?php
    $name=$_SESSION['admin'];
	$row=$dosql->GetOne("select * from `#@__admin` where username='$name'");
    $r = $dosql->GetOne("SELECT `groupname` FROM `#@__admingroup` WHERE `id`=".$row['levelname']);
	$groupname = isset($r['groupname']) ? $r['groupname'] : '';

		switch($row['checkadmin'])
		{
			case 'true':
				$checkadmin = '已审';
				break;  
			case 'false':
				$checkadmin = '未审';
				break;
			default:
				$checkadmin = '没有获取到参数';
		}

	
		if($row['id'] == 1)
			$checkstr = '已审';
		else
			$checkstr = $checkadmin;


		if($row['id'] == 1)
			$delstr = '删除';
		else
			$delstr = '删除';	
	?>
	<tr align="left" class="dataTr">
		<td height="36"  align="center"><?php echo $row['id']; ?></td>
		<td align="center"><?php echo $row['username']; ?></td>
		<td  align="center"><?php echo $groupname; ?></td>
		<td  align="center"><?php echo $row['nickname']; ?></td>
		<td  align="center" class="num"><font color="red"><?php echo $row['jiuqian']; ?></font></td>
		<td  align="center"><?php echo $row['phone']; ?></td>
		<td  align="center"><?php echo GetDateTime($row['logintime']); ?></td>
		<td  align="center"><?php echo $row['loginip']; ?></td>
		<td  align="center">
        <span><a title="发货记录" style="cursor:pointer" onclick="tixian('<?php echo $row['nickname']; ?>','<?php echo $row['username']; ?>')">提现</a></span> | 
        <span><?php echo $checkstr; ?></span> | 
        <span><a href="admin_update.php?id=<?php echo $row['id']; ?>">修改</a></span> | 
        <span class="nb"><?php echo $delstr; ?></span>
        </td>
	</tr>
</table>
<div class="topToolbar"  style="margin-top:40px;"> <span class="title">提现记录</span></div>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
            <td width="2%" height="36">ID</td>
			<td width="15%" height="36">用户名</td>
			<td width="12%">姓名</td>
			<td width="11%">银行卡姓名</td>
			<td width="11%">银行卡账号</td>
			<td width="10%">提现金额（元）</td>
			<td width="14%" align="center">申请时间</td>
			<td width="11%" align="center">提现时间</td>
			<td width="14%" align="center">提现状态</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `pickupmoney` where Commercial='$name' and types=1",15);
		$i=0;
		while($i<$dosql->GetTotalRow() and $row = $dosql->GetArray())
		{
			$i++;
		
			switch($row['State'])
			{
				
				case '0':
					$State = "<font color='#FF0000'><B>".'待转账'."</b></font>";
					break;  
				case '1':
					$State = "<font color='#339933'><B>".'已转账'."</b></font>";
					break;
				default:
                    $State = '暂无分类';
				
				}
			switch($row['types'])
			{
				
				case 1:
					$types = "<font color='#0054d2'><B>".'管理员'."</b></font>";
					break;  
				case 0:
					$types = "<font color='#3a09fb'><B>".'商家'."</b></font>";
					break;
				default:
                    $types = '暂无分类';
				
				}
		?>
		<tr align="center" class="dataTr">
            <td><?php echo $i; ?></td>
			<td height="36" ><?php echo $row['Commercial']; ?></td>
			<td><?php  echo $row['RealName']; ?></td>
			<td><?php  echo $row['BankName']; ?></td>
			<td><?php  echo $row['BankNo']; ?></td>
			<td><?php  echo $row['ApplyMonery']; ?></td>
			<td align="center"><?php  echo $row['ApplyTime']; ?></td>
			<td align="center"><?php  echo $row['CreatTime']; ?></td>
			<td align="center"><?php echo $State; ?></td>
		</tr>
		<?php
		}
		?>
	</table>	
   <?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php }?>
</body>
</html>