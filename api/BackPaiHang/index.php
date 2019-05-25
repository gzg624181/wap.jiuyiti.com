<?php
    /**
    * 链接地址：BackPaiHang  提貨返現排行
    *
     * 下面直接来连接操作数据库进而得到json串
     *
     * 按json方式输出通信数据
     *
     * @param unknown $State 状态码
     *
     * @param string $Descriptor  提示信息
     *
     * @param string $Version  操作时间

     * @param array $Data 数据
     *
     * @return string
     *
     * @查询在活动期间的商家推荐排行 不需要提供返回参数账号
     */

require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

$year=date("Y");//获取当前的年份
$month=date("m");//获取当前的月份
$idd=1;
$ids=2;
$dosql->Execute("SELECT * FROM `pickuplist` WHERE year='$year' and month='$month' group by Commercial",$idd);  //今日提单数量
while($row = $dosql->GetArray($idd)){
$Commercial=$row['Commercial'];  //商戶賬號
if(isset($Commercial) && $Commercial!=""){
$dosql->Execute("SELECT sum(a.jiuQian) as sumjiuqian,CommercialName,CommercialImg from `pickuplist` a inner join commercialuser b on a.Commercial=b.Commercial where a.year='$year' and a.month='$month' and a.Commercial='$Commercial' order by sumjiuqian asc",$ids);
//$dosql->Execute("SELECT *,sum(jiuQian) as sumjiuqian from `pickuplist` where year='$year' and month='$month' and Commercial='$Commercial' order  by sumjiuqian asc",$ids);
while($show=$dosql->GetArray($ids)){
	$arrUsers[]=$show;
}
}
}
$sort = array(
        'direction' => 'SORT_DESC',        //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
        'field'     => 'sumjiuqian',       //排序字段
);
$arrSort = array();
foreach($arrUsers AS $uniqid => $row){
    foreach($row AS $key=>$value){
    $arrSort[$key][$uniqid] = $value;
    }
}
if($sort['direction']){
    array_multisort($arrSort[$sort['field']], constant($sort['direction']), $arrUsers);
}

//print_r($arrUsers);

if(is_array($arrUsers)){
$State = 1;
$Descriptor = '数据查询成功！';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
		'Version' => $Version,
                'Data' => $arrUsers,
                 );
echo phpver($result);

}else{
$State = 0;
$Descriptor = '数据查询失败!';
$Data=array();
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
		'Version' => $Version,
                'Data' => $Data,
        );
echo phpver($result);
}

?>
