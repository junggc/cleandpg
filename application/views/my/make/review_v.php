	<div class="inner">
		
		
		<!-- 마이페이지 -->
		<div class="mypage">
        	<?php $this->load->view('common/myNav'); ?>
				<h3 class="h3"><a href="/my/make" class="link m back">나의 리뷰</a></h3>
				<!-- pc -->
				<div class="table1 mb30  pc">
					<table>
						<colgroup>
							<col style="width:80px">
							<col style="width:150px">
							<col style="">
							<col style="width:190px">
							<col style="width:130px">
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>상품</th>
								<th class="text-left">내용</th>
								<th>평가</th>
								<th>날짜</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							if(count($list)) {
								$idx = 0;
								foreach($list as $row) {
						?>
                        
							<tr>
								<td><?php echo ($total - ($offset * $perpage) - $idx); ?></td>
								<td>
                                	<strong class="f22">
                                        <a href="#" data-toggle="modal" data-target="#modalReviewDetail" onclick="javascript:fnPopupSetDetail('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;">
                                            <?php echo $row['cit_name']; ?>
                                        </a>
                                    </strong>
                                </td>
								<td class="text-left" style="word-break:break-all;">
                                	<a href="#" data-toggle="modal" data-target="#modalReviewDetail" onclick="javascript:fnPopupSetDetail('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;">
										<?php echo $row['cre_title']; ?>
                                    </a>
                                </td>
								<td>
									<div class="grade">
                                    <?php 
										for($i = 0; $i < $row['cre_score']; $i++) {
											echo '<i class="on"></i>';
										}
										for($i = $row['cre_score']; $i < 5; $i++) {
											echo '<i></i>';	
										}
									?>
                                    </div>
								</td>
								<td><?php echo $row['ins_dtm']; ?></td>
							</tr>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<tr><td colspan="100%">등록된 리뷰가 없습니다.</td></tr>';
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile  mb40">
					<ul>
                        <?php
							if(count($list)) {
								$idx = 0;
								foreach($list as $row) {
						?>
						<li>
							<div class="item">
								<div class="grade">
                                <?php 
									for($i = 0; $i < $row['cre_score']; $i++) {
										echo '<i class="on"></i>';
									}
									for($i = $row['cre_score']; $i < 5; $i++) {
										echo '<i></i>';	
									}
								?>
                                </div>
								<div class="subj">
									<div>
										<div class="opt">번호 <?php echo ($total - ($offset * $perpage) - $idx); ?></div>
										<strong class="name">
                                        	<a href="#" data-toggle="modal" data-target="#modalReviewDetail"onclick="javascript:fnPopupSetDetail('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;">
												<?php echo $row['cit_name']; ?>
                                            </a>
                                        </strong>
									</div>
								</div>
								<div class="date"><?php echo $row['ins_dtm']; ?></div>
								<div class="addr mb0" style="word-break:break-all;">
                                	<a href="#" data-toggle="modal" data-target="#modalReviewDetail" onclick="javascript:fnPopupSetDetail('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;">
										<?php echo $row['cre_title'] . (strlen($row['cre_content']) > strlen($row['cre_title']) ? '...' : '') ?>
                                    </a>
                                </div>
							</div>
						</li>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<li style="text-align:center">등록된 리뷰가 없습니다.</li>';
							}
						?>
					</ul>
				</div>
				
				<div class="f16 gray mb60">*  광고성, 비방성, 사회적 무리가 있는 글 / 이미지 또는 제품과 무관한 정보전달성 리뷰에 대해서는 임의 삭제 됩니다.</div>
				
                <?php echo $pagination; ?>
				<div class="text-right">
					<a href="#" class="btn btn-type1 btn-m w190"  data-toggle="modal" data-target="#modalReview">리뷰 작성</a>
				</div>
            </div>
		</div>
	</div>
<?php $this->load->view('common/reviewWritePopup'); ?>
<?php $this->load->view('common/reviewViewPopup'); ?>

