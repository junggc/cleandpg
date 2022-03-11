<div class="member-wrap">
	<div class="inner-member">
		<h3 class="h3"><a href="/member/find_pw" class="back">이메일 주소로 찾기</a></h3>
		<div class="login">
			<div class="find-result">
				<div><?php echo $this->session->flashdata('f_mem_email'); ?> 주소로 <br>
					비밀번호 재설정 이메일을 발송하였습니다.
					<p>메일을 통해 새로운 비밀번호를 <br>
						설정해주세요.</p>
				</div>
			</div>
			<div class="flex-btns"> <a href="/" class="btn btn-type2">홈으로</a> <a href="/member/login" class="btn btn-type1">로그인</a> </div>
		</div>
	</div>
	<div class="inner-member2">
		<div class="desc1">* 메일을 받지 못하셨다면, 메일수신함에서 CLEAN D 메일 수신차단 여부를 확인해 주세요.</div>
	</div>
</div>
