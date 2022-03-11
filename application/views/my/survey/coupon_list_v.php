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
				<h3 class="h3 mb20"><a href="/my/survey" class="link m back">쿠폰</a></h3>
				<div class="text-right mb25"><a href="/my/survey/coupondown_list" class="btn-under" >쿠폰 등록</a></div>
				<!-- pc -->
				<div class="table1 f16 mb90 pc">
					<table>
						<thead>
							<tr>
								<th>쿠폰명</th>
								<th>혜택</th>
								<th>발급일</th>
								<th>유효기간</th>
								<th>남은일자</th>
								<th>제한금액</th>
								<th>상태</th>
								<th>적용대상</th>
							</tr>
						</thead>
						<tbody>
                        	<?php
								if(count($list) > 0) {
									foreach($list as $row) {
							?>
							<tr>
								<td class="f18"><?php echo $row['ccp_name']; ?></td>
								<td class="blue">
                                <?php
                                	if($row['price_type'] === '1') {
										echo $row['ccp_val'] . '% 할인';
										if($row['use_max'] === 'y') {
											echo ',<br>최대 ' . number_format($row['max_val']) . '원';
										}
									}
									else {
										echo number_format($row['ccp_val']) . '원 할인';
									}
								?>
                                </td>
								<td><?php echo $row['down_dtm']; ?></td>
								<td>~ <?php echo date('Y/m/d', strtotime($row['use_end_date'])); ?></td>
								<td class="blue">
								<?php 
									$date1 = new DateTime(date('Y-m-d'));
									$date2 = new DateTime($row['use_end_date']);
									$diff = date_diff($date1, $date2);
									if($date1 > $date2) {
										echo '사용불가';	
									}
									else {
										echo $diff->days . '일 남음';
									}
								?>
                                </td>
								<td>
                                <?php
                                	if($row['use_min'] === 'y') {
										echo number_format($row['min_val']) . '원 이상<br>구매시';
									}
									else {
										echo '없음';
									}
								?>
                                </td>
								<td class="blue"><?php echo $row['is_use'] === 'y' ? '사용' : '미사용'; ?></td>
								<td><a href="#" class="btn-under"  data-toggle="modal" data-target="#modalCoupon" onclick="javascript:fnPopupSetDetail('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;">조회</a></td>
							</tr>
                            <?php
									}
								}
								else {
							?>
							<tr>
								<td colspan="100%">등록된 쿠폰이 없습니다.</td>
							</tr>
                            <?php
								}
							?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile border-bottom-none mb80">
					<ul>
                   	<?php
						if(count($list) > 0) {
							foreach($list as $row) {
					?>
						<li>
							<div class="item">
								<div class="subj mb40">
									<div>
										<strong class="name"><?php echo $row['ccp_name']; ?></strong>
										<div class="date"><?php echo $row['down_dtm']; ?></div>
									</div>
									<div class="price blue">
                                    <?php
										if($row['price_type'] === '1') {
											echo $row['ccp_val'] . '% 할인';
											if($row['use_max'] === 'y') {
												echo ',<br>최대 ' . number_format($row['max_val']) . '원';
											}
										}
										else {
											echo number_format($row['ccp_val']) . '원 할인';
										}
									?>
                                	</div>
								</div>
								
								<div class="info1">
									<dl>
										<dt>유효기간</dt>
										<dd>~ <?php echo date('Y/m/d', strtotime($row['use_end_date'])); ?></dd>
									</dl>
									<dl>
										<dt>남은일자</dt>
										<dd class="blue">
										<?php 
											$date1 = new DateTime(date('Y-m-d'));
											$date2 = new DateTime($row['use_end_date']);
											$diff = date_diff($date1, $date2);
											if($date1 > $date2) {
												echo '사용불가';	
											}
											else {
												echo $diff->days . '일 남음';
											}
										?>
                                        </dd>
									</dl>
									<dl>
										<dt>제한금액</dt>
										<dd>
                                        <?php
											if($row['use_min'] === 'y') {
												echo number_format($row['min_val']) . '원 이상 구매시';
											}
											else {
												echo '없음';
											}
										?>
                                        </dd>
									</dl>
									<dl>
										<dt>적용대상</dt>
										<dd><a href="#" class="btn-under"  data-toggle="modal" data-target="#modalCoupon" onclick="javascript:fnPopupSetDetail('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;">조회</a></dd>
									</dl>
								</div>
								<div class="status">
									<dl>
										<dt>상태</dt>
										<dd>
											<span class="blue"><?php echo $row['is_use'] === 'y' ? '사용' : '미사용'; ?></span>
										</dd>
									</dl>
								</div>
							</div>
						</li>
                            
                    <?php
							}
						}
						else {
					?>
						<li style="text-align:center">등록된 쿠폰이 없습니다.
						</li>
                    <?php
						}
					?>
					</ul>
				</div>
				<?php echo $pagination; ?>
            </div>
		</div>
		<!-- // 마이페이지 -->
	</div>
	<!-- // inner -->
<?php $this->load->view('common/couponPopup'); ?>
    
