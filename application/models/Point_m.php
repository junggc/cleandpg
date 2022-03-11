<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Point_m extends CI_Model 
{
	public function __construct()
	{
        parent::__construct();		
		$this->load->database();
	}

	public function point_list($req, $offset, $perpage)
	{
		$sql = "SELECT
					t1.point_type
					, t1.point_val
					, t1.point_dir
					, date_format(t1.ins_dtm, '%Y/%m/%d %H:%i') as ins_dtm
					, if(t2.exp_dtm is null, '-', date_format(t2.exp_dtm, '%Y/%m/%d')) as exp_dtm
				FROM
					member_point_log t1
				LEFT OUTER JOIN member_point t2 on t2.mpo_id = t1.mpo_id
				WHERE
					t1.mem_id = ?  
				ORDER BY t1.ins_dtm desc
				LIMIT ?, ? ";
		return $this->db->query($sql, array($req['mem_id'], $offset, $perpage));
	}

	public function point_list_cnt($req)
	{
		$sql = "SELECT
					count(*) as cnt
				FROM
					member_point_log t1
				LEFT OUTER JOIN member_point t2 on t2.mpo_id = t1.mpo_id
				WHERE
					t1.mem_id = ?  ";
		$tmp = $this->db->query($sql, array($req['mem_id']))->row_array();
		return $tmp['cnt'];
	}
}
