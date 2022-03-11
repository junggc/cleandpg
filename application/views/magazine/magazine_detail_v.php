	<div class="sub-head">
		<div class="inner">
			<h2 class="h2">커뮤니티</h2>
			<div class="tabs">
				<div>
					<a href="javascript:void();" class="active">매거진</a>
					<a href="/event">이벤트</a>
					<a href="/faq">FAQ</a>
					<a href="/notice/list">공지사항</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="inner">
		
		<div class="board-view">
			<div class="head">
				<h3 class="h3 blue"><?php echo $info['cmg_title']; ?> </h3>
				<div class="date"><?php echo $info['ins_dtm']; ?></div>
			</div>
			<div class="body">
            	<?php echo $info['cmg_content']; ?>
			</div>
			
			<div class="board-foot">
				<ul>
                <?php
					if(!empty($info['prev'])) {
				?>
					<li>
						<a href="/magazine/detail?seq=<?php echo $info['prev']['cmg_id']; ?>">
							<strong>이전글</strong>
							<p><?php echo $info['prev']['cmg_title']; ?></p>
							<span><?php echo $info['prev']['ins_dtm']; ?></span>
						</a>
					</li>
                <?php
					}
					
					if(!empty($info['next'])) {
				?>
					<li>
						<a href="/magazine/detail?seq=<?php echo $info['next']['cmg_id']; ?>">
							<strong>다음글</strong>
							<p><?php echo $info['next']['cmg_title']; ?></p>
							<span><?php echo $info['next']['ins_dtm']; ?></span>
						</a>
					</li>
                <?php
					}
				?>
				</ul>
			</div>
		</div>
		
		<div class="text-center more">
			<a href="/magazine" class="btn btn-type1 btn-m w190">목록</a>
		</div>
		
	</div>