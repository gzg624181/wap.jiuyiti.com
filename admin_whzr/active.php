<?php require_once(dirname(__FILE__).'/inc/config.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>活动列表管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/listajax.js"></script>
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
function activecontent(id)
{
layer.open({
  type: 2,
  title: '查看活动详情：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['1280px' , '800px'],
  content: 'activecontent.php?id='+id,
  });
}
function activecommercial(daima,firsttime,endtime)
{
layer.open({
  type: 2,
  title: '已报名商户列表：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['1200px' , '700px'],
  content: 'activecommercial.php?daima='+daima+'&firsttime='+firsttime+'&endtime='+endtime,
  });
}
</script>
</head>
<body>
<div class="topToolbar"> <span class="title">所有评论</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<form name="form" id="form" method="post" action="active_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr class="head">
			<td width="1%" height="31" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="13%" align="center">活动标题</td>
			<td width="50%">活动简介</td>
			<td width="5%">活动代码</td>
			<td width="6%">活动起始时间</td>
			<td width="6%">活动截止时间</td>
			<td width="10%">添加时间</td>
			<td width="3%">是否开启</td>
			<td colspan="2">操作</td>
		</tr>
		<?php
		$dopage->GetPage("SELECT * FROM `#@__activelist`",5);
		while($row = $dosql->GetArray())
		{
         switch($row['play']){

				case 0:
					$play = "<font color='#FF0000'><B>"."<i class='fa fa-times' aria-hidden='true'></i>"."</b></font>";
					break;
				case 1:
					$play = "<font color='#339933'><B>"."<i class='fa fa-check' aria-hidden='true'></i>"."</b></font>";
					break;
				default:
                    $play = '暂无分类';

				}
		?>
		<tr class="dataTr">
			<td height="73" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php  echo $row['id']; ?>" /></td>
			<td align="center" valign="middle"><?php  echo $row['title'];?></td>
			<td align="center"><?php  echo $row['introduction'];?></td>
			<td align="center"><?php  echo $row['daima'];?></td>
			<td align="center"><?php  echo $row['firsttime'];?></td>
            <td align="center"><?php  echo $row['endtime'];?></td>
            <td align="center"><?php  echo $row['posttime'];?></td>
			<td align="center"><a style="cursor:pointer;" title="点击切换显示活动" href="active_save.php?id=<?php echo $row['id'];?>&play=<?php echo $row['play'];?>&action=check"><?php  echo $play;?></a></td>
			<td width="3%" align="center">

            <div id="jsddm"><a style="cursor:pointer;" title="查看活动详情" onclick="return activecontent('<?php echo $row['id'];?>')"> <i class="fa fa-paper-plane-o"></i></a></div>

            <div id="jsddm"><a title="查看活动规则" href="rule.php?daima=<?php echo $row['daima'];?>"><i class="fa fa-cogs"></i></a></div>

            <div id="jsddm"><a title="编辑" href="active_update.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil-square-o fa-lg fa-fw" aria-hidden="true"></i></a></div>
            </td>
			      <td width="3%" align="center">

             <div id="jsddm">
               <a style="cursor:pointer;" title="查看已报名商户" onclick="return activecommercial('<?php echo $row['daima'];?>','<?php echo $row['firsttime'];?>','<?php echo $row['endtime'];?>')"> <i class="fa fa-file-text"></i></a></div>
            <div id="jsddm"><a title="推荐统计" href="recommandtj.php?daima=<?php echo $row['daima']; ?>"><i class="fa fa-pie-chart"></i></a></div>
            <div id="jsddm"><a title="删除" href="active_save.php?action=del3&id=<?php echo $row['id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-lg fa-fw" aria-hidden="true"></i></a></div>

            </td>
		</tr>
		<?php
		}
		?>
	</table>
</form>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('business_banner_save.php');" onclick="return ConfDelAll(0);">删除</a></span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
</body>
</html>
