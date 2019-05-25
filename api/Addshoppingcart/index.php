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
	 *需要做好判断1.加入购物车的商品，首先判断目前的购物车里面是否有这种商品，如果有的话就直接在原来的基础上加上现在需要购买的商品商量
	 *          2.如果购物车里面没有这种商品，则在购物车清单里面加入这种商品的列表
	 *          3.用户购买完毕之后，不管是否购买成功，清空购物清单里面的商品列表
     */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();


	
	//像数据库里面导入购物记录
    $id= getrandomstring(20);   //购物车Id
	// 向购买的客户购物车里面添加数据
	/*添加购物车的步骤
	①.通过商品id和会员id查询购物车里面是否有相同的产品 ，如果有的话在原来的基础上面加上后面购买的商品数量
	②.如果购物车里面没有加入的商品Id，则添加一条新的数据到购物车里面去
	
	*/
	$r = $dosql->GetOne("SELECT * FROM `shoppingcart` WHERE CommodityId='$commodityid' and UserId='$userid'");
	if(is_array($r)){
		$setnumber=$r['CommodityNumber'];  //计算目前购物车里面的商品数量
		$number=$commoditynumber+$setnumber;
	    $sql ="UPDATE `shoppingcart` SET CommodityNumber='$number',Id='$id' WHERE CommodityId='$commodityid' and UserId='$userid'";
        $dosql->ExecNoneQuery($sql);	
		}else{
	$sql = "INSERT INTO `shoppingcart` (Id, CommodityId, CommodityNumber, UserId, CreatTime) VALUES ('$id', '$commodityid','$commoditynumber', '$userid', '$Version')";
	$dosql->ExecNoneQuery($sql);
		}
$show = $dosql->GetOne("SELECT * FROM `shoppingcart` WHERE Id='$id'");
if(is_array($show)){
$State = 1;
$Descriptor = '添加数据成功！';	
$Data[]=$show;
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
                'Data' => $Data,	
                 );
echo phpver($result);
}else{
$State = 0;
$Descriptor = '数据添加失败!';	
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