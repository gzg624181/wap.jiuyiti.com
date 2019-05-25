<?php
 require_once(dirname(__FILE__).'/inc/config.order.inc.php');
 error_reporting(E_ALL & ~E_NOTICE);  //屏蔽注意提示
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>所有订单</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<script type="text/javascript" src="layer/layer.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
//已付订单，未付订单，搜索
  function checkinfo(key){
     var v= key;
	// alert(v)
	window.location.href='allorder.php?check='+v;
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
  window.location.href='allorder.php?keyword='+keyword;
}
 function ab(Id){

	alert("预约订单地址还未选择！");
 }
 function message(account,alias,address,time,orderid){
	 if (!confirm("确认要发送提货短信吗？")) {
  window.event.returnValue = false;
      }
  window.location.href='sendmessage.php?account='+account+'&alias='+alias+'&address='+address+'&time='+time+'&orderid='+orderid;
 }

 function del_dingdan(){
 var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel!=1){
	  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
  }
	}

 function send_duanxin(){
 var adminlevel=document.getElementById("adminlevel").value;
  if(adminlevel!=1){
	  alert("亲，您还没有操作本模块的权限，请联系超级管理员！");
  }
  }

function vod_sh(dingdantype,userid,orderid){

  if(dingdantype==2){
  layer.open({
  type: 2,
  title: '',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['750px' , '650px'],
  content: 'express_sh.php?userid='+userid+'&orderid='+orderid,
  });
  }
}
function sj_express(dingdantype,address,orderid){

  if(dingdantype!=2){
  layer.open({
  type: 2,
  title: '',
  maxmin: true,
  shadeClose: true, //点击遮罩关闭	层
  area : ['750px' , '600px'],
  content: 'sj_express.php?address='+address+'&orderid='+orderid,
  });
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
?>
</head>
<body>
<input type="hidden" name="adminlevel" id="adminlevel" value="<?php echo $adminlevel;?>" />
<div class="topToolbar"> <span class="title">所有订单</span> <a href="javascript:location.reload();" class="reload">刷新</a></div>
<div class="toolbarTab">
	<ul>
 <li class="<?php if($check==""){echo "on";}?>"><a href="allorder.php">全部</a></li> <li class="line">-</li>
 <li class="<?php if($check=="unpay"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('unpay')">待付款</a></li> <li class="line">-</li>
 <li class="<?php if($check=="pay"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('pay')">待提取</a></li>
<li class="line">-</li>
 <li class="<?php if($check=="tiqu"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('tiqu')">已提取</a></li>
<li class="line">-</li>
<li class="<?php if($check=="yuyue"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('yuyue')">预约订单</a></li>
<li class="line">-</li>
<li class="<?php if($check=="ziti"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('ziti')">自提订单</a></li>
<li class="line">-</li>
<li class="<?php if($check=="kd"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('kd')">快递订单</a></li>
<li class="line">-</li>
<li class="<?php if($check=="jiuqian"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('jiuqian')">酒钱支付</a></li>
<li class="line">-</li>
<li class="<?php if($check=="jinqian"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('jinqian')">金钱支付</a></li>
<li class="line">-</li>
<li class="<?php if($check=="hunhe"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('hunhe')">混合支付</a></li>
<li class="line">-</li>
<li class="<?php if($check=="wei"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('wei')">未支付</a></li>
<li class="line">-</li>
<li class="<?php if($check=="today"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('today')">今日订单</a></li>
<li class="line">-</li>
<li class="<?php if($check=="todaytiqu"){echo "on";}?>"><a href="javascript:;" onclick="checkinfo('todaytiqu')">今日提货</a></li>
	</ul>
	<div id="search" class="search"> <span class="s">
<input name="keyword" id="keyword" type="text" class="number" placeholder="请输入订单号/提取码/下单人/手机号进行搜索" title="请输入订单号/提取码/下单人/手机号进行搜索" />
		</span> <span class="b"><a href="javascript:;" onclick="GetSearchs();"></a></span></div>
	<div class="cl"></div>
</div>
<?php
if($_SESSION['adminlevel']==1 || $_SESSION['adminlevel']==2){ ?>
<form name="form" id="form" method="post" action="order_save_sh.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="8%" align="center">&nbsp;&nbsp;订单号</td>
			<td width="5%" align="center">提取码</td>
			<td width="9%" align="center">订单类型</td>
		  <td width="5%" align="center">下单人</td>
		  <td width="5%" align="center">手机</td>
			<td width="6%" align="center">付款类型</td>
			<td width="5%" align="center">现金支付</td>
			<td width="5%" align="center">酒钱支付</td>
			<td width="5%" align="center">支付类型</td>
			<td width="5%" align="center">合计</td>
			<td width="8%" align="center">预约地址</td>
			<td width="6%" align="center">下单地址</td>
			<td width="6%" align="center">订单类型</td>
			<td width="5%" align="center">预约时间</td>
			<td width="6%" align="center">订单状态</td>
			<td width="8%" align="center">下单时间</td>
			<td width="2%" align="center">操作</td>
		</tr>
		<?php
		if($_SESSION['adminlevel']==1){
		if($check!=""){
		      if($check=='pay'){ //待提取
		      $dopage->GetPage("SELECT * FROM `orderform_commercial` where State='1'",15);
			    }elseif($check=='unpay'){ //待付款
		      $dopage->GetPage("SELECT * FROM `orderform_commercial` where State='5'",15);
			    }elseif($check=='tiqu'){  //以提取
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where State='8'",15);
				}elseif($check=='yuyue'){  //预约订单
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where address is not null",15);
				}elseif($check=='ziti'){  //自提订单
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where dingdantype=0",15);
				}elseif($check=='kd'){  //快递订单
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where dingdantype=2",15);
				}elseif($check=='jiuqian'){  //酒钱支付
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where  PaymentType=1",15);
				}elseif($check=='jinqian'){  //金钱支付
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where  PaymentType=2",15);
				}elseif($check=='hunhe'){  //混合支付
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where  PaymentType=3",15);
				}elseif($check=='wei'){  //未支付
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where  PaymentType=4",15);
				}elseif($check=='today'){  //今日订单
			$time=date("Y-m-d");
			$dopage->GetPage("select * from orderform_commercial where CreatTime like '%$time%' and (State=1 or State=8)",15);
				}elseif($check=='tomorrowdingdan'){  //昨日订单
			$time=date("Y-m-d",strtotime("-1 day"));
			$dopage->GetPage("select * from orderform_commercial where CreatTime like '%$time%' and State=1",15);
				}elseif($check=='todaytiqu'){  //今日提货
			$time=date("Y-m-d");
			$dopage->GetPage("select * from orderform_commercial where TakeTime like '%$time%' and State=8",15);
				}elseif($check=='tomorrowtiqu'){  //今日提货
			$time=date("Y-m-d",strtotime("-1 day"));
			$dopage->GetPage("select * from orderform_commercial where TakeTime like '%$time%' and State=8",15);
				}
		  }elseif($keyword!=""){
		  $dopage->GetPage("SELECT * FROM `orderform_commercial` where OrderId like '%$keyword%' or tiquma like '%$keyword%' or UserId like '%$keyword%'",15);
		  }else{
		     $dopage->GetPage("SELECT * FROM `orderform_commercial`",15);
		  }
	      }elseif($_SESSION['adminlevel']==2){
			if($check!=""){
		      if($check=='pay'){ //待提取
		      $dopage->GetPage("SELECT * FROM `orderform_commercial` where State='1' and city='$live_city'",15);
			    }elseif($check=='unpay'){ //待付款
		      $dopage->GetPage("SELECT * FROM `orderform_commercial` where State='5' and city='$live_city'",15);
			    }elseif($check=='tiqu'){  //以提取
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where State='8' and city='$live_city'",15);
				}elseif($check=='yuyue'){  //预约订单
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where address is not null and city='$live_city'",15);
				}elseif($check=='ziti'){  //自提订单
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where address is null and city='$live_city'",15);
				}elseif($check=='jiuqian'){  //酒钱支付
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where  PaymentType=1 and city='$live_city'",15);
				}elseif($check=='jinqian'){  //金钱支付
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where  PaymentType=2 and city='$live_city'",15);
				}elseif($check=='hunhe'){  //混合支付
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where  PaymentType=3 and city='$live_city'",15);
				}elseif($check=='wei'){  //未支付
			$dopage->GetPage("SELECT * FROM `orderform_commercial` where  PaymentType=4 and city='$live_city'",15);
				}elseif($check=='today'){  //今日订单
			$time=date("Y-m-d");
			$dopage->GetPage("select * from orderform_commercial where CreatTime like '%$time%' and State=1 and city='$live_city'",15);
				}elseif($check=='todaytiqu'){  //今日提货
			$time=date("Y-m-d");
			$dopage->GetPage("select * from orderform_commercial where TakeTime like '%$time%' and State=8 and city='$live_city'",15);
				}
		  }elseif($keyword!=""){
		  $dopage->GetPage("SELECT * FROM `orderform_commercial` where city='$live_city' and OrderId like '%$keyword%' or tiquma like '%$keyword%' or UserId like '%$keyword%'",15);
		  }else{
		     $dopage->GetPage("SELECT * FROM `orderform_commercial` where city='$live_city'",15);
		  }
			  }
		while($row = $dosql->GetArray())
		   {

	  //state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )
			switch($row['State'])
			{
				case 1:
				$State="<font color='#4bb1cf'><B>".'待提取'."</b></font>";
				break;

				case 2;
				$State="<font color='#6699FF'><B>".'返利单'."</b></font>";
				break;

				case 3;
				$State="换购单";
				break;

				case 4;
				$State="已失效";
				break;

				case 5;
				$State="<font color='#FF0000'><B>".'待付款'."</b></font>";
				break;

				case 6;
				$State="待评价";
				$break;

				case 7;
				$State="已提取";
				break;

				case 8;
				$State="<font color='#36F'><B>".'已提取'."</b></font>";
				break;
			}
			switch($row['PaymentType'])
			{
			case 1;
				$paymenttype="酒钱支付";
				break;

			case 2;
				$paymenttype="金钱支付";
				break;

			case 3;
				$paymenttype="混合支付";
				break;

			case "4";
				$paymenttype="未支付";
				break;
		   }
		  //商户名称
		switch($row['ordertype'])
			{
			case 0;
				$ordertype="会员购买";
				break;

			case 1;
				$ordertype="商户购买";
				break;

			case 2;
				$ordertype="商户补货";
				break;

		   }

		if($row['dingdantype']==1 && $row['PaymentType']!=4){
	            $xingzhi="<font color='#1f6f29'><b>"."预约订单"."</B></font>";
		}elseif($row['PaymentType']==4){
				$xingzhi="";
		}elseif($row['dingdantype']==0 && $row['PaymentType']!=4){
				$xingzhi="<font color='#96C'><b>"."自提订单"."</B></font>";
		}elseif($row['dingdantype']==2){
				$xingzhi="<font color='#21a270'><b>"."快递订单"."</B></font>";
			   }
		$states=$row['State'];
		?>
		<tr align="left" class="dataTr" >
			<td height="40" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td align="left">&nbsp;&nbsp;<?php echo $row['OrderId']; ?></td>
			<td align="center" class="num"><?php echo $row['tiquma'];?></td>
			<td align="center"><?php echo $ordertype;?></td>
		  <td align="center"> <?php echo $row['UserId'];?></td>
		  <td align="center"><?php
			 $UserId= $row['UserId'];
			 $rows = $dosql->GetOne("SELECT * FROM `commercialuser` WHERE Commercial='$UserId'");
			 if(is_array($rows)){
			 echo $rows['Phone'];
			 }
			 ?></td>
			<td align="center"><?php echo $paymenttype; ?></td>
			<td align="center"><?php echo $row['PayAmount']; ?></td>
			<td align="center"><?php echo $row['PayJiuQian']; ?></td>
			<td align="center" class="num">
            <?php
			if($row['PayAmount']!=0 && $row['State']!=5){
			   if($row['paytype']==0){
				  echo  "<font color='#288fe6'><b>"."支付宝支付"."</B></font>";
			  }elseif($row['paytype']==1){
				  echo "<font color='#bd4949'><b>"."微信支付"."</B></font>";
				  }
				}
			?>
            </td>
			<td align="center" class="num"><?php if($row['PayAmount']!="" && $row['PayJiuQian']!="")echo $row['PayAmount']+$row['PayJiuQian']; ?></td>
			<td align="center" title="<?php if(($row['dingdantype'])==2){if($row['kd_state']==0 && $row['duanxin']==0){
				 echo "订单详情";
				 }else{
				  echo "快递已发货，短信已发送";
					 }}else{echo "预约店铺：";}?><?php
		   $addresss=trim($row['address']);
		   if($addresss!=""){
		   $r=$dosql->GetOne("select * from commercialuser where CommercialSite='$addresss'");
           echo $r['CommercialName'];
		   echo "&nbsp;&nbsp;预约时间：".$row['time'];
		   }?>" ><a href="javascript:vod_sh('<?php echo $row['dingdantype'];?>','<?php echo $row['UserId'];?>','<?php echo $row['OrderId'];?>')"><?php
		     if(($row['address'])!=""){echo $row['address'];
			 }elseif(($row['dingdantype'])==2){
				 echo "<font color='#b15555;'><b>订单详情</B></font>";
				 }else{
				 echo "暂未选择";
				 };?>
             </a></td>
			<td align="center"><?php echo $row['prov']; ?><?php echo $row['city']; ?></td>
			<td align="center"><?php echo $xingzhi;?></td>
			<td align="center"><?php if($row['time']=="0000-00-00")
			{echo "";}else{echo $row['time'];};?>
			</td>
			<td align="center"><?php echo $State; ?></td>
			<td align="center"><?php echo $row['CreatTime']; ?></td>
		  <td align="center">
       <div id="jsddm"><a style="width: 24px;" title="订单详情" href="ordershow.php?OrderId=<?php echo $row['OrderId'];?>&CreatTime=<?php echo $row['CreatTime'];?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
       <div id="jsddm"><a style="width: 24px;" title="删除" href="order_save_sh.php?action=del2&id=<?php echo $row['Id']; ?>" onclick="return ConfDel(0);"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
  <?php if($row['dingdantype']==1){
      if($row['address']!=""){
  ?>
 <div id="jsddm"><a style="width: 24px;" title="预约详情" href="yuyueshow.php?OrderId=<?php echo $row['OrderId'];?>&CreatTime=<?php echo $row['CreatTime'];?>&address=<?php echo $row['address'];?>"><i class="fa fa-clock-o" aria-hidden="true"></i></a></div>
  <?php }else{ ?>
   <div id="jsddm"><a style="width: 24px;" title="预约详情" href="javascript:ab('<?php echo $row['Id']; ?>')"><i class="fa fa-clock-o" aria-hidden="true"></i></a></div>
  <?php }?>
  <?php
  if($row['duanxin']==0 && $row['State']!=8){
  ?>
  <div id="jsddm"><a style="width: 24px;" title="发送提货短信提醒" href="javascript:message('<?php echo $rows['Account']; ?>','<?php echo $rows['Alias']; ?>','<?php echo $row['address']; ?>','<?php echo date("Y-m-d"); ?>','<?php echo $row['OrderId']; ?>')"><i class="fa fa-commenting" aria-hidden="true"></i></a></div>
  <?php }elseif($row['duanxin']==1 && $row['State']!=8){ ?>
  <div id="jsddm"><a style="width: 24px; background: #bd4949;" title="短信已发送！"><i class="fa fa-commenting" aria-hidden="true"></i></a></div>
  <?php }?>
  <?php }?>
  <?php
  if($row['dingdantype']!=2 && $row['State']!=8){
  ?>
   <div id="jsddm"><a style="width: 24px;" title="发货给商家的快递" href="javascript:sj_express('<?php echo $row['dingdantype']; ?>','<?php echo $row['address']; ?>','<?php echo $row['OrderId']; ?>')"><i class="fa fa-truck"></i></a></div>
   <?php }?>
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
<div class="bottomToolbar"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('order_save_sh.php');" onclick="return ConfDelAll(0);">删除</a></span></div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>
<?php

//判断是否启用快捷工具栏
if($cfg_quicktool == 'Y')
{
?>
<div class="quickToolbar">
	<div class="qiuckWarp">
		<div class="quickArea"><span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('order_save_sh.php');" onclick="return ConfDelAll(0);">删除</a></span> <span class="pageSmall"> <?php echo $dopage->GetList(); ?> </span></div>
		<div class="quickAreaBg"></div>
	</div>
</div>
<?php
}
?>
<?php }else{ ?>
<form name="form" id="form" method="post" action="order_save_sh.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="1%" height="36" align="center"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="8%" align="center">&nbsp;&nbsp;订单号</td>
			<td width="5%" align="center">提取码</td>
			<td width="9%" align="center">订单类型</td>
		  <td width="5%" align="center">下单人</td>
		  <td width="5%" align="center">手机</td>
			<td width="6%" align="center">付款类型</td>
			<td width="5%" align="center">现金支付</td>
			<td width="5%" align="center">酒钱支付</td>
			<td width="5%" align="center">支付类型</td>
			<td width="5%" align="center">合计</td>
			<td width="8%" align="center">预约地址</td>
			<td width="6%" align="center">下单地址</td>
			<td width="6%" align="center">订单类型</td>
			<td width="5%" align="center">预约时间</td>
			<td width="6%" align="center">订单状态</td>
			<td width="8%" align="center">下单时间</td>
			<td width="2%" align="center">操作</td>
		</tr>
		<?php
		$one=1;
		$two=2;
		$dosql->Execute("SELECT CommercialSite FROM `commercialuser` where username='$username'",$one);
		while($rowz = $dosql->GetArray($one))
		{
		$commercialSite=$rowz['CommercialSite'];//   预约商户的地址
		$dosql->Execute("SELECT * FROM `orderform_commercial` where address='$commercialSite'",$two);
		while($rows = $dosql->GetArray($two)){
		$shanghu[]=$rows['OrderId'];
		}
		}

		$three=3;
		$four=4;
		$five=5;

       $dosql->Execute("SELECT Recommand FROM `commercialuser` where username='$username'",$three);
		while($rows = $dosql->GetArray($three))
		{
		$recommand=$rows['Recommand'];//   推荐人的推荐码
        $dosql->Execute("SELECT Account FROM `memberuser` where Yaoqingma='$recommand'",$four);
		while($row = $dosql->GetArray($four)){
		   	$userId=$row['Account'];   //下单人
			//echo $userId;
			$dosql->Execute("SELECT * FROM `orderform_commercial` where UserId='$userId'",$five);
			while($show = $dosql->GetArray($five)){
			$kehu[]=$show['OrderId'];
		}
		}
		}
           if(is_array($shanghu) || is_array($kehu)){
			$arr=(array_merge($shanghu, $kehu));
			$data_array=array_unique($arr);

			$pagesize = 15; //设置记录显示条数
			$numbers = count($data_array); //计算数组所得到记录总数
			$pagecount = ceil($numbers / $pagesize);
			if(!isset($_GET['page']))
			{
				$page = 1;
			}
			else
			{
			 $page=$_GET['page'];
			}
           //用array_slice(array,offset,length) 函数在数组中根据条件取出一段值;array(数组),offset(元素的开始位置),length(组的长度)
           $newarr = array_slice($data_array, ($page-1)*$pagesize, $pagesize);
 	        }
			for($i=$start;$i<count($newarr);$i++)
		   {
		   	$orderid=$newarr[$i];
			if($orderid!=""){
			$row=$dosql->GetOne("SELECT * FROM `orderform_commercial` where OrderId='$orderid'");
	  //state订单状态(1, 待提取 2，返利单  3换购单 4，已失效 5，待付款 6待评价 7 以退款 8以提取 )
			switch($row['State'])
			{
				case 1:
				$State="<font color='#4bb1cf'><B>".'待提取'."</b></font>";
				break;

				case 2;
				$State="<font color='#6699FF'><B>".'返利单'."</b></font>";
				break;

				case 3;
				$State="换购单";
				break;

				case 4;
				$State="已失效";
				break;

				case 5;
				$State="<font color='#FF0000'><B>".'待付款'."</b></font>";
				break;

				case 6;
				$State="待评价";
				$break;

				case 7;
				$State="以退款";
				break;

				case 8;
				$State="<font color='#36F'><B>".'已提取'."</b></font>";
				break;
			}
			switch($row['PaymentType'])
			{
			case 1;
				$paymenttype="酒钱支付";
				break;

			case 2;
				$paymenttype="金钱支付";
				break;

			case 3;
				$paymenttype="混合支付";
				break;

			case "4";
				$paymenttype="未支付";
				break;
		   }
		  //商户名称


		if($row['dingdantype']==1 && $row['PaymentType']!=4){
	            $xingzhi="<font color='#1f6f29'><b>"."预约订单"."</B></font>";
		}elseif($row['PaymentType']==4){
				$xingzhi="";
		}elseif($row['dingdantype']==0 && $row['PaymentType']!=4){
				$xingzhi="<font color='#96C'><b>"."自提订单"."</B></font>";
		}elseif($row['dingdantype']==2){
				$xingzhi="<font color='#33F'><b>"."快递订单"."</B></font>";
			   }
		$states=$row['State'];
		?>
		<tr align="left" class="dataTr" >
			<td height="40" align="center"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['Id']; ?>" /></td>
			<td align="left">&nbsp;&nbsp;<?php echo $row['OrderId']; ?></td>
			<td align="center" class="num"><?php echo $row['tiquma'];?></td>
			<td align="center"><?php $commercial= $row['Commercial'];
			$show=$dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
			if(is_array($show)){
			echo $show['CommercialName'];
			}
			?>			  </td>
		  <td align="center"><?php
			 $UserId= $row['UserId'];
			// echo $UserId;
			 $rows = $dosql->GetOne("SELECT * FROM `memberuser` WHERE Account='$UserId'");
			 if(is_array($rows)){
			 echo $rows['Alias'];
			 }
			 ?></td>
		  <td align="center"><?php  if(!empty($rows)) echo $rows['Account']; ?></td>
			<td align="center"><?php echo $paymenttype; ?></td>
			<td align="center"><?php echo $row['PayAmount']; ?></td>
			<td align="center"><?php echo $row['PayJiuQian']; ?></td>
			<td align="center" class="num">
            <?php
			if($row['PayAmount']!=0 && $row['State']!=5){
			   if($row['paytype']==0){
				  echo  "<font color='blue'><b>"."支付宝支付"."</B></font>";
			  }elseif($row['paytype']==1){
				  echo "<font color='#bd4949'><b>"."微信支付"."</B></font>";
				  }
				}
			?>
            </td>
			<td align="center" class="num"><?php if($row['PayAmount']!="" && $row['PayJiuQian']!="")echo $row['PayAmount']+$row['PayJiuQian']; ?></td>
			<td align="center" title="<?php if(($row['dingdantype'])==2){if($row['kd_state']==0 && $row['duanxin']==0){
				 echo "订单详情";
				 }else{
				  echo "快递已发货，短信已发送";
					 }}else{echo "预约店铺：";}?><?php
		   $addresss=trim($row['address']);
		   if($addresss!=""){
		   $r=$dosql->GetOne("select * from commercialuser where CommercialSite='$addresss'");
           echo $r['CommercialName'];
		   echo "&nbsp;&nbsp;预约时间：".$row['time'];
		   }?>"><a href="javascript:vod_sh('<?php echo $row['dingdantype'];?>','<?php echo $row['UserId'];?>')"><?php
		     if(($row['address'])!=""){echo $row['address'];
			 }elseif(($row['dingdantype'])==2){
				 echo "<font color='#33F'><b>订单详情</B></font>";
				 }else{
				 echo "暂未选择";
				 };?>
             </a></td>
			<td align="center"><?php echo $row['prov']; ?><?php echo $row['city']; ?></td>
			<td align="center"><?php echo $xingzhi;?></td>
			<td align="center"><?php
			if($row['dingdantype']==1){
			if($row['jingao']==1){
				echo "<font color='red'>商家缺货</font>";
				}
			}?></td>
			<td align="center"><?php echo $State; ?></td>
			<td align="center"><?php echo $row['CreatTime']; ?></td>
		  <td align="center">
       <div id="jsddm"><a style="width: 24px;" title="订单详情" href="ordershow.php?OrderId=<?php echo $row['OrderId'];?>&CreatTime=<?php echo $row['CreatTime'];?>"><i class="fa fa-info-circle" aria-hidden="true"></i></a></div>
       <div id="jsddm"><a style="width: 24px; cursor:pointer" title="删除" onclick="return del_dingdan();"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
  <?php if($row['dingdantype']==1){
      if($row['address']!=""){
  ?>
 <div id="jsddm"><a style="width: 24px;" title="预约详情" href="yuyueshow.php?OrderId=<?php echo $row['OrderId'];?>&CreatTime=<?php echo $row['CreatTime'];?>&address=<?php echo $row['address'];?>"><i class="fa fa-clock-o" aria-hidden="true"></i></a></div>
  <?php }else{ ?>
   <div id="jsddm"><a style="width: 24px;" title="预约详情" href="javascript:ab('<?php echo $row['Id']; ?>')"><i class="fa fa-clock-o" aria-hidden="true"></i></a></div>
  <?php }?>
  <?php
  if($row['duanxin']==0){
  ?>
  <div id="jsddm"><a style="width: 24px; cursor:pointer" title="发送提货短信提醒" onclick="return send_duanxin();"><i class="fa fa-commenting" aria-hidden="true"></i></a></div>
  <?php }else{ ?>
  <div id="jsddm"><a style="width: 24px; background: #bd4949;" title="短信已发送！"><i class="fa fa-commenting" aria-hidden="true"></i></a></div>
  <?php }?>
  <?php }?>
       </td>
		</tr>
		<?php
		}}
		?>
	</table>
    <?php
	if($pagecount!=""){?>
    <div class="page">
    <div class="pageList">
    <?php
if(!isset($_GET['page']) || $_GET['page']<=1){
?>
<a  title='首页' href='?page=1'><i class='fa fa-fast-backward' aria-hidden='true'></i></a>
<a title='第一页' href="?page=1"><i class='fa fa-chevron-circle-left' aria-hidden='true'></i></a>
<?php }else{ ?>
<a title='上一页' href="?page=1"><i class='fa fa-fast-backward' aria-hidden='true'></i></a>
<a title='下一页' href="?page=<?php echo $page-1;?>"><i class='fa fa-chevron-circle-left' aria-hidden='true'></i></a>
<?php } ?>

<?php if($_GET['page']>=$pagecount) {?>
<a href="?page=<?php echo $pagecount;?>"><i class='fa fa-chevron-circle-right' aria-hidden='true'></i></a>
<?php }else{ ?>
<a title='下一页' href="?page=<?php echo $page+1;?>"><i class='fa fa-chevron-circle-right' aria-hidden='true'></i></a>
<a title='最后一页' href="?page=<?php echo $pagecount;?>"><i class='fa fa-fast-forward' aria-hidden='true'></i></a>
<?php }
echo "共[<font color='#FF0000'><b>".$pagecount."</b></font>]页"."&nbsp;&nbsp;当前第<font color='#FF0000'><b>".$page."</b></font>页 &nbsp;&nbsp;每页<font color='#FF0000'><b>".$pagesize."</b></font>条记录";
?>
<?php }?>
</div>
</div>
</form>

<?php }?>

</body>
</html>
