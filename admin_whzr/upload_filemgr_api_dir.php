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
$keyword = isset($keyword) ? $keyword : '';
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

		//设置读取目录
		$dir = '../'.$dirname;
		//避免中文文件无法读取，强制转换
		$dir = iconv('utf-8', 'gb2312', $dir);

		//打开文件夹
		$handler = opendir($dir);

		$i = 0;
		while(($filename = readdir($handler)) !== false)
		{

			if($filename != '.' && $filename != '..'
			&& $filename != ($dirname=='api/' ? 'index.htm' : ''))
			{

				//用于显示中文目录
				$gbfilename = mb_convert_encoding($filename, 'utf-8', 'gb2312');


				if($cfg_editfile == 'Y')
					$editstr = '<a href="editfile_update.php?filename='.$dirname.urlencode($gbfilename).'"><i title="编辑" class="fa fa-wrench" aria-hidden="true"></i></a>';
				else
					$editstr = '<i style="font-style:normal;" title="不允许直接编辑PHP文件"><i title="编辑" class="fa fa-wrench" aria-hidden="true"></i></i>';


				if(is_dir($dir.$filename))
				{
				//判断数据库中是否存在已经有的接口名称
				$rs=$dosql->GetOne("SELECT * FROM `pmw_api` WHERE filename='$gbfilename'");
				if(!is_array($rs)){
				//向数据库中添加新的接口名称
				$updatetime=date("Y-m-d H:i:s", filemtime($dir.$filename));
			//	$givetime=date("Y-m-d H:i:s"); //上传的时间
				$size=GetRealSize(GetDirSize($dir.$filename));
			  $sql = "INSERT INTO `pmw_api` (filename,size) VALUES ('$gbfilename','$size')";
				$dosql->ExecNoneQuery($sql);
		   	}else{
				$r=$dosql->GetOne("SELECT * FROM `pmw_api` WHERE filename='$gbfilename'");

		?>
		<tr align="left" class="dataTr">
			<td height="36" class="firstCol"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $r['filename']; ?>" disabled="disabled" /></td>
			<td>
			<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold; color:rgba(118,133,131,1)"><?php echo $i+1;?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
		<?php
	    }}
				else
				{
		?>
		<tr align="left" class="dataTr">
			<td height="36" class="firstCol"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $gbfilename; ?>" /></td>
			<td><?php echo $gbfilename; ?></td>
			<td class="number" style="text-align:center;"><span><?php echo date("Y-m-d H:i:s", filemtime($dir.$filename)); ?></span></td>
			<td style="text-align:center;">&nbsp;</td>
			<td style="text-align:center;">&nbsp;</td>
			<td style="text-align:center;"><?php echo GetRealSize(filesize($dir.$filename)); ?></td>
			<td class="action endCol"><span><?php echo $editstr;?> </span> | <span class="nb"><a href="upload_filemgr_api_save.php?mode=dir&action=delfile&dirname=<?php echo urlencode($dirname); ?>&filename=<?php echo urlencode($filename); ?>" onclick="return ConfDel(0);"><i class="fa fa-trash-o" aria-hidden="true"></i></a></span></td>
		</tr>
		<?php
				}
			$i++;
			}
		}
		closedir($handler);
		?>
	</table>
	<input type="hidden" name="dirname" id="dirname" value="<?php echo $dirname; ?>" />
</form>
<?php

//无记录样式
if($i == 0)
{
	echo '<div class="dataEmpty">暂时没有文件</div>';
}
?>
<div class="bottomToolbar"> <span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAll('upload_filemgr_api_save.php','&mode=dir');" onclick="return ConfDelAll(0);">删除</a></span> </div>
<div class="page"> <div class="pageText">共<span><?php echo $i; ?></span>条记录</div> </div>

<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"> <span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAll('upload_filemgr_api_save.php','&mode=dir');" onclick="return ConfDelAll(0);">删除</a></span>

			<span class="pageSmall">
			<div class="pageText">共有<span><?php echo $i; ?></span>条记录</div>
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
