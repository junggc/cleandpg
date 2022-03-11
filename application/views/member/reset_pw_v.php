<div class="member-wrap">
	<h3 class="h3">비밀번호 재설정</h3>
	<div class="inner-member">
		<div class="login">
			<div class="inp-box1 mb10">
				<input a="mem_password" type="password" class="inp1" placeholder="새 비밀번호 입력" style="width:100%">
			</div>
			<div class="inp-box1 mb50">
				<input a="mem_password_re" type="password" class="inp1" placeholder="새 비밀번호 재입력" style="width:100%">
			</div>
			<button a="reset_pw_p" class="btn btn-type1 block">확인</button>
		</div>
	</div>
</div>
<script src="/res/js/validatePassword.js"></script>
<script>

	$(document).ready(function() 
	{
		$(document).on('click', 'button[a="reset_pw_p"]', function() 
		{	
			let passed = validatePassword($('input[a="mem_password"]').val().trim(), {
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
			
			if ( passed === false )
			{
				$('input[a="mem_password"]').focus();
				showAlert('error', '비밀번호는 6~15자의 영문 소문자, 숫자 혼합으로 입력해주세요.');	
				return;
			}
			
			if ( $('input[a="mem_password"]').val() !== $('input[a="mem_password_re"]').val() )
			{
				$('input[a="mem_password_re"]').focus();
				showAlert('error', '비밀번호 재입력이 틀립니다. 다시 입력해주세요.');	
				return;
			}
			
			$.ajax(
			{
				method: 'POST'
			,	url: '/member/reset_pw_p'
			,	data: 
				{ 
					mem_id: '<?php echo $mem_id; ?>'
				,	mem_password: $('input[a="mem_password"]').val().trim()
				}
			})
			.done(function( res ) 
			{
				if ( res.result )
				{
					showAlert('success', '새 비밀번호로 변경되었습니다.', function()
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
		});
	});
	
</script>
