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
				<h3 class="h3"><a href="/my/order/cancel_list/<?php echo $offset;?>" class="link m back">취소/환불 내역 상세</a></h3>
				<hr class="hr pc">
				<h4 class="h5-history pc">상태 <strong class="blue">: <?php echo $info['status_name']; ?></strong></h4>
				<!-- pc -->
				<div class="table1 pc">
					<table>
						<thead>
							<tr>
								<th>날짜</th>
								<th>주문번호</th>
								<th>상품</th>
								<th>수량</th>
								<th>결제</th>
								<th>포인트</th>
								<th>배송비</th>
								<th>총환불비용</th>
							</tr>
						</thead>
						<tbody>
                        <?php
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
                                <?php
									if($idx == 0) {
								?>
								<td rowspan="<?php echo count($info['list']); ?>"><?php echo $info['ins_dtm']; ?></td>
								<td class="f25" rowspan="<?php echo count($info['list']); ?>"><?php echo $info['order_id']; ?></td>
                                <?php 
									}
								?>
								<td class="f22"><strong><?php echo $row['cit_name']; ?></strong><div class="mt10 f20"><?php echo $row['cde_title']; ?></div></td>
								<td class="f20"><?php echo $row['qty']; ?></td>
								<td class="f20"><?php echo number_format($unit_price); ?>원</td>
                                <?php
									if($idx == 0) {
								?>
								<td class="f20" rowspan="<?php echo count($info['list']); ?>"><?php echo number_format($info['use_point']); ?>원</td>
								<td class="f20" rowspan="<?php echo count($info['list']); ?>"><?php echo number_format($info['delivery_price']); ?>원</td>
								<td class="f20" rowspan="<?php echo count($info['list']); ?>"><strong class="blue"><?php echo number_format($info['total_price']); ?>원</strong></td>
                                <?php 
									}
								?>
							</tr>
                        <?php
								$idx++;
							}
						?>
						</tbody>
					</table>
				</div>

				<!-- mobile -->
				<div class="m-table1 mobile border-bottom-none ">
					<ul>
                        <?php
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
                            <li>
                                <div class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['cit_name']; ?></strong>
                                            <span class="prd"><?php echo $info['refund_type_name']; ?></span>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $info['request_dtm']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>환불번호</dt>
                                            <dd><?php echo $info['crf_id']; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>반품완료일</dt>
                                            <dd><?php echo $info['complete_dtm']; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>상태</dt>
                                            <dd>
                                                <span class="blue"><?php echo $info['status_name']; ?></span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </li>
                        <?php
								$idx++;
							}
						?>
					</ul>
				</div>
				
				
				<div class="refund-form">
					<div class="box">
						<h4 class="h4">환불처리 <a href="/my/make/qna_write">문의</a></h4>
						<dl>
							<dt>환불상태</dt>
							<dd><p><?php echo $info['status_name']; ?></p></dd>
						</dl>
						<dl>
							<dt>환불번호</dt>
							<dd><p><?php echo $info['crf_id']; ?></p></dd>
						</dl>
						<dl>
							<dt>환불종류</dt>
							<dd><p><?php echo $info['refund_type_name']; ?></p></dd>
						</dl>
						<dl>
							<dt>환불접수일</dt>
							<dd><p><?php echo date('Y년 m월 d일', strtotime($info['request_dtm'])); ?></p></dd>
						</dl>
						<dl>
							<dt>환불완료일</dt>
							<dd><p><?php echo $info['complete_dtm'] == '' ? '&nbsp' : date('Y년 m월 d일', strtotime($info['complete_dtm'])); ?></p></dd>
						</dl>
					</div>
					<div class="box">
                    <?php 
						if(($info['payment_status'] == 'PAYMENT' && ($info['payMethod'] == 'VBank' || $info['payMethod'] == 'VBANK')) || $info['payment_status'] == 'COMPLETE') {
					?>
						<h4 class="h4">환불정보 <?php echo $info['status'] == 'REFUND_REQUEST' ? '<a href="#" onclick="javascript:fnChangeBank(); return false;">변경</a>' : ''; ?></h4>
                        <form id="frmBank">
                        	<input type="hidden" name="crf_id" value="<?php echo $info['crf_id']; ?>" />
						<dl>
							<dt>환불은행</dt>
							<dd>
								<select class="select1 bank_info" style="width:100%" name="bank_code" disabled>
									<option>은행명을 선택하세요</option>
                                <?php
									foreach($bank as $row) {
										echo '<option value="' . $row['code'] . '" ' . ($row['code'] == $info['bank_code'] ? 'selected' : '') . '>' . $row['name'] . '</option>';	
									}
								?>
								</select>
                                <input type="hidden" name="bank_name" value="<?php echo $info['bank_name']; ?>" />
							</dd>
						</dl>
						<dl>
							<dt>예금주</dt>
							<dd><input type="text" class="inp1 bank_info" name="bank_owner" placeholder="예금주를 입력하세요 " value="<?php echo $info['bank_owner']; ?>" readonly></dd>
						</dl>
						<dl>
							<dt>계좌번호</dt>
							<dd><input type="text" class="inp1 bank_info" name="bank_num" placeholder="계좌번호를 입력하세요 "  value="<?php echo $info['bank_num']; ?>" readonly></dd>
						</dl>
						<dl>
							<dt>상세사유</dt>
							<dd><input type="text" class="inp1 bank_info" name="reason_msg" placeholder="ex) 반품 환불 "  value="<?php echo $info['refund_memo']; ?>" readonly></dd>
						</dl>
                        </form>
                        <?php 
							if($info['status'] == 'REFUND_REQUEST') {
						?>
						<div class="btns" id="btn_save" style="display:none">
							<button class="btn btn-type1" onclick="javascript:fnSaveBank();">확인</button>
						</div>
                        <?php
							}
						?>
                    <?php
						}
						else if($info['payMethod'] == 'CARD' || $info['payMethod'] == 'VCard' || $info['payMethod'] == 'BANK' || $info['payMethod'] == 'DirectBank') {
							
						}
					?>
					</div>
				</div>
				
				<div class="text-center mb130">
					<a href="/my/order/cancel_list/<?php echo $offset;?>" class="btn btn-type2 btn-m w190">환불 목록</a>
				</div>
				
				
				<div class="refund-desc">
					<div class="box">
						<h4 class="h4-my">환불종류</h4>
						<dl>
							<dt>구독취소</dt>
							<dd>구독상품을 취소 시 구독취소로 표기됩니다.  </dd>
						</dl>
						<dl>
							<dt>단품결제취소</dt>
							<dd>단품상품에 대해 취소 시 단품결제취소로 표기됩니다. </dd>
						</dl>
						<dl>
							<dt>반품환불</dt>
							<dd>구독상품 및 단품상품 반품 신청 후 반품 완료 시 표기됩니다. </dd>
						</dl>
					</div>
					<div class="box">
						<h4 class="h4-my">환불 절차에 따른 상태값 </h4>
						<dl>
							<dt>환불신청</dt>
							<dd>고객님의 환불신청이 접수되었습니다.</dd>
						</dl>
						<dl>
							<dt>환불처리중</dt>
							<dd>고객님의 환불건을 처리중입니다.</dd>
						</dl>
						<dl>
							<dt>환불완료</dt>
							<dd>고객님께 환불해드렸습니다.</dd>
						</dl>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function(e) {
    $('select[name=bank_code]').on('change', function() {
		$('input[name=bank_name]').val($(this).find('option:selected').text());
	});
});

function fnChangeBank() {
	$('.bank_info').attr('readonly', false);
	$('.bank_info').attr('disabled', false);
	$('#btn_save').show();
}

function fnSaveBank()
{
	var msg = {msg : '환불정보를 수정하시겠습니까?', cancel:'취소', confirm : '수정'};
	showConfirm(msg, 
				function() {
						$.ajax({
							type:'POST',
							url:'/my/order/ajaxChangeBank',
							data : $('#frmBank').serialize(),
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
				});
}

</script>