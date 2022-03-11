<div class="quick">
	<div> 
    	<a href="<?php echo $shop['sns_kakao']; ?>" target="_blank"><img src="/res/img/common/ico_quick_kakao.png"></a> 
	    <a href="#" class="btn-top">위로</a> 
    </div>
</div>
<div id="footer">
	<div class="foot1">
		<div class="inner">
			<nav> 
            	<a href="/main/introduce">회사소개</a> 
            	<a href="/faq">이용안내</a> 
                <a href="#" data-toggle="modal" data-target="#modalTerms">이용약관</a> 
                <a href="#" data-toggle="modal" data-target="#modalPrivate">개인정보처리방침</a> 
                <a href="#" onclick="javascript:fnShowBiz(); return false;">사업자정보확인</a> 
            </nav>
			<div class="sns"> 
            	<a href="<?php echo $shop['sns_facebook']; ?>" target="_blank"><img style="width:36px;" src="/res/img/new_icon/ico_facebook.svg" alt="페이스북"></a> 
                <a href="<?php echo $shop['sns_instagram']; ?>" target="_blank"><img style="width:36px;" src="/res/img/new_icon/ico-insta.svg" alt="인스타"></a> 
                <a href="<?php echo $shop['sns_blog']; ?>" target="_blank"><img style="width:36px;" src="/res/img/new_icon/ico_blog.svg" alt="블로그"></a> 
                <a href="<?php echo $shop['sns_youtube']; ?>" target="_blank"><img style="width:36px;" src="/res/img/new_icon/ico-youtube.svg" alt="유튜브"></a> 
            </div>
		</div>
	</div>
	<div class="foot2">
		<div class="inner">
			<div class="cp">주식회사 클린디</div>
			<div class="info">
				<button class="mobile">사업자 정보</button>
				<div><?php echo $shop['office_addr']; ?><br>
                 물류: <?php echo $shop['delivery_addr']; ?>
					사업자등록번호 : <?php echo $shop['biz_no']; ?>   통신판매신고 : <?php echo $shop['shop_no']; ?><br>
					개인정보보호책임자 : <?php echo $shop['personal_name']; ?>&nbsp;&nbsp;&nbsp;&nbsp;대표자 : <?php echo $shop['ceo_name']; ?></div>
			</div>
			<div class="copy"><?php echo $shop['shop_copyright']; ?></div>
			<div class="cs">
				<p class="tit">클린디 고객센터</p>
				<strong><a href="tel:<?php echo preg_replace("/[^0-9]*/s", "", $shop['tel']); ?>" style="color:#fff;"><?php echo $shop['tel']; ?></a></strong>
				<div>고객문의 :  <?php echo $shop['qna_email']; ?><br>
					제휴문의 :  <?php echo $shop['partner_email']; ?><br>
					인재채용 :  <?php echo $shop['recruit_email']; ?></div>
				<div class="mobile">
					<div class="sns"> 
                    	<a href="<?php echo $shop['sns_facebook']; ?>" target="_blank"><img src="/res/img/new_icon/ico_mo_facebook.svg" alt="페이스북"></a> 
                        <a href="<?php echo $shop['sns_instagram']; ?>" target="_blank"><img src="/res/img/new_icon/ico-mo-insta.svg" alt="인스타"></a> 
                        <a href="<?php echo $shop['sns_blog']; ?>" target="_blank"><img src="/res/img/new_icon/ico_mo_blog.svg" alt="블로그"></a> 
                        <a href="<?php echo $shop['sns_youtube']; ?>" target="_blank"><img src="/res/img/new_icon/ico-mo-youtube.svg" alt="유튜브"></a> 
                    </div>
					<div class="copy"><?php echo $shop['shop_copyright']; ?></div>
				</div>
			</div>
			<a href="<?php echo $shop['sns_kakao']; ?>" class="btn-kakao-m mobile" style="position:fixed; width:45px; right:10px; bottom:10px; z-index:1000;">
            	<img src="/res/img/common/ico_m_kakao.png" alt="카카오">
            </a> 
        </div>
	</div>
</div>
<script>
function fnShowBiz()
{
	var url = "http://www.ftc.go.kr/bizCommPop.do?wrkr_no=290-87-02295";
	window.open(url, "bizCommPop", "width=750, height=700;");
}
</script>
<?php $this->load->view('common/termsPopup'); ?>
<?php $this->load->view('common/privatePopup'); ?>
</body>
</html>
