<?php
    /**  
	 * 链接地址：Recommand_sjtixian
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
     * @查询所有商品 不需要提供返回参数账号 提供参数：commercial
     */
require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$jiuqian_la=0;
$r = $dosql->GetOne("SELECT Recommand FROM `commercialuser` WHERE Commercial='$commercial'");
$recommand=$r['Recommand'];
  $dosql->Execute("SELECT * FROM `recommandlist` a inner join memberuser b on a.account=b.Phone where a.tjm='$recommand' and a.type=1");
if($dosql->GetTotalRow()>0){
$i=0;
while($i<$dosql->GetTotalRow())
{
	$Data[$i]=$row = $dosql->GetArray();
	$numss[]=$row['sum_money'];	
	$i++;
}
$State = 1;
$Descriptor = '数据查询成功！';	
if($dosql->GetTotalRow() == 0){
	$num= 0;
	}else{
foreach($numss as $val){
	$jiuqian_la += $val;	
}
$num= $jiuqian_la;
	}
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,
                'NUM'=>$num					
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