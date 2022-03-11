<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends CD_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');	
		$this->load->library('object_storage');
		$this->load->model('review_m');
	}
	
	public function index()
	{
		$this->load->view('header_v', $this->data);
		$this->load->view('review/review_v');
		$this->load->view('footer_v');
	}

	public function ajaxReviewAll()
	{
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 5);
		$offset = (int)$req['offset'];
		$list = $this->review_m->review_list_all($req['only_photo'], $offset, $perpage)->result_array();
		$offset += $perpage;
		$this->data['perpage'] = $perpage;
		$this->data['offset'] = $offset;
		$this->data['list'] = $list;
		
		echo json_encode($this->data);
	}

	public function ajaxReviewProduct()
	{
		$req = $this->input->post();

		$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 5);
		$offset = (int)$req['offset'];
		$list = $this->review_m->review_list_product($req['cit_id'], $req['only_photo'], $offset, $perpage)->result_array();
		$offset += $perpage;
		$this->data['perpage'] = $perpage;
		$this->data['offset'] = $offset;
		$this->data['list'] = $list;
		
		echo json_encode($this->data);
	}
}
