<?php
    /**  
	 * 修改购物车接口：Editshoppingcart
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
     *id :id   commodityid:商品id  commoditynumber:商品数量  userid:会员id 
	 
     */
require_once('../../include/config.inc.php');

/*$id = isset($id) ? $id : '' ;
$commodityid = isset($commodityid) ? $commodityid : '' ;
$commoditynumber = isset($commoditynumber) ? $commoditynumber : '' ;
$userid = isset($userid) ? $userid : '' ;*/

$State = '';
$Descriptor = '';
$Version=date("Y-m-d H:i:s");
$Data = array();


	
	//修改购物车接口
	$sql = "UPDATE `shoppingcart` SET CommodityId='$commodityid', CommodityNumber='$commoditynumber', UserId='$userid' WHERE `Id`='$id'";
	$dosql->ExecNoneQuery($sql);
	

    $row = $dosql->GetOne("SELECT * FROM `shoppingcart` WHERE Id='$id'");
	if(is_array($row)){
$State = 1;
$Descriptor = '数据修改成功！';	
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
$Descriptor = '数据修改失败!';	
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