<div class="member-wrap">
	<h3 class="h3">회원가입</h3>
	<div class="inner-member">
		<div class="mine mb50">이미 클린디 계정이 있나요? <a href="/member/login">로그인</a></div>
		<div class="signup-btns">
			<div class="sns-btns">
				<button a="join_kakao" class="btn btn-kakao block mb30">카카오 아이디로 회원가입</button>
				<button a="join_naver" class="btn btn-naver block">네이버 아이디로 회원가입</button>
				<div id="naver_id_login" style="display: none;"></div>
			</div>
			<div class="or"><span>또는</span></div>
			<button class="btn-signup">이메일로 가입</button>
		</div>		
		<!-- 회원가입 폼 -->
		<div class="signup"> 			
			<!-- 인증 클릭 전 -->
			<div class="inp-box1">
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
			<!-- // 인증 클릭 전 --> 			
			<!-- 인증 클릭 후
				<div class="inp-box1 ">
					<input type="tel" class="inp1" placeholder="휴대폰 번호" style="width:100%">
					<div class="btn-box"><button class="btn-auth">다시요청</button></div>
				</div>
				
				<div class="certify">
					<div class="count">
						<div>인증번호가 문자메시지로 발송되었습니다. </div>
						<p>3:00</p>
					</div>
					<div class="inp-box-certify">
						<input type="tel" class="inp1">
						<button class="btn-auth"><span>인증번호 확인</span></button>
					</div>
				</div>
				-->			
			<div class="inp-box1">
				<input a="mem_username" type="text" class="inp1" placeholder="이름" style="width:100%">
			</div>			
			<div class="inp-box1">
				<input a="mem_email" type="email" class="inp1" placeholder="이메일주소 (아이디)" style="width:100%">
				<em a="mem_email" class="chk"></em>
			</div>
			<div a="mem_email" class="alert-msg1" style="display: none">이메일 형식이 올바르지 않습니다.</div>			
			<div class="inp-box1">
				<input a="mem_password" type="password" class="inp1" placeholder="비밀번호 (6~15자의 영문 소문자, 숫자 혼합)" style="width:100%">
				<em a="mem_password" class="chk"></em>
			</div>
			<div a="mem_password" class="alert-msg1" style="display: none">6~15자의 영문 소문자, 숫자 혼합</div>			
			<div class="inp-box1 ">
				<input a="mem_password_re" type="password" class="inp1" placeholder="비밀번호 재입력" style="width:100%">
				<em a="mem_password_re" class="chk"></em>
			</div>
			<div a="mem_password_re" class="alert-msg1" style="display: none">비밀번호가 일치하지 않습니다.</div>
                        <div class="find_input join">
                            <p>치과에서 클린디를 진단받으셨다면 방문 치과를 입력해주세요.</p>
                            <div class="inp-box1">
                                <input a="mem_email" type="email" class="inp1" placeholder="방문 치과명 또는 치과 주소를 검색해주세요." style="width:100%">
                                <button type="button" class="btn_seach"  data-toggle="modal" data-target="#modalrecommend"></button>
                            </div>
                            <div a="mem_email" class="alert-msg1">* 치과명이 잘못되었습니다. 다시 입력해주세요</div> <!-- style="display: block;" 넣으면 보임-->
                        </div>        
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
		<!-- // 회원가입 폼 --> 
	</div>
</div>
<div class="modal fade modalrecommend" id="modalrecommend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">치과 추천 가입</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="txt">
              <p>치과에서 클린디를 진단받으셨다면<br>방문치과를 선택해주세요.</p>
              <div class="find_input">
                <div class="inp-box1">
                   <input a="mem_email" type="email" class="inp1" placeholder="방문 치과명 또는 치과 주소를 검색해주세요." style="width:100%">
                   <button type="button" class="btn_seach"></button>
               </div>
               <div a="mem_email" class="alert-msg1">* 치과명이 잘못되었습니다. 다시 입력해주세요</div> <!-- style="display: block;" 넣으면 보임-->
              </div>
          </div>
            <div class="find_list"><!-- .show 클래스 추가시 넣으면 보임-->
                <div class="total_cnt">검색결과 <span class="count">2</span>건</div>
                <ul class="addr_list">
                    <li>
                        <input type="radio" id="addr_01" name="address">
                        <label clas="addrbox" for="addr_01">
                            <span class="name">케이스랩치과</span>
                            <em class="address">서울 강남구 청담동 123-12</em>
                            <a class="tel" href="tel:02-111-2222">02-111-2222</a>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="addr_02" name="address">
                        <label clas="addrbox" for="addr_02">
                            <span class="name">케이스랩치과22</span>
                            <em class="address">경기도 성남시 행운동 57-12</em>
                            <a class="tel" href="tel:02-111-2222">02-111-2222</a>
                        </label>
                    </li>
                </ul>
            </div>
      </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-type2" data-dismiss="modal">취소</button>
        <a href="/recommend/index" class="btn btn-type1">선택하기</a>
      </div>
    </div>
  </div>
</div>
<!-- // member-wrap --> 
<script src="/res/js/validatePassword.js"></script>
<script src="/res/js/kakao.min.js"></script>
<script src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js"></script>
<script>
	
	function join_sns_p(mem_userid, mem_email, mem_username, mem_sns_type)
	{
		$.ajax(
		{
			method: 'POST'
		,	url: '/member/join_sns_p'
		,	data: 
			{ 
				mem_userid: mem_userid
			,	mem_email: mem_email
			,	mem_username: mem_username
			,	mem_sns_type: mem_sns_type
			}
		})
		.done(function( res ) 
		{
//			console.log(data);

			if ( res.result )
			{
				showAlert('success', '클린디 회원에 가입되셨습니다.', function()
				{
					location.href = '/member/login';
				});
			}
			else
			{
				showAlert('error', res.result_msg);
			}	
		})
		.fail(function() 
		{
			alert('네트워크 오류입니다. 잠시 후 다시 시도해주세요.');
		});	
	}
	
	var naver_id_login = new naver_id_login("wLR69MKqvbkvKQk77W6x", "<?php echo $base_url; ?>/member/join");
	var state = naver_id_login.getUniqState();
	naver_id_login.setButton("white", 2,40);
	naver_id_login.setDomain("<?php echo $base_url; ?>");
	naver_id_login.setState(state);
	naver_id_login.setPopup();
	naver_id_login.init_naver_id_login();	

	function naverSignInCallback() 
	{
		opener.join_sns_p(naver_id_login.getProfileData('id'), naver_id_login.getProfileData('email'), naver_id_login.getProfileData('name'), 'naver');
		self.close();
	}

	if( naver_id_login.is_callback )
	{
		naver_id_login.get_naver_userprofile("naverSignInCallback()");
	}

	$(function(){

		$('.signup-btns .btn-signup').click(function(){
			$('.signup').stop().slideToggle(300);
			$(this).toggleClass('active');
		})

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
					showAlert('success', res.msg);	
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

			if ( $('em[a="mem_password"]').hasClass('active') === false )
			{
				$('input[a="mem_password"]').focus();
				showAlert('error', '비밀번호를 입력해주세요.');	
				return;
			}

			if ( $('em[a="mem_password_re"]').hasClass('active') === false )
			{
				$('input[a="mem_password_re"]').focus();
				showAlert('error', '비밀번호 재입력을 입력해주세요.');	
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
			data.append('mem_phone', $('input[a="mem_phone"]').val().trim());
			data.append('mem_username', $('input[a="mem_username"]').val().trim());
			data.append('mem_email', $('input[a="mem_email"]').val().trim());
			data.append('mem_password', $('input[a="mem_password"]').val().trim());
			data.append('mem_receive_sms', $('input[a="mem_receive_sms"]').is(':checked'));

			$.ajax(
			{	
				method: 'POST'
			,	url: '/member/join_p'
			,	data : data	
			,	processData : false
			,	contentType : false
			})
			.done(function(data, textStatus, jqXHR)
			{	
	//			console.log(data);

				if ( data.result )
				{
					showAlert('success', '클린디 회원에 가입되셨습니다.', function()
					{
						location.href = '/member/login';
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

		Kakao.init('8813692b86a42862f75f8deea52429d2');
		Kakao.isInitialized();

		$(document).on('click', 'button[a="join_kakao"]', function() 
		{	
			Kakao.Auth.login(
			{
				success: function(auth) 
				{
	//				console.log(JSON.stringify(auth));

					Kakao.API.request(
					{
						url: '/v2/user/me',
						success: function(res) 
						{
	//						console.log(JSON.stringify(res));

							join_sns_p(res.id, res.kakao_account.email, res.kakao_account.profile.nickname, 'kakao');
						},
						fail: function(err) 
						{
							alert(JSON.stringify(err));
						}
					});
				},
				fail: function(err) 
				{
					alert(JSON.stringify(err));
				},
			});
		});

		$(document).on('click', 'button[a="join_naver"]', function() 
		{
			$('#naver_id_login').children('a').trigger('click');
		});
	});
	
</script>
