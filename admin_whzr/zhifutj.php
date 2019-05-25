<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('goodsorder'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>销售额</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
</head>
<body>
<div class="topToolbar"> <span class="title">支付方式统计</span>
 <a href="javascript:location.reload();" class="reload">刷新</a></div>
<?php
date_default_timezone_set('PRC'); 
$dates2="";
$one=1;
$two=2;
$three=3;
$pvs=array();
$uvs=array();
$dosql->Execute("SELECT *,sum(PayAmount) as zhifubao,count(distinct posttime) from `orderform` where State <> 5 and PayAmount <> 0 and paytype=0 group by posttime desc limit 15",$one);
while($row=$dosql->GetArray($one)){
    $pvs[] = floatval($row['zhifubao']);//支付宝支付  //注意这里必须要用intval强制转换，不然图表不能显示
}
$dosql->Execute("SELECT *,sum(PayAmount) as weixin,count(distinct posttime) from `orderform` where State <> 5 and PayAmount <> 0 and paytype=1 group by posttime desc limit 15",$two);
while($row=$dosql->GetArray($two)){
    $uvs[] = floatval($row['weixin']);//微信支付  //注意这里必须要用intval强制转换，不然图表不能显示
	$posttime[]=$row['posttime'];
}
$posttimes=array();
$posttimes=array_reverse($posttime);
foreach($posttimes as $key=>$va){
$dates2.="'".$posttimes[$key]."',";	
}
$pv=array_reverse($pvs);
$uv=array_reverse($uvs);
$data = array(
array(
"name"=>"支付宝支付",
"data"=>$pv)
,
array(
"name"=>"微信支付",
"data"=>$uv
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
                text: '玖易提15天金钱支付、酒钱支付曲线图',
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
</body>
</html>