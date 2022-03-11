<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recommend extends CD_Controller 
{
        public function index()
	{
                $this->load->view('header_v', $this->data);
		$this->load->view('recommend/index'); 
		$this->load->view('footer_v');
	}
        
        public function recommend_subscribe()
	{
                $this->load->view('header_v', $this->data);
		$this->load->view('recommend/recommend_subscribe'); 
		$this->load->view('footer_v');
	}
        public function recommend_calendar()
	{
                $this->load->view('header_v', $this->data);
		$this->load->view('recommend/recommend_calendar'); 
		$this->load->view('footer_v');
	}
}
