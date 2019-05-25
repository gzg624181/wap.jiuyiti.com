<?php

//根据接口的实际情况，进行编写sql语句(GetCommodity接口)
		$citys="武汉市";
		$dosql->Execute("SELECT Id,Title,Explains,Images,NewPrice,shprice,OldPrice,Standard,Colour,JiuQianMax,JiuQian,picurl2,picarr,RecommendIndex,CommentNumber,Pinpai,Types,Grade,ActivityType,TwoImg,CommodityNumber,Commercial,CreatTime,CommodityClass,SJJiuQian,yuyue,summary FROM `commodity` WHERE del='0' and live_city='$citys' order by orderid desc");
		while($row = $dosql->GetArray())
		{
			$date[]=$row;
		}
		$cachename="GetCommodity";
		GetCache($date,$cachename);
		
		?>