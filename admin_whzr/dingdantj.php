<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php');IsModelPriv('goodsbrand'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>销售额</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">销售额&nbsp;&nbsp;&nbsp;<i class="fa fa-line-chart" aria-hidden="true"></i></span>
 <a href="javascript:location.reload();" class="reload">刷新</a></div>
<?php
date_default_timezone_set('PRC'); 
$dates2="";

$dosql->Execute("SELECT *,sum(PayJiuQian) as jiuqian,sum(PayAmount) as amount,count(distinct posttime) from `orderform` where State <> 5 group by posttime order by posttime desc limit 15");
while($row=$dosql->GetArray()){
    $pvs[] = floatval($row['amount']);//金钱支付  //注意这里必须要用intval强制转换，不然图表不能显示
    $uvs[] = floatval($row['jiuqian']);//酒钱支付
	$sums[]=floatval($row['amount'])+floatval($row['jiuqian']);
	$posttime[]=$row['posttime'];
}
$posttimes=array();
$posttimes=array_reverse($posttime);
foreach($posttimes as $key=>$va){
$dates2.="'".$posttimes[$key]."',";	
}
$pv=array_reverse($pvs);
$uv=array_reverse($uvs);
$sum=array_reverse($sums);

// for($i=-14;$i<1;$i++){
		// $dates2.="'".date("Y-m-d",strtotime("+$i day"))."',";
	// }
$data = array(
array(
"name"=>"金钱支付",
"data"=>$pv)
,
array(
"name"=>"酒钱支付",
"data"=>$uv
)
,
array(
"name"=>"合计",
"data"=>$sum
)
);
$data = json_encode($data);    //把获取的数据对象转换成json格式

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="public/jquery-1.8.2.min.js"></script>
<script src="public/highcharts.js"></script>
<script type="text/javascript">
$(function () {
        $('#container').highcharts({
            title: {
                text: '酒易提15天金钱支付、酒钱支付曲线图',
                x: -20 //center
            },
            subtitle: {
                text: '来源: http://wap.jiuyiti.zrcase.com',
                x: -20
            },
            xAxis: {
              //  categories: ['周一', '周二', '周三', '周四', '周五', '周六','周日']
				categories: [<?php echo rtrim($dates2,",");?>]
            },
            yAxis: {
                title: {
                    text: ''
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '元'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series:<?php echo $data?>
        });
    });
</script>
<div class="homeTeam">
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
</div>
<form name="form" id="form" method="post" action="comment_save.php">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="dataTable">
		<tr align="left" class="head">
			<td width="5%" height="31" align="center">日期</td>
			<td width="28%" align="center">微信付款</td>
			<td width="30%" align="center">支付宝付款</td>
			<td width="24%" align="center">酒钱付款</td>
			<td width="13%" align="center">支付合计</td>
		</tr>
        <?php
		$dopage->GetPage("SELECT *,sum(PayJiuQian) as jiuqian,sum(PayAmount) as amount,count(distinct posttime) from `orderform` where State <> 5 group by posttime asc",15); 
		while($row = $dosql->GetArray())
		{	
			$sums=floatval($row['amount'])+floatval($row['jiuqian']);	
			if($row['paytype']==0 && $row['State']!=5){
				$zhifubao=$row['PayAmount'];
				$weixin=round(($row['amount']-$zhifubao),2);
				}else{
				$zhifubao=0;	
				$weixin=round(($row['amount']-$zhifubao),2);
					}
			$jiuqian[]=$row['jiuqian'];
			$amount[]=$row['amount']
      ?>
		<tr align="left" class="dataTr">
			<td height="42" align="center"><?php  echo $row['posttime'];?></td>
			<td align="center"><?php echo $weixin;?></td>
			<td align="center"><?php echo $zhifubao;?></td>
			<td align="center"><?php echo floatval($row['jiuqian']);?></td>
			<td align="center" class="num"><?php echo $sums;?></td>
		</tr>
		<?php
		}
		
		?>
        <tr align="left" class="dataTr">
			<td height="42" align="center"></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center" class="num">合计：<font color="red"><B><?php echo array_sum($jiuqian)+array_sum($amount);?></B></font>元</td>
		</tr>
	</table>
</form>
<?php

//判断无记录样式
if($dosql->GetTotalRow() == 0)
{
	echo '<div class="dataEmpty">暂时没有相关的记录</div>';
}
?>
<div class="page"> <?php echo $dopage->GetList(); ?> </div>

</body>
</html>