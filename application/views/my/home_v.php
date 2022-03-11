	<div class="sub-head mypage-head">
		<div class="inner">
			<h2 class="h2">마이 클린디</h2>
		</div>
	</div>
	
	<div class="inner">
		<div class="mypage">
        	<?php $this->load->view('common/myNav'); ?>
			<div class="container">
				<div class="main">
					
					<div class="mine pc">
						<dl>
							<dt>구매내역</dt>
							<dd>
								<div class="his">
									<div>
										<strong>구독</strong>
										<strong><?php echo $top['billing_cnt']; ?></strong>
									</div>
									<div>
										<strong>단품</strong>
										<strong><?php echo $top['item_cnt']; ?></strong>
									</div>
								</div>
							</dd>
						</dl>
						<dl>
							<dt>포인트</dt>
							<dd><b><?php echo number_format($top['mem_point']); ?></b></dd>
						</dl>
						<dl>
							<dt>쿠폰</dt>
							<dd><?php echo number_format($top['coupon_cnt']); ?>개</dd>
						</dl>
						<dl>
							<dt>진단</dt>
							<dd><?php echo number_format($top['diagnosis_cnt']); ?>건</dd>
						</dl>
					</div>
					
					
					<!-- MOBILE -->
					<div class="mobile-welcome">
						<div class="welcome ">
							<div class="flex">
								<div>
									<dl>
										<dt>포인트</dt>
										<dd><strong class="blue"><?php echo number_format($top['mem_point']); ?></strong></dd>
									</dl>
									<dl>
										<dt>쿠폰</dt>
										<dd><strong class="blue"><?php echo number_format($top['coupon_cnt']); ?></strong>개</dd>
									</dl>
								</div>
							</div>
						</div>
						<div class="mine-m ">
							<dl>
								<dt>구매내역</dt>
								<dd>
									<div class="his">
										<div>
											<strong>구독</strong>
											<strong><?php echo $top['billing_cnt']; ?></strong>
										</div>
										<div>
											<strong>단품</strong>
											<strong><?php echo $top['item_cnt']; ?></strong>
										</div>
									</div>
								</dd>
							</dl>
							<dl>
								<dt>진단</dt>
								<dd><?php echo number_format($top['diagnosis_cnt']); ?>건</dd>
							</dl>

						</div>
					</div>
					
					<div class="subscription">
						<h3 class="h3"><a href="/my/subscribe/subscribe_list" class="link">구독현황</a><?php echo count($subscribe) > 0 ? '<a href="/my/subscribe/subscribe_list" class="more">구독관리</a>' : ''; ?></h3>
                        <?php 
							$seq = '';
							if(count($subscribe) > 0) {
						?>
                            <div class="tabs4 mb50">
                                <div class="swiper-box">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                        <?php 
                                            $idx = 0;
                                            foreach($subscribe as $row) {
                                        ?>
                                            <div class="swiper-slide">
                                                <a href="javascript:void(0);" class="tab_select <?php echo $idx == 0 ? 'active' : ''; ?>" a="<?php echo $row['csu_id']; ?>">
                                                    <span><?php echo $row['is_cancel'] == 'n' ? '구독중' : '구독취소'; ?></span>
                                                    <strong><?php echo $row['csu_title']; ?></strong>
                                                    <p class="img"><img src="<?php echo CDN_URL . $row['img_file']; ?>"></p>
                                                </a>
                                            </div>
                                        <?php
                                                $idx++;
                                            }
                                        ?>
                                        </div>
                                    </div>
            
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                            </div>
                            <?php
								$idx = 0;
                                foreach($subscribe as $row) {
									$pay = strtotime($row['start_date']);
									$now = '구독 시작일';
									$now_date = date('Y/m/d', strtotime($row['ins_dtm']));
									if($row['order_cnt'] > 0) {
										$now = $row['order_cnt'] . '차 배송완료';
										$now_date = date('Y/m/d', strtotime($row['last_date']));
										$pay = strtotime('+' . ($row['delivery_period'] * 7) . ' days', strtotime($row['last_date']));
									}
									if(!empty($row['new_date'])) $pay = strtotime($row['new_date']);
									$next = date('Y/m/d', $pay);
									if(empty($seq)) $seq = $row['csu_id'];
									echo '<input type="hidden" id="org_date_' . $row['csu_id'] . '" value="' . $next . '" />';
									echo '<input type="hidden" id="org_date_text_' . $row['csu_id'] . '" value="' . date('Y년 n월 j일', $pay) . '" />';
									echo '<input type="hidden" id="new_date_' . $row['csu_id'] . '" value="" />';
                            ?>
                            <div class="tab_wrap" id="tab_<?php echo $row['csu_id']; ?>" style="display:<?php echo $idx == 0 ? 'block' : 'none'; ?>">
                                <div class="sub-btns">
                                    <a href="/my/subscribe/detail/0?seq=<?php echo $row['csu_id']; ?>">구독관리</a>
                                </div>
                                
                                <!-- PC -->
                                <div class="delivery-plan pc">
                                    <p></p>
                                    <ul>
                                        <li>
                                            <strong><?php echo $row['order_cnt']; ?></strong>
                                            <dl>
                                                <dt><?php echo $now;?></dt>
                                                <dd><?php echo $now_date;?></dd>
                                            </dl>
                                        </li>
                                        <li>
                                            <strong><?php echo $row['order_cnt'] + 1; ?></strong>
                                            <dl>
                                                <dt>다음 배송일</dt>
                                                <dd id="next_day_<?php echo $row['csu_id']; ?>"><?php echo $next;?></dd>
                                            </dl>
                                            <a href="#" onclick="javascript:fnShowSetNow($('#org_date_text_<?php echo $row['csu_id']; ?>').val(), '<?php echo $row['csu_title']; ?>', '<?php echo number_format($row['total_price']); ?>'); return false;">즉시 당겨받기</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?php
									$idx++;
								}
							}
							else {
						?>
                                <div class="none-cart">
                                    <strong>구독중인 상품이 없습니다.</strong>
                                    <p><a href="/diagnosis" style="text-decoration:underline !important; text-underline-position: under;">몇 가지 건강설문을 통해 나만의 칫솔</a>을 찾아보세요.</p>
                                </div>
						<?php
							}
						?>
						<!-- mobile -->
						<div class="delivery-plan-wrap mobile">
						<?php 
							if(count($subscribe) > 0) {
								$idx = 0;
								$seq = '';
                                foreach($subscribe as $row) {
									$pay = strtotime($row['start_date']);
									$now = '구독 신청일';
									$now_date = date('Y/m/d', strtotime($row['ins_dtm']));
									if($row['order_cnt'] > 0) {
										$now = $row['order_cnt'] . '차 배송완료';
										$now_date = date('Y/m/d', strtotime($row['last_date']));
										$pay = strtotime('+' . ($row['delivery_period'] * 7) . ' days', strtotime($row['last_date']));
									}
									if(!empty($row['new_date'])) $pay = strtotime($row['new_date']);
									$next = date('Y/m/d', $pay);
									if(empty($seq)) $seq = $row['csu_id'];
									echo '<input type="hidden" id="org_date_' . $row['csu_id'] . '" value="' . $next . '" />';
									echo '<input type="hidden" id="org_date_text_' . $row['csu_id'] . '" value="' . date('Y년 n월 j일', $pay) . '" />';
									echo '<input type="hidden" id="new_date_' . $row['csu_id'] . '" value="" />';
                            ?>
							<div class="box tab_wrap" id="tab_mo_<?php echo $row['csu_id']; ?>" style="display:<?php echo $idx == 0 ? 'block' : 'none'; ?>">
								<div class="head">
									<span>구독중</span>
									<strong><?php echo $row['csu_title']; ?></strong>
								</div>
								<div class="delivery-plan">
									<p></p>
									<ul>
										<li>
											<strong><?php echo $row['order_cnt']; ?></strong>
											<dl>
												<dt><?php echo $now;?></dt>
												<dd><?php echo $now_date;?></dd>
											</dl>
										</li>
										<li>
											<strong><?php echo $row['order_cnt'] + 1; ?></strong>
											<dl>
												<dt>다음 배송일</dt>
												<dd id="next_day_mo_<?php echo $row['csu_id']; ?>"><?php echo $next;?></dd>
											</dl>
										</li>
									</ul>
									<a href="#" onclick="javascript:fnShowSetNow($('#org_date_text_<?php echo $row['csu_id']; ?>').val(), '<?php echo $row['csu_title']; ?>'); return false;" class="btn-now">즉시 당겨받기</a>
									<div class="deli-end">
										<em><?php echo $row['order_cnt']; ?></em>
										<strong><?php echo $now;?></strong>
										<span><?php echo $now_date;?></span>
									</div>
								</div>
							</div>
                        <?php
									$idx++;
								}
							}
						?>
						</div>
                    </div>
				
				
					<h3 class="h3"><a href="/my/order/order_list" class="link">최근 주문 내역</a><a href="/my/order/order_list" class="more">더보기</a></h3>
				
					<!-- pc -->
					<div class="table1 mb90 pc">
						<table>
							<thead>
								<tr>
									<th>날짜</th>
									<th>종류</th>
									<th>주문번호</th>
									<th>상품종류</th>
									<th>주문금액</th>
									<th>상태</th>
									<th>배송일자</th>
								</tr>
							</thead>
							<tbody>
							<?php
                                if(count($order) > 0) {
                                    foreach($order as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $row['ins_dtm']; ?></td>
                                    <td class="f20"><?php echo $row['product_name']; ?></td>
                                    <td class="f15"><?php echo $row['order_id']; ?></td>
                                    <td class="f22"><a href="/my/order/order_detail/0?seq=<?php echo $row['order_id']; ?>"><strong><?php echo $row['order_type'] == 'billing' ? '정기구독' : '단품구매'; ?></strong></a></td>
                                    <td class="f20"><?php echo number_format($row['total_price']); ?>원</td>
                                    <td class="f20"><?php echo $row['status_name']; ?></td>
                                    <td><?php echo $row['delivery_start_dtm']; ?></td>
                                </tr>
                            <?php
                                    }
                                }
                                else {
                                    echo '<tr>';
                                    echo '<td colspan="100%">등록된 주문내역이 없습니다.</td>';
                                    echo '</tr>';	
                                }
                            ?>
							</tbody>
						</table>
					</div>
					
					<!-- mobile -->
					<div class="m-table1 mobile mb80">
						<ul>
                        <?php
							if(count($order) > 0) {
								foreach($order as $row) {
						?>
						<li>
							<a href="/my/order/order_detail/0?seq=<?php echo $row['order_id']; ?>" class="item">
								<div class="subj">
									<div>
										<strong class="name"><?php echo $row['product_name']; ?></strong>
										<span class="prd"><?php echo $row['order_type'] == 'billing' ? '정기구독' : '단품구매'; ?></span>
									</div>
									<div class="price"><?php echo number_format($row['total_price']); ?> 원</div>
								</div>
								<div class="date"><?php echo $row['ins_dtm']; ?></div>
								<div class="deli">
									<span><?php echo $row['status_name']; ?></span>
									<span><?php echo $row['delivery_start_dtm']; ?></span>
								</div>
							</a>
						</li>
                        <?php
								}
							}
							else {
								echo '<li>';
								echo '등록된 주문내역이 없습니다.';
								echo '</li>';	
							}
						?>
						</ul>
					</div>
					
					<h3 class="h3"><a href="/my/survey/diagnosis_list" class="link">맞춤 추천상품</a><a href="/my/survey/diagnosis_list" class="more">더보기</a></h3>
					
					<div class="recommend-prd">
						<ul>
                        <?php
							if(count($diagnosis) > 0) {
								foreach($diagnosis as $row) {
						?>
							<li>
								<a href="/diagnosis/detail?seq=<?php echo $row['cdg_id']; ?>">
									<div class="img">
                                   	<?php
										$items = array();
                                       	foreach($row['items'] as $row2) {
											$items[] = $row2['cit_name'];	
											echo '<div style="width:50%; float:left;">';
											echo '<img src="' . CDN_URL . $row2['cit_file_1'] . '" alt="제품">';
											echo '</div>';
											echo '<div style="width:50%; float:left;">';
											echo '<img src="' . CDN_URL . $row2['cit_file_2'] . '" alt="제품">';
											echo '</div>';
										}
									?>
                                    </div>
									<dl>
										<dt>클린디 진단 패키지</dt>
										<dd>
                                        	<?php
												echo implode(' + ', $items);
											?>
                                        </dd>
									</dl>
								</a>
							</li>
                        <?php
								}
							}
							else {
								echo '<li style="text-align:center; font-size:18px; width:100%;">등록된 추천상품이 없습니다. 진단신청하시고 추천상품을 받아보세요.</li>';	
							}
						?>
						</ul>
					</div>
                    
				</div>				
			</div>
		</div>
	</div>
<input type="hidden" id="select_csu_id" value="<?php echo $seq; ?>" />
<?php $this->load->view('common/nowPopup'); ?>
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
		$('.tab_wrap').css('display', 'none');
		$('#tab_' + $(this).attr('a')).css('display', 'block');;
		$('#tab_mo_' + $(this).attr('a')).css('display', 'block');;
		$('#select_csu_id').val($(this).attr('a'));
	});
});

function fnSetNow() {
	$('#modalNow').modal('hide');
	var date = new Date();
	date.setDate(date.getDate() + 1);
	var yy = date.getFullYear();
	var mm = date.getMonth() + 1;
	var dd = date.getDate();
	var now = yy + '-' + (mm < 10 ? '0' : '') + mm + '-' + (dd < 10 ? '0' : '') + dd;

	$.ajax({
			url: "/my/subscribe/ajaxUpdateSubscribe",
			type: 'POST',
			dataType:"json",
			data: {csu_id : $('#select_csu_id').val()
				, org_date : $('#org_date_' + $('#select_csu_id').val()).val()
				, new_date : now
				, org_period : ''
				, new_period : '' },
			success: function(data, textStatus, jqXHR){
				if(data.status == 'login') {
					showAlert('error', data.msg, function() {location.href="/member/login";});
				}
				else if(data.status == 'fail') {
					showAlert('error', data.msg);
				}
				else {
					$('#next_day_' + $('#select_csu_id').val()).html(yy + '/' + (mm < 10 ? '0' : '') + mm + '/' + (dd < 10 ? '0' : '') + dd);
					$('#next_day_mo_' + $('#select_csu_id').val()).html(yy + '/' + (mm < 10 ? '0' : '') + mm + '/' + (dd < 10 ? '0' : '') + dd);
					$('#org_date_text_' + $('#select_csu_id').val()).val(yy + '년 ' + mm + '월 ' + dd + '일');
					showAlert('success', data.msg);
				}
			},
			error: function(request,status,error){
				alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
			}
	});
}

function fnSetNowCancel() {
	$('#modalNow').modal('hide');
}

</script>    