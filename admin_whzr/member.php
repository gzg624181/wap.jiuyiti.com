<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php');
$username=$_SESSION['admin'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员管理</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="layer/layer.js"></script>
<script>
function message(Id){
  // alert(Id);
   layer.ready(function(){ //为了layer.ext.js加载完毕再执行
   layer.photos({
   photos: '#layer-photos-demo_'+Id,
	 area:['300px','270px'],  //图片的宽度和高度
   shift: 0 ,//0-6的选择，指定弹出图片动画类型，默认随机
   closeBtn:1,
   offset:'40px',  //离上方的距离
   shadeClose:false
  });
});
}
function business(Account)
{
  // alert(Commercial);
  var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){
  layer.open({
  type: 2,
  title: '<span style="color:#000;"><b>添加店铺优惠券</b></span>',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['450px' , '250px'],
  content: 'quan_addlist.php?account='+Account,
  });
  }else{
  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
  }
}
//男，女，搜索
  function checkinfo(key){
     var v= key;
	// alert(v)
	window.location.href='member.php?check='+v;
	}
//标题搜索
   function GetSearchs(){
	 var keyword= document.getElementById("keyword").value;
	if($("#keyword").val() == "")
	{
		layer.alert("请输入搜索内容！",{icon:2});
		$("#keyword").focus();
		return false;
	}
  window.location.href='member.php?keyword='+keyword;
}
function erweima_tuijian(Account)
{
layer.open({
  type: 2,
  title: '推荐二维码：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['500px' , '385px'],
  content: 'erweima_tuijian.php?Account='+Account,
  });
}
function recommand_huiyuan(classes,Account,recommand)
{
layer.open({
  type: 2,
  title: '推荐记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'recommand_huiyuan.php?Account='+Account+'&Recommand='+recommand+'&classes='+classes,
  });
}
function tuijian_shopping(recommand)
{
layer.open({
  type: 2,
  title: '会员推荐消费记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'tuijian_shopping.php?Recommand='+recommand,
  });
}
function shopping(Account)
{
layer.open({
  type: 2,
  title: '会员购买记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'shopping.php?Account='+Account,
  });
}
function member_update(Id){
 var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel==1){
	  window.location("member_update.php?id="+Id);
    }else{
	  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
		}
	}

function del_member(){
 var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel!=1){
	  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
  }
	}
</script>


<?php
//初始化参数
$action  = isset($action)  ? $action  : '';
$keyword = isset($keyword) ? $keyword : '';
$check = isset($check) ? $check : '';
$username=$_SESSION['admin'];
$adminlevel=$_SESSION['adminlevel'];
$r=$dosql->GetOne("select * from pmw_admin where username='$username'");
$live_city=$r['live_city'];
//echo $username;
//echo $adminlevel;
//echo $live_city;

?>
</head>
<body>
<?php
$one=1;
$dosql->Execute("SELECT * FROM `memberuser`",$one);
$num=$dosql->GetTotalRow($one);
?>
<input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $adminlevel;?>" />
<div class="topToolbar"> <span class="title">会员合计：<span class="num" style="color:red;"><?php echo $num;?></span>
</span> <a href="javascript:location.reload();" class="reload">刷新</a><a onClick="return confirm('确认更新所有会员缓存？');"   style="width:100px; color:#e44410;font-weight: bold;" href="member_save.php?action=update_cache" class="reload">更新会员缓存</a></div>
<div class="toolbarTab" style="margin-bottom:-12px;">
	<div id="search" class="search"> <span class="s">
<input name="keyword" id="keyword" type="text" class="number" style="font-size:11px;" placeholder="请输入用户账号或者昵称" title="请输入用户账号或者昵称" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>
<?php
if($_SESSION['adminlevel']==1 || $_SESSION['adminlevel']==2){ ?>
<form name="form" id="form" method="post" action="member_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="4%" align="center">用户账号</td>
			<td width="7%" align="center">头像</td>
			<td width="7%" align="center">昵称</td>
			<td width="9%">手机</td>
			<td width="6%">推荐码</td>
			<td width="6%" align="center">推荐人</td>
			<td width="6%" align="center">最后登陆省份</td>
			<td width="9%" align="center">最后登陆城市</td>
			<td width="8%" align="center">登陆设备码</td>
			<td width="7%" align="center">本月奖励</td>
			<td width="8%" align="center">酒钱余额</td>
			<td width="8%" align="center">登陆设备</td>
			<td width="8%" align="center">注册时间</td>
			<td width="3%" align="left">操作</td>
		</tr>
		<?php
		if($_SESSION['adminlevel']==1){
		if($check=="today"){
		$time=date("Y-m-d");
		$dopage->GetPage("select * from `memberuser` where CreatTime like '%$time%'",15);
	     	}elseif($check=="tomorrowzhuce"){
		$time=date("Y-m-d",strtotime("-1 day"));
		$dopage->GetPage("select * from `memberuser` where CreatTime like '%$time%'",15);
	     	}elseif($keyword!=""){
	    $dopage->GetPage("SELECT * FROM `memberuser` where Account like '%$keyword%' or Alias  like '%$keyword%' ",15);
				}else{
		$dopage->GetPage("SELECT * FROM `memberuser`",15);
				}
		}elseif($_SESSION['adminlevel']==2){
		if($check=="man"){
		$dopage->GetPage("SELECT * FROM `memberuser` where sex='男' and city='$live_city'",15);
			}elseif($check=="woman"){
		$dopage->GetPage("SELECT * FROM `memberuser` where sex='女' and city='$live_city'",15);
	     	}elseif($check=="today"){
		$time=date("Y-m-d");
		$dopage->GetPage("select * from `memberuser` where CreatTime like '%$time%'  and city='$live_city'",15);
	     	}elseif($keyword!=""){
		$dopage->GetPage("SELECT * FROM `memberuser` where city='$live_city' and Account like '%$keyword%' or Alias  like '%$keyword%'",15);
			}else{
		$dopage->GetPage("SELECT * FROM `memberuser` where city='$live_city'",15);
			}
		}

		while($row = $dosql->GetArray())
		{
			switch($row['devicetype'])
			{
				case '1':
					$devicetype = '小程序';
					break;
				case '0':
					$devicetype = 'Android';
					break;

			}
			if($row['Image']==""){
			$Image="../templates/default/images/noimage.jpg";
		    }else{
            if(strpos($row['Image'],'uploads') !== false){
            $Image="../".$row['Image'];
            }else{
            $Image=$row['Image'];
            }
            }
		$Yaoqingma=$row['Yaoqingma'];
		$classes=$row['classes'];
		?>
		<tr align="left" class="dataTr">
			<td height="97" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td align="center"><?php echo $row['Account']; ?></td>
			<td align="center">
          <div id="layer-photos-demo_<?php  echo $row['Id'];?>" class="layer-photos-demo">
        <img  width="100px;" layer-src="<?php echo $Image;?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="<?php echo $Image;?>" alt="<?php echo $row['Alias']; ?>" />
        </div>
      </td>
			<td align="center"><?php echo $row['Alias']; ?></td>
			<td align="center"><?php echo $row['Account']; ?></td>
			<td align="center"><?php echo $row['Recommand']; ?></td>
			<td align="center"><a style=" cursor:pointer" onclick="recommand_huiyuan('<?php echo $classes; ?>','<?php echo tel($Yaoqingma,$classes);?>','<?php echo $Yaoqingma; ?>')" title="推荐人电话：<?php echo tel($Yaoqingma,$classes);?>">
			<?php echo tjr($Yaoqingma,$classes);?></a>
			</td>
			<td align="center"><?php echo $row['prov']; ?></td>
			<td align="center" ><?php echo $row['city']; ?></td>
			<td align="center"><?php echo $row['clientid']; ?></td>
			<td align="center" class="num"><a style="cursor:pointer;" title="注册奖励已发放：<?php echo $row['times'];?>次">
			 <?php
			 	 $month=date("m");  //获取当前的月份
			     if($row['getcost']==$month)
				 {
					 echo "<font color='#06C'>本月奖励已发放</font>";
				 }elseif($row['times']==12)
				 {
					 echo "<font color='#C36'>注册奖励已全部发放</font>";
				 }else
				 {
					echo "<font color=red>本月奖励未发放</font>";
				 }
			 ?></a>
			</td>
			<td align="center" class="num" style="color:red;"><?php echo $row['JiuQian']; ?></td>
			<td align="center"><?php echo $devicetype; ?></td>
			<td align="center"><?php echo $row['CreatTime'];?></td>
			<td align="center">
            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="优惠券列表" href="quanshow.php?account=<?php echo $row['Account']; ?>"><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i></a></div>
             <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐会员记录" style="cursor:pointer" onclick="recommand_huiyuan('<?php echo $classes; ?>','<?php echo $row['Account'];?>','<?php echo $row['Recommand'];?>');"><i class="fa fa-share-alt" aria-hidden="true"></i></a></div>



             <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="购买记录" style="cursor:pointer" onclick="shopping('<?php echo $row['Account'];?>');"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>

            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="编辑会员信息" href="member_update.php?id=<?php echo $row['Id']; ?>"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></a></div>

            </td>
			<td width="3%" align="center">
       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="添加优惠券" style="cursor:pointer" onclick="business('<?php echo $row['Account'];?>');"><i class="fa fa-plus" aria-hidden="true"></i></a></div>



       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐会员提成记录" style="cursor:pointer" onclick="tuijian_shopping('<?php echo $row['Recommand'];?>');"><i class="fa fa-share" aria-hidden="true"></i> </a></div>
         <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐二维码" style="cursor:pointer" onclick="erweima_tuijian('<?php echo $row['Account'];?>');"><i class="fa fa-skype" aria-hidden="true"></i></a></div>

       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="删除" href="member_save.php?action=del2&id=<?php echo $row['Id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a></div>

       </td>

		 <?php //}?>

		</tr>
		<?php
		}
		?>
	</table>
</form>
<?php

//

if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="bottomToolbar"><span class="selArea"><span>选择：</span>
<a href="javascript:CheckAll(true);">全部</a> -
<a href="javascript:CheckAll(false);">无</a> -
<a href="javascript:DelAllNone('member_save.php');" onclick="return  ConfDelAll(0);">删除</a>-
<a href="javascript:ConfsendReg('member_save.php');" onclick="return ConfDelAll(4);">发放注册奖励</a></span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('member_save.php');" onclick="return ConfDelAll(0);">删除</a>-
<a href="javascript:ConfsendReg('member_save.php');" onclick="return ConfDelAll(4);">发放注册奖励</a></span> <span class="pageSmall"> <?php echo $dopage->GetList(); ?></a> </span></div>
		<div class="quickAreaBg"></div>
	</div>

	</div>
<?php
}
?>
<?php }else{ ?>
<form name="form" id="form" method="post" action="member_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="4%" align="center">用户账号</td>
			<td width="7%" align="center">头像</td>
			<td width="7%" align="center">昵称</td>
			<td width="9%">手机</td>
			<td width="6%">推荐码</td>
			<td width="6%" align="center">推荐人</td>
			<td width="6%" align="center">最后登陆省份</td>
			<td width="9%" align="center">最后登陆城市</td>
			<td width="8%" align="center">登陆设备码</td>
			<td width="7%" align="center">本月奖励</td>
			<td width="8%" align="center">酒钱余额</td>
			<td width="8%" align="center">登陆设备</td>
			<td width="8%" align="center">注册时间</td>
			<td width="3%" align="left">操作</td>
		</tr>
		<?php
		$one=1;
		$two=2;
		$dosql->Execute("SELECT Recommand FROM `commercialuser` where username='$username'",$one);
		while($rows = $dosql->GetArray($one))
		{
		$recommand=$rows['Recommand'];//   推荐人的推荐码
		if($check=="man"){
		$dopage->GetPage("SELECT * FROM `memberuser` where sex='男' and Yaoqingma='$recommand'",15);
			}elseif($check=="woman"){
		$dopage->GetPage("SELECT * FROM `memberuser` where sex='女' and Yaoqingma='$recommand'",15);
	     	}elseif($check=="today"){
		$time=date("Y-m-d");
		$dopage->GetPage("select * from `memberuser` where CreatTime like '%$time%'  and Yaoqingma='$recommand'",15);
	     	}elseif($keyword!=""){
		$dopage->GetPage("SELECT * FROM `memberuser` where Yaoqingma='$recommand' and Account like '%$keyword%' or Alias  like '%$keyword%'",15);
			}else{
		$dosql->Execute("SELECT * FROM `memberuser` where Yaoqingma='$recommand'");
			}

		while($row = $dosql->GetArray()){
		switch($row['devicetype'])
			{
				case '1':
					$devicetype = '小程序';
					break;
				case '0':
					$devicetype = 'Android';
					break;

			}
			$Yaoqingma=$row['Yaoqingma'];
		$classes=$row['classes'];
		?>
		<tr align="left" class="dataTr">
			<td height="97" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td align="center"><?php echo $row['Account']; ?></td>
			<td align="center"><img  width="100px;" layer-src="<?php echo $Image;?>" style="cursor:pointer" onclick="message('<?php echo $row['Id']; ?>');"  src="<?php echo $Image;?>" alt="<?php echo $row['Image']; ?>" /></td>
			<td align="center"><?php echo $row['Alias']; ?></td>
			<td align="center"><?php echo $row['Account']; ?></td>
			<td align="center"><?php echo $row['Recommand']; ?></td>
			<td align="center"><a style=" cursor:pointer" onclick="recommand_huiyuan('<?php echo $classes; ?>','<?php echo tel($Yaoqingma,$classes);?>','<?php echo $Yaoqingma; ?>')" title="推荐人电话：<?php echo tel($Yaoqingma,$classes);?>">
			<?php echo tjr($Yaoqingma,$classes);?></a></td>
			<td align="center"><?php echo $row['prov']; ?></td>
			<td align="center" ><?php echo $row['city']; ?></td>
			<td align="center"><?php echo $row['clientid']; ?></td>
			<td align="center" class="num"><a  style="cursor:pointer;" title="注册奖励已发放：<?php echo $row['times'];?>次">
			<?php
			     $month=date("m");  //获取当前的月份
			     if($row['getcost']==$month)
				 {
					 echo "<font color='#06C'>本月奖励已发放</font>";
				 }elseif($row['times']==12)
				 {
					 echo "<font color='#C36'>注册奖励已全部发放</font>";
				 }else
				 {
					echo "<font color=red>本月奖励未发放</font>";
				 }
			 ?></a>
			</td>
			<td align="center" class="num" style="color:red;"><?php echo $row['JiuQian']; ?></td>
			<td align="center"><?php echo $devicetype; ?></td>
			<td align="center"><?php echo $row['CreatTime'];?></td>
			<td align="center">
            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="优惠券列表" href="quanshow.php?account=<?php echo $row['Account']; ?>"><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i></a></div>

            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐二维码" style="cursor:pointer" onclick="erweima_tuijian('<?php echo $row['Account'];?>');"><i class="fa fa-skype" aria-hidden="true"></i></a></div>

             <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="购买记录" style="cursor:pointer" onclick="shopping('<?php echo $row['Account'];?>');"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>


            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a style="cursor:pointer" title="编辑会员信息" onclick="member_update('<?php echo $row['Id']; ?>')"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></a></div>

            </td>
			<td width="3%" align="center">
       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="添加优惠券" style="cursor:pointer" onclick="business('<?php echo $row['Account'];?>');"><i class="fa fa-plus" aria-hidden="true"></i></a></div>

       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;cursor:pointer"><a title="推荐会员记录" style="cursor:pointer" onclick="recommand_huiyuan('<?php echo $row['Account'];?>','<?php echo $row['Recommand'];?>');"><i class="fa fa-share-alt" aria-hidden="true"></i></a></div>

       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐会员提成记录" style="cursor:pointer" onclick="tuijian_shopping('<?php echo $row['Recommand'];?>');"><i class="fa fa-share" aria-hidden="true"></i> </a></div>

       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a style="cursor:pointer" title="删除" onclick="return del_member();"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a></div>

       </td>

		 <?php //}?>

		</tr>
		<?php
		}
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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span>
<a href="javascript:CheckAll(true);">全部</a> -
<a href="javascript:CheckAll(false);">无</a> -
<a href="javascript:DelAllNone('member_save.php');" onclick="return  ConfDelAll(0);">删除</a>-
<a href="javascript:ConfsendReg('member_save.php');" onclick="return ConfDelAll(4);">发放注册奖励</a></span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('member_save.php');" onclick="return ConfDelAll(0);">删除</a>-
<a href="javascript:ConfsendReg('member_save.php');" onclick="return ConfDelAll(4);">发放注册奖励</a></span> <span class="pageSmall"> <?php echo $dopage->GetList(); ?></a> </span></div>
		<div class="quickAreaBg"></div>
	</div>

	</div>
<?php }}?>

</body>
</html>
