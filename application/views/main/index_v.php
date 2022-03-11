<div class="main <?php echo !empty($subscribe_cnt) ? 'subscribe_cnt' : ''; ?>">
	<div class="main2">
		<div class="inner">
			<div>
				<h2 data-aos="fade-up" data-aos-delay="100"><?php echo nl2br($main['main1_text1']); ?></h2>
				<div class="txt" data-aos="fade-up" data-aos-delay="300"><?php echo nl2br($main['main1_text2']); ?></div>
				<div class="main-btn" data-aos="fade-up" data-aos-delay="500"><a href="<?php echo $main['main1_btn_link']; ?>"><?php echo $main['main1_btn_text']; ?></a></div>
			</div>
		</div>
	</div>
	<div class="main6">
		<div class="inner">
			<h2 data-aos="fade-up" data-aos-delay="100"><strong class="blue">클린디</strong> 리뷰</h2>
			<div  data-aos="fade-in" data-aos-delay="300">
				<div class="swiper-container">
					<div class="swiper-wrapper">
                    <?php 
						foreach($reviews as $row) {
					?>
						<div class="swiper-slide"> 
                        	<a href="#"  data-toggle="modal" data-target="#modalReviewDetail" onclick="javascript:fnPopupSetDetail('<?php echo str_replace('"', '\\\'', json_encode($row)); ?>'); return false;" class="review-item">
                                <div class="img main_review_img" ><img src="<?php echo CDN_URL . $row['img_file1']; ?>" style="object-fit: cover; width: 100%; height: 100%;"></div>
                                <div class="detail">
                                    <div class="subj"><?php echo $row['cit_name']; ?></div>
                                    <div class="grade" style="width:100%"> 
                                    <?php
										for($i = 0; $i < $row['cre_score']; $i++) {
											echo '<i class="on"></i>';
										}
										for($i = $row['cre_score']; $i < 5; $i++) {
											echo '<i></i>';	
										}
									?>
                                    </div>
                                    <div class="txt" style="word-break:break-all;"><?php echo $row['cre_title']; ?></div>
                                    <div class="info"> <span><?php echo $row['mem_email']; ?></span> <span><?php echo $row['ins_dtm']; ?></span> </div>
                                </div>
							</a> 
                        </div>
                    <?php
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="main1-1">
    	<img src="<?php echo CDN_URL . $main['main2_img_url']; ?>" style="width:100%" />
    	<img src="<?php echo CDN_URL . $main['main2_img_m_url']; ?>" style="width:100%" class="mo" />
	</div>
	<div class="main1">
		<div class="inner">
			<h2 data-aos="fade-up" data-aos-delay="100"><?php echo nl2br($main['main3_text1']); ?></h2>
			<div class="txt" data-aos="fade-up" data-aos-delay="300"><?php echo nl2br($main['main3_text2']); ?></div>
			<div class="main-btn" data-aos="fade-up" data-aos-delay="500"><a href="<?php echo $main['main3_btn_link']; ?>"><?php echo $main['main3_btn_text']; ?></a></div>
		</div>
	</div>
	<div class="main3">
		<div class="inner">
			<div>
				<h2 data-aos="fade-up" data-aos-delay="100"><?php echo nl2br($main['main4_text1']); ?></h2>
				<div class="txt" data-aos="fade-up" data-aos-delay="300"><?php echo nl2br($main['main3_text2']); ?> </div>
				<div class="main-btn" data-aos="fade-up" data-aos-delay="500"><a href="<?php echo $main['main4_btn_link']; ?>"><?php echo $main['main4_btn_text']; ?></a></div>
			</div>
		</div>
	</div>
	<div class="main4">
		<div class="inner">
			<h2 data-aos="fade-up" data-aos-delay="100"><?php echo nl2br($main['main5_text1']); ?></h2>
			<div class="logo" data-aos="fade-up" data-aos-delay="300"><img src="/res/img/main/logo.png" alt="cleand"></div>
			<div class="txt" data-aos="fade-up" data-aos-delay="500"><?php echo nl2br($main['main5_text2']); ?> </div>
			<div class="main-btn" data-aos="fade-up" data-aos-delay="600"><a href="<?php echo $main['main5_btn_link']; ?>"><?php echo $main['main5_btn_text']; ?></a></div>
		</div>
	</div>
	<div class="main5">
		<div class="inner">
			<h2 data-aos="fade-up" data-aos-delay="100">구독으로 만나는 <br class="mobile">
				편리한 생활</h2>
			<div class="org" data-aos="fade-up" data-aos-delay="400">
				<dl>
					<dt><span><img src="/res/img/main/ico1.png"></span></dt>
					<dd>자가 진단을 통해<br>
						나만의 <strong>클린디</strong> 찾기</dd>
				</dl>
				<dl>
					<dt><span><img src="/res/img/main/ico2.png"></span></dt>
					<dd>원하는 날짜에<br>
						<strong>클린디</strong> 배송 받기 </dd>
				</dl>
				<dl>
					<dt><span><img src="/res/img/main/ico3.png"></span></dt>
					<dd>매일 매일 <strong>클린디</strong>로<br>
						구강 건강 걱정 끝!</dd>
				</dl>
			</div>
			<div class="main-btn" data-aos="fade-up" data-aos-delay="600"><a href="/product/product_list">클린디 정기구독 바로가기 </a></div>
		</div>
	</div>
	<div class="main7">
		<div class="inner">
        	<div>
                <h2 data-aos="fade-up" data-aos-delay="100"><strong class="blue">클린디</strong> 지금 만나세요.</h2>
                <div data-aos="fade-up" data-aos-delay="400"> <a href="/diagnosis"><span>클린디	맞춤 진단 <i class="fas fa-chevron-right"></i></span></a> </div>
            </div>
		</div>
	</div>
</div>

<?php
	foreach($popup as $row) {
?>
<div id="floating-notice-<?php echo $row['spp_id']; ?>" style=""> 
	<div style="font-size:20px;font-weight:bold;"> 
    	<?php 
			if(!empty($row['link_url'])) {
		?>
    	<a href="<?php echo $row['link_url']; ?>" <?php echo $row['link_type'] == '1' ? 'target="_blank"' : ''; ?>><img src="<?php echo CDN_URL . $row['img_url']; ?>" /></a>
        <?php
			}
			else {
		?>
    	<img src="<?php echo CDN_URL . $row['img_url']; ?>" />
        <?php
			}
		?>
    </div> 
   	<div style="text-align:left;margin:4px 0 1px 13px;float:left;"> 
    	<input type="checkbox" name="floating_banner" id="floating_banner_<?php echo $row['spp_id']; ?>" /> <label for="floating_banner_<?php echo $row['spp_id']; ?>"> 오늘 하루 그만보기 </label> 
    </div> 
    <div style="text-align:right;margin:4px 4px 1px 3px;"> <a href="javascript:closeBanner('<?php echo $row['spp_id']; ?>');">[닫기]</a> </div> 
</div>
<?php
	}
?>
<style>
.main2 { background: url(<?php echo CDN_URL . $main['main1_img_url']; ?>) no-repeat 0 100%; }
.main1 { background: url(<?php echo CDN_URL . $main['main3_img_url']; ?>) no-repeat 50% 50%; background-size: cover; }
.main3 { background: url(<?php echo CDN_URL . $main['main4_img_url']; ?>) no-repeat 70% 100%; height: 800px; }
#footer { margin-top:0; }
.main_review_img { height:380px; }
@media (max-width: 1023px) {
	.main_review_img { height:280px; }
	.main2 { background: url(<?php echo CDN_URL . $main['main1_img_m_url']; ?>) no-repeat 100% 100%; background-size: cover; }
	.main1 { background: url(<?php echo CDN_URL . $main['main3_img_m_url']; ?>) no-repeat 100% 100%; background-size: cover; }
	.main3 { height: auto; background: url(<?php echo CDN_URL . $main['main4_img_m_url']; ?>) no-repeat 100% 100%; background-size: cover;}
}

<?php
	foreach($popup as $row) {
?>
#floating-notice-<?php echo $row['spp_id']; ?> {left:<?php echo $row['pos_x']; ?>px; top:<?php echo $row['pos_y']; ?>px; max-width:500px; display:none;position:fixed;background:#fff; padding:0px;z-index:100; border:1px solid #CCCCCC;}
@media (max-width: 1023px) {
	#floating-notice-<?php echo $row['spp_id']; ?> {left:5%; top:100px; width:90%;}
}
<?php
	}
?>
</style>
<?php $this->load->view('common/reviewViewPopup'); ?>
<script>
$(document).ready(function () {
	var cook = '';
<?php
	foreach($popup as $row) {
?>
	cook = getCookie("cleand_layer_popup_<?php echo $row['spp_id']; ?>");
	if (cook == "N") { 
		$("#floating-notice-<?php echo $row['spp_id']; ?>").hide(); 
	} 
	else { 
		$("#floating-notice-<?php echo $row['spp_id']; ?>").show(); 
	} 
<?php
	}
?>

			var subLectureSwiper = new Swiper(".main6 .swiper-container", {
				slidesPerView: '3',
				spaceBetween: 30,
				observer: true,
				observeParents: true,
				breakpoints: {
				767: {
					loop:true,
					slidesPerView: 'auto',
					centeredSlides: true,
					loopedSlides : 1,
					
					},
					
				1024: {
					//spaceBetween: 20,
					},
				},
	
			});

		// swiper 이슈로 일단 숨김(시간이....)
		//AOS.init();
	
}); 

function closeBanner(idx) { 
	if ($("#floating_banner_" + idx).is(":checked")) { 
		setCookie("cleand_layer_popup_" + idx, "N", 1); 
	} 
	$("#floating-notice-" + idx).hide(); 
}

function getCookie(name) { 
	var cookie = document.cookie; 
	if (document.cookie != "") { 
		var cookie_array = cookie.split("; "); 
		for ( var index in cookie_array) { 
			var cookie_name = cookie_array[index].split("="); 
			if (cookie_name[0] == name) { 
				return cookie_name[1]; 
			} 
		} 
	} 
	return ; 
}

function setCookie(name, value, expiredays) {
    var date = new Date();
    date.setDate(date.getDate() + expiredays);
    document.cookie = escape(name) + "=" + escape(value) + "; expires=" + date.toUTCString();
}

	$(function(){
		
		
    });
</script>
<!-- // main -->
