<?php
    /**
	 * 链接地址：ReadCode
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
	   *
     * @param array $Data 数据
     *
     * @return string
     *
     * @获取商品详情  商品金额，money  商家账号 commercial  购物券id  shanghuzhanghao
     */

require_once('../../include/config.inc.php');
error_reporting(E_ALL & ~E_NOTICE);
$State = 0;
$Descriptor = '';
$Data = array();
$Version=date("Y-m-d H:i:s");
//通过优惠券的id获取当前优惠券的有效期,
$kow=$dosql->GetOne("select * from couponslist where id='$id'");
$deadtime=$kow['creatime'];
$now=strtotime(date('Y-m-d',time()));  //获取当前的系统日期
$endtime=strtotime($deadtime);
$diff=$endtime-$now;
//0失败，1成功，2.已使用 3.已过期
if($diff>=0){
if($commercial=$shanghuzhanghao){  //一对一优惠券,同时优惠券在有效期内
//判断是否存在这个商户
$r=$dosql->GetOne("select * from commercialuser where Commercial='$commercial'");
if(is_array($r)){
        $g=$dosql->GetOne("select * from couponslist where id='$id' and state=0");
        if(is_array($g)){
		//扫码成功之后，更新购物券为1，已使用
        $sql ="UPDATE `couponslist` SET state=1 WHERE id='$id'";
        $dosql->ExecNoneQuery($sql);
		//扫码成功之后，将优惠券的价值增加到商家的酒钱上面去
        $jiuqian=floatval($r['JiuQian'])+floatval($money);
        $sql ="UPDATE `commercialuser` SET JiuQian='$jiuqian' WHERE Commercial='$commercial'";
        $dosql->ExecNoneQuery($sql);
		//扫码成功之后，将优惠券的记录保存下来
		//保存的字段有1.会员账号account  2.商户账号commercial 3.优惠券金额money 4.优惠券使用时间gettime 5.优惠券图标picurl
		$tbname = 'record';
		$j=$dosql->GetOne("select * from couponslist a inner join memberuser b on a.account=b.Account where a.id='$id'");
		$alias=$j['Alias'];  //会员昵称

		$k=$dosql->GetOne("select * from couponslist a inner join coupons b on a.gid=b.id where a.id='$id'");
		$logo=$k['logo'];  //购物券logo
    $gid=$k['gid'];  //购物券id
		$type=$k['type'];

	    $sql = "INSERT INTO `$tbname` (account,commercial,gettime,money,gid,picurl,type) VALUES ('$alias', '$commercial', '$Version','$money',$gid,'$logo',$type)";
		$dosql->ExecNoneQuery($sql);
  }
		$s=$dosql->GetOne("select Commercial,JiuQian from commercialuser where Commercial='$commercial'");
		$Data[]=$s;
        $State = 1;
        $Descriptor = '数据扫码成功！';
        $result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'Data' => $Data
                 );
        echo phpver($result);
        }else{
$State = 0;
$Descriptor = '数据扫码失败!';
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
				'Version' => $Version,
				'Data' => $Data
        );
echo phpver($result);
}
}else{      //通用优惠券
//判断是否存在这个商户
$r=$dosql->GetOne("select * from commercialuser where Commercial='$shanghuzhanghao'");
if(is_array($r)){
        $g=$dosql->GetOne("select * from couponslist where id='$id' and state=0");
        if(is_array($g)){
		//扫码成功之后，更新购物券为1，已使用
        $sql ="UPDATE `couponslist` SET state=1 WHERE id='$id'";
        $dosql->ExecNoneQuery($sql);
		//扫码成功之后，将优惠券的价值增加到商家的酒钱上面去
        $jiuqian=floatval($r['JiuQian'])+floatval($money);
        $sql ="UPDATE `commercialuser` SET JiuQian='$jiuqian' WHERE Commercial='$shanghuzhanghao'";
        $dosql->ExecNoneQuery($sql);

		$tbname = 'record';
		$j=$dosql->GetOne("select * from couponslist a inner join memberuser b on a.account=b.Account where a.id='$id'");
		$alias=$j['Alias'];  //会员昵称

		$k=$dosql->GetOne("select * from couponslist a inner join coupons b on a.gid=b.id where a.id='$id'");
		$logo=$k['logo'];  //购物券logo
    $gid=$k['gid'];  //购物券id
		$type=$k['type'];

	    $sql = "INSERT INTO `$tbname` (account,commercial,gettime,money,gid,picurl,type) VALUES ('$alias', '$commercial', '$Version','$money',$gid,'$logo',type)";
		$dosql->ExecNoneQuery($sql);
	}
		$s=$dosql->GetOne("select Commercial,JiuQian from commercialuser where Commercial='$shanghuzhanghao'");
		$Data[]=$s;
        $State = 1;
        $Descriptor = '数据扫码成功！';
        $result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version,
								'Data' => $Data
                 );
        echo phpver($result);
        }else{
$State = 0;
$Descriptor = '数据扫码失败!';
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version,
								'Data' => $Data
        );
echo phpver($result);
}
}
}else{
$State = 2;
$Descriptor = '优惠券已过期！';
$Data[]="";
$result = array (
                'State' => $State,
                'Descriptor' => $Descriptor,
								'Version' => $Version,
								'Data' => $Data
        );
echo phpver($result);
}
?>
