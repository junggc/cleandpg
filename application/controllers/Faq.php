<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CD_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('common');
		$this->load->model('faq_m');
		$this->load->model('common_m');
	}

	public function index()
	{
		$this->data['category'] = $this->common_m->board_category_list('faq')->result_array();
		$this->load->view('header_v', $this->data);
		$this->load->view('faq/faq_v');
		$this->load->view('footer_v');
	}

	public function ajaxFaqList()
	{
		$req = $this->input->post();

		$perpage = 10;
		$offset = (int)$req['offset'];
		$total_rows = $this->faq_m->faq_list_cnt($req);

		$config = array();
		$config['base_url'] = '';
		$config['total_rows'] = $total_rows;
		$config['perpage'] = $perpage;
		$config['offset'] = $offset;
		$config['num_links'] = 5;
		$pagination = $this->common->pagination($config);
			
		$list = $this->faq_m->faq_list($req, $offset, $perpage)->result_array();
		for($i = 0; $i < count($list); $i++) {
			$list[$i]['files'] = $this->common_m->file_list('faq', $list[$i]['faq_id'])->result_array();
		}
		$offset += $perpage;
		$this->data['offset'] = $offset;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
		$this->data['pagination'] = $pagination;
			
		echo json_encode($this->data);
	}
}
