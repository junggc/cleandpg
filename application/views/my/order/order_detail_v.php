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
				
					
				<h3 class="h3"><a href="/my/order/order_list/<?php echo $offset; ?>" class="link m back">주문내역 상세</a></h3>
				<div class="tabs4 mobile mb50">
					<div>
						<a href="#" class="active">
							<span><?php echo $info['order_type'] == 'item' ? '1회구매' : '구독상품'; ?></span>
							<strong><?php echo $info['product_name']; ?></strong>
							<p class="img"><img src="<?php echo CDN_URL . $info['cit_file_1']; ?>"></p>
						</a>
					</div>
				</div>
				
				<h4 class="h4-my flex center">
					<div>주문상품<small><?php echo $info['order_id']; ?></small></div>
					<div class="ship-date"><?php echo $info['product_name']; ?></div>
				</h4>

				<!-- pc -->
				<div class="table1 mb90 pc">
					<table>
						<thead>
							<tr>
								<th>종류</th>
								<th>주문상품</th>
								<th>수량</th>
								<th>상품금액</th>
								<th>할인금액</th>
								<th>할인적용<br>금액</th>
								<th>포인트사용</th>
								<th>상태</th>
								<th>리뷰/취소/<br>반품/교환</th>
							</tr>
						</thead>
						<tbody>
                        <?php
							if($info['order_type'] == 'starter') {
								$org_price = 0;
								$items = array();
								foreach($info['list'] as $row) {
									$org_price += $row['cit_price'] * $row['qty'];
									$items[] = $row['cit_name'] . (!empty($row['cde_title']) ? '(' . $row['cde_title'] . ')' : '');
								}
								$sum_price = $org_price;
								$sum_price2 = $info['total_price'];
								$sum_dis = $org_price - $sum_price2;
						?>
							<tr>
								<td class="f20">1회<br>구매</td>
								<td class="f22"><strong><?php echo $info['product_name']; ?></strong><div class="mt10" style="font-size:14px"><?php echo implode('<br>', $items); ?></div></td>
								<td class="f20">1</td>
								<td class="f20"><?php echo number_format($org_price); ?>원</td>
								<td class="f20"><?php echo number_format($sum_dis); ?>원</td>
								<td class="f20 bold"><?php echo number_format($sum_price2); ?>원</td>
								<td class="f20"><?php echo number_format($info['use_point']); ?>원</td>
								<td class="f20"><?php echo $info['status_name']; ?>
                                    <?php 
										if($info['status'] == 'DELIVERY') {
									?>
                                	<div class="mt10"><a href="https://www.lotteglogis.com/home/reservation/tracking/linkView?InvNo=<?php echo preg_replace("/[^0-9]*/s", "", $info['delivery_invoice']); ?>" target="_blank" class="btn-under">배송조회</a></div>
                                    <?php
										}
									?>
                                </td>
								<td class="f20">
									<div class="btn-box-table">
                                    	<?php
											if(($info['status'] == 'COMPLETE' || $info['status'] == 'CHANGE_CANCEL' || $info['status'] == 'RETURN_CANCEL') && $info['item_cnt'] > $info['review_cnt']) {
										?>
										<div><a href="#" class="btn-under" data-toggle="modal" data-target="#modalReview">리뷰작성</a></div>
                                        <?php
											}
											if($info['status'] == 'REQUEST' || $info['status'] == 'PAYMENT') {
												echo '<div><a href="/my/order/cancel_request/' . $offset . '?seq=' . $row['order_id'] . '" class="btn-under">결제취소</a></div>';
											}
											if($info['status'] == 'DELIVERY_COMPLETE') {
										?>
										<div><a href="#" class="btn-under" onclick="javascript:fnComplete(); return false;">구매완료</a></div>
										<div><a href="/my/order/return_request/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="btn-under">반품신청</a></div>
										<div><a href="/my/order/change_request/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="btn-under">교환신청</a></div>
                                        <?php
											}
										?>
									</div>
								</td>
							</tr>                        
                        <?php
							}
							else {
								$sum_dis = 0;
								$sum_price = 0;
								$idx = 0;
								foreach($info['list'] as $row) {
									$unit_price = $row['cit_sale_price'];
									if($info['order_type'] == 'billing') $unit_price = $row['cit_subscribe_price'];
									$dis = $row['cit_price'] - $unit_price;
									$sum_dis += $dis * $row['qty'];
									$sum_price += $row['cit_price'] * $row['qty'];
						?>
							<tr>
								<td class="f20"><?php echo $info['order_type'] == 'billing' ? '구독<br>상품' : '1회<br>구매'; ?></td>
								<td class="f22"><strong><?php echo $row['cit_name']; ?></strong><div class="mt10 f20"><?php echo $row['cde_title']; ?></div></td>
								<td class="f20"><?php echo $row['qty']; ?></td>
								<td class="f20"><?php echo number_format($row['cit_price']); ?>원</td>
								<td class="f20"><?php echo number_format($dis); ?>원</td>
								<td class="f20 bold"><?php echo number_format($unit_price); ?>원</td>
                                <?php
									if($idx == 0) {
								?>
								<td class="f20" rowspan="<?php echo count($info['list']); ?>"><?php echo number_format($info['use_point']); ?>원</td>
								<td class="f20" rowspan="<?php echo count($info['list']); ?>"><?php echo $info['status_name']; ?>
                                    <?php 
										if($info['status'] == 'DELIVERY') {
									?>
                                	<div class="mt10"><a href="https://www.lotteglogis.com/home/reservation/tracking/linkView?InvNo=<?php echo preg_replace("/[^0-9]*/s", "", $info['delivery_invoice']); ?>" target="_blank" class="btn-under">배송조회</a></div>
                                    <?php
										}
									?>
                                </td>
								<td class="f20" rowspan="<?php echo count($info['list']); ?>">
									<div class="btn-box-table">
                                    	<?php
											if(($info['status'] == 'COMPLETE' || $info['status'] == 'CHANGE_CANCEL' || $info['status'] == 'RETURN_CANCEL') && $info['item_cnt'] > $info['review_cnt']) {
										?>
										<div><a href="#" class="btn-under" data-toggle="modal" data-target="#modalReview">리뷰작성</a></div>
                                        <?php
											}
											if($info['status'] == 'REQUEST' || $info['status'] == 'PAYMENT') {
												echo '<div><a href="/my/order/cancel_request/' . $offset . '?seq=' . $row['order_id'] . '" class="btn-under">결제취소</a></div>';
											}
											if($info['status'] == 'DELIVERY_COMPLETE') {
										?>
										<div><a href="#" class="btn-under" onclick="javascript:fnComplete(); return false;">구매완료</a></div>
										<div><a href="/my/order/return_request/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="btn-under">반품신청</a></div>
										<div><a href="/my/order/change_request/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="btn-under">교환신청</a></div>
                                        <?php
											}
										?>
									</div>
								</td>
                                <?php 
									}
								?>
							</tr>
                        <?php
									$idx++;
								}
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile mb80 border-bottom-none">
					<ul>
                    <?php
						if($info['order_type'] == 'starter') {
					?>
                            <li>
                                <div class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $info['product_name']; ?><br><span style="font-size:12px; font-weight:normal;"><?php echo implode('<br>', $items); ?></span></strong><br>
                                            <span class="prd">1회 구매</span>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $info['ins_dtm']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>할인금액</dt>
                                            <dd>- <?php echo number_format($sum_dis); ?> 원</dd>
                                        </dl>
                                        <dl>
                                            <dt>할인 적용 금액</dt>
                                            <dd><strong><?php echo number_format($sum_price2); ?> 원</strong></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>상태</dt>
                                            <dd>
                                                <span><?php echo $info['status_name']; ?></span>
                                                <?php 
                                                    if($info['status'] == 'DELIVERY') {
                                                ?>
                                                <a href="https://www.lotteglogis.com/home/reservation/tracking/linkView?InvNo=<?php echo preg_replace("/[^0-9]*/s", "", $info['delivery_invoice']); ?>">배송조회</a>
                                                <?php
                                                    }
                                                ?>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="btns-box">
                                        <div class="tit">리뷰 / 취소 / 반품 /  교환</div>
                                        <div class="btns">
                                            <?php
                                                if(($info['status'] == 'COMPLETE' || $info['status'] == 'CHANGE_CANCEL' || $info['status'] == 'RETURN_CANCEL') && $info['item_cnt'] > $info['review_cnt']) {
                                            ?>
                                            <a href="#" class="btn btn-type1 btn-m" data-toggle="modal" data-target="#modalReview">리뷰작성</a>
                                            <?php
                                                }
                                                if($info['status'] == 'REQUEST' || $info['status'] == 'PAYMENT') {
                                            ?>
                                            <a href="/my/order/cancel_request/<?php echo $offset; ?>?seq=<?php echo $row['order_id']; ?>" class="btn btn-type1 btn-m">결제취소</a>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                                if($info['status'] == 'COMPLETE' || $info['status'] == 'DELIVERY' || $info['status'] == 'DELIVERY_COMPLETE') {
                                            ?>
                                            <a href="#" class="btn btn-type1 btn-m" onclick="javascript:fnComplete(); return false;">구매완료</a>
                                            <a href="/my/order/return_request/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="btn btn-type1 btn-m">반품신청</a>
                                            <a href="/my/order/change_request/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="btn btn-type1 btn-m">교환신청</a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>                    
                    <?php
						}
						else {
							foreach($info['list'] as $row) {
								$unit_price = $row['cit_sale_price'];
								if($info['order_type'] == 'billing') $unit_price = $row['cit_subscribe_price'];
								$dis = $row['cit_price'] - $unit_price;
					?>
                            <li>
                                <div class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['cit_name']; ?><?php echo $row['cde_title'] != '' ? ' - ' . $row['cde_title'] : ''; ?></strong>
                                            <span class="prd"><?php echo $info['order_type'] == 'billing' ? '구독상품' : '1회<br>구매'; ?></span>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $info['ins_dtm']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>할인금액</dt>
                                            <dd>- <?php echo number_format($dis); ?> 원</dd>
                                        </dl>
                                        <dl>
                                            <dt>할인 적용 금액</dt>
                                            <dd><strong><?php echo number_format($unit_price); ?> 원</strong></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>상태</dt>
                                            <dd>
                                                <span><?php echo $info['status_name']; ?></span>
                                                <?php 
                                                    if($info['status'] == 'DELIVERY') {
                                                ?>
                                                <a href="https://www.lotteglogis.com/home/reservation/tracking/linkView?InvNo=<?php echo preg_replace("/[^0-9]*/s", "", $info['delivery_invoice']); ?>">배송조회</a>
                                                <?php
                                                    }
                                                ?>
                                            </dd>
                                        </dl>
                                    </div>
                                    <div class="btns-box">
                                        <div class="tit">리뷰 / 취소 / 반품 /  교환</div>
                                        <div class="btns">
                                            <?php
                                                if(($info['status'] == 'COMPLETE' || $info['status'] == 'CHANGE_CANCEL' || $info['status'] == 'RETURN_CANCEL') && $info['item_cnt'] > $info['review_cnt']) {
                                            ?>
                                            <a href="#" class="btn btn-type1 btn-m" data-toggle="modal" data-target="#modalReview">리뷰작성</a>
                                            <?php
                                                }
                                                if($info['status'] == 'REQUEST' || $info['status'] == 'PAYMENT') {
                                            ?>
                                            <a href="/my/order/cancel_request/<?php echo $offset; ?>?seq=<?php echo $row['order_id']; ?>" class="btn btn-type1 btn-m">결제취소</a>
                                            <?php
                                                }
                                            ?>
                                            <?php
                                                if($info['status'] == 'COMPLETE' || $info['status'] == 'DELIVERY' || $info['status'] == 'DELIVERY_COMPLETE') {
                                            ?>
                                            <a href="#" class="btn btn-type1 btn-m" onclick="javascript:fnComplete(); return false;">구매완료</a>
                                            <a href="/my/order/return_request/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="btn btn-type1 btn-m">반품신청</a>
                                            <a href="/my/order/change_request/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="btn btn-type1 btn-m">교환신청</a>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                    <?php
							}
						}
					?>
					</ul>
				</div>
				
				
				
				
				<!-- 주문자 정보 -->
				<div class="order-info">
					<div class="box">
						<h4 class="h4-my">주문자</h4>
						<div class="info">
							<dl>
								<dt>이름</dt>
								<dd><?php echo $info['mem_username']; ?></dd>
							</dl>
							<dl>
								<dt>전화번호</dt>
								<dd><?php echo $info['mem_phone']; ?></dd>
							</dl>
							<dl>
								<dt>이메일</dt>
								<dd><?php echo $info['mem_email']; ?></dd>
							</dl>
							<div class="desc">* 주문자 정보로 주문 관련 정보가 <br class="pc">문자와 이메일로 발송 됩니다. </div>
						</div>
					</div>
					<div class="box">
						<h4 class="h4-my">배송지 <?php echo $info['status'] == 'REQUEST' || $info['status'] == 'PAYMENT' ? '<a href="#" data-toggle="modal" data-target="#modalChangeDelivery">수정</a>' : ''; ?></h4>
						<div class="info">
							<dl>
								<dt>이름</dt>
								<dd><?php echo $info['recipient_name']; ?></dd>
							</dl>
							<dl>
								<dt>전화번호</dt>
								<dd><?php echo $info['recipient_phone']; ?></dd>
							</dl>
							<dl>
								<dt>주소</dt>
								<dd>(<?php echo $info['recipient_zip']; ?>)<?php echo $info['recipient_addr1']; ?> <?php echo $info['recipient_addr2'];?></dd>
							</dl>
							<dl>
								<dt>메모</dt>
								<dd><?php echo $info['recipient_memo']; ?></dd>
							</dl>
						</div>
					</div>
					<div class="box">
						<h4 class="h4-my">결제금액</h4>
						<div class="info2">
							<dl>
								<dt>상품금액</dt>
								<dd><strong><?php echo number_format($sum_price); ?></strong> 원</dd>
							</dl>
							<dl>
								<dt>배송비</dt>
								<dd><strong><?php echo $info['delivery_price'] > 0 ? '+ ' . number_format($info['delivery_price']) : '0'; ?></strong> 원</dd>
							</dl>
							<dl>
								<dt>할인금액</dt>
								<dd><strong><?php echo $sum_dis > 0 ? '- ' . number_format($sum_dis) : '0'; ?></strong> 원</dd>
							</dl>
							<dl>
								<dt>포인트 사용</dt>
								<dd><strong><?php echo $info['use_point'] > 0 ? '- ' . number_format($info['use_point']) : '0'; ?></strong> 원</dd>
							</dl>
							<dl class="total">
								<dt>최종결제금액</dt>
								<dd><strong><?php echo number_format($info['total_price']); ?></strong> 원</dd>
							</dl>
						</div>
					</div>
					<div class="box">
						<h4 class="h4-my">주문결제정보</h4>
						<div class="info3">
							<dl>
								<dt>주문번호</dt>
								<dd><?php echo $info['order_id']; ?></dd>
							</dl>
							<dl>
								<dt>주문날짜</dt>
								<dd><?php echo $info['order_dtm']; ?></dd>
							</dl>
                        <?php
							if($info['payMethod'] == 'Card' || $info['payMethod'] == 'VCard') {
						?>
							<dl>
								<dt>결제수단</dt>
								<dd>카드결제</dd>
							</dl>
							<dl>
								<dt>카드정보</dt>
								<dd><?php echo $info['card_name'] != '' ? $info['card_name'] . '/' : ''; ?><?php echo $info['card_num']; ?></dd>
							</dl>
							<dl>
								<dt>결재방식</dt>
								<dd><?php echo $info['order_type'] == 'billing' ? '정기결제' : '1회결제'; ?></dd>
							</dl>
							<dl>
								<dt>증빙자료</dt>
								<dd><a class="btn-under blue" target="_blank" href="https://iniweb.inicis.com/DefaultWebApp/mall/cr/cm/mCmReceipt_head.jsp?noTid=<?php echo $info['tid']; ?>&noMethod=1">신용카드 결제전표</a></dd>
							</dl>
                        <?php
							}
							else if($info['payMethod'] == 'VBank' || $info['payMethod'] == 'VBANK') {
						?>
							<dl>
								<dt>결제수단</dt>
								<dd>가상계좌(무통장)입금</dd>
							</dl>
							<dl>
								<dt>은행명</dt>
								<dd><?php echo $info['vbank_name']; ?></dd>
							</dl>
							<dl>
								<dt>계좌번호</dt>
								<dd><?php echo $info['vbank_num']; ?></dd>
							</dl>
							<dl>
								<dt>예금주명</dt>
								<dd><?php echo $info['vbank_owner']; ?></dd>
							</dl>
							<dl>
								<dt>입금기한</dt>
								<dd><?php echo date('Y.m.d', strtotime($info['vbank_date'])); ?></dd>
							</dl>
                        <?php	
							}
							else if($info['payMethod'] == 'DirectBank' || $info['payMethod'] == 'BANK') {
						?>
							<dl>
								<dt>결제수단</dt>
								<dd>실시간계좌이체</dd>
							</dl>
							<dl>
								<dt>은행명</dt>
								<dd><?php echo $info['bank_name']; ?></dd>
							</dl>
							<dl>
								<dt>계좌번호</dt>
								<dd><?php echo $info['bank_num']; ?></dd>
							</dl>
						<?php	
							}
						?>
							<dl>
								<dt>결제일시</dt>
								<dd><?php echo $info['applDate'] != '' && $info['status'] != 'REQUEST' ? date('Y-m-d', strtotime($info['applDate'])) : ''; ?> 
									<?php echo $info['applTime'] != '' && $info['status'] != 'REQUEST' ? date('H:i', strtotime($info['applTime'])) : ''; ?></dd>
							</dl>
						</div>
					</div>
				</div>
				<!-- // 주문자 정보 -->
				<div class="order-btn-box text-right border">
					<a href="/my/order/order_list/<?php echo $offset; ?>" class="btn btn-type1 btn-m">주문내역</a>
				</div>
	
			</div>
		</div>
	</div>
<?php $this->load->view('common/reviewWritePopup'); ?>
<?php $this->load->view('common/changeDeliveryPopup'); ?>

<script>
function fnComplete()
{
	$.ajax({
			type:'POST',
			url:'/my/order/ajaxComplete',
			data : {order_id: '<?php echo $info['order_id']; ?>'},
			dataType:"json",
			success:function(res){
				if(res.status == 'succ') {
					showAlert('success', res.msg, function() {location.reload();});
				}
				else if(res.status == 'login') {
					showAlert('error', res.msg, function() {location.href="/member/login";});
				}
				else {
					showAlert('error', res.msg);
				}
			},
			error:function(data){
				alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
			}
	});
}
</script>