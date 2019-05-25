<?php	require_once(dirname(__FILE__).'/inc/config.inc.php');

/*
**************************
(C)2010-2017 phpMyWind.com
update: 2014-5-30 17:22:45
person: Feng
**************************
*/


//初始化参数
$tbname = 'commodity';
$gourl  = 'product.php';


//引入操作类
require_once(ADMIN_INC.'/action.product.class.php');

//添加商品
if($action == 'add')
{
	if(!isset($picarr))        $picarr = '';
	//文章组图
	if(is_array($picarr) && is_array($picarr_txt))
	{
		$picarrNum = count($picarr);
		$picarrTmp = '';

		for($i=0;$i<$picarrNum;$i++)
		{
			if($picarrNum!=1){
			$picarrTmp[] = $picarr[$i].','.$picarr_txt[$i];
			}else{
			$picarrTmp[] = $picarr[$i];
			}
		}

		$picarr = json_encode($picarrTmp);
	}

    //获取商品省份
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_prov'");
	// print_r($row);
	 $live_provs=$row['dataname'];
	//获取商品城市
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_city'");
     $live_citys=$row['dataname'];
	//获取商品的所属账号,省份，城市
	 $row = $dosql->GetOne("SELECT * FROM `#@__admin` WHERE `username` = '$username'");
	 $levelname=$row['levelname'];
	 $p=$row['live_prov'];
	 $c=$row['live_city'];

	 if($live_provs!=$p  || $live_citys!=$c){
	  ShowMsg('商品所属账号的城市与所选城市不一致，请重新选择！','product_add.php');
	  exit();
		 }
	$arr=explode(",",$CommodityClass);
	$cy=$arr[3];
	$a="/uploads";
	$b=$cfg_weburl."/uploads";
	if(strpos($Details,$cfg_weburl) !== false){
   $content=$Details;
   }else{
  $content=str_replace($a,$b,$Details);
   }

	$sql = "INSERT INTO `$tbname` (Id,Title, yuyue,Images,picurl2, picarr,NewPrice, OldPrice, JiuQian, RecommendIndex, SJJiuQian, ActivityType, CommodityType, CommodityClass, CreatTime,del,orderid,Pinpai,Types,Country,gd,Details,live_prov,live_city,prov,city,UserName,adminlevel,summary,shprice,canshu) VALUES ('$Id','$Title', '$yuyue','$picurl', '$picurl2', '$picarr','$NewPrice', '$OldPrice', '$JiuQian', '$RecommendIndex', '$SJJiuQian', '$ActivityType', '$CommodityType', '$cy', '$CreatTime', '$del', '$orderid','$pinpai','$types','$country','$gd','$content','$live_provs','$live_citys','$live_prov','$live_city','$username',$levelname,'$summary','$shprice','$canshu')";
	if($dosql->ExecNoneQuery($sql))
	{
        include("api/Api_GetCommodityById.php");      //添加商品之后，更新单个商品缓存
		include("api/Api_GetCommodityByType.php");    //添加商品之后，更新单个分类的商品缓存
		include("api/Api_GetCommodity.php");          //添加商品之后，更新全部商品缓存
		header("location:$gourl");
		exit();
	}

}

//修改商品内容
else if($action == 'update')

{   if(!isset($picarr))        $picarr = '';
//文章组图
	if(is_array($picarr))
	{
		$picarrNum = count($picarr);
		$picarrTmp = '';

		for($i=0;$i< $picarrNum;$i++)
		{
			$picarrTmp[] = $picarr[$i];
		}

		$picarr = json_encode($picarrTmp);
	}

    //获取商品省份
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_prov'");
	// print_r($row);
	 $live_provs=$row['dataname'];
	//获取商品城市
	 $row = $dosql->GetOne("SELECT * FROM `pmw_cascadedata`WHERE `datavalue` = '$live_city'");
     $live_citys=$row['dataname'];


	$arr=explode(",",$CommodityClass);
	$cy=$arr[3];
	$c=$cfg_weburl;
	if(strpos($Details,$c)!==false){
	$Details=str_replace($c,'',$Details);
	}
	$a="/uploads";
	$b=$cfg_weburl."/uploads";
  $content=str_replace($a,$b,$Details);
	//更新商品的月销量
	$thisyear=date("Y",time());
	$thismonth=date("m",time());
	$r=$dosql->GetOne("select * from commodity_month_nums where commodityid_id='$id'");
	if(is_array($r)){
	$month_nums_last=$month_nums+$new_nums;
	$dosql->ExecNoneQuery("update commodity_month_nums set new_nums=$new_nums,month_nums_last=$month_nums_last where commodityid_id='$id'");
	}else{
	$month_nums_last=$month_nums+$new_nums;
	$dosql->ExecNoneQuery("insert into commodity_month_nums(commodityid_id,year,month,new_nums,month_nums_last) values ('$id',$thisyear,$thismonth,$new_nums,$month_nums_last)");
	}
	$sql = "UPDATE `$tbname` SET yuyue='$yuyue',Title='$Title',Pinpai='$pinpai',Types='$types',Country='$country',Images='$picurl',picurl2='$picurl2',picarr='$picarr',NewPrice='$NewPrice',OldPrice='$OldPrice',shprice='$shprice',JiuQian='$JiuQian',RecommendIndex='$RecommendIndex',SJJiuQian='$SJJiuQian',ActivityType='$ActivityType',CommodityType='$CommodityType',CommodityClass='$cy',orderid='$orderid',Details='$content',gd='$gd',live_prov='$live_provs',live_city='$live_citys',summary='$summary',prov='$live_prov',city='$live_city',canshu='$canshu' WHERE Id='$id'";

	if($dosql->ExecNoneQuery($sql))
	{
		include("api/Api_GetCommodityById.php");            //修改商品之后，更新单个商品缓存
		include("api/Api_GetCommodityByType.php");          //修改商品之后，更新单个分类的商品缓存
		include("api/Api_GetCommodity.php");                //修改商品之后，更新全部商品缓存

		header("location:$gourl");
		exit();
	}
}
elseif($action=="update_cache"){                           //更新商品所有的缓存，总商品数据缓存，和单个商品的数据缓存
	include("api/Api_GetCommodity.php");                   //更新全部商品缓存
	$sql="select * from `$tbname`";
	$dosql->Execute($sql);
	$i=0;
   while($i<$dosql->GetTotalRow())
    {
	$date[$i]=$row = $dosql->GetArray();

	$cachename=$row['Id'];
	GetCache($date[$i],$cachename);	                     //更新所有的单个商品的缓存数据
	$i++;
	}

	ShowMsg("缓存数据更新成功",$gourl);
}
else if($action == 'del3'){
	$sql = "delete  from `$tbname` where Id='$id'";
	$dosql->ExecNoneQuery($sql);
	//根据接口的实际情况，进行编写sql语句(GetCommodity接口)

	include("api/Api_Del_GetCommodityById.php");                 //删除商品之后，将商品缓存删除
	include("api/Api_GetCommodityByType.php");                   //删除商品之后，更新单个分类的商品缓存
	include("api/Api_GetCommodity.php");                         //删除商品之后，更新全部商品缓存
	header("location:$gourl");
	exit();
}
else if($action == 'kdcost'){
	$tbname="pmw_cascadedata";
	$sql = "UPDATE `$tbname` SET dataname='$rulename',costmoney='$rulemoney' WHERE id=$id";
	if($dosql->ExecNoneQuery($sql))
	{
		$gourls="kdcost.php";
		//ShowMsg("更新成功",$gourls);
		header("location:$gourls");
		exit();
	}
}
//无条件返回
else
{
    header("location:$gourl");
	exit();
}
?>
