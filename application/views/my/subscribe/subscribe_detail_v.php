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

                    <h3 class="h3"><a href="/my/subscribe/subscribe_order_list?seq=<?php echo $info['csu_id']; ?>" class="link m">구독내역</a>
                    	<span id="csu_title_wrap">
                        	<span><?php echo $info['csu_title']; ?></span>
                            <input type="text" id="csu_title" value="<?php echo $info['csu_title']; ?>" style="display:none" />
                            <button class="btn-under" onclick="javascript:fnShowChangeTitle();">구독명 수정</button>
                        </span>
                    </h3>
                    
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
                                if(!empty($info['order'])) {
                                    foreach($info['order'] as $order) {
                            ?>
                                <tr>
                                    <td><?php echo $order['ins_dtm']; ?></td>
                                    <td class="f20">구독상품</td>
                                    <td class="f15"><?php echo $order['order_id']; ?></td>
                                    <td class="f22"><a href="/my/subscribe/order_detail?seq=<?php echo $order['order_id']; ?>"><strong><?php echo $order['product_name']; ?></strong></a></td>
                                    <td class="f20"><?php echo number_format($order['total_price']); ?>원</td>
                                    <td class="f20"><?php echo $order['status_name']; ?></td>
                                    <td><?php echo $order['delivery_start_dtm']; ?></td>
                                </tr>
                            <?php
                                    }
                                }
                                else {
                                    echo '<tr><td colspan="100%">구독 이력이 없습니다.</td></tr>';
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- mobile -->
                    <div class="m-table1 mobile mb80">
                        <ul>
                            <?php
                                if(!empty($info['order'])) {
                                    foreach($info['order'] as $order) {
                            ?>
                            <li>
                                <a href="/my/subscribe/order_detail?seq=<?php echo $order['order_id']; ?>" class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $order['product_name']; ?></strong>
                                            <span class="prd">구독상품</span>
                                        </div>
                                        <div class="price"><?php echo number_format($order['total_price']); ?>원</div>
                                    </div>
                                    <div class="date"><?php echo $order['ins_dtm']; ?></div>
                                    <div class="deli">
                                        <span><?php echo $order['status_name']; ?></span>
                                        <span><?php echo $order['delivery_start_dtm']; ?></span>
                                    </div>
                                </a>
                            </li>
                            <?php
                                    }
                                }
                                else {
                                    echo '<li>구독 이력이 없습니다.</li>';
                                }
                            ?>
                        </ul>
                    </div>
    
                    <h3 class="h3">구독상품</h3>
                    <div class="table1 mb90 pc">
                        <table>
                            <thead>
                                <tr>
                                    <th>번호</th>
                                    <th>상품명</th>
                                    <th>옵션</th>
                                    <th>수량</th>
                                    <th>금액</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
								$idx = 1;
                                foreach($info['list'] as $row) {
                            ?>
                                <tr>
                                    <td><?php echo $idx; ?></td>
                                    <td class="f22"><?php echo $row['cit_name']; ?></td>
                                    <td class="f22"><?php echo $row['cde_title']; ?></td>
                                    <td class="f22"><?php echo $row['qty']; ?></td>
                                    <td class="f22"><?php echo number_format($row['cit_subscribe_price']); ?></td>
                                </tr>
	                        <?php
									$idx++;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- mobile -->
                    <div class="m-table1 mobile mb80">
                        <ul>
                            <?php
                                foreach($info['list'] as $row) {
                            ?>
                            <li>
                                <div class="item">
                                    <div class="subj">
                                        <div>
                                            <strong class="name"><?php echo $row['cit_name']; ?></strong>
                                        </div>
                                    </div>
                                    <div class="date"><?php echo $row['cde_title']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt><?php echo number_format($row['cit_subscribe_price']); ?>&nbsp;&nbsp;&nbsp; <?php echo $row['qty']; ?></dt>
                                        </dl>
                                    </div>
                                </div>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                    </div>

                    <h3 class="h3">구독 일정관리</h3>
                    <div class="subscription-schedule">
                        <div class="box box1">
                            <div class="schedule2">
                                <div class="sch-box">
                                    <div class="tit1">결제 일정</div>	
                                    <div class="box">
                                        <div class="sort">
                                            <div class="mb15"><label><input type="radio" class="radio-schedule" name="ra2" value="now"><span>즉시 당겨받기</span></label></div>
                                            <div class="mb15"><label><input type="radio" class="radio-schedule" name="ra2" value="2"><span>2주 뒤로 미루기</span></label></div>
                                            <div class="mb15"><label><input type="radio" class="radio-schedule" name="ra2" value="4"><span>4주 뒤로 미루기</span></label></div>
                                            <div class=""><label><input type="radio" class="radio-schedule" name="ra2" value="set"><span>날짜 선택하기</span></label></div>
                                        </div>
                                        <div class="circle">
                                            <div class="t1">이번 결제일</div>
                                            <div class="date" id="now_date">
                                            <?php
												if(!empty($info['new_date'])) {
													$pay = strtotime($info['new_date']);
												}
												else if(empty($info['last_date'])) {
													$pay = strtotime($info['start_date']);
												}
												else {
													$pay = strtotime('+' . ($info['delivery_period'] * 7) . ' days', strtotime($info['last_date']));
												}
												$next = strtotime('+' . ($info['delivery_period'] * 7) . ' days', $pay);
												echo date('n월 j일', $pay);										
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="sch-box">
                                    <div class="tit1">결제 주기</div>	
                                    <div class="box">
                                        <div class="sort">
                                            <div class="mb15">
                                            	<label>
                                                	<input type="radio" class="radio-schedule" name="ra3" value="4" <?php echo $info['delivery_period'] == '4' ? 'checked' : ''; ?>>
                                                    <span>4주 마다</span>
                                                </label>
                                            </div>
                                            <div class="mb15">
                                            	<label>
                                                	<input type="radio" class="radio-schedule" name="ra3" value="12" <?php echo $info['delivery_period'] == '12' ? 'checked' : ''; ?>>
                                                    <span>12주 마다</span>
                                                </label>
                                            </div>
                                            <div class="">
                                            	<label>
                                                	<input type="radio" class="radio-schedule" name="ra3" value="16" <?php echo $info['delivery_period'] == '16' ? 'checked' : ''; ?>>
                                                    <span>16주 마다</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="circle">
                                            <div class="t1">다음 결제일</div>
                                            <div class="date bg-blue" id="next_date"><?php echo date('n월 j일', $next);	?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center sch-btns">
                            <div class="mb20">
								<input type="hidden" id="org_date" value="<?php echo date('Y-m-d', $pay); ?>" />
                                <input type="hidden" id="new_date" value="" />
								<input type="hidden" id="org_period" value="<?php echo $info['delivery_period']; ?>" />
                                <input type="hidden" id="new_period" value="" />
                                <button class="btn btn-type1 btn-m" id="btnSave">변경하기</button>
                            </div>
                            <a href="#" class="btn-under" onclick="javascript:$('#modalSubscribe').modal('show'); return false;">구독해지</a>
                        </div>
                    </div>
                    
                    <h3 class="h3">배송지 관리</h3>	
                    <!-- pc -->
                    <div class="table1 mb90  pc">
                        <table>
                            <colgroup>
                                <col style="width:120px">
                                <col style="">
                                <col style="width:150px">
                                <col style="width:100px">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>받는 분</th>
                                    <th class="text-left">주소</th>
                                    <th>연락처</th>
                                    <th>관리</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="delivery_name"><?php echo $info['recipient_name']; ?></td>
                                    <td class="text-left f16 delivery_addr">[<?php echo $info['recipient_zip']; ?>] <?php echo $info['recipient_addr1']; ?> <?php echo $info['recipient_addr2']; ?></td>
                                    <td class="delivery_phone"><?php echo $info['recipient_phone']; ?></td>
                                    <td><a href="#" onclick="javascript:fnShowSubscribeAddr(); return false;" class="btn-under">수정</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
    
                    <!-- mobile -->
                    <div class="m-table1 mobile border-bottom-none mb80">
                        <ul>
                            <li>
                                <div href="#" class="item">
                                    <div class="addr delivery_addr">[<?php echo $info['recipient_zip']; ?>] <?php echo $info['recipient_addr1']; ?> <?php echo $info['recipient_addr2']; ?></div>
                                    <div class="info1">
                                        <dl>
                                            <dt>받는 분</dt>
                                            <dd class="delivery_name"><?php echo $info['recipient_name']; ?></dd>
                                        </dl>
                                        <dl>
                                            <dt>연락처</dt>
                                            <dd class="delivery_phone"><?php echo $info['recipient_phone']; ?></dd>
                                        </dl>
                                    </div>
                                    <div class="status">
                                        <dl>
                                            <dt>관리</dt>
                                            <dd>
                                                <a href="#" onclick="javascript:fnShowSubscribeAddr(); return false;" class="btn-under">수정</a>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </li>
                            
                            
                        </ul>
                    </div>
                    
                    <h3 class="h3">결제 정보</h3>
                    <div class="payment-kind" style="max-width:750px;">
                        <h4 class="h4-my flex center">
                            <div><?php echo $info['card_code_name'] . '/ ' . $info['card_num']; ?></div>
                            <div><a href="#" onclick="javascript:fnPaymentRequest(); return false;">결제수단 변경</a></div>
                        </h4>
                    </div>
                    
			</div>	
		</div>
		<!-- // 마이페이지 -->
	</div>
	<!-- // inner -->
                    
	<div class="modal fade" role="dialog" aria-labelledby="introHeader" aria-hidden="true" tabindex="-1" id="modalBaesong" data-backdrop="static">
		<div class="modal-dialog" style="max-width:830px; margin-top:100px;">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-msg1">
						<div class="h3 mb30">배송지 수정</div>
						<div class="baesong-form">
							<div class="mypage-modify">
								<dl>
									<dt>받는분</dt>
									<dd><input type="text" class="inp1" id="add_recipient" style="width:60%" value="<?php echo $info['recipient_name']; ?>"></dd>
								</dl>
								<dl class="hp">
									<dt>휴대폰</dt>
									<dd><input type="text" class="inp1" id="add_phone" style="width:60%" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11"  value="<?php echo $info['recipient_phone']; ?>"></dd>
								</dl>
								<dl class="addr">
									<dt>주소</dt>
									<dd>
										<div class="addr-box">
											<div class="inp-box1">
                                            	<input type="text" class="inp1" id="add_zip" readonly  value="<?php echo $info['recipient_zip']; ?>"> 
                                            	<a href="#" onclick="javascript:execDaumPostcode($('#add_zip'), $('#add_road'), $('#add_jibun') ); return false;" class="btn-under ml20">주소찾기</a>
                                            </div>
											<div class="inp-box2">
                                            	<input type="text" class="inp1 block" id="add_road" readonly value="<?php echo $info['recipient_addr1']; ?>">
                                            	<input type="hidden" class="inp1 block" id="add_jibun"  value="">
                                            </div>
											<div class="inp-box2"><input type="text" id="add_addr2" class="inp1 block"  value="<?php echo $info['recipient_addr2']; ?>"></div>
										</div>
									</dd>
								</dl>
								<dl>
									<dt>배송요청</dt>
									<dd><input type="text" class="inp1 block" id="add_memo"  value="<?php echo $info['recipient_memo']; ?>"></dd>
								</dl>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer text-center">
					<button class="btn btn-type2 w280" data-dismiss="modal">취소</button>
					<button class="btn btn-type1 w280" onclick="javascript:fnUpdateSubscribeAddr();">확인</button>
				</div>
			</div>
		</div>
	</div>
<style>
#csu_title_wrap {
	font-size:24px;
	display:inline-block;
	margin-left:20px;
}
#csu_title_wrap input {
	border:none;
	border-bottom:1px solid #333;
	font-size:24px;
	padding:0 5px;
	width:auto;
	letter-spacing: -1px;
}
#csu_title_wrap button{
	font-size:18px;
	display:inline-block;
	margin-left:10px;
	vertical-align:bottom;
}
@media (max-width: 1023px) {
	#csu_title_wrap { font-size:16px; margin-left:0; display:block; margin-top:15px; }
	#csu_title_wrap input {
		font-size:16px;
	}
	#csu_title_wrap button{
		font-size:14px;
	}
}

</style>
<?php $this->load->view('common/calPopup'); ?>
<?php // $this->load->view('common/nowPopup'); ?>
<?php $this->load->view('common/cancelPopup'); ?>
<form id="SendPayForm_web" name="" method="POST">
	<!-- 필수 -->
	<input type="hidden"  name="version" value="1.0" >
	<input type="hidden"  name="mid" value="" >
    <input type="hidden"  name="goodname" value="" >
	<input type="hidden"  name="oid" value="" >
	<input type="hidden"  name="price" value="" >
	<input type="hidden"  name="currency" value="WON" >
	<input type="hidden"  name="buyername" value="" >
	<input type="hidden"  name="buyertel" value="" >
    <input type="hidden"  name="buyeremail" value="" >
    <input type="hidden"  name="timestamp" value="" >
	<input type="hidden"  name="signature" value="" >
 	<input type="hidden"  name="returnUrl" value="<?php echo $base_url . RETURN_URL2 ?>" >
    <input type="hidden"  name="mKey" value="" >
    <!-- 기본 옵션 -->
	<input type="hidden" name="gopaymethod" value="card" >
    <input type="hidden" name="acceptmethod" value="billauth(card)" >
	<input type="hidden" name="payViewType" value="overlay" >
	<input type="hidden" name="offerPeriod" value="<?php echo date('Ymd') . date('Ymd', strtotime('+1 year')); ?>" />
	<input type="hidden" name="nointerest" value="" >
	<input type="hidden" name="quotabase" value="" >
	<input type="hidden" name="merchantData" value="" >
</form>

<form id="SendPayForm_mobile_bill" method="post" accept-charset="UTF-8" action="https://inilite.inicis.com/inibill/inibill_card.jsp"> 
<!-- 리턴받는 가맹점 URL 세팅 -->
	<input type="hidden" name="mid" value="<?php echo MID0; ?>"> 
	<input type="hidden" name="authtype" value="D"> 
 <!-- 지불수단 선택 (신용카드,계좌이체,가상계좌,휴대폰) -->
	<input type="hidden" name="orderid" value=""> 
<!-- 복합/옵션 파라미터 -->
	<input type="hidden" name="price" value="">
	<input type="hidden" name="goodname" value="">
	<input type="hidden" name="buyername" value="">  
	<input type="hidden" name="buyeremail" value=""> 
	<input type="hidden" name="buyertel" value=""> 
	<input type="hidden" name="returnurl" value="<?php echo $base_url . '/payment/change_result_mo';?>"> 
    <input type="hidden" name="timestamp" value="">  
	<input type="hidden" name="period" value="">  
    <input type="hidden" name="period_custom" value="" >
    <input type="hidden" name="carduse" value="" >
    <input type="hidden" name="merchantreserved" value="" >
    <input type="hidden" name="hashdata" value="" >
</form> 

<form id="frmPay" method="post"> 
<!-- 리턴받는 가맹점 URL 세팅 -->
	<input type="hidden" name="pay_type" value="card"> 
	<input type="hidden" name="cart_type" value="subscribe"> 
	<input type="hidden" name="total_price" value="<?php echo $info['total_price']; ?>">
	<input type="hidden" name="total_qty" value="<?php echo $info['total_qty']; ?>">
	<input type="hidden" name="device_type" value="">
	<input type="hidden" name="mem_phone" value="<?php echo $user['mem_phone']; ?>" >
	<input type="hidden" name="mem_name" value="<?php echo $user['mem_username']; ?>">
    <input type="hidden" name="mem_email" value="<?php echo $user['mem_email']; ?>" >
    <input type="hidden" name="mem_id" value="<?php echo $user['mem_id']; ?>" >
    <input type="hidden" name="csu_id" value="<?php echo $info['csu_id']; ?>" />
    <input type="hidden" name="csu_title" value="<?php echo $info['csu_title']; ?>" />
</form> 
<script language="javascript" type="text/javascript" src="https://stdpay.inicis.com/stdjs/INIStdPay.js" charset="UTF-8"></script>
<script>
var old_val = '';
$(document).ready(function(e) {
    $('input[name=ra2]').on('click', function() {
		if($(this).val() == 'set') {
			if($('#new_date').val() == '') fnPopupShowDay($('#org_date').val());
			else fnPopupShowDay($('#new_date').val());
			old_val = $(this).val();
		}
		else if($(this).val() == 'now') {
			var day = '<?php echo date('Y년 n월 j일', $pay); ?>';
			var date = new Date();
			date.setDate(date.getDate() + 1);
			var yy = date.getFullYear();
			var mm = date.getMonth() + 1;
			var dd = date.getDate();
			var now = yy + '년 ' + mm + '월 ' + dd + '일';
			if(day == now) {
				if(typeof(old_val) != 'undefined') {
					$('input[name=ra2]').prop('checked', false);
					$('input[name=ra2]').each(function(index, element) {
						if($(this).val() == old_val) $(this).prop('checked', true);
					});
				}
				showAlert('error', '가장 최근 날짜 입니다. 더이상 당길 수 없습니다.');
				return;	
			}

			var param = {msg : '즉시 당겨받기', msg2 : day + '날 받으시는 <?php echo $info['csu_title']; ?>을(를) <br>즉시 당겨 받으시겠습니까?  <br> <span style="color:red; font-weight:bold">결제 금액 <?php echo number_format($info['total_price']); ?>원은 익일 ' + now + ' 오후 3시 결제됩니다</span>', cancel : '취소하기', confirm : '당겨받기' };
			showConfirm(param, fnSetNow, fnSetNowCancel);
		}
		else {
			old_val = $(this).val();
			var date = new Date($('#org_date').val());
			date.setDate(date.getDate() + ($(this).val() * 7));
			var yy = date.getFullYear();
			var mm = date.getMonth() + 1;
			var dd = date.getDate();
			$('#new_date').val(yy + '-' + (mm < 10 ? '0' : '') + mm + '-' + (dd < 10 ? '0' : '') + dd);
			$('#now_date').html(mm + '월 ' + dd + '일');

			var period = $('#new_period').val() == '' ? $('#org_period').val() : $('#new_period').val();
			date.setDate(dd + (7 * period));
			yy = date.getFullYear();
			mm = date.getMonth() + 1;
			dd = date.getDate();
			$('#next_date').html(mm + '월 ' + dd + '일');
		}
	});

    $('input[name=ra3]').on('click', function() {
		var period = $(this).val();
		$('#new_period').val(period);
		var day = $('#new_date').val() == '' ? $('#org_date').val() : $('#new_date').val()

		var date = new Date(day);
		date.setDate(date.getDate() + (7 * period));
		yy = date.getFullYear();
		mm = date.getMonth() + 1;
		dd = date.getDate();
		$('#next_date').html(mm + '월 ' + dd + '일');
	});
	
	$('#btnSave').on('click', function() {
		var msg = {msg : '변경내역을 저장하시겠습니까?', cancel : '취소', confirm : '변경하기' };
		showConfirm(msg, 
					function() {
									$.ajax({
										url: "/my/subscribe/ajaxUpdateSubscribe",
										type: 'POST',
										dataType:"json",
										data: {csu_id : '<?php echo $info['csu_id']; ?>'
												, org_date : $('#org_date').val()
												, new_date : $('#new_date').val()
												, org_period : $('#org_period').val()
												, new_period : $('#new_period').val() },
										success: function(data, textStatus, jqXHR){
											if(data.status == 'login') {
												showAlert('error', data.msg, function() {location.href="/member/login";});
											}
											else if(data.status == 'fail') {
												showAlert('error', data.msg);
											}
											else {
												showAlert('success', data.msg, function() { location.reload(); });
											}
										},
										error: function(request,status,error){
											alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
										}
									});
					});
	
	});
});

function fnSetNow() {
	var date = new Date();
	date.setDate(date.getDate() + 1);
	var yy = date.getFullYear();
	var mm = date.getMonth() + 1;
	var dd = date.getDate();
	$('#new_date').val(yy + '-' + (mm < 10 ? '0' : '') + mm + '-' + (dd < 10 ? '0' : '') + dd);
	$('#now_date').html(mm + '월 ' + dd + '일');

	var period = $('#new_period').val() == '' ? $('#org_period').val() : $('#new_period').val();
	date.setDate(dd + (7 * period));
	yy = date.getFullYear();
	mm = date.getMonth() + 1;
	dd = date.getDate();
	$('#next_date').html(mm + '월 ' + dd + '일');
	
	$('#modalNow').modal('hide');
	if(typeof(old_val) != 'undefined') {
		old_val = 'now';
	}
}

function fnSetNowCancel() {
	if(typeof(old_val) != 'undefined') {
		$('input[name=ra2]').prop('checked', false);
		$('input[name=ra2]').each(function(index, element) {
			if($(this).val() == old_val) $(this).prop('checked', true);
		});
	}
	$('#modalNow').modal('hide');
}

function fnCancelSubscribe() {
	$.ajax({
			url: "/my/subscribe/ajaxCancelSubscribe",
			type: 'POST',
			dataType:"json",
			data: {csu_id : '<?php echo $info['csu_id']; ?>' },
			success: function(data, textStatus, jqXHR){
				if(data.status == 'login') {
					showAlert('error', data.msg, function() {location.href="/member/login";});
				}
				else if(data.status == 'fail') {
					showAlert('error', data.msg);
				}
				else {
					showAlert('success', data.msg, function() { location.href = '/my/subscribe/subscribe_list'; });
				}
			},
			error: function(request,status,error){
				alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
			}
	});
}

function fnPaymentRequest() {
	$('input[name=device_type]').val((isMobile() ? 'MO' : 'PC'));
	$.ajax({
       	type:'POST',
    	url:'/payment/change_request',
		data : $('#frmPay').serialize(),
		dataType:"json",
       	success:function(data){
			if(data.status == 'succ') {
				$('#SendPayForm_web input[name=mid]').val(data.data.mid);
				$('#SendPayForm_web input[name=goodname]').val(data.data.goodname);
				$('#SendPayForm_web input[name=oid]').val(data.data.oid);
				$('#SendPayForm_web input[name=price]').val(data.data.price);
				$('#SendPayForm_web input[name=buyername]').val(data.data.buyername);
				$('#SendPayForm_web input[name=buyertel]').val(data.data.buyertel);
				$('#SendPayForm_web input[name=buyeremail]').val(data.data.buyeremail);
				$('#SendPayForm_web input[name=timestamp]').val(data.data.timestamp);
				$('#SendPayForm_web input[name=signature]').val(data.data.signature);
				$('#SendPayForm_web input[name=mKey]').val(data.data.mKey);
				$('#SendPayForm_web input[name=gopaymethod]').val(data.data.gopaymethod);
				$('#SendPayForm_web input[name=acceptmethod]').val(data.data.acceptmethod);
				$('#SendPayForm_web input[name=merchantData]').val(data.data.merchantData);
				
				$('#SendPayForm_mobile_bill input[name=mid]').val(data.data.mid);
				$('#SendPayForm_mobile_bill input[name=orderid]').val(data.data.oid);
				$('#SendPayForm_mobile_bill input[name=price]').val(data.data.price);
				$('#SendPayForm_mobile_bill input[name=goodname]').val(data.data.goodname);
				$('#SendPayForm_mobile_bill input[name=buyername]').val(data.data.buyername);
				$('#SendPayForm_mobile_bill input[name=buyertel]').val(data.data.buyertel);
				$('#SendPayForm_mobile_bill input[name=buyeremail]').val(data.data.buyeremail);
				$('#SendPayForm_mobile_bill input[name=timestamp]').val(data.data.timestamp2);
				$('#SendPayForm_mobile_bill input[name=merchantreserved]').val(data.data.merchantData);
				$('#SendPayForm_mobile_bill input[name=hashdata]').val(data.data.hashdata);
				if(isMobile()) {
					$('#SendPayForm_mobile_bill').submit();
				}
				else {
					INIStdPay.pay('SendPayForm_web');
				}
			}
			else {
				showAlert('error', data.msg);	
				$('input[name=' + data.target + ']').focus();
			}
       	},
        error:function(data){
         	alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
        }
   });
}

function fnShowSubscribeAddr() {
	$('#add_recipient').val('<?php echo $info['recipient_name']; ?>');	
	$('#add_phone').val('<?php echo $info['recipient_phone']; ?>');	
	$('#add_zip').val('<?php echo $info['recipient_zip']; ?>');	
	$('#add_road').val('<?php echo $info['recipient_addr1']; ?>');	
	$('#add_addr2').val('<?php echo $info['recipient_addr2']; ?>');	
	$('#modalBaesong').modal('show');
}

function fnUpdateSubscribeAddr() {
	$.ajax({
			url: "/my/subscribe/ajaxUpdateSubscribeAddr",
			type: 'POST',
			dataType:"json",
			data: {csu_id : '<?php echo $info['csu_id']; ?>',
					recipient_name : $('#add_recipient').val(),
					recipient_phone : $('#add_phone').val(),
					recipient_zip : $('#add_zip').val(),
					recipient_addr1 : $('#add_road').val(),
					recipient_addr2 : $('#add_addr2').val(),
					recipient_memo : $('#add_memo').val() },
			success: function(data, textStatus, jqXHR){
				if(data.status == 'login') {
					showAlert('error', data.msg, function() {location.href="/member/login";});
				}
				else if(data.status == 'fail') {
					showAlert('error', data.msg);
				}
				else {
					$('#modalBaesong').modal('hide');
					location.reload();
				}
			},
			error: function(request,status,error){
				alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
			}
	});
}

function fnShowChangeTitle() {
	if($('#csu_title_wrap > span').css('display') == 'none') {
		$.ajax({
				url: "/my/subscribe/ajaxUpdateSubscribeTitle",
				type: 'POST',
				dataType:"json",
				data: {csu_id : '<?php echo $info['csu_id']; ?>',
						csu_title : $('#csu_title').val() },
				success: function(data, textStatus, jqXHR){
					if(data.status == 'login') {
						showAlert('error', data.msg, function() {location.href="/member/login";});
					}
					else if(data.status == 'fail') {
						showAlert('error', data.msg);
					}
					else {
						$('#csu_title_wrap > span').show();
						$('#csu_title_wrap > input').hide();
						$('#csu_title_wrap > span').html($('#csu_title_wrap > input').val());
					}
				},
				error: function(request,status,error){
					alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
				}
		});
	}
	else {
		var width = $('#csu_title_wrap > span').width();
		$('#csu_title_wrap > input').css('width', width + 30 + 'px');
		$('#csu_title_wrap > span').hide();
		$('#csu_title_wrap > input').show();
	}
}
</script>