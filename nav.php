         <?php
		 if (!session_id()){
		session_start();
			}
		 $str= GetCurUrl();
         $arr=explode("/",$str);
         $url=$arr[count($arr)-1];
		// echo $_SESSION['commercial'];
		// echo $_SESSION["Id"];
		 ?>
		 <nav class="navbar navbar-default margin-bottom-0" style="margin-top: 1px; background-color:#3c3b3b;" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle hamburger hamburger-close collapsed"
                data-target="#example-navbar-default-collapse" data-toggle="collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="hamburger-bar"></span>
                </button>
				<a class="navbar-brand navbar-logo" href="/" title="武汉酒易提">
					<img style="margin-bottom:10px;" src="templates/default/images/1502087410.png" title="武汉酒易提">
				</a>
              </div>
              <div class="collapse navbar-collapse navbar-collapse-group" style="overflow:visible;" id="example-navbar-default-collapse">

                <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                  <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                      <span class="avatar avatar-online text-middle margin-right-5">
                        <img src="templates/default/images/user.jpg" alt="<?php echo $_SESSION['commercial'];?>">
                      </span>
					  <span class="caret"></span>
                    </a>
                    <ul style="margin-top: 0px;" class="dropdown-menu bullet dropdown-menu-right" role="menu">
                      <li role="presentation">
                        <a href="profile-1-1.html" role="menuitem"><i class="fa fa-user"></i> &nbsp;&nbsp; 个人中心</a>
                      </li>
                      <li role="presentation">
                        <a href="order-1-1.html" role="menuitem"><i class="fa fa-bars"></i>&nbsp;&nbsp; 我的订单</a>
                      </li>
                      <li role="presentation">
                        <a href="basic-1-1.html" role="menuitem"><i class="fa fa-cog"></i> &nbsp;&nbsp;账户设置</a>
                      </li>
                      <li class="divider" role="presentation"></li>
                      <li role="presentation">
                        <a href="logout.php" role="menuitem"><i class="fa fa-power-off" aria-hidden="true"></i> &nbsp;&nbsp; 退出</a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a data-toggle="dropdown" href="javascript:void(0)" title="购物车" aria-expanded="false"
                    data-animation="slide-bottom" role="button">
                      <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                      <span class="badge badge-danger up hide topcart-goodnum"></span>
                    </a>
					<?php
					 $userid=$_SESSION["Id"];
					 $r=$dosql->GetOne("SELECT * FROM `shoppingcart` WHERE UserId='$userid'");
				     $dosql->Execute("SELECT * FROM `commodity` a inner join shoppingcart b on a.Id=b.CommodityId WHERE b.UserId='$userid'");
					while($rower=$dosql->GetArray()){
                    $num[] = floatval($rower['CommodityNumber']);//商品数量
	                $sums[]= $rower['shprice'] * $rower['CommodityNumber'];	 //商品总价格
                    }
					 if(is_array($r)){
				    ?>
                    <ul class="dropdown-menu bullet dropdown-menu-right dropdown-menu-media topcartremove" role="menu">
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
                          <div data-role="content" id="topcart-body"><span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;color:#a87413; font-size:11px;"><?php echo $i;?>.</span>
							<a style="color: #b68d41;transition: all 0.3s ease-out;font-weight: bold;" target="_blank" href="<?php echo $gourl;?>"><?php echo $str['Title']; ?></a>&nbsp;
							<span style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;color:#8db758; font-size:11px;"><?php echo sprintf("%.2f", $str['shprice']);?>元  x <?php echo $str['CommodityNumber']; ?></span>
                          </div>
                        </div>
                      </li>
						<?php }?>

                      <li class="dropdown-menu-footer" role="presentation">
						<div class="dropdown-menu-footer-btn">
							<a href="getlist-1-1.html" style="border-radius: 3px;" class="btn btn-squared btn-danger margin-bottom-5 margin-right-10">去购物车结算</a>
						</div>
                        <span class="red-600 font-size-18 topcarttotal">

						<span class="total-val red-600" style="font-family: Verdana, Geneva, sans-serif;font-weight: bold;">¥:<?php
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
			<li class="list-group dropdown-scrollable scrollable is-enabled scrollable-vertical" role="presentation" style="position: relative;">
				<div data-role="container" class="scrollable-container" style="height: 100px; width: 377px;">
					<div data-role="content" id="topcart-body" class="scrollable-content" style="width: 360px;"><div class="height-100 text-center vertical-align"><div class="vertical-align-middle"><a href="product-5-1.html">购物车中还没有商品，赶紧选购吧！</a></div></div></div>
				</div>
			<div class="scrollable-bar scrollable-bar-vertical is-disabled scrollable-bar-hide" draggable="false"><div class="scrollable-bar-handle"></div></div></li>
			<li class="dropdown-menu-footer" role="presentation" style="display: none;">
				<div class="dropdown-menu-footer-btn">
					<a href="getlist-1-1.html" class="btn btn-squared btn-danger margin-bottom-5 margin-right-10">去购物车结算</a>
				</div>
				<span class="red-600 font-size-18 topcarttotal">0.00元</span>
			</li>
		</ul>
					 <?php }?>

				 </li>
                </ul>

              </div>
            </div>
          </nav>
