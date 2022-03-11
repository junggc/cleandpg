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
				<div class="flex center">
					<h3 class="h3"><a href="/my/user/delivery_list" class="link m">배송지 관리<?php echo $delivery_cnt > 1 ? ' (' . $delivery_cnt . ')' : ''; ?></a></h3>	
					<a href="/my/user/delivery_list" class="btn-under blue mobile">관리</a>
				</div>
				
				<!-- pc -->
				<div class="table1 mb90  pc">
					<table>
						<colgroup>
							<col style="width:150px">
							<col style="width:120px">
							<col style="">
							<col style="width:150px">
							<col style="width:100px">
						</colgroup>
						<thead>
							<tr>
								<th>배송지 설명</th>
								<th>받는 분</th>
								<th class="text-left">주소</th>
								<th>연락처</th>
								<th>관리</th>
							</tr>
						</thead>
						<tbody>
                        <?php 
							if(!empty($delivery)) {
						?>
							<tr>
								<td class="delivery_title"><?php echo $delivery['mde_title']; ?></td>
								<td class="delivery_name"><?php echo $delivery['recipient_name']; ?></td>
								<td class="text-left f16 delivery_addr">[<?php echo $delivery['zipcode']; ?>] <?php echo $delivery['road_addr']; ?> <?php echo $delivery['detail_addr']; ?></td>
								<td class="delivery_phone"><?php echo $delivery['recipient_phone']; ?></td>
								<td><a href="#" data-toggle="modal" data-target="#modalBaesong" class="btn-under">수정</a></td>
							</tr>
						<?php
							}
							else {
						?>
							<tr>
								<td colspan="100%">등록된 기본주소가 없습니다.</td>
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
						if(!empty($delivery)) {
					?>
						<li>
							<div href="#" class="item">
								<div class="subj">
									<div>
										<span class="prd delivery_title"><?php echo $delivery['mde_title']; ?></span>
									</div>
								</div>
								<div class="addr delivery_addr">[<?php echo $delivery['zipcode']; ?>] <?php echo $delivery['road_addr']; ?> <?php echo $delivery['detail_addr']; ?></div>
								<div class="info1">
									<dl>
										<dt>받는 분</dt>
										<dd class="delivery_name"><?php echo $delivery['recipient_name']; ?></dd>
									</dl>
									<dl>
										<dt>연락처</dt>
										<dd class="delivery_phone"><?php echo $delivery['recipient_phone']; ?></dd>
									</dl>
								</div>
								<div class="status">
									<dl>
										<dt>관리</dt>
										<dd>
											<a href="#" data-toggle="modal" data-target="#modalBaesong" class="btn-under">수정</a>
										</dd>
									</dl>
								</div>
							</div>
						</li>
					<?php
						}
						else {
							echo '<li style="text-align:center">등록된 기본주소가 없습니다.</li>';	
						}
					?>
						
					</ul>
				</div>
				
				
				<h3 class="h3 f33">회원정보 수정</h3>
				
				<div class="mypage-modify">
                    <?php
						if($info['mem_sns_type'] === 'email') {
					?>
					<dl>
						<dt>아이디</dt>
						<dd><?php echo $info['mem_userid']; ?></dd>
					</dl>
					<dl>
						<dt>비밀번호</dt>
						<dd><a href="#" data-toggle="modal" data-target="#modalPassword"><span class="f16">비밀번호 설정</span></a></dd>
					</dl>
                    <?php
						}
						else if($info['mem_sns_type'] === 'kakao') {
					?>
					<dl>
						<dt>아이디</dt>
						<dd>카카오 회원가입 (<?php echo $info['mem_email']; ?>)</dd>
					</dl>
                    <?php
						}
						else if($info['mem_sns_type'] === 'naver') {
					?>
					<dl>
						<dt>아이디</dt>
						<dd>네이버 회원가입 (<?php echo $info['mem_email']; ?>)</dd>
					</dl>
                    <?php
						}
					?>

					<dl>
						<dt>이름</dt>
						<dd>
							<input type="text" class="inp-line" id="mem_username" value="<?php echo $info['mem_username']; ?>" >
						</dd>
					</dl>
					<dl>
						<dt>이메일</dt>
						<dd><?php echo $info['mem_email']; ?></dd>
					</dl>
					<dl>
						<dt>휴대폰번호</dt>
						<dd>
							<input type="text" class="inp-line" id="mem_phone" value="<?php echo $info['mem_phone']; ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11" > 
                            <a href="#" onclick="javascript:fnSendAuth(); return false;"><span class="f16">인증하기</span></a>
                            <input type="hidden" id="auth" />
						</dd>
					</dl>
                                        <dl>
						<dt>추천치과</dt>
						<dd>
							<input type="text" class="inp-line" id="mem_dentist" value="" >
						</dd>
					</dl>
					<div class="btn-box">
						<button class="btn btn-type2 btn-m" onclick="location.href='/my/home';">취소</button>
						<button class="btn btn-type1 btn-m" onclick="javascript:fnUpdateUser(); ">저장</button>
					</div>
				</div>
				
				<div class="my-benefit">
					<h3 class="h3 mb40">클린디 혜택 알람 받기</h3>
					<label><input type="checkbox" id="is_rcv" class="switch" <?php echo $info['is_rcv_email'] == 'y' || $info['is_rcv_sms'] == 'y' || $info['is_rcv_kakao'] == 'y' ? 'checked' : ''; ?>><span><em></em></span></label>
					<div class="desc">
						<p>- 혜택 알림 받기에  동의하시면 여러가지 할인혜택과 각종 이벤트 정보를 받아보실 수 있습니다.</p>
						<p>- 회원가입관련, 주문배송관련 등의 메일은 수신동의와 상관없이 모든 회원에게 발송됩니다</p>
					</div>
				</div>
				
				
				<h3 class="h3"><a href="/my/user/leave" class="link m">회원탈퇴</a></h3>
			</div>
		</div>
		<!-- // 마이페이지 -->
	</div>
	<!-- // inner -->
    <?php
		if(!empty($delivery)) {
	?>
	<div class="modal fade" role="dialog" aria-labelledby="introHeader" aria-hidden="true" tabindex="-1" id="modalBaesong" data-backdrop="static">
		<div class="modal-dialog" style="max-width:830px; margin-top:100px;">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-msg1">
						<div class="h3 mb30">기본 배송지 수정</div>
						<div class="baesong-form">
							<div class="mypage-modify">
								<dl>
									<dt>설명</dt>
									<dd><input type="text" class="inp1" id="add_title" style="width:60%" value="<?php echo $delivery['mde_title']; ?>"></dd>
								</dl>
								<dl>
									<dt>받는분</dt>
									<dd><input type="text" class="inp1" id="add_recipient" style="width:60%" value="<?php echo $delivery['recipient_name']; ?>"></dd>
								</dl>
								<dl class="hp">
									<dt>휴대폰</dt>
									<dd><input type="text" class="inp1" id="add_phone" style="width:60%" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11"  value="<?php echo $delivery['recipient_phone']; ?>"></dd>
								</dl>
								<dl class="addr">
									<dt>주소</dt>
									<dd>
										<div class="addr-box">
											<div class="inp-box1">
                                            	<input type="text" class="inp1" id="add_zip" readonly  value="<?php echo $delivery['zipcode']; ?>"> 
                                            	<a href="#" onclick="javascript:execDaumPostcode($('#add_zip'), $('#add_road'), $('#add_jibun') ); return false;" class="btn-under ml20">주소찾기</a>
                                            </div>
											<div class="inp-box2">
                                            	<input type="text" class="inp1 block" id="add_road" readonly value="<?php echo $delivery['road_addr']; ?>">
                                            	<input type="hidden" class="inp1 block" id="add_jibun"  value="<?php echo $delivery['jibun_addr']; ?>">
                                            </div>
											<div class="inp-box2"><input type="text" id="add_addr2" class="inp1 block"  value="<?php echo $delivery['detail_addr']; ?>"></div>
										</div>
									</dd>
								</dl>
								<dl>
									<dt>배송요청</dt>
									<dd><input type="text" class="inp1 block" id="add_memo"  value="<?php echo $delivery['memo']; ?>"></dd>
								</dl>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer text-center">
					<button class="btn btn-type2 w280" data-dismiss="modal">취소</button>
					<button class="btn btn-type1 w280" onclick="javascript:fnPopupAddAddr();">확인</button>
				</div>
			</div>
		</div>
	</div>
    <?php
		}
	?>

	<div class="modal fade" role="dialog" aria-labelledby="introHeader" aria-hidden="true" tabindex="-1" id="modalPassword" data-backdrop="static">
		<div class="modal-dialog" style="max-width:830px; margin-top:100px;">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-msg1">
						<div class="h3 mb30">비밀번호변경</div>
						<div class="baesong-form">
							<div class="mypage-modify">
                            <form id="frmPassword">
								<dl>
									<dt style="flex: 0 0 120px">기존비밀번호</dt>
									<dd><input type="password" class="inp1" name="mem_password" value="" style="width:90%"></dd>
								</dl>
								<dl>
									<dt style="flex: 0 0 120px">신규비밀번호</dt>
									<dd><input type="password" class="inp1" name="new_password" value="" style="width:90%"></dd>
								</dl>
								<dl>
									<dt style="flex: 0 0 120px">비밀번호확인</dt>
									<dd><input type="password" class="inp1" name="password_confirm" value="" style="width:90%"></dd>
								</dl>
                            </form>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer text-center">
					<button class="btn btn-type2 w280" data-dismiss="modal">취소</button>
					<button class="btn btn-type1 w280" onclick="javascript:fnChangePassword();">확인</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" role="dialog" aria-labelledby="introHeader" aria-hidden="true" tabindex="-1" id="modalAuth" data-backdrop="static">
		<div class="modal-dialog" style="max-width:830px; margin-top:100px;">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-msg1">
						<div class="h3 mb30">핸드폰 인증</div>
						<div class="baesong-form">
							<div class="member-wrap" style="padding:0; border:none">
                                <div class="inp-box1">
                                    <input a="mem_phone" type="tel" class="inp1" id="popup_mem_phone" placeholder="휴대폰 번호" style="width:100%" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11" />
                                    <div class="btn-box">
                                        <button class="btn-auth" id="auth_btn1" onclick="javascript:fnSendAuth(); return false;">인증</button>
                                    </div>
                                </div>
                                <div class="certify" id="sms_auth_wrap" style="display:none">
                                    <div a="auth_msg" class="count">
                                        <div>인증번호가 문자 메시지로 발송되었습니다.</div>
                                        <p id="auth_timer">3:00</p>
                                    </div>
                                    <div class="inp-box-certify">
                                        <input a="auth_number" type="tel" class="inp1" id="popup_auth_number"  oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="6" />
                                        <em a="auth_number" class="chk"></em>
                                        <button class="btn-auth" id="auth_btn2" onclick="javascript:fnCheckAuth(); return false;"><span>인증번호 확인</span></button>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer text-center">
					<button class="btn btn-type2 w280" onclick="javascript:fnCloseAuth();">취소</button>
					<button class="btn btn-type1 w280" onclick="javascript:fnSetAuth();">확인</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="modalBenefitPush">
		<div class="modal-dialog" style="max-width:830px">
			<div class="modal-content">
				<div class="modal-body">
					<div class="modal-msg1">
						<div class="h3 mb30">클린디 혜택 알림</div>
						<div class="benefit-push">
							<div class="text-right">
								<label><input type="checkbox" class="checkbox" checked><em></em><span>전체선택</span></label>
							</div>
							
							<hr>
							
							<h4 class="h4-my blue">클린디 서비스 알림</h4>
							<div class="txt">교체시기 알람, 맞춤 진단 등의 혜택 알림을 받으실 수 있습니다. </div>
							<div class="chks">
								<label><input type="checkbox" class="checkbox" checked><em></em><span>카카오톡</span></label>
								<label><input type="checkbox" class="checkbox" checked><em></em><span>문자메시지</span></label>
								<label><input type="checkbox" class="checkbox" checked><em></em><span>이메일</span></label>
							</div>
							<hr>
							
							<h4 class="h4-my blue">클린디 홍보 알림</h4>
							<div class="txt">신상품 소개, 이벤트 등의 알림을 받으실 수 있습니다.  </div>
							<div class="chks">
								<label><input type="checkbox" class="checkbox" checked><em></em><span>카카오톡</span></label>
								<label><input type="checkbox" class="checkbox" checked><em></em><span>문자메시지</span></label>
								<label><input type="checkbox" class="checkbox" checked><em></em><span>이메일</span></label>
							</div>
							
							<hr>
							
						</div>
					</div>
				</div>
				<div class="modal-footer text-center">
					<button class="btn btn-type1 w280" data-dismiss="modal">확인</button>
				</div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function(e) {
	$('#mem_phone').on('keypress', function() {
		$('#auth').val('');
	});
	
	$('#is_rcv').on('click', function() {
		var val = $(this).is(':checked') ? 'y' : 'n';
		$.ajax({
			url: "/my/user/ajaxUpdateRcv",
			type: 'POST',
			dataType : 'json',
			async: true,
			data: {is_rcv : val},
			success: function(data, textStatus, jqXHR){
				if(data.status == 'login') {
					showAlert('error', data.msg, function() {location.href="/member/login";});
				}
				else if(data.status == 'fail') {
					showAlert('error', data.msg, function() { $('#is_rcv').prop('checked', val== 'n' ? true : false); });
				}
				else {
					if(data.msg == 'y') $('#is_rcv').attr('checked', true);
					else $('#is_rcv').attr('checked', false);
				}
			},
			error: function(request,status,error){
				alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
			}
		});
	});
});

var timer1 = null;
function fnSendAuth() {
	$('#popup_mem_phone').val($('#mem_phone').val());
	$('#modalAuth').modal('show');
	clearInterval(timer1);
	cnt = 180;

	$.ajax({
		url: "/common/ajaxSendAuth2",
		type: 'POST',
		dataType : 'json',
		async: true,
		data: {'mem_phone' : $('#popup_mem_phone').val()},
		success: function(res, textStatus, jqXHR){
			if(res.status == 'succ') {
				$('#sms_auth_wrap').show();
				$('#auth_timer').show();
				$('#popup_auth_number').attr('readonly', false);
				$('#auth_btn1').html('다시요청');
				timer1 = setInterval(function() { //실행할 스크립트 
					cnt--;

					var div = parseInt(cnt / 60);
					var mod = cnt % 60;

					$('#auth_timer').html(div + ':' + (mod < 10 ? '0' : '') + mod);
					if(cnt <= 0) {
						clearInterval(timer1);	
					}
				}, 1000);
			}
			else {
				showAlert('error', res.msg);	
			}
		},
		error: function(request,status,error){
				alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
		}
	});

	$('em[a="auth_number"]').removeClass('active');
}

function fnCheckAuth() {
	$.ajax({
		url: "/common/ajaxCheckAuth",
		type: 'POST',
		dataType : 'json',
		async: true,
		data: {'mem_phone' : $('#popup_mem_phone').val(),
				'auth_number' : $('#popup_auth_number').val() },
		success: function(res, textStatus, jqXHR){
			if(res.status == 'succ') {
				$('#auth').val($('#popup_mem_phone').val());
				clearInterval(timer1);	
				$('#auth_timer').hide();
				$('#popup_auth_number').attr('readonly', true);
				showAlert('success', res.msg);	
			}
			else {
				showAlert('error', res.msg);	
			}
		},
		error: function(request,status,error){
				alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
		}
	});
}
	
function fnCloseAuth() {
	clearInterval(timer1);
	$('#auth').val('');
	$('#modalAuth').modal('hide');
}

function fnSetAuth() {
	if($('#auth').val() == '') {
		showAlert('error', '인증번호를 입력해 주세요.');
		return;	
	}
	clearInterval(timer1);
	$('#modalAuth').modal('hide');
}

function fnShowPassword()
{
	$('#modalPassword').modal('show');
	$('input[name=mem_password]').val('');
	$('input[name=new_password]').val('');
	$('input[name=password_confirm]').val('');	
}

function fnPopupAddAddr()
{
	var param = { mde_id : '<?php echo $delivery['mde_id']; ?>',
				mde_title : $('#add_title').val(),
				recipient_name : $('#add_recipient').val(),
				recipient_phone : $('#add_phone').val(),
				zipcode : $('#add_zip').val(),
				road_addr : $('#add_road').val(),
				jibun_addr : $('#add_jibun').val(),
				detail_addr : $('#add_addr2').val(),
				memo : $('#add_memo').val() };
				
	$.ajax({
		type:'POST',
		url:'/cart/ajaxUpdateAddress',
		data : param,
		dataType:"json",
		success:function(data){
			if(data.status == 'succ') {
				$('#modalBaesong').modal('hide');
				$('.delivery_title').html($('#add_title').val());
				$('.delivery_name').html($('#add_recipient').val());
				$('.delivery_phone').html($('#add_phone').val());
				$('.delivery_addr').html('[' + $('#add_zip').val() + '] ' + $('#add_road').val() + ' ' + $('#add_addr2').val());
			}
			else if(res.status == 'login') {
				showAlert('error', res.msg, function() {location.href="/member/login";});
			}
			else {
				showAlert('error', data.msg);
			}
		},
		error:function(data){
			alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
		}
   });
}

function fnChangePassword()
{
	$.ajax({
		type:'POST',
		url:'/my/user/ajaxChangePassword',
		data : $('#frmPassword').serialize(),
		dataType:"json",
		success:function(data){
			if(data.status == 'succ') {
				showAlert('success', data.msg, function() {location.href='/my/user';});
			}
			else if(data.status == 'login') {
				showAlert('error', data.msg, function() {location.href="/member/login";});
			}
			else {
				showAlert('error', data.msg);
			}
		},
		error:function(data){
			alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
		}
   });
}

function fnUpdateUser()
{
	var msg = {msg : '회원정보를 수정 하시겠습니까?', cancel:'닫기', confirm : '수정'};
	showConfirm(msg, function() {
									$.ajax({
										type:'POST',
										url:'/my/user/ajaxUpdateUser',
										data : {mem_username : $('#mem_username').val(),
												mem_phone : $('#mem_phone').val(),
												auth : $('#auth').val() },
										dataType:"json",
										success:function(data){
											if(data.status == 'succ') {
												showAlert('success', data.msg, function() {location.reload();});
											}
											else if(data.status == 'login') {
												showAlert('error', data.msg, function() {location.href="/member/login";});
											}
											else {
												showAlert('error', data.msg);
											}
										},
										error:function(data){
											alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
										}
								   });
				});
}
</script>