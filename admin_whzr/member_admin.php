<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php'); 
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
		alert("请输入搜索内容！");
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
function recommand_huiyuan(Account,recommand)
{
layer.open({
  type: 2,
  title: '会员推荐记录：',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['900px' , '655px'],
  content: 'recommand_huiyuan.php?Account='+Account+'&Recommand='+recommand,
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
$adminlevel=$_SESSION['adminlevel'];


?>
</head>
<body>
<input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $adminlevel;?>" />
<div class="topToolbar"> <span class="title">会员管理</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<div class="toolbarTab">
	<ul>
 <li class="<?php if($check==""){echo "on";}?>"><a href="member.php">全部</a></li> <li class="line">-</li> 
 <li class="<?php if($check=="man"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('man')">男</a></li> <li class="line">-</li> 
 <li class="<?php if($check=="woman"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('woman')">女</a></li>
	</ul>
	<div id="search" class="search"> <span class="s">
<input name="keyword" id="keyword" type="text" class="number" style="font-size:11px;" placeholder="请输入用户账号或者昵称" title="请输入用户账号或者昵称" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>
<form name="form" id="form" method="post" action="member_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="5%" align="center">用户账号</td>
			<td width="12%" align="center">昵称</td>
			<td width="11%">手机</td>
			<td width="7%">性别</td>
			<td width="7%">推荐码</td>
			<td width="9%" align="center">最后登陆省份</td>
			<td width="9%" align="center">最后登陆城市</td>
			<td width="12%" align="center">登陆设备码</td>
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
		?>
		<tr align="left" class="dataTr">
			<td height="97" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td align="center"><?php echo $row['Account']; ?></td>
			<td align="center"><?php echo $row['Alias']; ?></td>
			<td align="center"><?php echo $row['Account']; ?></td>
			<td align="center"><?php echo $row['Sex']; ?></td>
			<td align="center" class="num"><?php echo $row['Recommand']; ?></td>
			<td align="center"><?php echo $row['prov']; ?></td>
			<td align="center" ><?php echo $row['city']; ?></td>
			<td align="center"><?php echo $row['clientid']; ?></td>
			<td align="center" class="num" style="color:red;"><?php echo $row['JiuQian']; ?></td>
			<td align="center"><?php echo $devicetype; ?></td>
			<td align="center"><?php echo $row['CreatTime'];?></td>
			<td align="center">
            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="优惠券列表" href="quanshow.php?account=<?php echo $row['Account']; ?>"><i class="fa fa-credit-card fa-fw" aria-hidden="true"></i></a></div>
            
            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐二维码" style="cursor:pointer" onclick="erweima_tuijian('<?php echo $row['Account'];?>');"><i class="fa fa-skype" aria-hidden="true"></i></a></div>
            
             <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="购买记录" style="cursor:pointer" onclick="shopping('<?php echo $row['Account'];?>');"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></div>
             
            
            <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="编辑会员信息" href="member_update.php?id=<?php echo $row['Id']; ?>"><i class="fa fa-pencil-square-o fa-fw" aria-hidden="true"></i></a></div>
            
            </td>
			<td align="center">
       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="添加优惠券" style="cursor:pointer" onclick="business('<?php echo $row['Account'];?>');"><i class="fa fa-plus" aria-hidden="true"></i></a></div>
       
       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;cursor:pointer"><a title="推荐会员记录" style="cursor:pointer" onclick="recommand_huiyuan('<?php echo $row['Account'];?>','<?php echo $row['Recommand'];?>');"><i class="fa fa-share-alt" aria-hidden="true"></i></a></div>
       
       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="推荐会员提成记录" style="cursor:pointer" onclick="tuijian_shopping('<?php echo $row['Recommand'];?>');"><i class="fa fa-share" aria-hidden="true"></i> </a></div>
        
       <div id="jsddm" style="margin-top: 6px;margin-bottom: 8px;"><a title="删除" href="member_save.php?action=del2&id=<?php echo $row['Id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash fa-fw" aria-hidden="true"></i></a></div> 

       </td>

		 <?php //}?>
         
		</tr>
		<?php
		}}
		?>
	</table>
</form>

</body>
</html>