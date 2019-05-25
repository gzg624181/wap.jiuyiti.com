<?php
    /**  
	 * 添加购物车接口：Addshoppingcart
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
       提供参数	 
     *commodityid :商品id   commoditynumber:商品数量    userid:会员id
	 *  
	 */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();


	
	//像数据库里面导入购物记录
	// 向购买的客户购物车里面添加数据
	/*小程序端同步购物车的步骤
	①.删除购物车里面同一个userid的商品信息，同时更新购物车里面的信息
	*/

	$arrs=stripslashes($Datas);
	$arr=json_decode($arrs);
	//print_r($arr);
	//用户userid的id
	$userid=$arr->userid;
	//echo $userid;
	$shoppingcartlist=$arr->shoppingcartlist;
	$r=$dosql->GetOne("select * FROM `shoppingcart` WHERE UserId='$userid'");
	if(is_array($r)){
	$dosql->QueryNone("DELETE FROM `shoppingcart` WHERE UserId='$userid'");	
	}
	//print_r($shoppingcartlist);
    for($i=0;$i<count($shoppingcartlist);$i++){
	$id= getrandomstring(20).$i;   //购物车Id
	$commodityid=$shoppingcartlist[$i]->commodityid;
	$commoditynumber=$shoppingcartlist[$i]->commoditynumber;
	$userid=$shoppingcartlist[$i]->userid;
	$sql = "INSERT INTO `shoppingcart` (Id, CommodityId, CommodityNumber, UserId, CreatTime) VALUES ('$id', '$commodityid','$commoditynumber', '$userid', '$Version')";
	$dosql->ExecNoneQuery($sql);
	}
$dosql->Execute("SELECT * FROM `shoppingcart` WHERE UserId='$userid'");
if($dosql->GetTotalRow()>0){
$j=0;
while($j<$dosql->GetTotalRow())
{
	$Data[$j]=$row = $dosql->GetArray();
	$j++;
}
$State = 1;
$Descriptor = '数据查询成功！';	
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