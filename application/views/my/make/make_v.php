	<div class="sub-head mypage-head">
		<div class="inner">
			<h2 class="h2">마이 클린디</h2>
		</div>
	</div>

	<div class="inner">
		
		
		<!-- 마이페이지 -->
		<div class="mypage">
        	<?php $this->load->view('common/myNav'); ?>
			<div class="container">
				<h3 class="h3"><a href="/my/make/review" class="link m">나의 리뷰</a></h3>
				<!-- pc -->
				<div class="table1 mb35  pc">
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
								<th>내용</th>
								<th>평가</th>
								<th>날짜</th>
							</tr>
						</thead>
						<tbody>
						<?php
							if(count($review)) {
								$idx = 0;
								foreach($review as $row) {
						?>
                        
							<tr>
								<td><?php echo $review_cnt - $idx; ?></td>
								<td>
                                	<strong class="f22"><?php echo $row['cit_name']; ?></strong>
                                </td>
								<td class="text-left" style="word-break:break-all;"><?php echo $row['cre_title']; ?></td>
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
				<div class="m-table1 mobile border-bottom-none mb80">
					<ul>
						<?php
							if(count($review)) {
								$idx = 0;
								foreach($review as $row) {
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
                                            <div class="opt">번호 <?php echo $review_cnt - $idx; ?></div>
                                            <span class="name"><?php echo $row['cit_name']; ?></span>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $row['ins_dtm']; ?></div>
                                    <div class="addr mb0" style="word-break:break-all;"><?php echo $row['cre_title']; ?></div>
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
				<div class="text-right mb90 ">
					<a href="#" class="btn btn-type1 btn-m w190"  data-toggle="modal" data-target="#modalReview">리뷰 작성</a>
				</div>
				
				
				
				<h3 class="h3"><a href="/my/make/qna/all" class="link m">나의 문의</a></h3>
				
				<!-- pc -->
				<div class="table1 mb35 pc">
					<table>
						<colgroup>
							<col style="width:90px">
							<col style="width:120px">
							<col style="">
							<col style="width:120px">
							<col style="width:120px">
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>상태</th>
								<th>제목</th>
								<th>첨부</th>
								<th>날짜</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							$idx = 0;
							if(count($qa) > 0) {
								foreach($qa as $row) {
						?>
							<tr>
								<td><?php echo $qa_cnt - $idx; ?></td>
								<td><?php echo $row['is_answer'] == 'n' ? '답변대기' : '답변완료'; ?></td>
								<td class="text-left" style="word-break:break-all;"><a href="/my/make/qna_view?seq=<?php echo $row['cqa_id']; ?>"><?php echo $row['cqa_title']; ?></a></td>
								<td><?php echo $row['file_cnt'] > 0 ? '<i class="xi-paperclip"></i>' : ''; ?></td>
								<td><?php echo date('Y/m/d', strtotime($row['cqa_dtm'])); ?></td>
							</tr>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<tr><td colspan="100%">등록된 문의가 없습니다.</td></tr>';
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile border-bottom-none mb80">
					<ul>
                    <?php
						$idx = 0;
						if(count($qa) > 0) {
							foreach($qa as $row) {
					?>
                            <li>
                                <div href="/my/make/qna_view?seq=<?php echo $row['cqa_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <div class="opt">번호 <?php echo $qa_cnt - $idx; ?></div>
                                            <strong class="name" style="word-break:break-all;"><?php echo $row['cqa_title']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo date('Y/m/d', strtotime($row['cqa_dtm'])); ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>첨부</dt>
                                            <dd><?php echo $row['file_cnt'] > 0 ? '<i class="xi-paperclip"></i>' : ''; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>상태</dt>
                                            <dd>
                                                <span><?php echo $row['is_answer'] == 'n' ? '답변대기' : '답변완료'; ?></span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </li>
                    <?php
								$idx++;
							}
						}
						else {
							echo '<li style="text-align:center">등록된 문의가 없습니다.</li>';
						}
					?>
						
					</ul>
				</div>
				<div class="text-right">
					<a href="/my/make/qna_write" class="btn btn-type1 btn-m w190">문의 작성</a>
				</div>
			</div>				
		</div>
		<!-- // 마이페이지 -->
	</div>
<?php $this->load->view('common/reviewWritePopup'); ?>
<?php $this->load->view('common/reviewViewPopup'); ?>
