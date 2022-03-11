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
				<h3 class="h3">구독관리</h3>
				
				<div class="table1  f16 mb90 pc">
					<table>
						<thead>
							<tr>
								<th>구독명</th>
								<th>구독시작일</th>
								<th>이번 결제일</th>
								<th>다음 결제일</th>
								<th>결제금액</th>
								<th>회차</th>
							</tr>
						</thead>
						<tbody>
                        <?php 
							if(count($list) > 0) {
								$idx = 0;
								foreach($list as $row) {
						?>
							<tr>
								<td><a href="/my/subscribe/detail/<?php echo $offset; ?>?seq=<?php echo $row['csu_id']; ?>"><?php echo $row['csu_title']; ?></a></td>
								<td>
                                <?php
									if(!empty($row['new_date'])) {
										$pay = strtotime($row['new_date']);
									}
									else if(empty($row['last_date'])) {
										$pay = strtotime($row['start_date']);
									}
									else {
										$pay = strtotime('+' . ($row['delivery_period'] * 7) . ' days', strtotime($row['last_date']));
									}
									$next = strtotime('+' . ($row['delivery_period'] * 7) . ' days', $pay);
									echo date('Y/m/d', strtotime($row['start_date']));
                                ?>
								</td>
								<td><?php echo date('Y/m/d', $pay); ?></td>
								<td><?php echo date('Y/m/d', $next); ?></td>
								<td><?php echo number_format($row['total_price']); ?></td>
								<td><?php echo number_format($row['order_cnt']); ?></td>
							</tr>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<tr><td colspan="100%">구독중인 상품이 없습니다.</td></tr>';
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
                                <a href="/my/subscribe/detail/<?php echo $offset; ?>?seq=<?php echo $row['csu_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['csu_title']; ?></strong>
                                            <span class="prd">구독상품</span>
                                        </div>
                                        <div>
                                            <strong class="name" style="text-align:right;"><?php echo number_format($row['total_price']); ?></strong>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo date('Y/m/d', $pay); ?></div>
                                    <div class="info1" style="padding-bottom:15px">
                                        <dl>
                                            <dt>다음 결제일&nbsp;&nbsp;&nbsp; <?php echo date('Y/m/d', $next); ?></dt>
                                        </dl>
                                    </div>
                                </a>
                            </li>
                        <?php
									$idx++;
								}
							}
							else {
								echo '<li style="text-align:center">구독중인 상품이 없습니다.</li>';
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
<script>
$(document).ready(function(e) {
	var swiper = new Swiper(".tabs4 .swiper-container", {
		slidesPerView: "auto",
		spaceBetween: 6,
		navigation: {
			nextEl: ".tabs4 .swiper-button-next",
			prevEl: ".tabs4 .swiper-button-prev",
		},
	});

	$('.tab_select').on('click', function() {
		$('.tab_select').removeClass('active');
		$(this).addClass('active');
		fnGetDetail($(this).attr('a'));
	});
	
});

</script>