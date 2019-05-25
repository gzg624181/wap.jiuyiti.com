            <div class="col-md-3">
                <div class="row">

					<div class="met-news-bar">

                        <form method="post" action="news-4-1.html">
                            <div class="form-group">
                                <div class="input-search">
                                    <button type="submit" class="input-search-btn"><i class="fa fa-search" aria-hidden="true"></i> </button>
                                    <input class="form-control" name="keyword" id="keyword" placeholder="Search" type="text">
                                </div>
                            </div>
                        </form>

						<div class="recommend news-list-md">
							<h3>为您推荐</h3>
							<ul class="list-group list-group-bordered">
                <?php
                
				$dosql->Execute("SELECT * FROM `#@__infolist` WHERE (classid=$cid OR parentstr LIKE '%,$cid,%') AND delstate='' AND checkinfo=true and flag like '%c%' ORDER BY orderid DESC limit 6");
				while($row = $dosql->GetArray())
				{
				 $gourl = 'newsshow-'.$row['classid'].'-'.$row['id'].'-1.html';
                 ?>
					<li class="list-group-item"><a href="<?php echo $gourl;?>" title="<?php echo $row['title'];?>" target="_self"><?php echo $row['title'];?></a></li>
				<?php }?>

							</ul>
						</div>

                        <ul class="column">
                            <li><a href="case-8-1.html" title="所有文章" target="_self">所有文章</a></li>
<?php
						$pid=4;
						$dosql->Execute("select * from `#@__infoclass` where parentid='$pid' and checkinfo=true order by orderid asc");
						while($show = $dosql->GetArray()){
						$gourls=$show['linkurl'];
						?>
                            <li><a href="<?php echo $gourls;?>" title="<?php echo $show['classname'];?>"><?php echo $show['classname'];?></a></li>
						<?php }?>
                            

                        </ul>

					</div>

                </div>
            </div>
