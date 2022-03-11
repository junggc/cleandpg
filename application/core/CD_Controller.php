<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CD_Controller extends CI_Controller
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();

		$this->load->model('product_m');
		$this->load->model('cart_m');
		$this->load->model('common_m');
		if(XenoPostToForm::check()) XenoPostToForm::submit($_POST); // session_start(); 하기 전에

		$this->load->library('session');
//		if(strpos($this->uri->segment(2), 'ajax') === false)
//		{
			$this->data['user'] = $this->session->userdata('user');
			$this->data['mem_userid'] = $this->session->userdata('mem_userid');
			
			$category = $this->session->userdata('category');
			if(empty($category)) {
				$category = $this->product_m->category_list()->result_array();
				$this->session->set_userdata('category', $category);
			}
			$this->data['category'] = $category;
			
			if(!empty($this->data['user']['mem_id'])) {
				$this->data['cart_cnt'] = $this->cart_m->cart_cnt($this->data['user']['mem_id']);
			}
			else {
				$cart = $this->session->userdata('cart');
				$this->data['cart_cnt'] = empty($cart) ? '0' : count($cart);
			}

			
				$this->session->set_userdata('shop', '');
			$shop = $this->session->userdata('shop');
			if(empty($shop)) {
				$shop = $this->common_m->shop_info2()->row_array();
				$this->session->set_userdata('shop', $shop);
			}
			$this->data['shop'] = $shop;
			
			$this->data['base_url'] = 'https://' . $_SERVER['HTTP_HOST'];
//		}
	}

	public function pagination2($num_links = 3)
	{
		$config = array();
												
										
		$config['num_links'] = $num_links;
		$config['full_tag_open'] = '';
		$config['full_tag_close'] = '';
		$config['first_link'] = '<button class="ab_prev_all">맨처음으로</button>';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';	
		$config['last_link'] = '<button class="ab_next_all">맨마지막으로</button>';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '';	
		$config['next_link'] = '<button class="ab_next">다음페이지</button>';
		$config['next_tag_open'] = '';
		$config['next_tag_close'] = '';
		$config['prev_link'] = ' <button class="ab_prev">이전페이지</button>';
		$config['prev_tag_open'] = '';
		$config['prev_tag_close'] = '';
		$config['cur_tag_open'] = '<a href="javascript:;" class="on">';
		$config['cur_tag_close'] = '</a>';	
		$config['num_tag_open'] = '';
		$config['num_tag_close'] = '';
		return $config;
	}
	
	public function sendBizMessage($id, $message)
	{
		$body = array();
		$body['userid'] = 'cleand';
		$body['api_key'] = 'd7m71daatwx1vjgnng3l20edamjfzpi83pe29gzp';
		$body['template_id'] = $id;
		$body['messages'] = $message;

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

		curl_close($ch);
		$result = json_decode(urldecode($res));

		$this->load->model('common_m');
		$this->common_m->insert_bizmessage($body, $result);
	}
	
}

class XenoPostToForm
{
	public static function check() {
		return !isset($_COOKIE['PHPSESSID']) && count($_POST) && isset($_SERVER['HTTP_REFERER']) && !preg_match('~^https://'.preg_quote($_SERVER['HTTP_HOST'], '~').'/~', $_SERVER['HTTP_REFERER']);
	}

	public static function submit($posts) {
		echo '<html><head><meta charset="UTF-8"></head><body>';
		echo '<form id="f" name="f" method="post">';
		echo self::makeInputArray($posts);
		echo '</form>';
		echo '<script>';
				echo 'document.f.submit();';
				echo '</script></body></html>';
		exit;
	}

	public static function makeInputArray($posts) {
		$res = [];
		foreach($posts as $k => $v) {
			$res[] = self::makeInputArray_($k, $v);
		}
		return implode('', $res);
	}

	private static function makeInputArray_($k, $v) {
		if(is_array($v)) {
			$res = [];
			foreach($v as $i => $j) {
				$res[] = self::makeInputArray_($k.'['.htmlspecialchars($i).']', $j);
			}
			return implode('', $res);
		}
		return '<input type="hidden" name="'.$k.'" value="'.htmlspecialchars($v).'" />';
	}
}
