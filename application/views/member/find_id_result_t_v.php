<div class="member-wrap">
	<div class="inner-member">
		<h3 class="h3"><a href="/member/find_id" class="back">아이디 찾기</a></h3>
		<div class="login">
			<div class="find-result">
				<div><?php echo $this->session->flashdata('f_mem_username'); ?>님의 아이디는 <strong><?php echo $this->session->flashdata('f_mem_userid'); ?></strong> 입니다. </div>
				<p>(<?php echo date('Y/m/d', strtotime($this->session->flashdata('f_mem_register_datetime'))); ?> <?php echo strtoupper($this->session->flashdata('f_mem_sns_type')); ?> 로 가입)</p>
			</div>
			<a href="/member/login" class="btn btn-type1 block">로그인</a>
		</div>
	</div>
</div>
