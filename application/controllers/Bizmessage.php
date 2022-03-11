<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bizmessage extends CD_Controller{

	function __construct(){
		parent::__construct();

		$this->load->model('common_m');
	}

	public function test_bizmessage()
	{
		list($microtime,$timestamp) = explode(' ',microtime());
		$time = $timestamp.substr($microtime, 2, 3);
		
		$id = '50061';
		$msg = '[[클린디]]
안녕하세요. [NAME]님

문의하신 내용에 답변이 등록되었습니다.
감사합니다^^


▷ 클린디 바로가기
https://www.cleand.kr
고객센터
(070-4610-5057)';
		$msg = '[[클린디]]
[NAME]님, 맞춤덴탈케어 클린디 정기구독이 신청되었습니다.

- 수취인 : 테스터
- 배송지 : 서울시 강남구 양재역
- 클린디 제품 : 
칫솔 (L 블루) / 3
- 주문번호 : CD111111111

이번 달부터 건강하게 배송하겠습니다.

※ 평일 기준으로 2~3일 이내 도착합니다. (택배사 사정에 따라 다소 달라질 수 있습니다.)';
		$msg = '[[클린디]]
안녕하세요. [NAME]님
주문하신 클린디 상품이 발송 되었습니다.

배송일로부터 상품수령까지 약 2일~3일 소요되며, 택배사 사정에 의해 지연될 수 있습니다.

■ 주문번호: [ODERID]
■ 송장정보: 롯데택배/[DELINUM]
■ 배송조회: [URL]'; 

		$messages = array();
		
		$message = array();
		$message['no'] = '0';
		$message['tel_num'] = '01027584305';
		$message['custom_key'] = $time . '000';
		$message['msg_content'] = $msg;
		$message['sms_content'] = $msg;
		$message['use_sms'] = '1';
		$message['btn_url'] = array();
		$button = array();
		$button['url_pc'] = 'https://www.cleand.kr/my/order/order_list';
		$button['url_mobile'] = 'https://www.cleand.kr/my/order/order_list';
		$message['btn_url'][] = $button; 
		$messages[] = $message;

		$this->sendBizMessage($id, $messages);
	}
	
	public function result()
	{
		$req = $this->input->post();
		$post = json_decode(file_get_contents('php://input'));

		$this->common_m->insert_bizmessage_result($post);
			
	}
	
}