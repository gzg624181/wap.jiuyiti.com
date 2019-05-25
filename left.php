<?php
$str= GetCurUrl();
$arr=explode("/",$str);
$url=$arr[count($arr)-1];
?>
<div class="col-md-3 visible-md-block visible-lg-block">
			<div class="panel margin-right-15" style="border-radius: 3px;">
				<div class="panel-body shopcenter-nav-body">
					
					<h5 class="font-size-18" style="font-weight:bold;color: #806f60;"><i class="fa fa-user-circle-o" aria-hidden="true"></i></i>&nbsp;&nbsp;账户设置</h5>
					<ul class="list-group">
					<li class="list-group-item <?php if($url=="basic-1-1.html"){echo "active";}?>"><a href="basic-1-1.html">个人信息</a></li>
					<li class="list-group-item <?php if($url=="profile-2-1.html"){echo "active";}?>"><a href="profile-2-1.html">推荐二维码</a></li>
					<li class="list-group-item <?php if($url=="basic-2-1.html"){echo "active";}?>"><a href="basic-2-1.html">账号密码</a></li>
					<li class="list-group-item <?php if($url=="address-1-1.html"){echo "active";}?>"><a href="address-1-1.html">收货地址</a></li>
					<li class="list-group-item <?php if($url=="basic-3-1.html"){echo "active";}?>"><a href="basic-3-1.html">申请提现</a></li>
					</ul>
					
					<h5 class="font-size-18" style="font-weight:bold;color: #806f60;"><i class="fa fa-cart-arrow-down"></i>&nbsp;&nbsp;进货中心</h5>
					<ul class="list-group">
					<li class="list-group-item <?php if($url=="order-1-1.html"){echo "active";}?>"><a href="order-1-1.html">进货订单</a></li>
					<li class="list-group-item <?php if($url=="basic-4-1.html"){echo "active";}?>"><a href="basic-4-1.html">购物车</a></li>
					
					</ul>
					
					<h5 class="font-size-18" style="font-weight:bold;color: #806f60;"><i class="fa fa-cloud-upload" aria-hidden="true"></i>&nbsp;&nbsp;发货中心</h5>
					<ul class="list-group">
					<li class="list-group-item <?php if($url=="order-3-1.html"){echo "active";}?>"><a href="order-3-1.html">发货订单</a></li>
					<li class="list-group-item <?php if($url=="order-2-1.html"){echo "active";}?>"><a href="order-2-1.html">发货记录</a></li>
					</ul>
					
					<h5 class="font-size-18" style="font-weight:bold;color: #806f60;"><i class="fa fa-gift" aria-hidden="true"></i> &nbsp;&nbsp;奖励中心</h5>
					<ul class="list-group">
					<li class="list-group-item <?php if($url=="order-4-1.html"){echo "active";}?>"><a href="order-4-1.html">现金券记录</a></li>
					<li class="list-group-item <?php if($url=="order-1-1.html"){echo "active";}?>"><a href="order-1-1.html">推荐提成</a></li>
					</ul>
					
				</div>
			</div>
		</div>