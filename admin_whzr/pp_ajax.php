<?php 
        require_once(dirname(__FILE__).'/inc/config.inc.php');
		$arr=explode(",",$s);
		$pid=$arr[0];
		$lid=$arr[1];
		$cid=$arr[2];
		
		//获取所有的热门品牌的数据
		$hot="";
        $hot.= "<select name='pinpai' id='pinpai' class='input' style='width:100px;'>";
		$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$pid and parentstr like '%$pid%' and checkinfo='true'");
		while($row = $dosql->GetArray())
		{
		$hot.= "<option value='".$row['classname']."'>".$row['classname']."</option>";  
		}
		$hot.= "</select>";
		
		//获取所有的类型的数据
		$leixing="";
        $leixing.= "<select name='types' id='types' class='input' style='width:110px;'>";
		$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$lid and parentstr like '%$lid%' and checkinfo='true'");
		while($row = $dosql->GetArray())
		{
		$leixing.= "<option value='".$row['classname']."'>".$row['classname']."</option>";  
		}
		$leixing.= "</select>";
		
		//获取所有的国家的数据
		$country="";
        $country.= "<select name='country' id='country' class='input' style='width:80px;'>";
		$dosql->Execute("SELECT * FROM `pmw_maintype` where parentid=$cid and parentstr like '%$cid%' and checkinfo='true'");
		while($row = $dosql->GetArray())
		{
		$country.= "<option value='".$row['classname']."'>".$row['classname']."</option>";  
		}
		$country.= "</select>";
		
	$data = array(
    'hot' => $hot,
    'leixing' => $leixing,
    'country' => $country
    );
	echo json_encode($data);
		?>
