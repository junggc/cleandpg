<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CD_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');	
		$this->load->library('object_storage');
		$this->load->library('common');
		$this->load->model('order_m');
		$this->load->model('member_m');
		$this->load->model('subscribe_m');
		$this->load->model('diagnosis_m');
	}
	
	public function index()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$offset = 0;
			$perpage = 2;
			$this->data['top'] = $this->member_m->member_info_for_home($this->data['user']['mem_id'])->row_array();
			$req['mem_id'] = $this->data['user']['mem_id'];
			$req['order_status'] = 'order';
			$this->data['order'] = $this->order_m->order_list($req, $offset, $perpage)->result_array();
			$this->data['subscribe'] = $this->subscribe_m->subscribe_list_all($req)->result_array();
			$diagnosis = $this->diagnosis_m->diagnosis_list($this->data['user'], 0, 3)->result_array();
			for($i = 0; $i < count($diagnosis); $i++) {
				$item = array();
				$item[] = $diagnosis[$i]['brush_shape_name'];
				
				if($diagnosis[$i]['is_concern'] == '1') {
					$item[] = '활짝100g';
				}
				else if($diagnosis[$i]['is_concern'] == '2') {
					$item[] = '살짝100g';
				}
				else if($diagnosis[$i]['is_concern'] == '3') {
					$item[] = '달짝100g';
				}
				else if($diagnosis[$i]['is_concern'] == '4') {
					$item[] = '반짝90g';	
				}
				
				$diagnosis[$i]['items'] = $this->diagnosis_m->diagnosis_list_item($item)->result_array();
			}
			
			$this->data['diagnosis'] = $diagnosis;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/home_v');
			$this->load->view('footer_v');
		}
	}
}
