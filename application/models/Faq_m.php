<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq_m extends CI_Model 
{
	public function __construct()
	{
        parent::__construct();		
		$this->load->database();
	}

	public function faq_list($req, $offset, $perpage) {
		$sql = "SELECT
					t1.faq_id
					, t1.cbc_id
					, ifnull(t2.cbc_name, '') as cbc_name
					, ifnull(t2.is_show, '') as cbc_is_show
					, t1.faq_title
					, t1.faq_content
					, t1.order_no
					, t1.is_show
					, date_format(t1.ins_dtm, '%Y-%m-%d %H:%i') as ins_dtm
					, date_format(t1.upd_dtm, '%Y-%m-%d %H:%i') as upd_dtm
				FROM
					cmall_board_faq t1
				LEFT OUTER JOIN cmall_board_category t2 on t2.cbc_id = t1.cbc_id and t2.is_delete = 'n'
				WHERE
					t1.is_delete = 'n' 
					AND t1.is_show = 'y' ";
		if(!empty($req['searchText'])) {
			$sql .= " AND (t1.faq_title LIKE '%" . $req['searchText']	 . "%' OR t1.faq_content LIKE '%" . $req['searchText'] . "%') ";
		}
		if(!empty($req['cbc_id'])) {
			$sql .= " AND t1.cbc_id IN (" . $req['cbc_id'] . ") ";	
		}
		$sql .= "ORDER BY t1.order_no
				LIMIT ?, ? ";

		return $this->db->query($sql, array($offset, $perpage));
	}

	public function faq_list_cnt($req) {
		$sql = "SELECT
					count(*) as cnt
				FROM
					cmall_board_faq t1
				LEFT OUTER JOIN cmall_board_category t2 on t2.cbc_id = t1.cbc_id and t2.is_delete = 'n'
				WHERE
					t1.is_delete = 'n' 
					AND t1.is_show = 'y' ";
		if(!empty($req['searchText'])) {
			$sql .= " AND (t1.faq_title LIKE '%" . $req['searchText']	 . "%' OR t1.faq_content LIKE '%" . $req['searchText'] . "%') ";
		}
		if(!empty($req['cbc_id'])) {
			$sql .= " AND t1.cbc_id IN (" . $req['cbc_id'] . ") ";	
		}

		$tmp = $this->db->query($sql, array())->row_array();
		return $tmp['cnt'];
	}
	
}