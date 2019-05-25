<?php
    /**  
     * 链接地址：Addcomment
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
     * @return string  添加评论接口   Addcomment
     *           
     * @添加评论接口   提供返回参数账号
     *
	 
    orderid  订单id   
	 
    comment:评论内容  
	 
    recomment:回复内容
	 
    timestamp:添加评论时间    
	 
     userid:会员id

     score_total: 总评分

     score1:评分1

     score2:评分2

     tag: 评分标签
	  
     添加评论接口   
     */
require_once('../../include/config.inc.php');


$State = '';
$Descriptor = '';
$Version=date("Y-m-d h:i:s");
$Data = array();


    
	$rows = $dosql->GetOne("SELECT * FROM `pmw_comment` WHERE orderid='$orderid'");
        if(!is_array($rows)){
	$posttime=date("Y-m-d H:i:s",$timestamp/1000);
	$sql = "INSERT INTO `pmw_comment` (comment, userid, orderid, score_total,score1,score2,timestamp) VALUES ('$comment', '$userid', '$orderid',$score_total,$score1,$score2,'$posttime')";
	$dosql->ExecNoneQuery($sql);
	
	//同时将订单的评论状态改为已评论
	$sql = "UPDATE `orderform` SET IsComment=1 WHERE `OrderId`='$orderid'";
	$dosql->ExecNoneQuery($sql);

        $row = $dosql->GetOne("SELECT * FROM `pmw_comment` WHERE orderid='$orderid'");
	
	$Data[]=$row;
	$State = 1;
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