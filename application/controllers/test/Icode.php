<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Icode extends CI_Controller 
{	
	public function __construct() 
	{	
		parent::__construct();
		
		$this->load->library('icode_l');
	}
	
	public function sms_send()
	{
		$res = $this->icode_l->sms_send(['01090428238'], '테스트 ' . mt_rand());
		print_r($res);
	}
}
