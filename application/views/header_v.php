<?php
	if (!empty($user))
	{
		if ( basename($_SERVER['PHP_SELF']) !== 'join_more' &&
			 strlen($user['mem_phone']) < 1 )
		{
			header('Location: /member/join_more');
		}
	}
	else
	{
		if ( basename($_SERVER['PHP_SELF']) === 'join_more' )
		{
			header('Location: /');
		}
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $shop['shop_title']; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="telephone=no" />
<meta name="description" content="<?php echo $shop['shop_desc']; ?>" />
<meta name="keywords" content="<?php echo $shop['shop_keyword']; ?>" />
<?php
	if(strpos('/main/introduce', $_SERVER['REQUEST_URI']) !== false) {
?>
<meta property="og:title" content="클린디 :: 클린디가 처음이라면" />
<meta property="og:description" content="클린디가 나에게 필요한 이유" />
<meta property="og:url" content="<?php echo $base_url; ?>/main/introduce" />
<meta property="og:image" content="" />
<?php		
	}
	else if(strpos('/product/product_list', $_SERVER['REQUEST_URI']) !== false) {
?>
<meta property="og:title" content="클린디 :: 상품 소개" />
<meta property="og:description" content="‘나’에게 맞춘 상품들을 만나보세요" />
<meta property="og:url" content="<?php echo $base_url; ?>/product/product_list" />
<meta property="og:image" content="" />
<?php
	}
	else {
?>
<meta property="og:title" content="클린디 :: 개인 맞춤형 구강케어 구독 플랫폼" />
<meta property="og:description" content="스마트한 구강케어를 위한 토털 구강 케어 서비스입니다." />
<meta property="og:url" content="<?php echo $base_url; ?>" />
<meta property="og:image" content="" />
<?php		
	}
?>
<meta name="google-site-verification" content="myPoy8_a95gLsDXSGaq5ijBQt-Z3doxyMhm93xyGO58" />

<link rel="shortcut icon" href="/res/img/main/favicon.ico">
<link rel="stylesheet" type="text/css" href="/res/css/front.css">
<link href="/res/css/sweetalert/sweetalert2.min.css" rel="stylesheet">
<link href="/res/css/swiper/swiper.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
<script type="text/javascript" src="/res/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/res/js/front.js"></script>
<script type="text/javascript" src="/res/js/swiper/swiper.js"></script>
<script src="/res/js/bootstrap.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=8813692b86a42862f75f8deea52429d2&libraries=services"></script>
<script type="text/javascript" src="/res/js/common.js"></script>
<script src="/res/js/sweetalert/sweetalert2.all.js"></script>
<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<style>
.swal2-container.swal2-center {z-index : 30000 !important;}
.swal2-header .swal2-icon{display:none !important;}
.swal2-header #swal2-title {
	font-size:36px;
	font-weight: 700;
    letter-spacing: -1px;
	margin-bottom:30px;
}
.swal2-content #swal2-content {
	font-size:20px;	
	font-weight: 700 !important;
	margin-bottom:50px;
}
.swal2-container .swal2-actions {
	margin:0;
}
.swal2-container .swal2-actions button { 
	height: 80px;
    border: 1px solid transparent;
    line-height: 78px;
    text-align: center;
    border-radius: 13px;
    font-size: 24px;
    background: #003ca6;
    padding: 0 20px;
	width: 280px;
}
.swal2-container .swal2-actions button:focus { 
    box-shadow: none !important;
}
.swal2-popup {
	border-radius : 13px;	
	padding: 35px 80px;
	max-width: 830px;
	width:auto;
}
.swal2-container .swal2-actions button.swal2-cancel {
	background: #fff !important;
    color: #003ca6 !important;
    border: 1px solid #003ca6 !important;	
}
@media (max-width: 1023px) {
	.swal2-header #swal2-title {
		font-size:25px ;
		margin-bottom:15px;
	}
	.swal2-popup {
		border-radius : 13px;	
		padding: 35px 40px;
		max-width: 96%;
		width:auto;
	}
	.swal2-content #swal2-content {
		font-size:14px;
		margin-bottom:30px;
	}
	.swal2-container .swal2-actions button { 
		height: 50px;
		line-height: 48px;
		font-size: 14px;
		padding: 0 20px;
		width: auto;
	}
}
</style>
<?php echo $shop['sns_ga']; ?>

<?php echo $shop['sns_pixel']; ?>

<?php 
	$header_uri = $_SERVER['REQUEST_URI'];
	if(strpos('/main/introduce', $_SERVER['REQUEST_URI']) !== false) {
?>
<!-- Event snippet for 좌측 상단_클린디소개_페이지조회 conversion page --> 
<script> gtag('event', 'conversion', {'send_to': 'AW-10803290940/l2eWCISGkJADELzGtJ8o'}); </script>
<?php		
	}
	else if(strpos($_SERVER['REQUEST_URI'], '/diagnosis/detail') !== false) {
?>
<!-- Event snippet for 상단_진단_양식작성완료 conversion page --> 
<script> gtag('event', 'conversion', {'send_to': 'AW-10803290940/Y4nvCPjU9JEDELzGtJ8o'}); </script>
<?php		
	}
	else if($header_uri === '/diagnosis') {
?>
<!-- Event snippet for 상단_진단_시작하기 클릭 conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> 
<script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-10803290940/EDz-CJnl6pEDELzGtJ8o', 'event_callback': callback }); return false; } </script>
<?php
	}
	else if((strpos($_SERVER['REQUEST_URI'], '/payment/payment_result') !== false || strpos($_SERVER['REQUEST_URI'], '/payment/payment_result_mo') !== false) && !empty($order) && $order['order_type'] !== 'subscribe') {
?>
<!-- Event snippet for 상단_진단_양식작성완료 conversion page --> 
<!-- Event snippet for 구매 conversion page --> 
<script> gtag('event', 'conversion', { 'send_to': 'AW-10803290940/emfCCL_lvJEDELzGtJ8o', 'value': <?php echo $order['total_price']; ?>, 'currency': 'KRW', 'transaction_id': '<?php echo $order['order_id']; ?>' }); </script><?php		
	}
	else if(((strpos($_SERVER['REQUEST_URI'], '/payment/payment_result') !== false || strpos($_SERVER['REQUEST_URI'], '/payment/payment_result_mo_bill') !== false) && !empty($order) && $order['order_type'] === 'subscribe') || strpos($_SERVER['REQUEST_URI'], '/diagnosis/payment_result') !== false || strpos($_SERVER['REQUEST_URI'], '/diagnosis/payment_result_mo_bill') !== false) {
?>
<!-- Event snippet for 구독 conversion page --> 
<script> gtag('event', 'conversion', { 'send_to': 'AW-10803290940/PK4cCLicwo0DELzGtJ8o', 'value': <?php echo $order['total_price']; ?>, 'currency': 'KRW' }); </script>
<?php
	}
	else if(strpos($_SERVER['REQUEST_URI'], '/product/product_detail') !== false) {
?>
<!-- Event snippet for 장바구니에 추가 conversion page In your html page, add the snippet and call gtag_report_conversion when someone clicks on the chosen link or button. --> 
<script> function gtag_report_conversion(url) { var callback = function () { if (typeof(url) != 'undefined') { window.location = url; } }; gtag('event', 'conversion', { 'send_to': 'AW-10803290940/BPShCKat7ZEDELzGtJ8o', 'value': 1.0, 'currency': 'KRW', 'event_callback': callback }); return false; } </script>
<?php		
	}
?>
</head>
<body>
<?php
	if(!empty($subscribe_cnt)) {
?>
<style>
.subscribe_counter_wrap { line-height:80px; background-color:#333; display:block; position:relative; text-align:center; width:100%; z-index : 100;}
.subscribe_counter_wrap span { color:#fff; font-size:20px;font-family: "noto"; margin-right:15px;}
.subscribe_counter_wrap span.subscribe_counter_title {
	color: #fff;
    background-color: #003ca6;
    padding: 10px 20px;
    border-radius: 30px;
    font-size: 20px;
	font-weight:bold;
}
.subscribe_counter_cnt {
	color: #1a6af7 !important;
}
.subscribe_counter_cnt span{
	font-size: 30px;
	color: #1a6af7 !important;
	font-weight: bold;
	font-family: "Noto";
	margin-right:5px !important;
}
.subscribe_counter_wrap button.btn-subscribe-close {
	position: absolute;
    right: 10px;
    top: 0;
    width: 50px;
    height: 80px;
    background: none;
	color:#fff;
}
.subscribe_counter_wrap button.btn-subscribe-close:before{
	content: '';
    position: absolute;
    left: 50%;
    margin-left: -10px;
    top: 50%;
    width: 23px;
    height: 2px;
    background: #fff;
    transform: rotate(45deg);	
}
.subscribe_counter_wrap button.btn-subscribe-close:after{
	content: '';
    position: absolute;
    left: 50%;
    margin-left: -10px;
    top: 50%;
    width: 23px;
    height: 2px;
    background: #fff;
    transform: rotate(-45deg);
}
@media (max-width: 1023px) {
	.subscribe_counter_wrap { line-height:50px; position:fixed; left:0; top:0;}
	.subscribe_counter_wrap span {margin-right:5px;}
	#header .inner.subscribe_cnt {top:50px !important;}
	.main.subscribe_cnt {margin-top:50px}
	.subscribe_counter_wrap span.subscribe_counter_title {
		font-size:10px;
		padding:5px 10px;
		border-radius : 18px;
	}
	.subscribe_counter_wrap span { font-size:12px}
	.subscribe_counter_cnt {
		font-size: 10px;
	}
	.subscribe_counter_cnt span{
		font-size: 14px;
	}
	.subscribe_counter_wrap button.btn-subscribe-close {
		width:40px;
		height:50px;
	    right: -10px;
	}
	.subscribe_counter_wrap button.btn-subscribe-close:before{
		width:14px;
	}
	.subscribe_counter_wrap button.btn-subscribe-close:after{
		width:14px;
	}
}
</style>
<div class="subscribe_counter_wrap" style="display:none">
	<span class="subscribe_counter_title">실시간 클린디</span>
	<span>플랫폼 구독자수</span><span>|</span>
	<span class="subscribe_counter_cnt"><span><?php echo number_format($subscribe_cnt); ?></span>명 구독중</span>
	<button class="btn-subscribe-close"></button>
</div>
<script>
$(document).ready(function(e) {
	$('#header > .inner').removeClass('subscribe_cnt');
	$('.main').removeClass('subscribe_cnt');
    $('.btn-subscribe-close').on('click', function() {
		$('.subscribe_counter_wrap').hide();
		$('#header > .inner').removeClass('subscribe_cnt');
		$('.main').removeClass('subscribe_cnt');
	});
});
</script>
<?php
	}
?>
<div id="header">
	<div class="inner <?php echo !empty($subscribe_cnt) ? 'subscribe_cnt' : ''; ?>">
		<h1><a href="/">clean'd</a></h1>
		<nav id="gnb">
			<ul>
				<li><a href="/main/introduce"><span>클린디</span></a></li>
				<li><a href="/product/product_list"><span>상품</span></a></li>
				<li><a href="/diagnosis"><span>진단</span></a></li>
				<li><a href="/review"><span>리뷰</span></a></li>
				<li><a href="/magazine"><span>커뮤니티</span></a></li>
			</ul>
		</nav>
		<div class="etc">
                    <button type="button" class="btn-login btn-type2 btn_recom pc" data-toggle="modal" data-target="#modalrecommend" style="margin-right:5px">치과추천가입</button>
                    <button type="button" class="btn-ico recom mo" data-toggle="modal" data-target="#modalrecommend" style="margin-right:5px">
                        <em class="tooltip">치과추천가입</em>
                    </button>
		<?php
		if (!empty($mem_userid))
		{
		?>
			<a href="/member/logout" class="btn-login pc">로그아웃</a>
			<a href="/my/home" class="btn-ico my"></a>
			<a href="/cart/cart_list?type=subscribe" class="btn-ico cart"><span><?php echo $cart_cnt; ?></span></a> 
		<?php
		}
		else
		{
		?>
			<a href="/member/login" class="btn-login pc" style="margin-right:5px">로그인</a>
			<a href="/member/join" class="btn-login pc">회원가입</a>
			<a href="/cart/cart_list?type=subscribe" class="btn-ico cart"><span><?php echo $cart_cnt; ?></span></a> 
		<?php	
		}
		?>
			<button class="btn-m"> <span></span> <span></span> <span></span> </button>
		</div>
	</div>
</div>
<!-- // header -->
<div class="m-gnb">
	<div class="head">
		<h1><a href="#">clean'd</a></h1>
		<button class="btn-close"></button>
	</div>
	<div class="welcome">
		<div class="before">
			<?php
			if (!empty($mem_userid))
			{
			?>
				<a href="/member/logout">로그아웃</a>
			<?php
			}
			else
			{
			?>
				<a href="/member/login">로그인</a>
				<a href="/member/join">회원가입</a>
			<?php	
			}
			?>
		</div>
		<!-- // 로그인전 --> 
		<!--
			<div class="after">
				<div class="in">
					<strong><span>김클린</span>님</strong>
					<a href="#" class="btn-logout">로그아웃</a>
				</div>
				<div class="info">
					<div><img src="/res/img/board/img_level_gold.png"> 골드회원</div>
					<dl>
						<dt>포인트</dt>
						<dd>2,560</dd>
					</dl>
					<dl>
						<dt>쿠폰</dt>
						<dd>3<span>개</span></dd>
					</dl>
				</div>
			</div>
			--> 
		<!-- // 로그인후 --> 
	</div>
	<nav>
		<ul>
			<li> <a href="#" class="btn-dep1 flip"><span>클린디</span></a>
				<ul class="dep2">
					<li><a href="/main/introduce" class="btn-dep2">클린디 소개</a></li>
					<li><a href="/main/why" class="btn-dep2">왜 클린디인가?</a></li>
					<li><a href="/main/characteristic" class="btn-dep2">특징 및 구성</a></li>
				</ul>
			</li>
			<li> <a href="#" class="btn-dep1 flip"><span>상품</span></a>
				<ul class="dep2">
					<li><a href="/product/product_list" class="btn-dep2">전체</a></li>
                <?php
					foreach($category as $row) {
						echo '<li><a href="/product/product_list?seq=' . $row['cca_id'] . '" ' . ' class="btn-dep2">' . $row['cca_value'] . '</a></li>';
                    }
				?>
				</ul>
			</li>
			<li> <a href="/diagnosis" class="btn-dep1 "><span>진단</span></a> </li>
			<li> <a href="/review" class="btn-dep1 "><span>리뷰</span></a> </li>
			<li> <a href="#" class="btn-dep1"><span>커뮤니티</span></a>
				<ul class="dep2" style="display: block">
					<li><a href="/magazine" class="btn-dep2">매거진</a></li>
					<li><a href="/event" class="btn-dep2">이벤트</a></li>
					<li><a href="/faq" class="btn-dep2">FAQ</a></li>
					<li><a href="/notice/list" class="btn-dep2">공지사항</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<div class="msg">밝고 자신있게 웃어보세요. <br>
		<strong>클린디</strong>가 응원할게요.</div>
</div>

<div class="modal fade modalrecommend" id="modalrecommend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">치과 추천 가입</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <div class="txt">
              <p>치과에서 클린디를 진단받으셨다면<br>방문치과를 선택해주세요.</p>
              <div class="find_input">
                <div class="inp-box1">
                   <input a="mem_email" type="email" class="inp1" placeholder="방문 치과명 또는 치과 주소를 검색해주세요." style="width:100%">
                   <button type="button" class="btn_seach"></button>
               </div>
               <div a="mem_email" class="alert-msg1">* 치과명이 잘못되었습니다. 다시 입력해주세요</div> <!-- style="display: block;" 넣으면 보임-->
              </div>
          </div>
            <div class="find_list"><!-- .show 클래스 추가시 넣으면 보임-->
                <div class="total_cnt">검색결과 <span class="count">2</span>건</div>
                <ul class="addr_list">
                    <li>
                        <input type="radio" id="addr_01" name="address">
                        <label clas="addrbox" for="addr_01">
                            <span class="name">케이스랩치과</span>
                            <em class="address">서울 강남구 청담동 123-12</em>
                            <a class="tel" href="tel:02-111-2222">02-111-2222</a>
                        </label>
                    </li>
                    <li>
                        <input type="radio" id="addr_02" name="address">
                        <label clas="addrbox" for="addr_02">
                            <span class="name">케이스랩치과22</span>
                            <em class="address">경기도 성남시 행운동 57-12</em>
                            <a class="tel" href="tel:02-111-2222">02-111-2222</a>
                        </label>
                    </li>
                </ul>
            </div>
      </div>
     <div class="modal-footer">
        <button type="button" class="btn btn-type2" data-dismiss="modal">취소</button>
        <a href="/recommend/index" class="btn btn-type1">선택하기</a>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function(e) {
    $('#myModal').on('shown.bs.modal', function () {
      $('#myInput').trigger('focus')
    });
    $('.btn_seach').on('click', function(){
        console.log('aa');
        $(this).parents('.modal-content').addClass('show'); 
    }); 
    
    placeholderText();
});

let wid = $(window).width();
$(window).on('resize', function () {
   placeholderText();
});  
function placeholderText(){
    if(wid >740){
        $('.find_input .inp-box1 input').attr('placeholder','방문 치과명 또는 치과 주소를 검색해주세요.');
    }else if((wid <740)){
        $('.find_input .inp-box1 input').attr('placeholder','치과명이나 치과 주소를 검색해주세요.');
        
    }
};
</script>
    