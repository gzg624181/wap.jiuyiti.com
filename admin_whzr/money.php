<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('message'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提现记录</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script>
 function message(commercial,applytime,types,money){
  window.location.href='sendtxmessage.php?commercial='+commercial+'&applytime='+applytime+'&types='+types+'&money='+money;
 }
</script>
<?php
//初始化参数
$check = isset($check) ? $check : '';
?>
</head>
<body>
<div class="topToolbar">
<span class="title">提现记录</span>
<a href="javascript:location.reload();" class="reload">刷新</a>
</div>
<form name="form" id="form" method="post" action="money_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="2%" height="36" class="firstCol"><input type="checkbox" name="checkid" id="checkid" onclick="CheckAll(this.checked);"></td>
			<td width="9%">商家账号</td>
			<td width="8%">商家/管理员</td>
			<td width="8%">姓名</td>
			<td width="10%">银行卡姓名</td>
			<td width="11%">银行卡账号</td>
			<td width="13%">提现金额（元）</td>
			<td width="11%" align="center">申请时间</td>
			<td width="10%" align="center">提现时间</td>
			<td width="9%" align="center">提现状态</td>
			<td colspan="2" align="center">操作</td>
		</tr>
		<?php
		if($check!=""){
			if($check=='today'){
		$time=date("Y-m-d");
		$dopage->GetPage("select * from pickupmoney where CreatTime like '%$time%' and State=1",15);
			}elseif($check=='tomorrowtixian'){
		$time=date("Y-m-d",strtotime("-1 day"));
		$dopage->GetPage("select * from pickupmoney where CreatTime like '%$time%' and State=1",15);
			}elseif($check=='shenqintixian'){
		$dopage->GetPage("select * from pickupmoney where State=0",15);
				}
		}else{
		$dopage->GetPage("SELECT * FROM `pickupmoney`",15);
		}
		while($row = $dosql->GetArray())
		{
			switch($row['State'])
			{

				case '0':
					$State = "<font color='#FF0000'><B>".'待提现'."</b></font>";
					break;
				case '1':
					$State = "<font color='#339933'><B>".'已提现'."</b></font>";
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
			<td height="36" class="firstCol"><input type="checkbox" name="checkid[]" id="checkid[]" value="<?php echo $row['id']; ?>" /></td>
			<td><?php echo $row['Commercial']; ?></td>
			<td><?php echo $types;?></td>
			<td><?php  echo $row['RealName']; ?></td>
			<td><?php  echo $row['BankName']; ?></td>
			<td><?php  echo $row['BankNo']; ?></td>
			<td><?php  echo $row['ApplyMonery']; ?></td>
			<td align="center"><?php  echo $row['ApplyTime']; ?></td>
			<td align="center"><?php  echo $row['CreatTime']; ?></td>
			<td align="center"><?php echo $State; ?></td>
			<td width="6%" align="center">
            <?php
			if($row['State']==0 && $row['send']==0){
				?>
             <div id="jsddm"><a style="width:85px;">未发送提现通知</a></div>
          <?php }elseif($row['State']==1 && $row['send']==0){?>
            <div id="jsddm"><a style="width:85px;"  href="javascript:message('<?php echo $row['Commercial']; ?>','<?php echo $row['ApplyTime']; ?>','<?php echo $row['types']; ?>','<?php echo $row['ApplyMonery']; ?>')" onclick="return ConfDelss(0);">发送提现通知</a></div>
              <?php }elseif($row['State']==1 && $row['send']==1){?>
            <div id="jsddm"><a  style="width:85px; background-color:#0a566c;">已发送提现通知</a></div>
              <?php }?>
            </td>
			<td width="3%" align="center">
            <?php if($row['State']==0){?>
            <div id="jsddm"><a title="确认提现" href="money_save.php?action=update&id=<?php echo $row['id']; ?>" onclick="return ConfDels(0);"><i class="fa  fa-check" aria-hidden="true"></i></a></div>
            <?php }elseif($row['State']==1){ ?>
             <div id="jsddm"><a title="已提现" style="color: #fff"><i class="fa fa-lg fa-get-pocket" aria-hidden="true"></i></a></div>
            <?php }?>
               <div id="jsddm"><a href="money_save.php?action=del5&id=<?php echo $row['id'];?>" onclick="return ConfDel(0)" title="删除" style="color: #fff"><i class="fa fa-trash" aria-hidden="true"></i></a></div>
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
<div class="bottomToolbar"> <span class="selArea"><span>选择：</span> <a href="javascript:CheckAll(true);">全部</a> - <a href="javascript:CheckAll(false);">无</a> - <a href="javascript:DelAllNone('money_save.php');" onclick="return ConfDelAll(0);">删除</a></span> </div>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>

</body>
</html>
