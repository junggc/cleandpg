<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller 
{	
	public function __construct() 
	{	
		parent::__construct();
		
		$this->load->library('email_l');
	}
	
	public function email_send()
	{
		echo $res = $this->email_l->email_send('test@test.com', 'test', 'ccnp.rjh@gmail.com', '제목 test', '내용 test');
//		print_r($res);
	}
}
