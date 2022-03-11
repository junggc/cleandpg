<div class="member-wrap">
	<div class="inner-member mb70">
		<h3 class="h3"><a href="/member/find_pw" class="back">이메일 주소로 찾기</a></h3>
		<div class="inp-box1 mb10">
			<input a="mem_username" type="text" class="inp1" placeholder="이름" style="width:100%">
		</div>
		<div class="inp-box1">
			<input a="mem_email" type="text" class="inp1" placeholder="이메일 주소" style="width:100%">
		</div>
		<button a="find_pw_email_p" class="btn btn-type1 block mt50">확인</button>
	</div>
	<div class="inner-member2">
		<div class="login"> <a href="/member/find_pw_hp_step1" class="btn btn-type0 btn-lg block">휴대폰 번호로 찾기</a> </div>
	</div>
</div>
<script>

	$(document).ready(function() 
	{	
		$(document).on('click', 'button[a="find_pw_email_p"]', function() 
		{	
			let _this = $(this);
			_this.attr('disabled', true);
			
			if ( $('input[a="mem_username"]').val().trim().length < 1 )
			{
				$('input[a="mem_username"]').focus();
				showAlert('error', '이름을 입력해주세요.');	
				return;
			}

			if ( $('input[a="mem_email"]').val().trim().length < 1 )
			{
				$('input[a="mem_email"]').focus();
				showAlert('error', '이메일 주소를 입력해주세요.');	
				return;
			}
			
			$.ajax(
			{
				method: 'POST'
			,	url: '/member/find_pw_email_p'
			,	data: 
				{ 
					mem_username: $('input[a="mem_username"]').val().trim()
				,	mem_email: $('input[a="mem_email"]').val().trim()
				}
			})
			.done(function( res ) 
			{
				if ( res.result )
				{
					location.href='/member/find_pw_email_result';
				}
				else
				{
					showAlert('error', res.result_msg);	
					_this.attr('disabled', false);
				}	
			})
			.fail(function() 
			{
				alert('네트워크 오류입니다. 잠시 후 다시 시도해주세요.');
			});
		});
	});
	
</script>
