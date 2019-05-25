<?php
header("Content-Type: text/html; charset=utf-8");
date_default_timezone_set('PRC');
require_once(dirname(__FILE__).'/inc/config.inc.php');IsModelPriv('message');
require_once(dirname(__FILE__) . '/' . 'IGt.Push.php'); 
require_once(dirname(__FILE__) . '/' . 'igetui/IGt.AppMessage.php');
require_once(dirname(__FILE__) . '/' . 'igetui/IGt.APNPayload.php'); 
require_once(dirname(__FILE__) . '/' . 'igetui/template/IGt.BaseTemplate.php');
require_once(dirname(__FILE__) . '/' . 'IGt.Batch.php');
require_once(dirname(__FILE__) . '/' . 'igetui/utils/AppConditions.php');

//初始化参数
$tbname = 'pickupmoney';
$gourl  = 'money.php';


//引入操作类
require_once(ADMIN_INC.'/action.class.php');

$r = $dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
$Account=$r['clientid'];
$Version=date("Y-m-d H:i:s");
$Title="提现通知";          //通知标题
$CreatTime=$Version;         //通知时间
$posttime=substr($CreatTime,0,10)
//向商户推送提现的通知
$row = $dosql->GetOne("select * from  `$tbname` where Commercial='$commercial' and CreatTime='$creatime' and State=1");
$money=$row['ApplyMonery'];   //提现金额
$applytime=$row['ApplyTime'];  //申请时间
$Message="尊敬的".$commercial."商户，您于".$applytime."申请的".$money."元酒钱现已发放，请注意查收！";


//http的域名

define('HOST','http://sdk.open.api.igexin.com/apiex.htm');

//定义常量, appId、appKey、masterSecret 采用本文档 "第二步 获取访问凭证 "中获得的应用配置

define('APPKEY','xg76m9flnA7QYKc44MekR7');

define('APPID','xQWMIIKHm26YuzVXKAxIh');

define('MASTERSECRET','5steQptSHa8BXZ46sQbJe3');


//define('Alias1','请输入您的Alias1'); //define('Alias2','请输入您的Alias2');

pushMessageToList();


//define('BEGINTIME','2015-03-06 13:18:00');


//define('ENDTIME','2015-03-06 13:24:00');

//多推接口案例
function pushMessageToList()
{
	global $Account;
    putenv("gexin_pushList_needDetails=true");
    putenv("gexin_pushList_needAsync=true");

    $igt = new IGeTui(HOST, APPKEY, MASTERSECRET);
    //消息模版：
    // 1.TransmissionTemplate:透传功能模板
    // 2.LinkTemplate:通知打开链接功能模板
    // 3.NotificationTemplate：通知透传功能模板
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板


    //$template = IGtNotyPopLoadTemplateDemo();
    //$template = IGtLinkTemplateDemo();
    //$template = IGtNotificationTemplateDemo();
    $template = IGtTransmissionTemplateDemo();
    //个推信息体
    $message = new IGtListMessage();
    $message->set_isOffline(true);//是否离线
    $message->set_offlineExpireTime(3600 * 12 * 1000);//离线时间
    $message->set_data($template);//设置推送消息类型
//    $message->set_PushNetWorkType(1);	//设置是否根据WIFI推送消息，1为wifi推送，0为不限制推送
//    $contentId = $igt->getContentId($message);
    $contentId = $igt->getContentId($message,"toList任务别名功能");	//根据TaskId设置组名，支持下划线，中文，英文，数字

    // $target1 = new IGtTarget(); 
	// $target1->set_appId(APPID); 
	// $target1->set_clientId(CID1);
	
    // $target2 = new IGtTarget(); 
    // $target2->set_appId(APPID); 
    // $target2->set_clientId(CID2);

	// $targetList[0] = $target1; 
	// $targetList[1] = $target2;

	$array=explode(",",$Account);
	for($i=0;$i<count($array);$i++){
	$target = new IGtTarget(); 
	$target->set_appId(APPID); 
	$target->set_clientId($array[$i]);
	$targetList[]=$target;
    }
$rep = $igt->pushMessageToList($contentId, $targetList); 
//var_dump($rep);

}
$sql = "UPDATE `$tbname` SET  send=1 WHERE Commercial='$commercial' and CreatTime='$creatime' and posttime=$posttime";		
$dosql->ExecNoneQuery($sql);
header("location:$gourl");
exit();	

function IGtTransmissionTemplateDemo(){
$Version=date("Y-m-d h:i:s");
$template = new IGtTransmissionTemplate();
$template->set_appId(APPID);//应用appid
$template->set_appkey(APPKEY);//应用appkey
$template->set_transmissionType(2);//透传消息类型
global $Title,$Message,$CreatTime;
$arr=array();
$arr = array('title' =>$Title,'content'=>$Message,'time'=>$CreatTime);
$shuzu=json_encode($arr);
$template->set_transmissionContent($shuzu);//透传内容
//$template->set_transmissionContent("测试离线ddd");//透传内容
//$template->set_duration(BEGINTIME,ENDTIME); //设置ANDROID客户端在此时间区间内展示消息

// 如下有两个推送模版，一个简单一个高级，可以互相切换使用。此处以高级为例，所以把简单模版注释掉。
// APN简单推送
// $apn = new IGtAPNPayload();
// $alertmsg=new SimpleAlertMsg();
// $alertmsg->alertMsg="";
// $apn->alertMsg=$alertmsg;
// $apn->badge=2;
// $apn->sound="";
// $apn->add_customMsg("payload","payload");
// $apn->contentAvailable=1;
// $apn->category="ACTIONABLE";
// $template->set_apnInfo($apn);
// APN高级推送
$apn = new IGtAPNPayload();
$alertmsg=new DictionaryAlertMsg();
$alertmsg->body="body";
$alertmsg->actionLocKey="ActionLockey";
$alertmsg->locKey="LocKey";
$alertmsg->locArgs=array("locargs");
$alertmsg->launchImage="launchimage";
// IOS8.2 支持
$alertmsg->title="水培喝水";
$alertmsg->titleLocKey="TitleLocKey";
$alertmsg->titleLocArgs=array("TitleLocArg");
$apn->alertMsg=$alertmsg;
$apn->badge=1;
$apn->sound="";
$apn->add_customMsg("payload","阿波罗度上市");
// $apn->contentAvailable=1;
$apn->category="ACTIONABLE";
$template->set_apnInfo($apn);
return $template;
}






?>