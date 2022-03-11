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
		
		<div class="board-view">
			<div class="head border">
				<h3 class="h3"><?php echo $info['cbn_title']; ?></h3>
				<div class="flex center">
					<div><span class="label">공지사항</span></div>
					<div class="date"><?php echo $info['ins_dtm']; ?></div>
				</div>
			</div>
			<div class="body">
				<?php echo $info['cbn_content']; ?>
                <?php
					if(!empty($info['files'])) {
				?>
						<div style="margin-top:80px">첨부파일</div>
                        <?php 
							foreach($info['files'] as $row) {
						?>
							<div class="add_file">
                            	<a href="<?php echo CDN_URL . $row['new_filepath'] . $row['new_filename'];?>"><?php echo $row['org_filename']; ?></a>
                            </div>
                        <?php
							}
						?>
                <?php
					}
				?>
			</div>
			
			<div class="board-foot">
				<ul>
                <?php
					if(!empty($info['prev'])) {
				?>
					<li>
						<a href="/notice/detail/<?php echo $offset; ?>?seq=<?php echo $info['prev']['cbn_id']; ?>">
							<strong>이전글</strong>
							<p><?php echo $info['prev']['cbn_title']; ?></p>
							<span><?php echo $info['prev']['ins_dtm']; ?></span>
						</a>
					</li>
                <?php
					}
					
					if(!empty($info['next'])) {
				?>
					<li>
						<a href="/notice/detail/<?php echo $offset; ?>?seq=<?php echo $info['next']['cbn_id']; ?>">
							<strong>다음글</strong>
							<p><?php echo $info['next']['cbn_title']; ?></p>
							<span><?php echo $info['next']['ins_dtm']; ?></span>
						</a>
					</li>
                <?php
					}
				?>
				</ul>
			</div>
		</div>
		
		<div class="text-center">
			<a href="/notice/list/<?php echo $offset; ?>" class="btn btn-type1 btn-m w190">목록</a>
		</div>
		
	</div>
<style>
.add_file {margin-top:10px;}
.add_file a {
	display: inline-block;
    vertical-align: middle;
    padding-bottom: 4px;
    font-size: 20px;
    color: #003ca6;
    border-bottom: 1px solid #003ca6;
}
</style>
