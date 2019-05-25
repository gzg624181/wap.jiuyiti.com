<div class="met-column-nav  ">
			<div class="container">
				<div class="row">

					<div class="col-md-12 sidebar_tile overflow-visible">
						<ul class="met-column-nav-ul">


							<li>

								<a href="about-3-1.html" title="公司简介" class="link <?php if($url=='about-3-1.html'){echo 'active';}?>">公司简介</a>

							</li>

							<li class="dropdown">

								<a href="aboutlist-14-1.html" title="合作伙伴" class="dropdown-toggle link  <?php if($url=='aboutlist-14-1.html'){echo 'active';}?>" data-toggle="dropdown">合作伙伴<span class="caret"></span>
								</a>
								<ul class="dropdown-menu ">
	                       <?php
			$dosql->Execute("SELECT * FROM `#@__infoimg` WHERE classid=14 AND delstate='' AND checkinfo=true ORDER BY orderid DESC");
			while($row = $dosql->GetArray())
			{
		    if($row['linkurl']=='' and $cfg_isreurl!='Y')
			$gourl = 'aboutshow.php?cid='.$row['classid'].'&id='.$row['id'];
			else if($cfg_isreurl=='Y') $gourl = 'aboutshow-'.$row['classid'].'-'.$row['id'].'-1.html';
			else $gourl = $row['linkurl'];
			?>
			<li><a href="<?php echo $gourl;?>" title="<?php echo $row['title'];?>"><?php echo $row['title'];?></a></li>
            <?php }?>
			</ul>

							</li>

							 <li>

								<a href="aboutjoin-15-1.html" title="人才招聘" class="link  <?php if($url=='aboutjoin-15-1.html'){echo 'active';}?>">人才招聘</a>

							</li>
							<li>

							 <a href="about-26-1.html" title="代理加盟" class="link  <?php if($url=='about-26-1.html'){echo 'active';}?>">代理加盟</a>

							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
