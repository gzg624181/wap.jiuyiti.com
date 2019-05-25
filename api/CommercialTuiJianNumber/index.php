<?php
    /**  
	 * 链接地址：CommercialTuiJianNumber  获取单个商家当月的具体推荐人数（type :0，当月推荐的所有会员 1，推荐的所有的会员）
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
     * @根据商户账号  recommand  type 当月： 0   全部 ：1
     */
	 
require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$year=date("Y",time());//获取当前的年份
$month=date("m",time());//获取当前的月份
if($type==1){
$r = $dosql->GetOne("SELECT Recommand FROM `commercialuser` WHERE Commercial='$commercial'");
$recommand=$r['Recommand'];
$dosql->Execute("SELECT Phone,Alias,rec_time FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$recommand'");
$num=$dosql->GetTotalRow();
}elseif($type==0){
$r = $dosql->GetOne("SELECT Recommand FROM `commercialuser` WHERE Commercial='$commercial'");
$recommand=$r['Recommand'];
$dosql->Execute("SELECT Phone,Alias,rec_time FROM `recommand` a inner join memberuser b on a.account=b.Phone where a.tjm='$recommand' and a.year='$year' and a.month='$month'");	
$num=$dosql->GetTotalRow();
}
if($dosql->GetTotalRow()>0){
$i=0;
while($i<$dosql->GetTotalRow())
{
	$Data[$i]=$row = $dosql->GetArray();
	$i++;
}
$State = 1;
$Descriptor = '数据查询成功！';	
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,
                'NUM'=>$num,			
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