<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice extends CD_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('common');
		$this->load->model('notice_m');
		$this->load->model('common_m');
	}

	public function list()
	{
		$req = $this->input->post();

		$perpage = 10;
		$offset = (int)$this->uri->segment('3', 0);
		$total_rows = $this->notice_m->notice_list_cnt();

		$config = array();
		$config['base_url'] = '/notice/list';
		$config['total_rows'] = $total_rows;
		$config['perpage'] = $perpage;
		$config['offset'] = $offset;
		$config['num_links'] = 5;
		$pagination = $this->common->pagination($config);
			
		$list = $this->notice_m->notice_list($offset, $perpage)->result_array();
		$this->data['offset'] = $offset;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['pagination'] = $pagination;

		$this->load->view('header_v', $this->data);
		$this->load->view('notice/notice_v');
		$this->load->view('footer_v');
	}

	public function detail()
	{
		$req = $this->input->get();

		$perpage = 10;
		$offset = (int)$this->uri->segment('3', 0);
		$info = $this->notice_m->notice_detail($req['seq'], $offset, $perpage);
		if(empty($info)) {
			header('Location: /notice');
		}
		else {
			$info['files'] = $this->common_m->file_list('notice', $req['seq'])->result_array();
			
			$this->data['info'] = $info;
			$this->data['offset'] = $this->uri->segment('3', 0);
			$this->load->view('header_v', $this->data);
			$this->load->view('notice/notice_detail_v');
			$this->load->view('footer_v');
		}
	}
}
