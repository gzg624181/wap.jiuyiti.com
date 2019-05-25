<?php
    /**  
	 * 链接地址：CommercialTuiJian  获取单个商家当月的排行榜
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
     * @获取单个商家当月的排行榜 提供参数 商家的账号  commercial
     */
require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$year=date("Y");//获取当前的年份
$month=date("m");//获取当前的月份
$r = $dosql->GetOne("SELECT Recommand FROM `commercialuser` WHERE Commercial='$commercial'");
$recommand=$r['Recommand'];
$row = $dosql->GetOne("SELECT b.CommercialName,b.CommercialImg,a.num,a.Recommand FROM `#@__active` a inner join commercialuser b on a.recommand=b.Recommand and a.year='$year' and a.month='$month' and a.daima='0' where a.recommand='$recommand'");

if(is_array($row)){
$row['yu']=intval($row['num'] / 100);
$State = 1;
$Data[]=$row;
$Descriptor = '数据查询成功';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据查询失败!';	
$r = $dosql->GetOne("SELECT Recommand FROM `commercialuser` WHERE Commercial='$commercial'");
$recommand=$r['Recommand'];
$show = $dosql->GetOne("SELECT CommercialName,CommercialImg,Recommand from commercialuser  where Recommand='$recommand'");
$show['num']=0;
$show['yu']=0;
$Data[]=$show;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}

?>