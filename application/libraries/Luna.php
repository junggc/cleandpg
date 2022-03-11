<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Luna 
{
	public function sendMessage($id, $message)
	{
		$body = array();
//		$body['userid'] = 'lunasoft';
//		$body['api_key'] = 'key_1234';

		$body['userid'] = 'cleand';
		$body['api_key'] = 'd7m71daatwx1vjgnng3l20edamjfzpi83pe29gzp';
		$body['template_id'] = $id;
		$body['messages'] = $message;
echo '<pre>';
print_r($body);		
		$url = 'https://jupiter.lunasoft.co.kr/api/AlimTalk/message/send';

		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
//		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body)); 
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$res = curl_exec($ch);
		echo $res;
		curl_close($ch);
$result = json_decode(urldecode($res));
print_r($result);
		$this->load->model('common_m');
//		$this->common_m->insert_bizmessage($message, $res);
	}
}
