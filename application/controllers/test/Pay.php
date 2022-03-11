<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pay extends CI_Controller 
{	
	public function __construct() 
	{	
		parent::__construct();
	}
	
	public function bill_test()
	{
		require_once('application/third_party/inicis/INIStdPayUtil.php');
		$SignatureUtil = new INIStdPayUtil();
			
//8d1e7dfd3da234827290fc2a2a275bf51609f295e1622959788cfd0e7428ae1fbc0c19d8398f21c58bde0bdae9ab141e85dd57c45a92bbe84fb17edb7a222725
//8d1e7dfd3da234827290fc2a2a275bf51609f295e1622959788cfd0e7428ae1fbc0c19d8398f21c58bde0bdae9ab141e85dd57c45a92bbe84fb17edb7a222725
		$timestamp = date("YmdHis");   
		$order_id = 'CDA' . $SignatureUtil->getTimestamp();
		$ip = '118.67.134.168';
		$billKey = '0ad8a79b3b566ee37fa0823e643cb25204839626';
		$price = '1000';
		$type = 'Billing';
		$paymethod = 'Card';

		$params = array(
						'type' => $type,
						'paymethod' => $paymethod,
						'timestamp' => $timestamp,
						'clientIp' => $ip,
						'mid' => MIDB,
						'url' => 'http://dev.cleand.kr',
						'moid' => $order_id,
						'goodName' => '테스트상품',
						'buyerName' => '전준형',
						'buyerEmail' => 'jj@appdr.com',
						'buyerTel' => '01027584305',
						'price' => $price,
						'billKey' => $billKey,
						'authentification' => '00',
						'hashData' => hash('sha512', INI_API_KEY.$type.$paymethod.$timestamp.$ip . MIDB . $order_id.$price . $billKey)
						);

		$ch = curl_init();                                 //curl 초기화
		curl_setopt($ch, CURLOPT_URL, BILL_URL);               //URL 지정하기
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    //요청 결과를 문자열로 반환 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);      //connection timeout 10초 
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);   //원격 서버의 인증서가 유효한지 검사 안함
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=utf-8'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));       //POST data
		curl_setopt($ch, CURLOPT_POST, 1);              //true시 post 전송 
		 
		$response = curl_exec($ch);
		
		$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
		$header = substr($response, 0, $header_size);
		$body = substr($response, $header_size);
		print_r($body);
		$result = json_decode($body);

		curl_close($ch);
		print_r($result);
		echo '<br><br>' . $result->resultCode;
	}
}
