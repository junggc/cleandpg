<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CD_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');	
		$this->load->library('object_storage');
		$this->load->library('common');
		$this->load->model('point_m');
		$this->load->model('member_m');
		$this->load->model('order_m');
		$this->load->model('subscribe_m');
		$this->load->model('cart_m');
	}
	
	public function index()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$member = $this->member_m->member_info($this->data['user']['mem_id'])->row_array();
			if($member['mem_sns_type'] == 'email') {
				$this->load->view('header_v', $this->data);
				$this->load->view('my/user/user_v');
				$this->load->view('footer_v');
			}
			else {
				header('Location: /my/user/info');	
			}
		}
	}
	
	public function info()
	{
		$req = $this->input->post();
		
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$info = $this->member_m->member_info($this->data['user']['mem_id'])->row_array();
			if($info['mem_sns_type'] == 'email') {
				if(empty($req['mem_password'])) {
					$this->data['msg'] = '비밀번호를 입력해 주세요.';
					$this->data['move'] = '/my/user';
					$this->load->view('header_v', $this->data);
					$this->load->view('errors/invalid_seq');
					$this->load->view('footer_v');
				}
				else {
					$where = array();
					$where['mem_id'] = $this->data['user']['mem_id'];
					$where['mem_password'] = $req['mem_password'];
					$res = $this->member_m->member_r6($where)->row_array();
					if(empty($res)) {
						$this->data['msg'] = '비밀번호가 일치하지 않습니다.';
						$this->data['move'] = '/my/user';
						$this->load->view('header_v', $this->data);
						$this->load->view('errors/invalid_seq');
						$this->load->view('footer_v');
					}
				}
			}
			$this->data['info'] = $info;
			$this->data['delivery'] = $this->cart_m->delivery_address_default($this->data['user']['mem_id'])->row_array();
			$this->data['delivery_cnt'] = $this->cart_m->delivery_address_cnt($this->data['user']['mem_id']);
			$this->load->view('header_v', $this->data);
			$this->load->view('my/user/info_v');
			$this->load->view('footer_v');
		}
	}

	public function delivery_list()
	{
		$req = $this->input->post();
		
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$req = $this->input->post(); 
			
			$req['mem_id'] = $this->data['user']['mem_id'];
			$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 10);
			$offset = (int)$this->uri->segment(4, 0);
			$total_rows = $this->cart_m->delivery_list_cnt($req);;
			$num = $total_rows - $offset;

			$config = array();
			$config['base_url'] = '/my/user/delivery_list/';
			$config['total_rows'] = $total_rows;
			$config['perpage'] = $perpage;
			$config['offset'] = $offset;
			$config['num_links'] = 5;
			$pagination = $this->common->pagination($config);
	
			$list = $this->cart_m->delivery_list($req, $offset, $perpage)->result_array();

			$this->data['list'] = $list;
			$this->data['total'] = $total_rows;
			$this->data['offset'] = $offset;
			$this->data['perpage'] = $perpage;
			$this->data['pagination'] = $pagination;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/user/delivery_list_v');
			$this->load->view('footer_v');
		}
	}
	
	public function leave()
	{
		$req = $this->input->post();
		
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$this->load->view('header_v', $this->data);
			$this->load->view('my/user/leave_v');
			$this->load->view('footer_v');
		}
	}
	
	public function ajaxLeave()
	{
		$req = $this->input->post();

		if(empty($this->data['user'])) {
			$result['status'] = 'login';
			$result['msg'] = '로그인이 필요합니다.';
		}
		else if(empty(trim($req['leave_reason_msg']))) {
			$result['status'] = 'fail';
			$result['msg'] = '탈퇴사유를 입력해 주세요.';
		}
		else if(empty($req['agree'])) {
			$result['status'] = 'fail';
			$result['msg'] = '개인정보 삭제에 동의해 주세요.';
		}
		else {
			$order = $this->order_m->check_order($this->data['user']);
			$subscribe = $this->subscribe_m->subscribe_list_all($this->data['user'])->result_array();
			if($order > 0) {
				$result['status'] = 'fail';
				$result['msg'] = '처리중인 주문건이 있습니다. 해당 주문건을 완료하고 다시 시도해 주시길 바랍니다.';
			}
			else if(!empty($subscribe)) {
				$result['status'] = 'fail';
				$result['msg'] = '구독중인 상품이 있습니다. 해당 구독건을 종료하고 다시 시도해 주시길 바랍니다.';
			}
			else {
				$res = $this->member_m->member_leave($this->data['user']);
				if($res) {
					$this->session->sess_destroy();
					$result['status'] = 'succ';
					$result['msg'] = '탈퇴 되었습니다. 그동안 클린디를 이용해 주셔서 감사합니다.';
				}
				else {
					$result['status'] = 'fail';
					$result['msg'] = '탈퇴 처리에 실패했습니다. 관리자에게 문의해주세요.';
				}
			}
		}
		echo json_encode($result);		
	}
	
	public function ajaxChangePassword()
	{
		$req = $this->input->post();
		
		if(empty($this->data['user'])) {
			$result['status'] = 'login';
			$result['msg'] = '로그인이 필요합니다.';
		}
		else if(empty($req['mem_password'])) {
			$result['status'] = 'fail';
			$result['msg'] = '기존 비밀번호를 입력해 주세요.';	
		}
		else if(empty($req['new_password'])) {
			$result['status'] = 'fail';
			$result['msg'] = '신규 비밀번호를 입력해 주세요.';	
		}
		else if(preg_match('/^.*(?=^.{6,15}$)(?=.*\d)(?=.*[a-zA-Z]).*$/', $req['new_password']) == false) {
			$result['status'] = 'fail';
			$result['msg'] = '비밀번호는 숫자,영어대소문자를 조합한 6~15자리로 입력하여 주세요.';
		}
		else if($req['new_password'] !== $req['password_confirm']) {
			$result['status'] = 'fail';
			$result['msg'] = '비밀번호 확인이 일치하지 않습니다.';
		}
		else {
			$val = array();
			$val['mem_id'] = $this->data['user']['mem_id'];
			$val['mem_password'] = $req['mem_password'];
			$info = $this->member_m->member_r6($val)->row_array();
			if(empty($info)) {
				$result['status'] = 'fail';
				$result['msg'] = '기존 비밀번호가 일치하지 않습니다.';
			}
			else {
				$val['mem_password'] = $req['new_password'];
				$this->member_m->member_u4($val);
				$result['status'] = 'succ';
				$result['msg'] = '수정되었습니다.';
			}
		}
		
		echo json_encode($result);
	}

	public function ajaxUpdateUser()
	{
		$req = $this->input->post();
		
		if(empty($this->data['user'])) {
			$result['status'] = 'login';
			$result['msg'] = '로그인이 필요합니다.';
		}
		else if(empty($req['mem_username'])) {
			$result['status'] = 'fail';
			$result['msg'] = '이름을 입력해주세요.';
		}
		else if(empty($req['mem_phone'])) {
			$result['status'] = 'fail';
			$result['msg'] = '휴대폰번호를 입력해 주세요.';	
		}
		else {
			$info = $this->member_m->member_info($this->data['user']['mem_id'])->row_array();
			if($info['mem_phone'] != $req['mem_phone'] && empty($req['auth'])) {
				$result['status'] = 'fail';
				$result['msg'] = '휴대폰번호를 인증해 주세요.';	
			}
			else {
				$val = array();
				$val['mem_username'] = $req['mem_username'];
				$val['mem_id'] = $this->data['user']['mem_id'];
				$val['mem_phone'] = $req['mem_phone'];
				$this->member_m->member_u5($val);
				$result['status'] = 'succ';
				$result['msg'] = '수정되었습니다.';
			}
		}
		echo json_encode($result);
	}
	
	public function ajaxUpdateRcv()
	{
		$req = $this->input->post();
		$res = $this->member_m->update_rcv_status($this->data['user']['mem_id'], $req['is_rcv']);	
		if($res) {
			$result['status'] = 'succ';
			$result['msg'] = $req['is_rcv'];
		}
		else {
			$result['status'] = 'fail';
			$result['msg'] = '수정에 실패하였습니다.';
		}
		echo json_encode($result);
	}
}
