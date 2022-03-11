<div class="member-wrap">
	<div class="inner-member mb70">
		<h3 class="h3"><a href="/member/find_pw" class="back">휴대폰 번호로 찾기</a></h3>
		<div class="inp-box1 mb10">
			<input a="mem_username" type="text" class="inp1" placeholder="이름" style="width:100%">
		</div>
		<div class="inp-box1">
			<input a="mem_phone" type="tel" class="inp1" name="mem_phone" placeholder="휴대폰 번호" style="width:100%" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11" />
		</div>
		<button a="find_pw_hp_step1" class="btn btn-type1 block mt50">확인</button>
	</div>
	<div class="inner-member2">
		<div class="login">
			<a href="/member/find_pw_email" class="btn btn-type0 btn-lg block">이메일 주소로 찾기</a>
		</div>
	</div>
</div>
<script>

	$(document).ready(function() 
	{	
		$(document).on('click', 'button[a="find_pw_hp_step1"]', function() 
		{	
			if ( $('input[a="mem_username"]').val().trim().length < 1 )
			{
				$('input[a="mem_username"]').focus();
				showAlert('error', '이름을 입력해주세요.');	
				return;
			}

			if ( $('input[a="mem_phone"]').val().trim().length < 1 )
			{
				$('input[a="mem_phone"]').focus();
				showAlert('error', '휴대폰 번호를 입력해주세요.');	
				return;
			}
			
			$.ajax(
			{
				method: 'POST'
			,	url: '/member/find_id_p'
			,	data: 
				{ 
					mem_username: $('input[a="mem_username"]').val().trim()
				,	mem_phone: $('input[a="mem_phone"]').val().trim()
				}
			})
			.done(function( res ) 
			{
				if ( res.result )
				{
					location.href='/member/find_pw_hp_step2';
				}
				else
				{
					showAlert('error', res.result_msg);	
				}	
			})
			.fail(function() 
			{
				showAlert('error', '네트워크 오류입니다. 잠시 후 다시 시도해주세요.');	
			});
		});
	});

</script>
