<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CD_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');	
		$this->load->library('object_storage');
		$this->load->library('common');
		$this->load->model('point_m');
		$this->load->model('coupon_m');
		$this->load->model('member_m');
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
			
			$info = $this->member_m->member_info($this->data['user']['mem_id'])->row_array();
			$points = $this->point_m->point_list($this->data['user'], $offset, $perpage)->result_array();
			$points_cnt = $this->point_m->point_list_cnt($this->data['user']);
			$diagnosis = $this->diagnosis_m->diagnosis_list($this->data['user'], $offset, $perpage)->result_array();
			$diagnosis_cnt = $this->diagnosis_m->diagnosis_list_cnt($this->data['user']);
			$coupon = $this->coupon_m->coupon_list($this->data['user'], $offset, $perpage)->result_array();
			$coupon_cnt = $this->coupon_m->coupon_list_cnt($this->data['user']);


			$this->data['info'] = $info;
			$this->data['points'] = $points;
			$this->data['points_cnt'] = $points_cnt;
			$this->data['diagnosis'] = $diagnosis;
			$this->data['diagnosis_cnt'] = $diagnosis_cnt;
			$this->data['coupon'] = $coupon;
			$this->data['coupon_cnt'] = $coupon_cnt;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/survey/survey_v');
			$this->load->view('footer_v');
		}
	}

	public function point_list()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$req['mem_id'] = $this->data['user']['mem_id'];
			$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 10);
			$offset = (int)$this->uri->segment(4, 0);
			$total_rows = $this->point_m->point_list_cnt($req);;
			$num = $total_rows - $offset;

			$config = array();
			$config['base_url'] = '/my/survey/point_list/';
			$config['total_rows'] = $total_rows;
			$config['perpage'] = $perpage;
			$config['offset'] = $offset;
			$config['num_links'] = 5;
			$pagination = $this->common->pagination($config);
	
			$info = $this->member_m->member_info($this->data['user']['mem_id'])->row_array();
			$list = $this->point_m->point_list($req, $offset, $perpage)->result_array();

			$this->data['info'] = $info;
			$this->data['list'] = $list;
			$this->data['total'] = $total_rows;
			$this->data['offset'] = $offset;
			$this->data['perpage'] = $perpage;
			$this->data['pagination'] = $pagination;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/survey/point_list_v');
			$this->load->view('footer_v');
		}
	}

	public function coupon_list()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$req['mem_id'] = $this->data['user']['mem_id'];
			$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 10);
			$offset = (int)$this->uri->segment(4, 0);
			$total_rows = $this->coupon_m->coupon_list_cnt($this->data['user']);

			$config = array();
			$config['base_url'] = '/my/survey/coupon_list/';
			$config['total_rows'] = $total_rows;
			$config['perpage'] = $perpage;
			$config['offset'] = $offset;
			$config['num_links'] = 5;
			$pagination = $this->common->pagination($config);
	
			$list = $this->coupon_m->coupon_list($this->data['user'], $offset, $perpage)->result_array();

			$this->data['list'] = $list;
			$this->data['total'] = $total_rows;
			$this->data['offset'] = $offset;
			$this->data['perpage'] = $perpage;
			$this->data['pagination'] = $pagination;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/survey/coupon_list_v');
			$this->load->view('footer_v');
		}
	}

	public function coupondown_list()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$req['mem_id'] = $this->data['user']['mem_id'];
			$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 10);
			$offset = (int)$this->uri->segment(4, 0);
			$total_rows = $this->coupon_m->coupon_down_list_cnt($this->data['user']);

			$config = array();
			$config['base_url'] = '/my/survey/coupon_list/';
			$config['total_rows'] = $total_rows;
			$config['perpage'] = $perpage;
			$config['offset'] = $offset;
			$config['num_links'] = 5;
			$pagination = $this->common->pagination($config);
	
			$list = $this->coupon_m->coupon_down_list($this->data['user'], $offset, $perpage)->result_array();

			$this->data['list'] = $list;
			$this->data['total'] = $total_rows;
			$this->data['offset'] = $offset;
			$this->data['perpage'] = $perpage;
			$this->data['pagination'] = $pagination;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/survey/coupondown_list_v');
			$this->load->view('footer_v');
		}
	}

	public function diagnosis_list()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$req['mem_id'] = $this->data['user']['mem_id'];
			$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 10);
			$offset = (int)$this->uri->segment(4, 0);
			$total_rows = $this->diagnosis_m->diagnosis_list_cnt($req);

			$config = array();
			$config['base_url'] = '/my/survey/diagnosis_list/';
			$config['total_rows'] = $total_rows;
			$config['perpage'] = $perpage;
			$config['offset'] = $offset;
			$config['num_links'] = 5;
			$pagination = $this->common->pagination($config);
	
			$list = $this->diagnosis_m->diagnosis_list($req, $offset, $perpage)->result_array();

			$this->data['list'] = $list;
			$this->data['total'] = $total_rows;
			$this->data['offset'] = $offset;
			$this->data['perpage'] = $perpage;
			$this->data['pagination'] = $pagination;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/survey/diagnosis_list_v');
			$this->load->view('footer_v');
		}
	}
	
	public function ajaxCouponDownload()
	{
		$req = $this->input->post();
		
		$req['mem_id'] = $this->data['user']['mem_id'];
		$req['mem_email'] = $this->data['user']['mem_email'];
		
		$res = $this->coupon_m->coupon_download($req);
		$result = array();
		if($res) {
			$result['status'] = 'succ';
			$result['msg'] = '다운로드 했습니다.';
		}
		else {
			$result['status'] = 'fail';
			$result['msg'] = '다운로드에 실패했습니다.';
		}
		echo json_encode($result);
	}
}
