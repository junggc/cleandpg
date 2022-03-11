	<div class="sub-head">
		<div class="inner">
			<h2 class="h2">커뮤니티</h2>
			<div class="tabs">
				<div>
					<a href="/magazine">매거진</a>
					<a href="/event">이벤트</a>
					<a href="/faq">FAQ</a>
					<a href="javascript:void(0);" class="active">공지사항</a>
				</div>
			</div>
		</div>
	</div>
	
	<div class="inner">
		
		<div class="board-list-type1">
			<div class="head">
				<ul>
					<li>번호</li>
					<li>제목</li>
					<li>등록일</li>
				</ul>
			</div>
			<div class="body">
				<ul>
                <?php
					$idx = 0;
					foreach($list as $row) {
				?>
					<li>
						<a href="/notice/detail/<?php echo $offset; ?>?seq=<?php echo $row['cbn_id']; ?>">
							<span class="num"><?php echo $total_rows - $offset - $idx; ?></span>
							<span class="label"><?php echo $row['is_top'] == 'y' ? '<em>중요</em>' : ''; ?></span>
							<span class="subj"><?php echo $row['cbn_title']; ?></span>
							<span class="date"><?php echo $row['ins_dtm']; ?></span>
						</a>
					</li>
                <?php
						$idx++;
					}
				?>
				</ul>
			</div>
		</div>
		
		<?php echo $pagination; ?>
		
	</div>
