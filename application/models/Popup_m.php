<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popup_m extends CI_Model 
{
	public function __construct()
	{
        parent::__construct();		
		$this->load->database();
	}

	public function popup_list() {
		$sql = "select
					t1.spp_id
					, t1.popup_title
					, t1.img_url
					, t1.link_url
					, t1.link_type
					, t1.pos_x
					, t1.pos_y
					, t1.start_date
					, t1.end_date
					, t1.is_use
					, t1.is_delete
					, date_format(t1.ins_dtm, '%Y-%m-%d %H:%i') as ins_dtm
					, date_format(t1.upd_dtm, '%Y-%m-%d %H:%i') as upd_dtm
					, (select concat(FN_DECRYPT(a.mem_username), ' (' , FN_DECRYPT(a.mem_email) , ')') from `member` a where a.mem_id = t1.ins_user) as ins_user_name
					, (select concat(FN_DECRYPT(a.mem_username), ' (' , FN_DECRYPT(a.mem_email) , ')') from `member` a where a.mem_id = t1.upd_user) as upd_user_name
				from
					shop_popup t1
				where
					t1.is_delete = 'n' 
					and t1.is_use = 'y'
					and date_format(now(), '%Y-%m-%d') between t1.start_date and t1.end_date ";
		return $this->db->query($sql, array());
	}
	
}