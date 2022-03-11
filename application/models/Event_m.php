<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_m extends CI_Model 
{
	public function __construct()
	{
        parent::__construct();		
		$this->load->database();
	}

	public function event_list($req, $offset, $perpage) {
		$sql = "SELECT
					t1.cbe_id
					, t1.cbe_title
					, t1.cbe_content
					, date_format(STR_TO_DATE(t1.start_date, '%Y-%m-%d'), '%Y/%m/%d') as start_date
					, date_format(STR_TO_DATE(t1.end_date, '%Y-%m-%d'), '%Y/%m/%d') as end_date
					, t1.main_img
					, t1.is_show
					, t1.view_cnt
					, t1.is_winnerset
					, t1.winner_url
					, date_format(t1.ins_dtm, '%Y-%m-%d %H:%i') as ins_dtm
					, date_format(t1.upd_dtm, '%Y-%m-%d %H:%i') as upd_dtm
					, case t1.is_winnerset when 'y' then '당첨자발표'
						else 
							case when t1.start_date > date_format(now(), '%Y-%m-%d') then '진행전'
								when t1.end_date < date_format(now(), '%Y-%m-%d') then '종료'
								else '진행중' end 
						end as status_text
					, case t1.is_winnerset when 'y' then 'end'
						else 
							case when t1.start_date > date_format(now(), '%Y-%m-%d') then ''
								when t1.end_date < date_format(now(), '%Y-%m-%d') then 'close'
								else '' end 
						end as status
				FROM
					cmall_board_event t1
				WHERE
					t1.is_delete = 'n'
					AND t1.is_show = 'y' ";
		if(!empty($req['searchText'])) {
			$sql .= " AND (t1.cbe_title LIKE '%" . $req['searchText'] . "%' OR t1.cbe_content LIKE '%" . $req['searchText'] . "%' ) ";
		}
		if($req['order_by'] == 'end') {
			$sql .= " ORDER BY t1.end_date ";
		}
		else if($req['order_by'] == 'winner') {
			$sql .= " ORDER BY t1.winner_date ";
		}
		else {
			$sql .= " ORDER BY t1.ins_dtm DESC ";
		}
		$sql .= "LIMIT ?, ? ";

		return $this->db->query($sql, array($offset, $perpage));
	}

	public function event_list_cnt($req) {
		$sql = "SELECT
					count(*) as cnt
				FROM
					cmall_board_event t1
				WHERE
					t1.is_delete = 'n'
					AND t1.is_show = 'y' ";
		if(!empty($req['searchText'])) {
			$sql .= " AND (t1.cbe_title LIKE '%" . $req['searchText'] . "%' OR t1.cbe_content LIKE '%" . $req['searchText'] . "%' ) ";
		}
				
		$tmp = $this->db->query($sql, array())->row_array();
		return $tmp['cnt'];
	}

	public function event_detail($seq) {
		$this->db->where('cbe_id', $seq);
		$this->db->set('view_cnt', 'view_cnt + 1', false);
		$this->db->update('cmall_board_event');

		$sql = "SELECT
					t1.cbe_id
					, t1.cbe_title
					, t1.cbe_content
					, date_format(STR_TO_DATE(t1.start_date, '%Y-%m-%d'), '%Y/%m/%d') as start_date
					, date_format(STR_TO_DATE(t1.end_date, '%Y-%m-%d'), '%Y/%m/%d') as end_date
					, t1.main_img
					, t1.is_show
					, t1.view_cnt
					, t1.is_winnerset
					, t1.winner_url
					, case when t1.winner_date is null or t1.winner_date = '' then '미정'
						else date_format(STR_TO_DATE(t1.winner_date, '%Y-%m-%d'), '%Y/%m/%d') end as winner_date
					, date_format(t1.ins_dtm, '%Y-%m-%d %H:%i') as ins_dtm
					, date_format(t1.upd_dtm, '%Y-%m-%d %H:%i') as upd_dtm
					, case t1.is_winnerset when 'y' then '당첨자발표'
						else 
							case when t1.start_date > date_format(now(), '%Y-%m-%d') then '진행전'
								when t1.end_date < date_format(now(), '%Y-%m-%d') then '종료'
								else '진행중' end 
						end as status_text
					, case t1.is_winnerset when 'y' then 'end'
						else 
							case when t1.start_date > date_format(now(), '%Y-%m-%d') then ''
								when t1.end_date < date_format(now(), '%Y-%m-%d') then 'close'
								else '' end 
						end as status
				FROM
					cmall_board_event t1
				WHERE
					t1.cbe_id = ? 
					and t1.is_delete = 'n'
					and t1.is_show = 'y' ";
		$info = $this->db->query($sql, array($seq))->row_array();

		if(!empty($info)) {
			$sql = "SELECT
						t1.cbe_id
						, t1.cbe_title
						, t1.cbe_content
						, t1.start_date
						, t1.end_date
						, t1.main_img
						, t1.is_show
						, t1.view_cnt
						, t1.is_winnerset
						, t1.winner_url
						, date_format(t1.ins_dtm, '%Y-%m-%d %H:%i') as ins_dtm
						, date_format(t1.upd_dtm, '%Y-%m-%d %H:%i') as upd_dtm
					FROM
						cmall_board_event t1
					WHERE
						? < t1.cbe_id 
						and t1.is_delete = 'n' 
						and t1.is_show = 'y'  
					ORDER BY t1.ins_dtm LIMIT 1";
			$info['next'] = $this->db->query($sql, array($seq))->row_array();
			
			$sql = "SELECT
						t1.cbe_id
						, t1.cbe_title
						, t1.cbe_content
						, t1.start_date
						, t1.end_date
						, t1.main_img
						, t1.is_show
						, t1.view_cnt
						, t1.is_winnerset
						, t1.winner_url
						, date_format(t1.ins_dtm, '%Y-%m-%d %H:%i') as ins_dtm
						, date_format(t1.upd_dtm, '%Y-%m-%d %H:%i') as upd_dtm
					FROM
						cmall_board_event t1
					WHERE
						? > t1.cbe_id 
						and t1.is_delete = 'n' 
						and t1.is_show = 'y'  
					ORDER BY t1.ins_dtm DESC LIMIT 1 ";
			$info['prev'] = $this->db->query($sql, array($seq))->row_array();
		}
		return $info;		
	}
	
}