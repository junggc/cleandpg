<div class="member-wrap">
	<div class="inner-member">
		<h3 class="h3 pc">로그인</h3>
		<h3 class="login-logo mobile"><img src="/res/img/new_icon/logo/logo-01.svg" alt="clean'd"></h3>
		<div class="login">
			<div class="inp-box1">
				<input a="mem_userid" type="text" class="inp1" placeholder="아이디 혹은 이메일 주소를 입력해주세요." style="width:100%">
				<!--<p class="chk"></p>-->
			</div>
			<!--<div class="alert-msg1">* 입력하신 이메일 주소를 찾을 수 없습니다.</div>-->
			<div class="inp-box1 mb50">
				<input a="mem_password" type="password" class="inp1" placeholder="비밀번호를 입력해주세요." style="width:100%">
				<!--<p class="chk"></p>-->
			</div>
			<button a="login" class="btn btn-type1 block">로그인</button>
			<div class="btns">
				<a href="/member/find_id">아이디 찾기</a>
				<a href="/member/find_pw">비밀번호 찾기</a>
			</div>
			<div class="sns">
				<button a="login_kakao" class="btn btn-kakao block mb20">카카오 로그인</button>
				<button a="login_naver" class="btn btn-naver block mb20">네이버 로그인</button>
				<div id="naver_id_login" style="display: none;"></div>
				<button class="btn block btn-register">아직 회원이 아니신가요? <a href="/member/join"><span>회원가입</span></a></button>
			</div>
		</div>
	</div>
</div>
<!-- // member-wrap -->
<script src="/res/js/kakao.min.js"></script>
<script src="https://static.nid.naver.com/js/naverLogin_implicit-1.0.3.js"></script>
<script>
	
	function login_sns_p(mem_userid, mem_sns_type)
	{
		$.ajax(
		{
			method: 'POST'
		,	url: '/member/login_sns_p'
		,	data: 
			{ 
				mem_userid: mem_userid
			,	mem_sns_type: mem_sns_type
			}
		})
		.done(function( res ) 
		{
//			console.log(data);

			if ( res.result )
			{
//				showAlert('success', '클린디에 로그인되셨습니다.', function()
//				{
//					location.href='/';
					location.href = '<?php echo $login_referer; ?>';
//				});
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
	
	var naver_id_login = new naver_id_login("wLR69MKqvbkvKQk77W6x", "<?php echo $base_url; ?>/member/login");
	var state = naver_id_login.getUniqState();
	naver_id_login.setButton("white", 2,40);
	naver_id_login.setDomain("<?php echo $base_url; ?>");
	naver_id_login.setState(state);
	naver_id_login.setPopup();
	naver_id_login.init_naver_id_login();	

	function naverSignInCallback() 
	{
		opener.login_sns_p(naver_id_login.getProfileData('id'), 'naver');
		self.close();
	}

	if( naver_id_login.is_callback )
	{
		naver_id_login.get_naver_userprofile("naverSignInCallback()");
	}
	
	$(document).ready(function() 
	{	
		$('input[a="mem_password"]').on('keypress', function(e) {
			if(event.keyCode == 13) {
				$('button[a="login"]').click();
			}
		});
		
		$(document).on('click', 'button[a="login"]', function() 
		{	
			if ( $('input[a="mem_userid"]').val().trim().length < 1 )
			{
				$('input[a="mem_userid"]').focus();
				showAlert('error', '아이디 혹은 이메일 주소를 입력해주세요.');	
				return;
			}

			if ( $('input[a="mem_password"]').val().trim().length < 1 )
			{
				$('input[a="mem_password"]').focus();
				showAlert('error', '비밀번호를 입력해주세요.');	
				return;
			}

			$.ajax(
			{
				method: 'POST'
			,	url: '/member/login_p'
			,	data: 
				{ 
					mem_userid: $('input[a="mem_userid"]').val().trim()
				,	mem_password: $('input[a="mem_password"]').val().trim()
				}
			})
			.done(function( res ) 
			{
	//			console.log(data);

				if ( res.result )
				{
//					showAlert('success', '클린디에 로그인되셨습니다.', function()
//					{
//						location.href='/';
						location.href = '<?php echo $login_referer; ?>';
//					});
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
		});

		Kakao.init('8813692b86a42862f75f8deea52429d2');
		Kakao.isInitialized();

		$(document).on('click', 'button[a="login_kakao"]', function() 
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

							login_sns_p(res.id, 'kakao');
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

		$(document).on('click', 'button[a="login_naver"]', function() 
		{
			$('#naver_id_login').children('a').trigger('click');
		});
	});
	
</script>
