<?php
    /**
	 * 链接地址：GetCommentList

     * 下面直接来连接操作数据库进而得到json串
     *
     * @param unknown $State 状态码
     *
     * @param string $Descriptor  提示信息
     *
     * @param array $Data 数据
     *
     * @return string  查询评论列表接口
     */

require_once('../../include/config.inc.php');
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$id="me";
$ids="we";

 //已付款，未提取的订单
$dosql->Execute("SELECT * FROM `ordercommodity` where CommodityId='$commodityid' order by CreatTime desc",$id);
if($dosql->GetTotalRow($id)>0){
	// 两张表联合查询
	/* b ordercommodity 商品订单列表
	   c commodity     商品详情
	*/
for($i=0;$i<$dosql->GetTotalRow($id);$i++){
$row = $dosql->GetArray($id);
$orderid=$row['OrderId'];//一个订单号对应着多件商品

$r=$dosql->GetOne("select a.comment,a.recomment,a.timestamp,b.Alias,b.Image from pmw_comment  a inner join memberuser b on a.userid=b.account where a.orderid='$orderid' and a.status=1 order by a.timestamp desc");
if(is_array($r)){
if($r['Image']==""){
  $r['Image']="templates/default/images/noimage.jpg";
}else{
    if(strpos($r['Image'],'uploads') !== false){
    $r['Image']=$cfg_webpath.$r['Image'];
    }
    }
$Data[]=$r;
}
}
$State = 1;
$Descriptor = '数据查询成功';
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
			        	'Version' => $Version,
                'Data' => $Data
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
