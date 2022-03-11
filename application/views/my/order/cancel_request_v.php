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
				<h3 class="h3"><a href="/my/order/order_detail/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>" class="link m back">결제취소</a></h3>
				
<!--				<hr class="hr pc">

<!--				<div class="f18 mb15">취소할 상품을 먼저 선택하고 수량을 입력하세요.</div>-->
				<!-- pc -->
				<div class="table1 pc mb40">
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
								<th>배송비</th>
								<th>상태</th>
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
								<td class="f20">0원</td>
								<td class="f20">0원</td>
								<td class="f20"><?php echo $info['status_name']; ?></td>
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
                                    <td class="f20" rowspan="<?php echo count($info['list']); ?>"><?php echo number_format($info['delivery_price']); ?>원</td>
                                    <td class="f20" rowspan="<?php echo count($info['list']); ?>"><?php echo $info['status_name']; ?></td>
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
				<div class="m-table1 mobile border-bottom-none mb80">
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
                                            </dd>
                                        </dl>
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
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </li>
                    <?php
							}
						}
					?>
					</ul>
				</div>
				
				
				
				<h4 class="h4-my">취소사유</h4>
				<div class="mb50"><input type="text" id="reason_msg" class="inp1 block" placeholder="취소사유를 입력해주세요 ex) 반품 환불"></div>
				
                <?php
					if($info['status'] == 'PAYMENT') {
				?>
				<h4 class="h4-my">환불정보</h4>
				<div class="refund-dl mb80">
					<dl>
						<dt>상품 취소 금액</dt>
						<dd><p><?php echo number_format($sum_price); ?>원</p></dd>
					</dl>
					<dl>
						<dt>배송비</dt>
						<dd><p><?php echo number_format($info['delivery_price']); ?>원</p></dd>
					</dl>
					<dl>
						<dt>할인 및 차감금액</dt>
						<dd><p><?php echo number_format($sum_dis); ?>원</p></dd>
					</dl>
					<dl>
						<dt>총 환불 금액</dt>
						<dd><p><span  style="color:red; font-weight:bold"><?php echo number_format($info['total_price']); ?>원</span></p></dd>
					</dl>
                    <?php 
						if($info['order_type'] !== 'starter') {
					?>
					<dl>
						<dt>환불수단</dt>
						<dd><p><?php 
								if($info['payMethod'] == 'VBANK' || $info['payMethod'] == 'VBank') echo '가상계좌(무통장)입금 ';
								else if($info['payMethod'] == 'CARD' || $info['payMethod'] == 'VCard' || $info['payMethod'] == 'Card') echo '카드결제 ';
                                                                else if($info['payMethod'] == 'KakaoPay') echo '카카오페이 ';
                                                                else if($info['payMethod'] == 'NaverPay') echo '네이버페이 ';
								else echo '실시간계좌이체 ';
								echo number_format($info['total_price']) . '원 / <br class="mobile">포인트' . number_format($info['use_point']) . '원'; ?>
                         	</p>
                        </dd>
					</dl>
                    <?php
						}
					?>
				</div>
					<?php
						if($info['payMethod'] == 'VBANK' || $info['payMethod'] == 'VBank') {
					?>
				<h4 class="h4-my">환불방법</h4>
				<div class="refund-dl type2 max490 mb30">
					<dl>
						<dt>환불은행</dt>
						<dd>
							<select class="select1" style="width:100%" id="bank_code">
								<option>은행명을 선택하세요</option>
                                <?php
									foreach($bank as $row) {
										echo '<option value="' . $row['code'] . '">' . $row['name'] . '</option>';	
									}
								?>
							</select>
                        </dd>
					</dl>
					<dl>
						<dt>예금주</dt>
						<dd><input type="text" class="inp1 block" id="bank_owner" placeholder="예금주를 입력하세요 " /></dd>
					</dl>
					<dl>
						<dt>계좌번호</dt>
						<dd><input type="tel" class="inp1 block" id="bank_num" placeholder="계좌번호를 입력하세요.(숫자만입력) " oninput="this.value = this.value.replace(/[^0-9]/g, '');" /></dd>
					</dl>
				</div>
				<div class="agree-box1">
					<label class="label-checkbox"><input type="checkbox" class="checkbox" id="bankCheck"><em></em><span>환불계좌 수집이용에 동의하고, 환불 계좌 정보를 저장합니다.</span></label>
				</div>
				
				<div class="terms1 mb60">
					<div>- 수집목적 : 취소/반품 시 환불처리</div>
					<div>- 수집항목 : 은행, 계좌번호, 명의자 이름</div>
						- 보유 및 이용기간 : 
					<p>- 환불 완료 후 5년, 단 환불계좌관리에 등록할 경우 회원탈퇴 혹은 정보 삭세 시 까지</p>
					<p>- 등록 후 환불 기록이 없을 경우 등록 1년 후 삭제</p></div>
				</div>
				<?php
						}
					}
				?>
				
				<h4 class="h4-my">주문취소 동의</h4>
				
				<div class="agree-box1">
					<label class="label-checkbox">
                    	<input type="checkbox" class="checkbox" id="cancelCheck"><em></em>
                        <span>주문취소 상품의 상품명, 상품가격, 배송정보를 확인하였으며 주문취소에 동의합니다. (전자상거래법 제8조 제2항) (필수) </span>
                    </label>
				</div>
				
				<div class="terms1">
					<div>- 주문취소는 입금전, 입금확인, 결제완료 상태에서만 주문취소가 가능합니다.</div>
					<div>- 상품준비중/배송중 상태에서는 주문취소가 불가능합니다. (고객센터를 통해 문의하여 주십시오)</div>
					<div>- 배송완료 상태부터는 배송/교환/반품 신청이 가능합니다.</div>
					<div>- 신용카드 결제 취소 시 카드 승인 후 당일 취소는 당일 승인 취소 처리되며, 당일 이후 취소 시 카드사 영업일 기준 약2~3일 소요됩니다.</div>
					<div>- 주문 부분 취소 시 결제수단 상관없이 취소신청 후 3-7일 이내에 결제금액 환불처리가 됩니다.</div>
					<div>- 할인쿠폰을 이용한 주문을 취소하실 때 일부 쿠폰의 경우 재발급되지 않습니다.</div>
					<div>- 일부 신용카드의 경우 금액 부분취소가 불가할 수 있습니다. 이 경우 주문 전체취소 후 재구매 또는 고객센터(1661-6417)로 문의하여 주시기 바랍니다.</div>
				</div>
				
				<div class="btn-box-common1">
					<button class="btn btn-type2 btn-m" onclick="javascript:location.href='/my/order/order_detail/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>';">취소</button>
					<button class="btn btn-type1 btn-m" onclick="javascript:fnCancel();">주문취소</button>
				</div>
            </div>
		</div>
	</div>
<form id="frmCancel">
	<input type="hidden" name="order_id" value="<?php echo $info['order_id']; ?>" />
    <input type="hidden" name="bank_num" value="" />
    <input type="hidden" name="bank_code" value="" />
    <input type="hidden" name="bank_name" value="" />
    <input type="hidden" name="bank_owner" value="" />
    <input type="hidden" name="reason_msg" value="" />
    <input type="hidden" name="refund_price" value="<?php echo $info['total_price']; ?>" />
    <input type="hidden" name="refund_point" value="<?php echo $info['use_point']; ?>" />
    <input type="hidden" name="refund_coupon" value="<?php echo $info['use_coupon']; ?>" />
    <input type="hidden" name="refund_coupon_id" value="<?php echo $info['use_coupon_id']; ?>" />
    <input type="hidden" name="refund_coupon_type" value="<?php echo $info['use_coupon_type']; ?>" />
    <input type="hidden" name="refund_type" value="CANCEL" />
    <input type="hidden" name="bankCheck" value="y" />
    <input type="hidden" name="cancelCheck" value="n" />
</form>
<script>
$(document).ready(function(e) {
    $('#bank_code').on('change', function() {
		$('input[name=bank_name]').val($(this).find('option:selected').text());
	});
});

function fnCancel()
{
	$('input[name=reason_msg]').val($('#reason_msg').val());
	$('input[name=cancelCheck]').val($('#cancelCheck').is(':checked') ? 'y' : 'n');
	<?php 
		if(($info['payMethod'] == 'VBANK' || $info['payMethod'] == 'VBank') && $info['status'] == 'PAYMENT') {
	?>
		$('input[name=bank_num]').val($('#bank_num').val());
		$('input[name=bank_code]').val($('#bank_code').val());
		$('input[name=bank_name]').val($('#bank_name').val());
		$('input[name=bank_owner]').val($('#bank_owner').val());
		$('input[name=bankCheck]').val($('#bankCheck').is(':checked') ? 'y' : 'n');
	<?php
		}
	?>
	var msg = {msg : '주문을 취소하시겠습니까?', cancel:'닫기', confirm : '주문취소'};
	showConfirm(msg, 
				function() {
						$.ajax({
							type:'POST',
							url:'/my/order/ajaxCancel',
							data : $('#frmCancel').serialize(),
							dataType:"json",
							success:function(res){
								if(res.status == 'succ') {
									showAlert('success', res.msg, function() {location.href='/my/order/order_detail/<?php echo $offset; ?>?seq=<?php echo $info['order_id']; ?>';});
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
				});
}

</script>