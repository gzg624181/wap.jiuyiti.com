<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('upload_filemgr_sql'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>接口API文件管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
function dir_left(id){
	//alert(id);
	var explain=$("#explain"+id).val();
	var parameter=$("#parameter"+id).val();
	var updatetime=$("#updatetime"+id).val(); ajax_url='upload_filemgr_api_save.php?mode=sql&explain='+explain+'&parameter='+parameter+'&id='+id+'&action='+'dir_left_update'+'&updatetime='+updatetime;
	//alert(ajax_url);
	window.location.href=ajax_url;
	}

	//标题搜索
	   function GetSearchs(){
		 var keyword= document.getElementById("keyword").value;
		if($("#keyword").val() == "")
		{
			alert("请输入搜索内容！");
			$("#keyword").focus();
			return false;
		}
	  window.location.href='api_list.php?keywords='+keyword;
	}
</script>
</head>
<body>
<?php
$keywords = isset($keywords) ? $keywords : '';
if(empty($dirname) or $dirname=='api/')
{
	$dirname = 'api/';
	$dirhigh = 'javascript:;';
	$dirtext = '当前是根目录';
}
else
{
	$dirname = str_replace(array('..\\', '../', './', '.\\'), '', trim($dirname));
	$dirname = htmlspecialchars($dirname);
	$dirhigh = '?dirname=';
	$dirtext = '返回上一层';

	$dirarr = explode('/', $dirname);
	$curnum = count($dirarr)-2;
	for($i=0; $i<$curnum; $i++)
	{
		$dirhigh .= $dirarr[$i].'/';
	}
}
?>
<div class="topToolbar"> <span class="title">接口API文件管理</span>
	<span class="text">[当前目录：<strong>/<?php echo $dirname; ?></strong><span>|</span><a href="<?php echo $dirhigh; ?>" class="topFolder"><?php echo $dirtext; ?></a>]</span>
	 <div class="topToolbar"><a href="javascript:location.reload();" class="reload">刷新</a></div>
 </div>
<div class="toolbarTab">
	<ul>
		<li class="on"><a href="upload_filemgr_api_dir.php">目录模式</a></li>
	</ul>
	<div id="search" class="search"> <span class="s">
<input name="keyword" id="keyword" type="text" class="number" style="font-size:11px;" placeholder="请输入接口文件名称或接口说明或接口参数" title="请输入接口文件名称或接口说明或接口参数" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>

<form name="form" id="form" method="post" action="upload_filemgr_api_save.php">
	<table width="100%" align="center" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="3%" height="36" class="firstCol"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);" /></td>
			<td width="19%">接口文件名称</td>
			<td width="13%">上传日期</td>
			<td width="21%">接口说明</td>
			<td width="29%">接口参数</td>
			<td width="8%">文件大小</td>
			<td width="7%" class="endCol">操作</td>
		</tr>
		<?php
		if($keywords!=""){
			//$dosql->Execute("SELECT * FROM pmw_api where filename like '%$keywords%' or explain like '%$keywords%' or parameter like '%$keywords%'");
		  $dosql->Execute("SELECT * FROM pmw_api where `explain` like '%$keywords%' or `filename` like '%$keywords%' or `parameter` like '%$keywords%'");
			$num=$dosql->GetTotalRow();
		}else{
				$dsoql->Execute("select * from 'pmw_api'");
					$num=$dosql->GetTotalRow();
		}
		while($r=$dosql->GetArray()){
		$filename=$r['filename'];
		$gbfilename = mb_convert_encoding($filename, 'utf-8', 'gb2312');
		?>
		<tr align="left" class="dataTr">
			<td height="36" class="firstCol"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $r['filename']; ?>" disabled="disabled" /></td>
			<td>
			<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold; color:rgba(118,133,131,1)"><?php echo $r['id'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<span class="isdir"><?php echo $r['filename']; ?></span>
		  </td>
			<td class="number" style="text-align: center;"><span><input type="text" name="updatetime<?php echo $r['id'];?>" id="updatetime<?php echo $r['id'];?>" class="inputd" style="width:95%;text-align:center;font-family: Verdana, Geneva, sans-serif;
				font-weight: bold; border-radius:3px; color:#a5a5a5" value="<?php echo $r['updatetime']; ?>" /></span></td>
			<td style="text-align:center;"><input type="text" name="explain<?php echo $r['id'];?>" id="explain<?php echo $r['id'];?>" class="inputd" style="width:95%;text-align:center;font-family: Verdana, Geneva, sans-serif;
				font-weight: bold; border-radius:3px; color:#a5a5a5" value="<?php echo $r['explain']; ?>" />	</td>
			<td style="text-align:center;"><input type="text" name="parameter<?php echo $r['id'];?>" id="parameter<?php echo $r['id'];?>" class="inputd" style="width:100%;text-align:center;font-family: Verdana, Geneva, sans-serif;
font-weight: bold; border-radius:3px;color:#a5a5a5" value="<?php echo $r['parameter']; ?>" /></td>

			<td style="text-align:center;"><?php echo $r['size']; ?></td>

			<td class="action endCol">
            <span><a style="cursor:pointer; text-decoration:none;" onclick="return dir_left('<?php echo $r['id'];?>');"><i title="更新" class="fa fa-refresh" aria-hidden="true"></i></a></span>
			<span><a href="upload_filemgr_api_dir.php?dirname=<?php echo urlencode($dirname.$gbfilename.'/'); ?>"><i  title="进入"  class="fa fa-sign-in" aria-hidden="true"></i></a></span>
			<span class="nb">
			<a href="editfile_update.php?filename=<?php echo $dirname.urlencode($filename); ?>/index.php"> <i  title="代码编辑" class="fa fa-location-arrow"></i></a></span>
		</td>
		</tr>
	<?php }?>
	</table>
	<input type="hidden" name="dirname" id="dirname" value="<?php echo $dirname; ?>" />
</form>
<?php

//无记录样式
if($num == 0)
{
	echo '<div class="dataEmpty">暂时没有文件</div>';
}
?>
<div class="bottomToolbar"> <span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAll('upload_filemgr_api_save.php','&mode=dir');" onclick="return ConfDelAll(0);">删除</a></span> </div>
<div class="page"> <div class="pageText">共<span><?php echo $num; ?></span>条记录</div> </div>

<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"> <span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAll('upload_filemgr_api_save.php','&mode=dir');" onclick="return ConfDelAll(0);">删除</a></span>

			<span class="pageSmall">
			<div class="pageText">共有<span><?php echo $num; ?></span>条记录</div>
			</span>

		</div>

		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
<div class="formSubBtn" style="text-align:right;">
	<input type="button" class="back" value="返回" onclick="history.go(-1);" />
</div>
</body>
</html>
