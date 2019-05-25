<?php
    /**
	 * 链接地址：CollectList
	 
     * 下面直接来连接操作数据库进而得到json串
     * 
     * @param integer $State 状态码
     *            
     * @param string $Descriptor  提示信息
     *           
     * @param array $Data 数据
     *            
     * @return string  查询浏览记录接口
     */
	 
require_once('../../include/config.inc.php');
$one=1;
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
$dosql->Execute("SELECT * FROM `orderform` where  UserId='$userid' and State='1' order by CreatTime desc",$one); 
$pay=$dosql->GetTotalRow($one);
 //已提取 
/*$dosql->Execute("SELECT * FROM `orderform` where  UserId='$userid' and State='8' order by CreatTime desc",$two); 
$tiqu=$dosql->GetTotalRow($two)
 //未付款
$dosql->Execute("SELECT * FROM `orderform` where  UserId='$userid' and State='5' order by CreatTime desc",$three); 	
$unpay=$dosql->GetTotalRow($three)
*/
if($dosql->GetTotalRow($one)>0){
$Data=array(
      'Pay'=>$pay,
	 // 'TIQU'=>$tiqu,
	//  'UNPAY'=>$unpay,
	//  'SHIXIAO'=>$shixiao
);
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