<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_m extends CI_Model 
{
	public function __construct()
	{
        parent::__construct();		
		$this->load->database();
	}

	public function order_list($seq)
	{
		$sql = "SELECT
					TB1.*
				FROM
				(
					select
						t1.cod_id
						, t1.order_id
						, t1.cit_name
						, t1.cde_title
						, t1.cit_id
						, t2.cde_filename
						, ifnull(t3.cre_id, 'n') as cre_id
						, ifnull(t5.cit_file_1, '') as cit_file_1
						, ifnull(t5.cit_file_2, '') as cit_file_2
						, ifnull(t5.cit_file_3, '') as cit_file_3
						, ifnull(t5.cit_file_4, '') as cit_file_4
						, ifnull(t5.cit_file_5, '') as cit_file_5
						, ifnull(t5.cit_file_6, '') as cit_file_6
						, ifnull(t5.cit_file_7, '') as cit_file_7
						, ifnull(t5.cit_file_8, '') as cit_file_8
						, ifnull(t5.cit_file_9, '') as cit_file_9
						, ifnull(t5.cit_file_10, '') as cit_file_10
					from
						cmall_order_detail t1
					inner join cmall_order t4 on t4.order_id = t1.order_id
					inner join cmall_item t5 on t5.cit_id = t1.cit_id
					inner join cmall_item_detail t2 on t2.cde_id = t1.cde_id and t2.cit_id = t1.cit_id
					left outer join cmall_review t3 on t3.order_id = t1.order_id and t3.cod_id = t1.cod_id
					where
						t4.mem_id = ? 
						and t4.status = 'COMPLETE'
						and t4.order_type != 'subscribe'
				) TB1
				WHERE
					TB1.cre_id = 'n'	
				";
		return $this->db->query($sql, array($seq));
	}

	public function order_list2($seq)
	{
		$sql = "SELECT
					TB1.*
				FROM
				(
					select
						t1.cod_id
						, t1.order_id
						, t1.cit_name
						, t1.cit_id
						, t1.cde_title
						, t2.cde_filename
						, ifnull(t3.cre_id, 'n') as cre_id
						, ifnull(t5.cit_file_1, '') as cit_file_1
						, ifnull(t5.cit_file_2, '') as cit_file_2
						, ifnull(t5.cit_file_3, '') as cit_file_3
						, ifnull(t5.cit_file_4, '') as cit_file_4
						, ifnull(t5.cit_file_5, '') as cit_file_5
						, ifnull(t5.cit_file_6, '') as cit_file_6
						, ifnull(t5.cit_file_7, '') as cit_file_7
						, ifnull(t5.cit_file_8, '') as cit_file_8
						, ifnull(t5.cit_file_9, '') as cit_file_9
						, ifnull(t5.cit_file_10, '') as cit_file_10
					from
						cmall_order_detail t1
					inner join cmall_order t4 on t4.order_id = t1.order_id
					inner join cmall_item t5 on t5.cit_id = t1.cit_id
					inner join cmall_item_detail t2 on t2.cde_id = t1.cde_id and t2.cit_id = t1.cit_id
					left outer join cmall_review t3 on t3.order_id = t1.order_id and t3.cod_id = t1.cod_id
					where
						t4.order_id = ? 
				) TB1
				WHERE
					TB1.cre_id = 'n'	
				";
		return $this->db->query($sql, array($seq));
	}

	public function review_list($seq, $offset, $perpage)
	{
		$sql = "select
					t1.cre_id
					, t1.cre_content
					, CASE WHEN LENGTH(t1.cre_content) > 80 THEN concat(left(t1.cre_content, 80), '...')
						ELSE t1.cre_content END  as cre_title
					, date_format(t1.ins_dtm, '%Y/%m/%d') as ins_dtm
					, t1.cre_score
					, ifnull(t1.img_file1, '') as img_file1
					, ifnull(t1.img_file2, '') as img_file2
					, ifnull(t1.img_file3, '') as img_file3
					, ifnull(t1.img_file4, '') as img_file4
					, ifnull(t1.img_file5, '') as img_file5
					, ifnull(t1.img_file6, '') as img_file6
					, ifnull(t1.img_file7, '') as img_file7
					, ifnull(t1.img_file8, '') as img_file8
					, ifnull(t1.img_file9, '') as img_file9
					, ifnull(t1.img_file10, '') as img_file10
					
					, ifnull(t5.cit_file_1, '') as cit_file_1
					, ifnull(t5.cit_file_2, '') as cit_file_2
					, ifnull(t5.cit_file_3, '') as cit_file_3
					, ifnull(t5.cit_file_4, '') as cit_file_4
					, ifnull(t5.cit_file_5, '') as cit_file_5
					, ifnull(t5.cit_file_6, '') as cit_file_6
					, ifnull(t5.cit_file_7, '') as cit_file_7
					, ifnull(t5.cit_file_8, '') as cit_file_8
					, ifnull(t5.cit_file_9, '') as cit_file_9
					, ifnull(t5.cit_file_10, '') as cit_file_10
					, t2.cit_name
					, t2.cde_title
					, t2.cit_id
					, t3.cde_filename
				from
					cmall_review t1
				inner join cmall_order_detail t2 on t2.order_id = t1.order_id and t2.cod_id = t1.cod_id
				inner join cmall_item_detail t3 on t3.cde_id = t2.cde_id
					inner join cmall_item t5 on t5.cit_id = t2.cit_id
				where
					t1.mem_id = ? 
					and t1.is_block = 'n'
					and t1.is_delete = 'n' 
				order by t1.ins_dtm desc 
				limit ?, ?";
		return $this->db->query($sql, array($seq, $offset, $perpage));
	}

	public function review_list_cnt($seq)
	{
		$sql = "select
					count(*) as cnt
				from
					cmall_review t1
				inner join cmall_order_detail t2 on t2.order_id = t1.order_id and t2.cod_id = t1.cod_id
				inner join cmall_item_detail t3 on t3.cde_id = t2.cde_id
				where
					t1.mem_id = ? 
					and t1.is_block = 'n'
					and t1.is_delete = 'n' ";
		$tmp = $this->db->query($sql, array($seq))->row_array();
		return $tmp['cnt'];
	}
	
	public function review_list_all($only_photo, $offset, $perpage)
	{
		$sql = "select
					t1.cre_id
					, t1.cre_content
					, CASE WHEN LENGTH(t1.cre_content) > 80 THEN concat(left(t1.cre_content, 80), '...')
						ELSE t1.cre_content END  as cre_title
					, date_format(t1.ins_dtm, '%Y/%m/%d') as ins_dtm
					, t1.cre_score
					, ifnull(t1.img_file1, '') as img_file1
					, ifnull(t1.img_file2, '') as img_file2
					, ifnull(t1.img_file3, '') as img_file3
					, ifnull(t1.img_file4, '') as img_file4
					, ifnull(t1.img_file5, '') as img_file5
					, ifnull(t1.img_file6, '') as img_file6
					, ifnull(t1.img_file7, '') as img_file7
					, ifnull(t1.img_file8, '') as img_file8
					, ifnull(t1.img_file9, '') as img_file9
					, ifnull(t1.img_file10, '') as img_file10
					
					, ifnull(t5.cit_file_1, '') as cit_file_1
					, ifnull(t5.cit_file_2, '') as cit_file_2
					, ifnull(t5.cit_file_3, '') as cit_file_3
					, ifnull(t5.cit_file_4, '') as cit_file_4
					, ifnull(t5.cit_file_5, '') as cit_file_5
					, ifnull(t5.cit_file_6, '') as cit_file_6
					, ifnull(t5.cit_file_7, '') as cit_file_7
					, ifnull(t5.cit_file_8, '') as cit_file_8
					, ifnull(t5.cit_file_9, '') as cit_file_9
					, ifnull(t5.cit_file_10, '') as cit_file_10
					, t2.cit_name
					, t2.cde_title
					, t2.cit_id
					, t3.cde_filename
					, t4.order_type
					, FN_MASK(FN_DECRYPT(t6.mem_email), 3, LENGTH(FN_DECRYPT(t6.mem_email)), '*') as mem_email
				from
					cmall_review t1
				inner join cmall_order_detail t2 on t2.order_id = t1.order_id and t2.cod_id = t1.cod_id
				inner join cmall_item_detail t3 on t3.cde_id = t2.cde_id
				inner join cmall_order t4 on t4.order_id = t1.order_id
				inner join cmall_item t5 on t5.cit_id = t2.cit_id
				inner join member t6 on t6.mem_id = t1.mem_id
				where
					t1.is_block = 'n'
					and t1.is_delete = 'n' ";
		if($only_photo == 'y') {
			$sql .= " and ifnull(t1.img_file1, '') != '' ";
		}
		$sql .= "order by t1.is_top desc, t1.ins_dtm desc 
				limit ?, ?";
		return $this->db->query($sql, array($offset, $perpage));
	}

	public function review_list_product($seq, $only_photo, $offset, $perpage)
	{
		$sql = "select
					t1.cre_id
					, t1.cre_content
					, CASE WHEN LENGTH(t1.cre_content) > 80 THEN concat(left(t1.cre_content, 80), '...')
						ELSE t1.cre_content END  as cre_title
					, date_format(t1.ins_dtm, '%Y/%m/%d') as ins_dtm
					, t1.cre_score
					, ifnull(t1.img_file1, '') as img_file1
					, ifnull(t1.img_file2, '') as img_file2
					, ifnull(t1.img_file3, '') as img_file3
					, ifnull(t1.img_file4, '') as img_file4
					, ifnull(t1.img_file5, '') as img_file5
					, ifnull(t1.img_file6, '') as img_file6
					, ifnull(t1.img_file7, '') as img_file7
					, ifnull(t1.img_file8, '') as img_file8
					, ifnull(t1.img_file9, '') as img_file9
					, ifnull(t1.img_file10, '') as img_file10
					
					, ifnull(t5.cit_file_1, '') as cit_file_1
					, ifnull(t5.cit_file_2, '') as cit_file_2
					, ifnull(t5.cit_file_3, '') as cit_file_3
					, ifnull(t5.cit_file_4, '') as cit_file_4
					, ifnull(t5.cit_file_5, '') as cit_file_5
					, ifnull(t5.cit_file_6, '') as cit_file_6
					, ifnull(t5.cit_file_7, '') as cit_file_7
					, ifnull(t5.cit_file_8, '') as cit_file_8
					, ifnull(t5.cit_file_9, '') as cit_file_9
					, ifnull(t5.cit_file_10, '') as cit_file_10
					, t2.cit_name
					, t2.cde_title
					, t2.cit_id
					, t3.cde_filename
					, t4.order_type
					, FN_MASK(FN_DECRYPT(t6.mem_email), 3, LENGTH(FN_DECRYPT(t6.mem_email)), '*') as mem_email
				from
					cmall_review t1
				inner join cmall_order_detail t2 on t2.order_id = t1.order_id and t2.cod_id = t1.cod_id
				inner join cmall_item_detail t3 on t3.cde_id = t2.cde_id
				inner join cmall_order t4 on t4.order_id = t1.order_id
				inner join cmall_item t5 on t5.cit_id = t2.cit_id
				inner join member t6 on t6.mem_id = t1.mem_id
				where
					t1.is_block = 'n'
					and t1.is_delete = 'n' 
					and t2.cit_id = ? ";
		if($only_photo == 'y') {
			$sql .= " and ifnull(t1.img_file1, '') != '' ";
		}
		$sql .= "order by t1.is_top desc, t1.ins_dtm desc 
				limit ?, ?";
		return $this->db->query($sql, array($seq, $offset, $perpage));
	}
	
	public function review_list_all_cnt()
	{
		$sql = "select
					count(*) as cnt
				from
					cmall_review t1
				inner join cmall_order_detail t2 on t2.order_id = t1.order_id and t2.cod_id = t1.cod_id
				inner join cmall_item_detail t3 on t3.cde_id = t2.cde_id
				inner join cmall_item t5 on t5.cit_id = t2.cit_id
				where
					t1.is_block = 'n'
					and t1.is_delete = 'n' ";
		$tmp = $this->db->query($sql, array())->row_array();
		return $tmp['cnt'];
	}
		
	public function review_info($seq)
	{
		$sql = "select
					t1.cre_content
					, left(t1.cre_content, 80) as cre_title
					, date_format(t1.ins_dtm, '%Y/%m/%d') as ins_dtm
					, t1.cre_score
					
					, t2.cit_name
					, t2.cde_title
					, t2.cit_id
					, t3.cde_filename
				from
					cmall_review t1
				inner join cmall_order_detail t2 on t2.order_id = t1.order_id and t2.cod_id = t1.cod_id
				inner join cmall_item_detail t3 on t3.cde_id = t2.cde_id
				where
					t1.cre_id = ? 
					and t1.is_block = 'n'
					and t1.is_delete = 'n' ";
		return $this->db->query($sql, array($seq));
	}
	
	public function insert_review($val, $files)
	{
		$this->db->trans_begin();

		$sql = "insert into
					cmall_review
				(
					mem_id
					, order_id
					, cod_id
					, cre_score
					, cre_content
					, ins_dtm
					, upd_dtm ";
		$idx = 1;
		foreach($files as $row) {
			$sql .= " , img_file" . $idx . "
					  , img_name" . $idx;
			$idx++;
		}
		$sql .= ")
				 VALUES
				 (
				 	?
					, ?
					, ?
					, ?
					, ?
					, now()
					, now() ";
		foreach($files as $row) {
			$sql .= " , '" . $row['target'] . "'
					  , '" . $row['fileName'] . "' ";
		}
		$sql .= ")";		
		$this->db->query($sql, array($val['mem_id'], $val['order_id'], $val['cod_id'], $val['cre_score'], $val['cre_content']));	

		$points = $this->db->get('cmall_point_manage')->row_array();
		
		$point = $points['review'];
		$point_type = '후기작성';
		if(count($files) > 0) {
			$point = $points['review_photo'];
			$point_type = '사진후기작성';
		}
		
		$this->db->reset_query();
		$this->db->set('mem_id', $val['mem_id']);
		$this->db->set('add_type', 'review');
		$this->db->set('add_val', $point);
		$this->db->set('rest_val', '0');
		$this->db->set('use_val', '0');
		$this->db->set('ins_dtm', date('Y-m-d H:i:s'));
		$this->db->set('exp_dtm', date('Y-m-d', strtotime('+1 year')));
		$this->db->insert('member_point');
		$mpo_id = $this->db->insert_id();
		
		$this->db->reset_query();
		$this->db->set('mem_id', $val['mem_id']);
		$this->db->set('point_type', $point_type);
		$this->db->set('point_val', $point);
		$this->db->set('point_dir', 'plus');
		$this->db->set('ins_dtm', date('Y-m-d H:i:s'));
		$this->db->set('mpo_id', $mpo_id);
		$this->db->insert('member_point_log');
		
		$this->db->reset_query();
		$this->db->where('mem_id', $val['mem_id']);
		$this->db->set('mem_point', 'mem_point + ' . $point, false);
		$this->db->update('member');
		
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}else{
			$this->db->trans_commit();
			return true;
		}
	}
}