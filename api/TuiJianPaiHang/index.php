<?php
    /**  
     * 链接地址：TuiJianPaiHang  推荐排行
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
$one=1;
$two=2;
$dosql->Execute("SELECT b.CommercialName,b.CommercialImg,a.num FROM `#@__active` a inner join commercialuser b on a.recommand=b.Recommand and a.year='$year' and a.month='$month' and a.daima='0' order by a.num desc",$one);
if($dosql->GetTotalRow($one)>0){
$i=0;
$num=$dosql->GetTotalRow($one);
while($i<$dosql->GetTotalRow($one))
{   $row = $dosql->GetArray($one);

	$Data[$i]=$row;
	$number=$row['num'];
    if($number<30){
	$Data[$i]['yu']=0;	
	}elseif($number>=30 && $number<100){
	$Data[$i]['yu']=1;		
	}elseif($number>=100 && $number<200){
	$Data[$i]['yu']=2;		
	}elseif($number>=200 && $number<300){
	$Data[$i]['yu']=3;		
	}elseif($number>=300 && $number<500){
	$Data[$i]['yu']=4;		
	}elseif($number>=500 && $number<700){
	$Data[$i]['yu']=5;		
	}elseif($number>=700 && $number<20000){
	$Data[$i]['yu']=6;		
	}
	
	$i++;
}
$State = 1;
$Descriptor = '数据查询成功！';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,
                'Num' => $num,	
                'Cishu'	=>intval($month),			
                 );
echo phpver($result);

}else{

$State = 0;
$Descriptor = '数据查询失败!';	
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}

?>