<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_m extends CI_Model 
{
	public function __construct()
	{
        parent::__construct();		
		$this->load->database();
	}

	public function email_list() {
		return $this->db->get('shop_email');
	}

	public function email_detail($code) {
		$this->db->where('mail_code', $code);
		$this->db->where('is_use', 'y');
		return $this->db->get('shop_email');
	}
	
	public function email_insert($to_email, $title, $html)
	{
		$this->db->set('to_email', $to_email);
		$this->db->set('mail_title', $title);
		$this->db->set('mail_content', $html);
		$this->db->set('is_send', 'n');
		$this->db->set('ins_dtm', 'now()', false);
		$this->db->set('upd_dtm', 'now()', false);
		$this->db->insert('shop_send_mail');
	}
}