<?php
    /**  
	 * 链接地址：LoginCheck
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
     * @根据商户id查询商品，提供phone 随机数randnumber`
     */
	 
require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
//select * from tbl_dept a inner join tbl_emp b on a.id=b.deptId;
$row = $dosql->GetOne("SELECT * FROM randnumber a inner join memberuser b on b.Account=a.phone WHERE a.phone='$phone' and a.number='$randnumber`'");
if(is_array($row)){
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