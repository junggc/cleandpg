	<div class="sub-head mypage-head">
		<div class="inner">
			<h2 class="h2">마이 클린디</h2>
		</div>
	</div>
	
	<div class="inner">
		<!-- 마이페이지 -->
		<div class="mypage" style="min-height:300px;">
        	<?php $this->load->view('common/myNav'); ?>
			<div class="container">
				<h3 class="h3 f33">회원정보 수정</h3>
				<div class="mypage-modify">
					<div style="padding:0 0 50px 0">
                    <form method="post" action="/my/user/info">
						<input type="password" class="inp1 block" name="mem_password" placeholder="비밀번호를 입력해주세요." style="max-width:300px;"/>
						<button class="btn btn-type1 btn-m">비밀번호확인</button>
                    </form>
					</div>
				</div>
			</div>
		</div>
		<!-- // 마이페이지 -->
	</div>
    <style>
	@media (max-width: 1023px) {
		form button { margin-top:10px; width:100%; }
	}
	</style>
	<!-- // inner -->