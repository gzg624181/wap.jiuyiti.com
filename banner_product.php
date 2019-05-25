       <?php
		$k=$dosql->GetOne("select * from `#@__infoclass` where id=$kid and checkinfo=true");
		?>
<div class="slick-slide">
			<img class="cover-image" src="<?php echo $k['picurl'];?>" sizes="(max-width: 767px) 500px" alt="" style="height: auto;">

			<div class="banner-text p-5">
				<div class="container">
					<div class="banner-text-con">
						<div>
							<h1 style="color:;"><?php echo $k['keywords'];?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>