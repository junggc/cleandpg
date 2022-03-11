<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_l
{
	public function __construct() 
	{
//		parent::__construct();
	}
	
	public function email_send($from, $name, $to, $subject, $message) 
	{
		$CI =& get_instance();
		
		$config = [];
		$config['protocol'] = 'smtp';
		$config['smtp_crypto'] = 'ssl';
//		$config['smtp_crypto'] = 'tls';
//		$config['smtp_host'] = 'smtpout.asia.secureserver.net';
		$config['smtp_host'] = 'smtp.gmail.com';
		$config['smtp_port'] = 465;
//		$config['smtp_port'] = 587;
		$config['smtp_user'] = 'help@cleand.kr';
//		$config['smtp_pass'] = 'cLLndd!21';
		$config['smtp_pass'] = 'yvxhwvjqqukpzokw';
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
//		$this->load->library('email', $config);
		$CI->load->library('email', $config);
		
//		$this->email->from($from, $name);
//		$this->email->to($to);
//		$this->email->subject($subject);
//		$this->email->message($message);	
		$CI->email->from($from, $name);
		$CI->email->to($to);
		$CI->email->subject($subject);
		$CI->email->message($message);	
		
		return $CI->email->send();
	}
}
