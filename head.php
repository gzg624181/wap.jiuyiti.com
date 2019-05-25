<?php
		if (!session_id()){
		session_start();
			}
	$str= GetCurUrl();
    $arr=explode("/",$str);
    $url=$arr[count($arr)-1];
	$flag=IsMobile();
	if($flag)
	{
	$system='phone';
	}
	else
	{
	$system='pc';
	}
	?>
	<?php
			if(isset($_SESSION['commercial']) && $_SESSION['commercial']!="")
			{?>
       <div class="container">
            <div class="row">
                <div class="navbar-header">
					<button type="button" class="navbar-toggle hamburger hamburger-close collapsed"
					data-target="#example-navbar-default-collapse" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="hamburger-bar"></span>
					</button>
					<a href="index.html" class="navbar-brand navbar-logo vertical-align" title="武汉红酒代理">
						<div class="vertical-align-middle"><img src="templates/default/images/1502087410.png" title="武汉红酒代理" /></div>
					</a>
				</div>

             <div class="collapse navbar-collapse navbar-collapse-toolbar" id="example-navbar-default-collapse">

                <ul class="nav navbar-toolbar navbar-right " style="float:none;margin-right: 91px;margin-left:74px;">

                  <li>
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                      <span class="avatar avatar-online text-middle margin-right-5">
                        <img src="templates/default/images/user.png" alt="<?php echo $_SESSION['commercial'];?>">
                      </span>
					  <?php
					  echo $_SESSION['commercial'];?>
					  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu bullet dropdown-menu-right" role="menu" style="margin-top: -1px;<?php if($system=='phone'){echo 'top:107px;';}else{echo 'top:61px;';} ?> background-color:#464646; border: 1px solid #464646;">
                      <li role="presentation">
                        <a href="profile-1-1.html" role="menuitem">
						<i class="fa fa-user"></i> &nbsp;&nbsp;个人中心</a>
                      </li>
                      <li role="presentation">
                        <a href="order-1-1.html" role="menuitem"><i class="fa fa-bars"></i>&nbsp;&nbsp; 我的订单</a>
                      </li>
                      <li role="presentation">
                        <a href="basic-1-1.html" role="menuitem"><i class="fa fa-cog"></i> &nbsp;&nbsp;账户设置</a>
                      </li>
                      <li role="presentation">
                        <a href="logout.php" role="menuitem"><i class="fa fa-power-off" aria-hidden="true" style="float:none;"></i> &nbsp;&nbsp;退出</a>
                      </li>
                    </ul>
                  </li>&nbsp;&nbsp;
                      <li class="dropdown" >
                    <a data-toggle="dropdown" href="javascript:void(0)" title="购物车" aria-expanded="false"
                    data-animation="slide-bottom" role="button">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                      <span class="badge badge-danger up hide topcart-goodnum"></span>
                    </a>
					 <?php
					 $userid=$_SESSION["Id"];
					 $idd=1;
					 $r=$dosql->GetOne("SELECT * FROM `shoppingcart` WHERE UserId='$userid'");
				     $dosql->Execute("SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'",$idd);
				  	while($row=$dosql->GetArray($idd)){
                    $num[] = floatval($row['CommodityNumber']);//商品数量
	                $sums[]= $row['shprice'] * $row['CommodityNumber'];	 //商品总价格
                    }
					 if(is_array($r)){
				    ?>
                    <ul class="dropdown-menu bullet dropdown-menu-right dropdown-menu-media topcartremove" role="menu" style="<?php if($system=='phone'){echo 'top:107px';}else{echo 'top:48px';} ?> ">
                      <li class="dropdown-menu-header">
                        <h5>购物车</h5>
                        <span class="label label-round label-danger">共 <span class="topcart-goodnum" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;"><?php
						$numer="";
						foreach($num as $key => $va)
						{
						   $numer += $va;
						}
						echo $numer;
						?></span> 件商品</span>
                      </li>
					  <?php
					    $ids=2;
					    $dosql->Execute("SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'",$ids);
						$i=0;
				        while($i<$dosql->GetTotalRow($ids))
				        {
						$str=$dosql->GetArray($ids);
						$gourl = 'productshow-'.$str['CommodityClass'].'-'.$str['CommodityId'].'-'.$i.'-1.html';
						$i++;
				      ?>
                      <li class="list-group dropdown-scrollable" style="line-height: 25px;margin-left: 15px;margin-top: 2px;" role="presentation">
                        <div data-role="container">
                          <div data-role="content" style="margin-top: 5px;">
						  <span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;color:#a87413; font-size:11px;"><?php echo $i;?>.</span>
						<a style="color: #b68d41;transition: all 0.3s ease-out;font-weight: bold;" href="<?php echo $gourl;?>"><?php echo $str['Title']; ?></a>&nbsp;
							<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;color:#8db758; font-size:11px;"><?php echo sprintf("%.2f", $str['shprice']);?>元  x <?php echo $str['CommodityNumber']; ?></span>
                          </div>
                        </div>
                      </li>
						<?php }?>

                      <li class="dropdown-menu-footer" role="presentation" style="background-color:#464646; height:52px;line-height:50px;">
						<div class="dropdown-menu-footer-btn">
							<a href="getlist-1-1.html" style="border-radius: 3px;" class="btn btn-squared btn-danger margin-bottom-5 margin-right-10">去购物车结算</a>
						</div>
                        <span class="red-600 font-size-18 topcarttotal">

						<span class="total-val red-600" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;margin-left: 10px;">¥:<?php
						$sumer="";
						foreach($sums as $key => $item)
						{
						   $sumer+=$item;
						}
						echo sprintf("%.2f",$sumer);
						?></span>
						</span>
                      </li>

                    </ul>
                      <?php }else{ ?>
				    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media topcartremove" role="menu">
			<li class="dropdown-menu-header">
				<h5>购物车</h5>
				<span class="label label-round label-danger">共 <span class="topcart-goodnum">0</span> 件商品</span>
			</li>
			 <li class="list-group dropdown-scrollable" style="line-height: 25px;margin-left: 15px;margin-top: 2px;" role="presentation">
                        <div data-role="container">
                          <div data-role="content">
						 <div class="height-100 text-center vertical-align"><div class="vertical-align-middle" style="color:white;font-weight:bold;"><a href="product-5-1.html">购物车中还没有商品，赶紧选购吧！</a></div></div>
                          </div>
                        </div>
                      </li>
		</ul>
					 <?php }?>
				  </li>
    </ul>
               <ul class="nav navbar-nav navbar-right navlist">

					<li><a href="index.html" class="<?php if(strpos($url,'index')!== false){echo "link active";
					}else{echo "link  animation-zoomIn";}?>">首 页</a></li>

					<li class="dropdown margin-left-30" >
						<a
							class="<?php if(strpos($url,'about')!== false){echo "link active";
					}else{echo "link  animation-zoomIn";}?>"
							data-toggle="dropdown"
							data-hover="dropdown"
							href="about-2-1.html"
							aria-expanded="false"
							role="button"
						>企业介绍<i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right" role="menu" >
                       <?php
	$pid=2;
	$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
	while($show = $dosql->GetArray()){
	$gourls=$show['linkurl'];
	?>
						<li class="animation-fade animation-delay-"><a href="<?php echo $gourls;?>" class="animation-fade"><?php echo $show['classname'];?></a></li>
    <?php }?>
						</ul>
					</li>

					<li class="dropdown margin-left-30">
						<a
							class="<?php if(strpos($url,'news')!== false){echo "link active";}else{echo "link  animation-zoomIn";}?>"
							data-toggle="dropdown"
							data-hover="dropdown"
							href="news-4-1.html"
							aria-expanded="false"
							role="button"
								title="红酒资讯"
						>红酒资讯<i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right  " role="menu" >
	                    <?php
	$pid=4;
	$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
	while($show = $dosql->GetArray()){
	$gourls=$show['linkurl'];
	?>
							<li class="animation-fade animation-delay-">
							<a href="<?php echo $gourls;?>" class="animation-fade"><?php echo $show['classname'];?></a>
							</li>
		                <?php }?>

						</ul>
					</li>


					<li class="dropdown margin-left-30">
						<a
							class="<?php if(strpos($url,'product')!== false){echo "link active";}else{echo "link  animation-zoomIn";}?>"
							data-toggle="dropdown"
							data-hover="dropdown"
							href="product-5-1.html"
							aria-expanded="false"
							role="button"

							title="代理产品"
						>代理产品<i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right  " role="menu" >
	                    <?php
	$pid=5;
	$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
	while($show = $dosql->GetArray()){
	$gourls=$show['linkurl'];
	?>
							<li class="animation-fade animation-delay-">
							<a href="<?php echo $gourls;?>" class="animation-fade"><?php echo $show['classname'];?></a>
							</li>
		                <?php }?>

						</ul>
					</li>
					<li class="margin-left-30"><a href="case-8-1.html"  class="<?php if(strpos($url,'case')!== false){echo "link active";}else{echo "link  animation-zoomIn";}?>">红酒学院</a></li>

				  </ul>

            </div>
        </div>
		</div>
			<?php }else{ ?>

			<div class="container">
			<div class="row">
            <div class="navbar-header">
					<button type="button" class="navbar-toggle hamburger hamburger-close collapsed"
					data-target="#example-navbar-default-collapse" data-toggle="collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="hamburger-bar"></span>
					</button>
					<a href="index.html" class="navbar-brand navbar-logo vertical-align" title="武汉红酒批发">
						<div class="vertical-align-middle"><img src="templates/default/images/1502087410.png" title="武汉红酒批发" /></div>
					</a>
				</div>
				<div class="collapse navbar-collapse navbar-collapse-toolbar" id="example-navbar-default-collapse">

        <div class="navbar-right vertical-align met-nav-login animation-slide-top margin-left-30">
		<div class="vertical-align-middle margin-right-10"><a href="register-1-1.html" style="border-color: #6c5936;padding: 2px 11px; color:#7a5f2b" class="btn btn-squared btn-primary btn-outline">注册</a></div>
		<div class="vertical-align-middle"><a href="login-1-1.html" style="border-color: #6c5936;padding: 2px 11px; color:#7a5f2b"  class="btn btn-squared btn-primary btn-outline">登录</a></div>
	    </div>
<ul class="nav navbar-nav navbar-right navlist">

					<li><a href="index.html" class="<?php if(strpos($url,'index')!== false){echo "link active";
					}else{echo "link  animation-zoomIn";}?>">首 页</a></li>

					<li class="dropdown margin-left-30" >
						<a
							class="<?php if(strpos($url,'about')!== false){echo "link active";
					}else{echo "link  animation-zoomIn";}?>"
							data-toggle="dropdown"
							data-hover="dropdown"
							href="about-2-1.html"
							aria-expanded="false"
							role="button"
						>企业介绍<i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right  " role="menu" >
                       <?php
	$pid=2;
	$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
	while($show = $dosql->GetArray()){
	$gourls=$show['linkurl'];
	?>
						<li class="animation-fade animation-delay-"><a href="<?php echo $gourls;?>" class="animation-fade"><?php echo $show['classname'];?></a></li>
    <?php }?>
						</ul>
					</li>

					<li class="dropdown margin-left-30">
						<a
							class="<?php if(strpos($url,'news')!== false){echo "link active";}else{echo "link  animation-zoomIn";}?>"
							data-toggle="dropdown"
							data-hover="dropdown"
							href="news-4-1.html"
							aria-expanded="false"
							role="button"

							title="红酒资讯"
						>红酒资讯<i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right  " role="menu" >
	                    <?php
	$pid=4;
	$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
	while($show = $dosql->GetArray()){
	$gourls=$show['linkurl'];
	?>
							<li class="animation-fade animation-delay-">
							<a href="<?php echo $gourls;?>" class="animation-fade"><?php echo $show['classname'];?></a>
							</li>
		                <?php }?>

						</ul>
					</li>


					<li class="dropdown margin-left-30">
						<a
							class="<?php if(strpos($url,'product')!== false){echo "link active";}else{echo "link  animation-zoomIn";}?>"
							data-toggle="dropdown"
							data-hover="dropdown"
							href="product-5-1.html"
							aria-expanded="false"
							role="button"

							title="代理产品"
						>代理产品<i class="fa fa-angle-down"></i></a>
						<ul class="dropdown-menu dropdown-menu-right  " role="menu" >
	                    <?php
	$pid=5;
	$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
	while($show = $dosql->GetArray()){
	$gourls=$show['linkurl'];
	?>
							<li class="animation-fade animation-delay-">
							<a href="<?php echo $gourls;?>" class="animation-fade"><?php echo $show['classname'];?></a>
							</li>
		                <?php }?>

						</ul>
					</li>
					<li class="margin-left-30"><a href="case-8-1.html"  class="<?php if(strpos($url,'case')!== false){echo "link active";}else{echo "link  animation-zoomIn";}?>">红酒学院</a></li>

				  </ul>

				</div>
			</div>
		</div>

			<?php }?>
