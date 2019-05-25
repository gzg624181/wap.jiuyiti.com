<?php require_once(dirname(__FILE__).'/inc/config.order.inc.php');IsModelPriv('message'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>提现统计</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="topToolbar"> <span class="title">提现统计&nbsp;&nbsp;&nbsp;<i class="fa fa-area-chart" aria-hidden="true"></i></span>
 <a href="javascript:location.reload();" class="reload">刷新</a></div>
<?php
date_default_timezone_set('PRC'); 
$dates2="";

$dosql->Execute("SELECT *,sum(ApplyMonery) as applymoney,count(distinct posttime) from `pickupmoney` where State = 1 group by posttime asc limit 15");
while($row=$dosql->GetArray()){
    $pv[] = floatval($row['applymoney']);//提现总金额  //注意这里必须要用intval强制转换，不然图表不能显示
	$dates2.="'".$row['posttime']."',";
}
// for($i=-14;$i<1;$i++){
		// $dates2.="'".date("Y-m-d",strtotime("+$i day"))."',";
	// }
$data = array(
array(
"name"=>"提现金额",
"data"=>$pv)
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
                text: '酒易提提现曲线图',
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
			<td align="center">提现金额</td>
			<td width="13%" align="center">支付合计</td>
		</tr>
        <?php
		$dopage->GetPage("SELECT *,sum(ApplyMonery) as applymoney,count(distinct posttime) from `pickupmoney` where State = 1 group by posttime desc",15); 
		while($row = $dosql->GetArray())
		{
		$sum[]=$row['applymoney'];
      ?>
		<tr align="left" class="dataTr">
			<td height="42" align="center"><?php  echo $row['posttime'];?></td>
			<td align="center"><?php  echo $row['applymoney'];?></td>
			<td align="center" class="num" style="color:red;"><?php  echo $row['applymoney'];?></td>
		</tr>
		<?php
		}
		
		?>
       <tr align="left" class="dataTr">
			<td height="42" align="center"></td>
			<td align="center"></td>
			<td align="center" class="num" style="color:black; font-weight:bold">合计：
             <?php 
            echo array_sum($sum);
			 ?>元</td>
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