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
				<h3 class="h3"><a href="/my/survey/diagnosis_list" class="link m">진단관리</a></h3>

				<!-- pc -->
				<div class="table1 mb90 f16 pc">
					<table>
						<colgroup>
							<col style="width:90px">
							<col style="width:160px">
							<col style="">
							<col style="width:120px">
						</colgroup>
						<thead>
							<tr>
								<th>번호</th>
								<th>진단일시</th>
								<th>진단명</th>
								<th>결과</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							$idx = 0;
							if(count($diagnosis) > 0) {
								foreach($diagnosis as $row) {
						?>
							<tr>
								<td><?php echo $diagnosis_cnt - $idx; ?></td>
								<td><?php echo date('Y/m/d', strtotime($row['ins_dtm'])); ?></td>
								<td class="f18 text-left"><?php echo $row['cdg_title']; ?></td>
								<td><a href="/diagnosis/detail?seq=<?php echo $row['cdg_id']; ?>" class="btn-under">결과보기</a></td>
							</tr>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<tr><td colspan="100%">진단 이력이 없습니다.</td></tr>';	
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
						if(count($diagnosis) > 0) {
							foreach($diagnosis as $row) {
					?>
						<li>
							<div href="#" class="item">
								<div class="subj">
									<div>
										<div class="opt">번호 <?php echo $diagnosis_cnt - $idx; ?></div>
										<strong class="name"><?php echo $row['cdg_title']; ?></strong>
									</div>
								</div>
								<div class="date mb50"><?php echo date('Y/m/d', strtotime($row['ins_dtm'])); ?></div>
								<div class="status">
									<dl>
										<dt>결과</dt>
										<dd>
											<a href="/diagnosis/detail?seq=<?php echo $row['cdg_id']; ?>">결과보기</a>
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
							echo '<li>진단 이력이 없습니다.</li>';
						}
					?>
					</ul>
				</div>
				
				
				
				<h3 class="h3 mb30"><a href="/my/survey/point_list" class="link m">포인트</a></h3>

				<div class="mb20 f18">고객님께서 <br class="mobile">보유하고 있는 포인트는 <strong class="blue f30"><?php echo number_format($info['mem_point']); ?></strong>포인트 입니다.</div>
				<!-- pc -->
				<div class="table1  f16 mb90 pc">
					<table>
						<thead>
							<tr>
								<th>번호</th>
								<th>일시</th>
								<th>지급/차감</th>
								<th>사유</th>
								<th>유효기간</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							$idx = 0;
							if(count($points) > 0) {
								foreach($points as $row) {
						?>
							<tr>
								<td><?php echo $points_cnt - $idx; ?></td>
								<td><?php $ins = explode(' ', $row['ins_dtm']); 
									echo $ins[0] . '<br>' .$ins[1]; ?></td>
								<td><?php echo ($row['point_dir'] == 'plus' ? '+' : '-') . number_format($row['point_val']); ?></td>
								<td class="text-left f18"><?php echo $row['point_type']; ?></td>
								<td><?php echo $row['exp_dtm']; ?></td>
							</tr>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<tr><td colspan="100%">포인트 이력이 없습니다.</td></tr>';	
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
							if(count($points) > 0) {
								foreach($points as $row) {
						?>
                            <li>
                                <div class="item">
                                    <div class="subj">
                                        <div>
                                            <div class="opt">번호 <?php echo $points_cnt - $idx; ?></div>
                                            <strong class="name"><?php echo $row['point_type']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="date mb50"><?php echo $row['ins_dtm']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>지급 / 차감</dt>
                                            <dd><?php echo ($row['point_dir'] == 'plus' ? '+' : '-') . number_format($row['point_val']); ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>유효기간</dt>
                                            <dd><?php echo $row['exp_dtm']; ?></dd>
                                        </dl>
                                    </div>
                                </div>
                            </li>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<li>포인트 이력이 없습니다.</li>';
							}
						?>
						
					</ul>
				</div>
				
				
				
				
				
				
				<h3 class="h3 mb20"><a href="/my/survey/coupon_list" class="link m">쿠폰</a></h3>
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
								if(count($coupon) > 0) {
									foreach($coupon as $row) {
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
						if(count($coupon) > 0) {
							foreach($coupon as $row) {
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
			</div>
		</div>
	</div>
<?php $this->load->view('common/couponPopup'); ?>
<script>
$(document).ready(function(e) {
    
});

</script>
