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
//电商ID
require_once(dirname(__FILE__).'/inc/config.inc.php');
$ebusinessid="1320793";
$appKey="bfbae16b-cd00-43bd-866c-085c78f26515";
// $shipperCode="ZTO";
// $LogisticCode="475511397016";
defined('EBusinessID') or define('EBusinessID', $ebusinessid);
//电商加密私钥，快递鸟提供，注意保管，不要泄漏
defined('AppKey') or define('AppKey', $appKey);
//请求url
defined('ReqURL') or define('ReqURL', 'http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx');

//调用查询物流轨迹
//---------------------------------------------

//调用程序
//---------------------------------------------
 
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

?>

<?php
if($shipperCode=="ZTO"){
$kd="中通快递";	
}elseif($shipperCode="YD"){
$kd="韵达快递";
}
echo "<table width='100%' border='0' cellspacing='0' cellpadding='0' class='formTable'>";

$logisticResult=getOrderTracesByJson();
$arr= json_decode(stripslashes($logisticResult),true); 
if($arr['State']==3){

		echo "<tr>";
		echo "<td style='color:#ff7800' height='40' align='center'>"; ?>
		<?php $riqi= substr($arr['Traces'][count($arr['Traces'])-1]['AcceptTime'],0,10);
		      
		      $w= date("w",strtotime($riqi)); 
			  
			 switch($w)
			{
				case '1':
					$xingqi = '星期一';
					break;  
				case '2':
					$xingqi = '星期二';
					break;
				case '3':
					$xingqi = '星期三';
					break;  
				case '4':
					$xingqi = '星期四';
					break;
				case '5':
					$xingqi = '星期五';
					break;  
				case '6':
					$xingqi = '星期六';
					break;
				case '0':
					$xingqi = '星期日';
					break;
			}
			echo $riqi."&nbsp;&nbsp;";
			echo $xingqi;
		?>
        <?php echo "</td>
		<td style='color:#ff7800'>派件已签收 感谢使用";?><?php echo $kd;?>
          <?php echo ",期待再次为您服务!</td>
        </tr>
		<tr>
		  <td height='40' align='center'>时间</td>
		  <td width='74%'>地点和跟踪进度</td>
    </tr>"?>
 <?php }?>
<?php

// print_r($arr);     //  state 物流状态：2-在途中,3-签收,4-问题件
                     //  Success  1成功  0失败
if($arr['Success']==1){					
$num = count($arr['Traces']); 

for($i=$num-1;$i>=0;$i--){
	if($i<0){break;}
?>
	<tr>
			<td width="26%" height="54" align="center"><?php echo $arr['Traces'][$i]['AcceptTime'];?> </td>
			<td><?php echo $arr['Traces'][$i]['AcceptStation'];?></td>
	</tr>
	<?php }}?>
</table>

