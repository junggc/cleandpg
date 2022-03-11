	<div class="sub-head mypage-head">
		<div class="inner">
			<h2 class="h2">마이 클린디</h2>
		</div>
	</div>
	
	<div class="inner">
		<!-- 마이페이지 -->
		<div class="mypage">
        	<?php $this->load->view('common/myNav'); ?>
			<div class="container">
				<h3 class="h3"><a href="#" class="link m back">회원탈퇴</a></h3>	
				<div class="secession">
                	<form id="frmLeave">
					<dl>
						<dt>탈퇴사유</dt>
						<dd>
							<div class="labels">
								<label><input type="radio" class="radio" name="leave_reason_code" value="0" checked><em></em><span>프로그램 불만족</span></label>
								<label><input type="radio" class="radio" name="leave_reason_code" value="1"><em></em><span>사이트이용 불편</span></label>
								<label><input type="radio" class="radio" name="leave_reason_code" value="2"><em></em><span>가격불만족</span></label>
								<label><input type="radio" class="radio" name="leave_reason_code" value="3"><em></em><span>상담 불만족</span></label>
								<label><input type="radio" class="radio" name="leave_reason_code" value="4"><em></em><span>기타</span></label>
							</div>
						</dd>
					</dl>
					<dl style="display:none" id="reason_msg_wrap">
						<dt>내용</dt>
						<dd>
							<textarea class="textarea" name="leave_reason_msg">프로그램 불만족</textarea>
						</dd>
					</dl>
					<div class="msg">회원탈퇴 시 회원님의 개인정보, 주문내역 등 모든 정보가 바로 삭제됩니다.</div>
					<div class="agree">
						<label><input type="checkbox" class="checkbox" name="agree" ><em></em><span>예, 정보 삭제에 동의합니다.</span></label>
					</div>
                    </form>
				</div>
				
				<div class="btn-box-common1">
					<button class="btn btn-type2 btn-m" onclick="javascript:location.href='/my/user';">취소</button>
					<button class="btn btn-type1 btn-m" onclick="javascript:fnLeave();">확인</button>
				</div>
			</div>				
		</div>
		<!-- // 마이페이지 -->
	</div>
<script>
$(document).ready(function(e) {
    $('input[name=leave_reason_code]').on('click', function() {
		if($(this).val() == '4') {
			$('textarea[name=leave_reason_msg]').val('');
			$('#reason_msg_wrap').show();
		}
		else {
			$('textarea[name=leave_reason_msg]').val($(this).siblings('span').html());
			$('#reason_msg_wrap').hide();
		}
	});
});

function fnLeave()
{
	var msg = {msg : '회원을 탈퇴 하시겠습니까?', cancel:'닫기', confirm : '퇄퇴'};
	showConfirm(msg, 
				function() {
						$.ajax({
							type:'POST',
							url:'/my/user/ajaxLeave',
							data : $('#frmLeave').serialize(),
							dataType:"json",
							success:function(res){
								if(res.status == 'succ') {
									showAlert('success', res.msg, function() {location.href='/';});
								}
								else if(res.status == 'login') {
									showAlert('error', res.msg, function() {location.href="/member/login";});
								}
								else {
									showAlert('error', res.msg);
								}
							},
							error:function(data){
								alert("오류가 발생하였습니다. 관리자에게 문의해 주세요.");
							}
					   });
				});
}

</script>