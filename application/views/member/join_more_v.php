<div class="member-wrap">
	<h3 class="h3">필수 정보 입력</h3>
	<div class="inner-member">
		<div class="signup" style="display: block">
			<div class="inp-box1 mb10">
				<input a="mem_phone" type="tel" class="inp1" name="mem_phone" placeholder="휴대폰 번호" style="width:100%" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11" />
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
					<input a="auth_number" type="tel" class="inp1" name="auth_number"  oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="6" />
					<em a="auth_number" class="chk"></em>
					<button class="btn-auth" id="auth_btn2" onclick="javascript:fnCheckAuth(); return false;"><span>인증번호 확인</span></button>
				</div>
			</div>
			<div class="inp-box1 mb10">
				<input a="mem_username" type="text" class="inp1" placeholder="이름" style="width:100%" value="<?php echo $this->session->userdata('user')['mem_username']; ?>">
			</div>
			<div class="inp-box1 mb10">
				<input a="mem_email" type="email" class="inp1" placeholder="이메일주소" style="width:100%" value="<?php echo $this->session->userdata('user')['mem_email']; ?>">
				<em a="mem_email" class="chk active"></em>
			</div>			
			<div a="mem_email" class="alert-msg1" style="display: none">이메일 형식이 올바르지 않습니다.</div>	
			<div class="agree-wrap">
				<div class="mb20">
					<label class="label-checkbox">
						<input type="checkbox" class="checkbox" id="AllCheck">
						<em></em><span><strong>전체 동의, 선택 항목도 포함합니다.</strong></span></label>
				</div>
				<div class="in">
					<div class="mb20">
						<label class="label-checkbox">
							<input a="terms1" type="checkbox" class="checkbox">
							<em></em><span>(필수) 이용약관에 모두 동의합니다.</span></label>
					</div>
					<div class="mb20">
						<label class="label-checkbox">
							<input a="terms2" type="checkbox" class="checkbox">
							<em></em><span> (필수) 개인정보 수집 및 이용에 동의합니다.</span></label>
					</div>
					<div class="view">
						<dl>
							<dt>서비스 이용약관</dt>
							<dd><a href="#" data-toggle="modal" data-target="#modalTerms">내용보기</a></dd>
						</dl>
						<dl>
							<dt>개인정보 수집 및 이용 동의</dt>
							<dd><a href="#" data-toggle="modal" data-target="#modalPrivate">내용보기</a></dd>
						</dl>
					</div>
					<div class="mb20">
						<label class="label-checkbox">
							<input a="terms3" type="checkbox" class="checkbox">
							<em></em><span>(필수) 본인은 만 14세 이상입니다.</span></label>
					</div>
					<div class="mb20">
						<label class="label-checkbox">
							<input a="mem_receive_sms" type="checkbox" class="checkbox">
							<em></em><span>(선택) 정보/이벤트 메일, SMS수신에 동의합니다.</span></label>
					</div>
					<div class="msg">
						<p>* SMS, 이메일 수신에  동의해주시면 클린디 맞춤 알림을 받아 보실 수 있습니다.</p>
					</div>
				</div>
			</div>
			<button a="join" class="btn btn-type1 block">가입하고 클린디 진단하기</button>			
		</div>
	</div>
</div>
<!-- // member-wrap --> 
<script>

	$(function(){

		$('#AllCheck').click(function(){
			if($(this).prop('checked')){
				$('.checkbox').prop('checked', true);
			}else{
				$('.checkbox').prop('checked', false);
			}
		})
		$('.checkbox').click(function(){
			var checked = $(this).is(':checked');
			if(!checked){
				$('#AllCheck').prop('checked', false);
			}
		})
	})

	var timer1 = null;
	function fnSendAuth() {
		clearInterval(timer1);
		cnt = 180;

		$.ajax({
			url: "/common/ajaxSendAuth",
			type: 'POST',
			dataType : 'json',
			async: true,
			data: {'mem_phone' : $('input[name=mem_phone]').val()},
			success: function(res, textStatus, jqXHR){
				if(res.status == 'succ') {
					$('#sms_auth_wrap').show();
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
			data: {'mem_phone' : $('input[name=mem_phone]').val(),
					'auth_number' : $('input[name=auth_number]').val() },
			success: function(res, textStatus, jqXHR){
				if(res.status == 'succ') {
					$('input[name=auth]').val($('input[name=mem_phone]').val());
					clearInterval(timer1);	
	//				$('#auth_timer').hide();
					$('div[a="auth_msg"]').hide();
	//				$('input[a="auth_number"]').attr('readonly', true);
					$('#auth_btn2').hide();
					$('em[a="auth_number"]').addClass('active');
					showAlert('info', res.msg);	
				}
				else {
					$('em[a="auth_number"]').removeClass('active');
					showAlert('error', res.msg);	
				}
			},
			error: function(request,status,error){
					alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
			}
		});
	}
	
	$(document).ready(function(e) {

		$('input[name=mem_phone]').on('keyup', function() {
			clearInterval(timer1);
			$('input[name=auth]').val('');	
			$('input[name=auth_number]').val('');	
			$('#sms_auth_wrap').hide();
			$('#auth_btn1').html('인증');
			$('#auth_timer').show();
			$('#auth_btn2').show();
			$('em[a="auth_number"]').removeClass('active');
		});

		$(document).on('blur', 'input[a="mem_email"]', function() 
		{
			if ( validateEmail($(this).val()) )
			{
				$('div[a="mem_email"]').css('display', 'none');
				$('em[a="mem_email"]').addClass('active');
			}
			else
			{
				$('div[a="mem_email"]').css('display', 'block');
				$('em[a="mem_email"]').removeClass('active');
			}
		});	

		$(document).on('click', 'button[a="join"]', function() 
		{	
			if ( $('em[a="auth_number"]').hasClass('active') === false )
			{
				showAlert('error', '휴대폰 번호를 인증해주세요.');	
				return;
			}

			if ( $('input[a="mem_username"]').val().trim().length < 1 )
			{
				$('input[a="mem_username"]').focus();
				showAlert('error', '이름을 입력해주세요.');	
				return;
			}

			if ( $('em[a="mem_email"]').hasClass('active') === false )
			{
				$('input[a="mem_email"]').focus();
				showAlert('error', '이메일을 입력해주세요.');	
				return;
			}

			if ( $('input[a="terms1"]').is(':checked') === false ||
				 $('input[a="terms2"]').is(':checked') === false ||
				 $('input[a="terms3"]').is(':checked') === false )
			{
				showAlert('error', '필수 약관에 동의해주시기 바랍니다.');	
				return;
			}

			let data = new FormData();
			data.append('mem_id', '<?php echo $this->session->userdata('user')['mem_id']; ?>');
			data.append('mem_phone', $('input[a="mem_phone"]').val().trim());
			data.append('mem_username', $('input[a="mem_username"]').val().trim());
			data.append('mem_email', $('input[a="mem_email"]').val().trim());
			data.append('mem_receive_sms', $('input[a="mem_receive_sms"]').is(':checked'));

			$.ajax(
			{	
				method: 'POST'
			,	url: '/member/join_more_p'
			,	data : data	
			,	processData : false
			,	contentType : false
			})
			.done(function(data, textStatus, jqXHR)
			{	
	//			console.log(data);

				if ( data.result )
				{
					showAlert('info', '회원 정보를 업데이트 하였습니다.', function()
					{
						location.href = '/';
					});
				}
				else
				{
					showAlert('error', data.result_msg);
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown)
			{	
				alert('네트워크 오류입니다. 잠시 후 다시 시도해주세요.');
			});
		});
	});
	
</script>
