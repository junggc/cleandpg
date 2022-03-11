<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CD_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('event_m');
	}

	public function index()
	{
		$this->load->view('header_v', $this->data);
		$this->load->view('event/event_v');
		$this->load->view('footer_v');
	}

	public function ajaxEventList()
	{
		$req = $this->input->post();
		$perpage = 6;

		$offset = (int)$req['offset'];
		$list = $this->event_m->event_list($req, $offset, $perpage)->result_array();
		$total_rows = $this->event_m->event_list_cnt($req);
		$offset += $perpage;
		$this->data['perpage'] = $perpage;
		$this->data['offset'] = $offset;
		$this->data['list'] = $list;
		$this->data['total_rows'] = $total_rows;
			
		echo json_encode($this->data);
	}
	
	public function detail()
	{
		$req = $this->input->get();
		
		$this->data['info'] = $this->event_m->event_detail($req['seq']);
		if(empty($this->data['info'])) {
			header('Location: /event');
		}
		else {
			$this->load->view('header_v', $this->data);
			$this->load->view('event/event_detail_v');
			$this->load->view('footer_v');
		}
	}
}
