<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Qa_m extends CI_Model 
{
	public function __construct()
	{
        parent::__construct();		
		$this->load->database();
	}

	public function qa_list($seq, $offset, $perpage)
	{
		$sql = "select
					t1.*
					, (select count(*) from cmall_file a where a.parent_gbn = 'qna' and a.parent_cd = t1.cqa_id and a.is_delete = 'n') as file_cnt
				from
					cmall_board_qna t1
				where
					t1.mem_id = ? 
					and t1.is_delete = 'n' 
				order by t1.cqa_dtm desc 
				limit ?, ?";
		return $this->db->query($sql, array($seq, $offset, $perpage));
	}
	
	public function qa_list_cnt($seq)
	{
		$sql = "select
					count(*) as cnt
				from
					cmall_board_qna t1
				where
					t1.mem_id = ? 
					and t1.is_delete = 'n' ";

		$tmp = $this->db->query($sql, array($seq))->row_array();
		return $tmp['cnt'];
	}

	public function qa_detail($seq)
	{
		$sql = "select
					t1.*
				from
					cmall_board_qna t1
				where
					t1.cqa_id = ? 
					and t1.is_delete = 'n' ";
		return $this->db->query($sql, array($seq));
	}

	public function insert_qa($val)
	{
		$this->db->set('cqa_dtm', 'now()', false);
		$this->db->insert('cmall_board_qna', $val);
		return $this->db->insert_id();	
	}

	public function update_qa($seq, $val)
	{
		$this->db->where('cqa_id', $seq);
		$this->db->update('cmall_board_qna', $val);
	}
}