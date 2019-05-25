<?php
    /**  
	 * 链接地址：ChangeAppointment
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
     * @预约功能 提供返回参数账号，预约地点：address   预约时间：time  订单号 orderid   用户 userid
     */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();
   /*   预约商品步骤
    *   1.向数据库导入预约商品步骤
    *   2.购买商品的数组Id
    *	3.商家库存ID
    *   4.商品Id进行对比 
    *   5.和商家的库存id数量做对比
	*/

/*	//预约订单的商品Id
$one=1;
$dosql->Execute("select a.CommodityId from ordercommodity a inner join commodity b on a.CommodityId=b.Id where a.OrderId='$orderid'",$one);
while($row=$dosql->GetArray($one)){
    $xhs[]=$row['CommodityId'];	 //商品id	
}
$dosql->Execute("SELECT * FROM commoditystock,commodity where commoditystock.CommodityId=commodity.Id and commoditystock.CommercialUser='$commercial'",$two);
while($rows=$dosql->GetArray($two)){
    $new_xhs[]=$rows['CommodityId'];	
}	
$a=$xhs;
$b=$new_xhs;

$flag = 1;
foreach ($a as $va) {
  if (in_array($va, $b)) {
    continue;   //continue和break有点类似，区别在于continue只是终止本次循环，接着还执行后面的循环，break则完全终止循环。
  }else{
    $flag = 0;
    break;    //可以理解为continue是跳过当次循环中剩下的语句，执行下一次循环。
  }
}
*/
	//向数据库里面导入预约信息
$sql ="UPDATE `orderform` SET address='$address',time='$time',dingdantype=1 where OrderId='$orderid' and UserId='$userid'";
$dosql->ExecNoneQuery($sql);
	
$row = $dosql->GetOne("SELECT * FROM `orderform` where OrderId='$orderid' and UserId='$userid'");
if(is_array($row)){
$State = 1;
$Descriptor = '预约转换成功！';	
$Data[]=$row;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
        );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '预约转换失败!';	
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