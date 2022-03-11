	<div class="sub-head">
		<div class="inner">
			<h2 class="h2">커뮤니티</h2>
			<div class="tabs">
				<div>
					<a href="/magazine">매거진</a>
					<a href="javascript:void(0);" class="active">이벤트</a>
					<a href="/faq">FAQ</a>
					<a href="/notice/list">공지사항</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="inner">
		
		<div class="board-view event-type">
			<div class="head border">
				<h3 class="h3 blue"><?php echo $info['cbe_title']; ?> <small><?php echo $info['status_text']; ?></small></h3>
				<div class="event-date">
					<span>기간 : <?php echo $info['start_date']; ?> ~ <?php echo $info['end_date']; ?></span>
					<span>당첨자 발표  : <?php echo $info['winner_date']; ?></span>
				</div>
			</div>
			<div class="body">
            	<?php 
					if($info['is_winnerset'] == 'y') {
				?>
				<div class="winner">
					<a href="<?php echo $info['winner_url']; ?>" target="_blank">당첨자 발표</a>
				</div>
                <?php
					}
				?>
				<div><?php echo $info['cbe_content']; ?></div>
			</div>
			
			<div class="board-foot">
				<ul>
                <?php
					if(!empty($info['prev'])) {
				?>
					<li>
						<a href="/event/detail?seq=<?php echo $info['prev']['cbe_id']; ?>">
							<strong>이전 이벤트</strong>
							<p><?php echo $info['prev']['cbe_title']; ?></p>
						</a>
					</li>
                <?php
					}
					
					if(!empty($info['next'])) {
				?>
					<li>
						<a href="/event/detail?seq=<?php echo $info['next']['cbe_id']; ?>">
							<strong>다음 이벤트</strong>
							<p><?php echo $info['next']['cbe_title']; ?></p>
						</a>
					</li>
                <?php
					}
				?>
				</ul>
			</div>
		</div>
		
		<div class="text-center">
			<a href="/event" class="btn btn-type1 btn-m w190">목록</a>
		</div>
		
	</div>