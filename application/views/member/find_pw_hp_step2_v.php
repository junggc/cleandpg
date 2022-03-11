<div class="member-wrap">
	<div class="inner-member mb70">
		<h3 class="h3"><a href="/member/find_pw" class="back">휴대폰 번호로 찾기</a></h3>
		<div class="inp-box1 mb10">
			<input a="mem_username" type="text" class="inp1" value="<?php echo $this->session->flashdata('f_mem_username'); ?>" readonly style="width:100%">
		</div>
		<div class="inp-box1">
			<input a="mem_phone" type="tel" class="inp1" name="mem_phone" value="<?php echo $this->session->flashdata('f_mem_phone'); ?>" readonly style="width:100%" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11" />
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
		<div class="inp-box1">
			<input a="mem_password" type="password" class="inp1" placeholder="새 비밀번호 (6~15자의 영문 대소문자, 숫자 혼합)" style="width:100%">
			<em a="mem_password" class="chk"></em>
		</div>
		<div a="mem_password" class="alert-msg1" style="display: none">6~15자의 영문 대/소문자, 숫자 혼합</div>			
		<div class="inp-box1 ">
			<input a="mem_password_re" type="password" class="inp1" placeholder="새 비밀번호 재입력" style="width:100%">
			<em a="mem_password_re" class="chk"></em>
		</div>
		<div a="mem_password_re" class="alert-msg1" style="display: none">새 비밀번호가 일치하지 않습니다.</div>
		
		
		<button a="find_pw_hp_step2" class="btn btn-type1 block mt50">확인</button>
	</div>
	<div class="inner-member2">
		<div class="login">
			<a href="/member/find_pw_email" class="btn btn-type0 btn-lg block">이메일 주소로 찾기</a>
		</div>
	</div>
</div>
<script src="/res/js/validatePassword.js"></script>
<script>

	var timer1 = null;
	function fnSendAuth() {
		clearInterval(timer1);
		cnt = 180;

		$.ajax({
			url: "/common/ajaxSendAuth2",
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

		$(document).on('blur', 'input[a="mem_password"]', function() 
		{
			let passed = validatePassword($(this).val(), {
	//			length:   [8, Infinity],
				length:   [6, 15],
				lower:    1,
				upper:    0,
				numeric:  1,
	//			special:  1,
				special:  0,
	//			badWords: ["password", "steven", "levithan"],
				badWords: [],
	//			badSequenceLength: 4
				badSequenceLength: 0
			});

	//		console.log(passed);

			if ( passed )
			{
				$('div[a="mem_password"]').css('display', 'none');
				$('em[a="mem_password"]').addClass('active');
			}
			else
			{
				$('div[a="mem_password"]').css('display', 'block');
				$('em[a="mem_password"]').removeClass('active');
			}	
		});

		$(document).on('keyup', 'input[a="mem_password"]', function() 
		{
			$('em[a="mem_password_re"]').removeClass('active');
		});

		$(document).on('blur', 'input[a="mem_password_re"]', function() 
		{	
			if ( $('input[a="mem_password"]').val() === $('input[a="mem_password_re"]').val() )
			{
				$('div[a="mem_password_re"]').css('display', 'none');
				$('em[a="mem_password_re"]').addClass('active');
			}
			else
			{
				$('div[a="mem_password_re"]').css('display', 'block');
				$('em[a="mem_password_re"]').removeClass('active');
			}	
		});

		$(document).on('click', 'button[a="find_pw_hp_step2"]', function() 
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

			if ( $('em[a="mem_password"]').hasClass('active') === false )
			{
				$('input[a="mem_password"]').focus();
				showAlert('error', '새 비밀번호를 입력해주세요.');	
				return;
			}

			if ( $('em[a="mem_password_re"]').hasClass('active') === false )
			{
				$('input[a="mem_password_re"]').focus();
				showAlert('error', '새 비밀번호 재입력을 입력해주세요.');	
				return;
			}

			let data = new FormData();
			data.append('mem_id', '<?php echo $this->session->flashdata('f_mem_id'); ?>');
			data.append('mem_password', $('input[a="mem_password"]').val().trim());

			$.ajax(
			{	
				method: 'POST'
			,	url: '/member/find_pw_hp_step2_p'
			,	data : data	
			,	processData : false
			,	contentType : false
			})
			.done(function(data, textStatus, jqXHR)
			{	
	//			console.log(data);

				if ( data.result )
				{
					location.href = '/member/find_pw_hp_result';
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
