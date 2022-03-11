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
				<h3 class="h3 mb30"><a href="/my/survey" class="link m back">포인트</a></h3>

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
							if(count($list) > 0) {
								$idx = 0;
								foreach($list as $row) {
						?>
							<tr>
								<td><?php echo $total - $offset - $idx; ?></td>
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
							if(count($list) > 0) {
								foreach($list as $row) {
						?>
                            <li>
                                <div class="item">
                                    <div class="subj">
                                        <div>
                                            <div class="opt">번호 <?php echo $total - $offset - $idx; ?></div>
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
				
				<?php echo $pagination; ?>
            </div>
		</div>
		<!-- // 마이페이지 -->
	</div>
	<!-- // inner -->
