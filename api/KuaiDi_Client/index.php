<?php
	/*
	**  快递鸟
	**    getOrderTracesByJson() 
	**    ->$eBusinessID         //电商的ID        
	**    ->$appKey             //电商加密私钥，快递鸟提供，注意保管，不要泄漏
	**     ->$reqURL            //电商的ID
	**  ->$shipperCode          //快递商编号
	**     ->$logisticCode      //快递单号
	****/

    /**  
	 * 链接地址：KuaiDi_Client
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
     * @提供会员账号：$shipperCode (快递名称)   $LogisticCode(快递单号)    会员订单账号OrderId
     */
	 
require_once('../../include/config.inc.php');

$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");

//电商ID
require_once('../../include/config.inc.php');
$ebusinessid="1320793";
$appKey="bfbae16b-cd00-43bd-866c-085c78f26515";
$r=$dosql->GetOne("select * from orderform_commercial where OrderId='$OrderId'");
$shipperCode=$r['kd_exp'];
$LogisticCode=$r['kd_number'];
if($shipperCode=="中通快递"){
$shipperCode="ZTO";	
}elseif($shipperCode="韵达快递"){
$kd="YD";
}
 //$LogisticCode="475511397016";
defined('EBusinessID') or define('EBusinessID', $ebusinessid);
//电商加密私钥，快递鸟提供，注意保管，不要泄漏
defined('AppKey') or define('AppKey', $appKey);
//请求url
defined('ReqURL') or define('ReqURL', 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx');
/**
 * Json方式 查询订单物流轨迹
 */
function getOrderTracesByJson(){
	global $shipperCode;
	global $LogisticCode;
	$requestData= "{'OrderCode':'','ShipperCode':'$shipperCode','LogisticCode':'$LogisticCode'}";
	
	$datas = array(
        'EBusinessID' => EBusinessID,
        'RequestType' => '1002',
        'RequestData' => urlencode($requestData) ,
        'DataType' => '2',
    );
    $datas['DataSign'] = encrypt($requestData, AppKey);
	$result=sendPost(ReqURL, $datas);	
	
	//根据公司业务处理返回的信息......
	
	return $result;
}

/**
 *  post提交数据 
 * @param  string $url 请求Url
 * @param  array $datas 提交的数据 
 * @return url响应返回的html
 */
function sendPost($url, $datas) {
    $temps = array();	
    foreach ($datas as $key => $value) {
        $temps[] = sprintf('%s=%s', $key, $value);		
    }	
    $post_data = implode('&', $temps);
    $url_info = parse_url($url);
	if(empty($url_info['port']))
	{
		$url_info['port']=80;	
	}
    $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
    $httpheader.= "Host:" . $url_info['host'] . "\r\n";
    $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
    $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
    $httpheader.= "Connection:close\r\n\r\n";
    $httpheader.= $post_data;
    $fd = fsockopen($url_info['host'], $url_info['port']);
    fwrite($fd, $httpheader);
    $gets = "";
	$headerFlag = true;
	while (!feof($fd)) {
		if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
			break;
		}
	}
    while (!feof($fd)) {
		$gets.= fread($fd, 128);
    }
    fclose($fd);  
    
    return $gets;
}

/**
 * 电商Sign签名生成
 * @param data 内容   
 * @param appkey Appkey
 * @return DataSign签名
 */
function encrypt($data, $appkey) {
    return urlencode(base64_encode(md5($data.$appkey)));
}

$logisticResult=getOrderTracesByJson();
$arr= json_decode(stripslashes($logisticResult),true); 
 //  state 物流状态：2-在途中,3-签收,4-问题件
 //  Success  1成功  0失败

if($arr['Success']==1){
$State = 1;
$Data[]=$arr;
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