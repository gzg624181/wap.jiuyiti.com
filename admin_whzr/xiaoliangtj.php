<?php require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('goods'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品销量</title>
<link href="templates/style/admin.css" rel="stylesheet" type="text/css" />
<link href="templates/style/menu1.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="templates/js/jquery.min.js"></script>
<script type="text/javascript" src="templates/js/forms.func.js"></script>
</head>
<body>
<div class="topToolbar"> <span class="title">商品销量</span>
 <a href="javascript:location.reload();" class="reload">刷新</a></div>
<?php
date_default_timezone_set('PRC'); 
$dates2="";
/*  正式选用之后用这个sql语句
$dosql->Execute("SELECT orderform.posttime,sum(ordercommodity.Quantity) as quantity,count(distinct orderform.posttime) from ordercommodity left join orderform on ordercommodity.OrderId=orderform.OrderId and orderform.State <> 5 group by orderform.posttime asc limit 15");
*/

$dosql->Execute("SELECT ordercommodity.posttime,sum(ordercommodity.Quantity) as quantity,count(distinct ordercommodity.posttime) from ordercommodity left join orderform on ordercommodity.OrderId=orderform.OrderId and orderform.State <> 5 group by ordercommodity.posttime desc limit 15");
while($row=$dosql->GetArray()){
    $pvs[] = intval($row['quantity']);//销量  //注意这里必须要用intval强制转换，不然图表不能显示
	$posttime[]=$row['posttime'];
}
$posttimes=array();
$posttimes=array_reverse($posttime);
foreach($posttimes as $key=>$va){
$dates2.="'".$posttimes[$key]."',";	
}
$pv=array_reverse($pvs);

$data = array(
array(
"name"=>"商品销量",
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
                text: '玖易提15天商品销量曲线图',
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
                valueSuffix: '件'
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