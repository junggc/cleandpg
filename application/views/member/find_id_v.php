<div class="member-wrap">
	<div class="inner-member">
		<h3 class="h3"><a href="/member/login" class="back">아이디 찾기</a></h3>
		<div class="login">
			<div class="inp-box1">
				<input a="mem_username" type="text" class="inp1" placeholder="이름" style="width:100%">
			</div>
			<div class="inp-box1 mb50">
				<input a="mem_phone" type="tel" class="inp1" placeholder="휴대폰 번호" style="width:100%" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11">
			</div>
			<button a="find_id" class="btn btn-type1 block">확인</button>
			<div class="desc1 text-left">* 회원가입시 등록한 이름, 휴대폰번호 정보를 입력해 주세요</div>
		</div>
	</div>
</div>
<script>
	
	function isNull(v) {
		return (v === undefined || v === null) ? true : false;
	}

	$(document).ready(function() 
	{	
		$(document).on('click', 'button[a="find_id"]', function() 
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
					location.href='/member/find_id_result_t';
				}
				else
				{
					if ( isNull(res.result_data.mem_sns_type) === false )	showAlert('error', res.result_msg);	
					else													location.href='/member/find_id_result_f';
				}	
			})
			.fail(function() 
			{
				alert('네트워크 오류입니다. 잠시 후 다시 시도해주세요.');
			});
		});
	});

</script>
