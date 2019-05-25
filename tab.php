						<?php
						$state=$_GET['tab'];
						$userid=$_GET['orderid'];
						$cfg_geturl="https://wap.jiuyiti.zrcase.com/";
						$get_name="GetorderList_Client_Pc";
						if($state==0){   //全部有效订单
						//type(1已付款 2已提取  3未付款  0全部订单)
						$type=0;		   //全部订单	
						$arr = file_get_contents(stripslashes($cfg_geturl."api/".$get_name."/index.php?type=".$type."&userid=".$userid));  //去除对象里面的斜杠
						$str = json_decode($arr,true);
						$ssr=$str['Data'];
						for($i=0;$i<count($ssr);$i++){
						 switch($ssr[$i]['State'])
						{
							case 1: 
								$state = "<font color='#1f8c71'>".'已付款'."</font>";
								break;  
							case 5:
								$state = "<font color=red>".'待付款'."</font>";
								break;
							case 8:
								$state = "<font color='#2e61b9'>".'已发货'."</font>";
								break;
						}
						switch($ssr[$i]['PaymentType'])
						{
							case 1: 
								$paymenttype = '酒钱支付';
								break;  
							case 2:
								$paymenttype = '现金支付';
								break;
							case 3:
								$paymenttype = '混合支付';
								break;
							case 4:
								$paymenttype = '未支付';
								break;
						}
						echo "<div class='shop-order-list state-1' style='border-radius: 3px;'>
						<div class='row shop-order-top'>
						<div class='col-md-8 col-sm-8 ting'>
						<h4>".$state."</h4>
						<span class='info'>".$ssr[$i]['CreatTime']."</span>
						<span class='info'>订单号 : ".$ssr[$i]['OrderId']."</span>
						<span class='info'>".$paymenttype."</span></div>
						<div class='col-md-4 col-sm-4 ting text-right'>
						订单金额 ：<span class='price grey-800'>".sprintf("%.2f",($ssr[$i]['PayAmount']+$ssr[$i]['PayJiuQian']+$ssr[$i]['PayKdMoney']))."元</span></div>
						</div>
						<div class='row shop-order-bottom'>
						<div class='col-md-7 col-sm-6'>";
						$row=$ssr[$i]['Commodity'];
						for($j=0;$j<count($row);$j++){
							$gourl = 'productshow-'.$row[$j]['CommodityClass'].'-'.$row[$j]['CommodityId'].'-'.$j.'-1.html';
							$picurl=$cfg_geturl.$row[$j]['picurl2'];
						echo "<div class='media media-xs margin-top-5'>
						<div class='media-left'>
						<a target='_blank' href='".$gourl."'><img class='media-object' src='".$picurl."' alt='".$row[$j]['Title']."'></a></div>
						<div class='media-body'><h4 class='media-heading'><a href='".$gourl."'>".$row[$j]['Title']." </a></h4><p>".sprintf("%.2f",$row[$j]['shprice'])."元 x ".$row[$j]['Quantity']."</p></div>
						</div>";
						}
						
						
						echo "</div>
						<div  class='col-md-5 col-sm-6 text-right btn-box'>
						<p style='display:";
						if($ssr[$i]['State']==5){echo 'block';}else{echo 'none';}
						echo "'><a style='border-radius:3px;' href='pay.php?id=".$ssr[$i]['Id']."' class='btn btn-danger btn-squared'>立即付款</a></p>
						
						<p class='margin-bottom-0' style='margin-top: 0px;'><a style='border-radius:3px;' href='order-".$ssr[$i]['Id']."-1.html' class='btn btn-outline btn-default btn-squared'>订单详情</a></p>
						
						<p class='margin-bottom-0' style='margin-top: 11px;'><a style='border-radius:3px; background-color: #d4a13f;color: white;' onclick='order_del('".$ssr[$i]['OrderId']."')' class='btn btn-outline btn-default btn-squared'>删除订单</a></p>
						</div>
						</div>
						</div>";
						}
						}elseif($state==1){
												//type(1已付款 2已提取  3未付款  0全部订单)
						$type=3;		   //全部订单	
						$arr = file_get_contents(stripslashes($cfg_geturl."api/".$get_name."/index.php?type=".$type."&userid=".$userid));  //去除对象里面的斜杠
						$str = json_decode($arr,true);
						$ssr=$str['Data'];
						for($i=0;$i<count($ssr);$i++){
						 switch($ssr[$i]['State'])
						{
							case 1: 
								$state = "<font color='#1f8c71'>".'已付款'."</font>";
								break;  
							case 5:
								$state = "<font color=red>".'待付款'."</font>";
								break;
							case 8:
								$state = "<font color='#2e61b9'>".'已发货'."</font>";
								break;
						}
						switch($ssr[$i]['PaymentType'])
						{
							case 1: 
								$paymenttype = '酒钱支付';
								break;  
							case 2:
								$paymenttype = '现金支付';
								break;
							case 3:
								$paymenttype = '混合支付';
								break;
							case 4:
								$paymenttype = '未支付';
								break;
						}
						echo "<div class='shop-order-list state-1' style='border-radius: 3px;'>
						<div class='row shop-order-top'>
						<div class='col-md-8 col-sm-8 ting'>
						<h4>".$state."</h4>
						<span class='info'>".$ssr[$i]['CreatTime']."</span>
						<span class='info'>订单号 : ".$ssr[$i]['OrderId']."</span>
						<span class='info'>".$paymenttype."</span></div>
						<div class='col-md-4 col-sm-4 ting text-right'>
						订单金额 ：<span class='price grey-800'>".sprintf("%.2f",($ssr[$i]['PayAmount']+$ssr[$i]['PayJiuQian']+$ssr[$i]['PayKdMoney']))."元</span></div>
						</div>
						<div class='row shop-order-bottom'>
						<div class='col-md-7 col-sm-6'>";
						$row=$ssr[$i]['Commodity'];
						for($j=0;$j<count($row);$j++){
							$gourl = 'productshow-'.$row[$j]['CommodityClass'].'-'.$row[$j]['CommodityId'].'-'.$j.'-1.html';
							$picurl=$cfg_geturl.$row[$j]['picurl2'];
						echo "<div class='media media-xs margin-top-5'>
						<div class='media-left'>
						<a target='_blank' href='".$gourl."'><img class='media-object' src='".$picurl."' alt='".$row[$j]['Title']."'></a></div>
						<div class='media-body'><h4 class='media-heading'><a href='".$gourl."'>".$row[$j]['Title']." </a></h4><p>".sprintf("%.2f",$row[$j]['shprice'])."元 x ".$row[$j]['Quantity']."</p></div>
						</div>";
						}
						
						
						echo "</div>
						<div  class='col-md-5 col-sm-6 text-right btn-box'>
						<p style='display:";
						if($ssr[$i]['State']==5){echo 'block';}else{echo 'none';}
						echo "'><a style='border-radius:3px;' href='pay.php?id=".$ssr[$i]['Id']."' class='btn btn-danger btn-squared'>立即付款</a></p>
						
						<p class='margin-bottom-0' style='margin-top: 0px;'><a style='border-radius:3px;' href='order-".$ssr[$i]['Id']."-1.html' class='btn btn-outline btn-default btn-squared'>订单详情</a></p>
						
						<p class='margin-bottom-0' style='margin-top: 11px;'><a style='border-radius:3px; background-color: #d4a13f;color: white;' onclick='order_del('".$ssr[$i]['OrderId']."')' class='btn btn-outline btn-default btn-squared'>删除订单</a></p>
						</div>
						</div>
						</div>";
						}
						}elseif($state==2){
												//type(1已付款 2已提取  3未付款  0全部订单)
						$type=2;		   //全部订单	
						$arr = file_get_contents(stripslashes($cfg_geturl."api/".$get_name."/index.php?type=".$type."&userid=".$userid));  //去除对象里面的斜杠
						$str = json_decode($arr,true);
						$ssr=$str['Data'];
						for($i=0;$i<count($ssr);$i++){
						 switch($ssr[$i]['State'])
						{
							case 1: 
								$state = "<font color='#1f8c71'>".'已付款'."</font>";
								break;  
							case 5:
								$state = "<font color=red>".'待付款'."</font>";
								break;
							case 8:
								$state = "<font color='#2e61b9'>".'已发货'."</font>";
								break;
						}
						switch($ssr[$i]['PaymentType'])
						{
							case 1: 
								$paymenttype = '酒钱支付';
								break;  
							case 2:
								$paymenttype = '现金支付';
								break;
							case 3:
								$paymenttype = '混合支付';
								break;
							case 4:
								$paymenttype = '未支付';
								break;
						}
						echo "<div class='shop-order-list state-1' style='border-radius: 3px;'>
						<div class='row shop-order-top'>
						<div class='col-md-8 col-sm-8 ting'>
						<h4>".$state."</h4>
						<span class='info'>".$ssr[$i]['CreatTime']."</span>
						<span class='info'>订单号 : ".$ssr[$i]['OrderId']."</span>
						<span class='info'>".$paymenttype."</span></div>
						<div class='col-md-4 col-sm-4 ting text-right'>
						订单金额 ：<span class='price grey-800'>".sprintf("%.2f",($ssr[$i]['PayAmount']+$ssr[$i]['PayJiuQian']+$ssr[$i]['PayKdMoney']))."元</span></div>
						</div>
						<div class='row shop-order-bottom'>
						<div class='col-md-7 col-sm-6'>";
						$row=$ssr[$i]['Commodity'];
						for($j=0;$j<count($row);$j++){
							$gourl = 'productshow-'.$row[$j]['CommodityClass'].'-'.$row[$j]['CommodityId'].'-'.$j.'-1.html';
							$picurl=$cfg_geturl.$row[$j]['picurl2'];
						echo "<div class='media media-xs margin-top-5'>
						<div class='media-left'>
						<a target='_blank' href='".$gourl."'><img class='media-object' src='".$picurl."' alt='".$row[$j]['Title']."'></a></div>
						<div class='media-body'><h4 class='media-heading'><a href='".$gourl."'>".$row[$j]['Title']." </a></h4><p>".sprintf("%.2f",$row[$j]['shprice'])."元 x ".$row[$j]['Quantity']."</p></div>
						</div>";
						}
						
						
						echo "</div>
						<div  class='col-md-5 col-sm-6 text-right btn-box'>
						<p style='display:";
						if($ssr[$i]['State']==5){echo 'block';}else{echo 'none';}
						echo "'><a style='border-radius:3px;' href='pay.php?id=".$ssr[$i]['Id']."' class='btn btn-danger btn-squared'>立即付款</a></p>
						
						<p class='margin-bottom-0' style='margin-top: 0px;'><a style='border-radius:3px;' href='order-".$ssr[$i]['Id']."-1.html' class='btn btn-outline btn-default btn-squared'>订单详情</a></p>
						
						<p class='margin-bottom-0' style='margin-top: 11px;'><a style='border-radius:3px; background-color: #d4a13f;color: white;' onclick='order_del('".$ssr[$i]['OrderId']."')' class='btn btn-outline btn-default btn-squared'>删除订单</a></p>
						</div>
						</div>
						</div>";
						}	
						}elseif($state==3){
						$type=1;		   //全部订单	
						$arr = file_get_contents(stripslashes($cfg_geturl."api/".$get_name."/index.php?type=".$type."&userid=".$userid));  //去除对象里面的斜杠
						$str = json_decode($arr,true);
						$ssr=$str['Data'];
						for($i=0;$i<count($ssr);$i++){
						 switch($ssr[$i]['State'])
						{
							case 1: 
								$state = "<font color='#1f8c71'>".'已付款'."</font>";
								break;  
							case 5:
								$state = "<font color=red>".'待付款'."</font>";
								break;
							case 8:
								$state = "<font color='#2e61b9'>".'已发货'."</font>";
								break;
						}
						switch($ssr[$i]['PaymentType'])
						{
							case 1: 
								$paymenttype = '酒钱支付';
								break;  
							case 2:
								$paymenttype = '现金支付';
								break;
							case 3:
								$paymenttype = '混合支付';
								break;
							case 4:
								$paymenttype = '未支付';
								break;
						}
						echo "<div class='shop-order-list state-1' style='border-radius: 3px;'>
						<div class='row shop-order-top'>
						<div class='col-md-8 col-sm-8 ting'>
						<h4>".$state."</h4>
						<span class='info'>".$ssr[$i]['CreatTime']."</span>
						<span class='info'>订单号 : ".$ssr[$i]['OrderId']."</span>
						<span class='info'>".$paymenttype."</span></div>
						<div class='col-md-4 col-sm-4 ting text-right'>
						订单金额 ：<span class='price grey-800'>".sprintf("%.2f",($ssr[$i]['PayAmount']+$ssr[$i]['PayJiuQian']+$ssr[$i]['PayKdMoney']))."元</span></div>
						</div>
						<div class='row shop-order-bottom'>
						<div class='col-md-7 col-sm-6'>";
						$row=$ssr[$i]['Commodity'];
						for($j=0;$j<count($row);$j++){
							$gourl = 'productshow-'.$row[$j]['CommodityClass'].'-'.$row[$j]['CommodityId'].'-'.$j.'-1.html';
							$picurl=$cfg_geturl.$row[$j]['picurl2'];
						echo "<div class='media media-xs margin-top-5'>
						<div class='media-left'>
						<a target='_blank' href='".$gourl."'><img class='media-object' src='".$picurl."' alt='".$row[$j]['Title']."'></a></div>
						<div class='media-body'><h4 class='media-heading'><a href='".$gourl."'>".$row[$j]['Title']." </a></h4><p>".sprintf("%.2f",$row[$j]['shprice'])."元 x ".$row[$j]['Quantity']."</p></div>
						</div>";
						}
						
						
						echo "</div>
						<div  class='col-md-5 col-sm-6 text-right btn-box'>
						<p style='display:";
						if($ssr[$i]['State']==5){echo 'block';}else{echo 'none';}
						echo "'><a style='border-radius:3px;' href='pay.php?id=".$ssr[$i]['Id']."' class='btn btn-danger btn-squared'>立即付款</a></p>
						
						<p class='margin-bottom-0' style='margin-top: 0px;'><a style='border-radius:3px;' href='order-".$ssr[$i]['Id']."-1.html' class='btn btn-outline btn-default btn-squared'>订单详情</a></p>
						
						<p class='margin-bottom-0' style='margin-top: 11px;'><a style='border-radius:3px; background-color: #d4a13f;color: white;' onclick='order_del('".$ssr[$i]['OrderId']."')' class='btn btn-outline btn-default btn-squared'>删除订单</a></p>
						</div>
						</div>
						</div>";
						}	
						}
						?>
						