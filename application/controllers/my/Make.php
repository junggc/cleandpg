<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Make extends CD_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('pagination');	
		$this->load->library('object_storage');
		$this->load->library('common');
		$this->load->model('common_m');
		$this->load->model('review_m');
		$this->load->model('member_m');
		$this->load->model('qa_m');
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
			$offset = 0;
			$perpage = 2;
			$review = $this->review_m->review_list($this->data['user']['mem_id'], $offset, $perpage)->result_array();
			$review_cnt = $this->review_m->review_list_cnt($this->data['user']['mem_id']);
			
			$qa = $this->qa_m->qa_list($this->data['user']['mem_id'], $offset, $perpage, 'all')->result_array();
			$qa_cnt = $this->qa_m->qa_list_cnt($this->data['user']['mem_id'], 'all');

			$this->data['category'] = $this->common_m->board_category_list('qna')->result_array();
			$this->data['orders'] = $this->review_m->order_list($this->data['user']['mem_id'])->result_array();
			$this->data['review'] = $review;
			$this->data['review_cnt'] = $review_cnt;
			$this->data['qa'] = $qa;
			$this->data['qa_cnt'] = $qa_cnt;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/make/make_v');
			$this->load->view('footer_v');
		}
	}

	public function review()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 10);
			$offset = (int)$this->uri->segment(4, 0);
			$total_rows = $this->review_m->review_list_cnt($this->data['user']['mem_id']);
			$num = $total_rows - $offset;

			$config = array();
			$config['base_url'] = '/my/make/review/';
			$config['total_rows'] = $total_rows;
			$config['perpage'] = $perpage;
			$config['offset'] = $offset;
			$config['num_links'] = 5;
			$pagination = $this->common->pagination($config);
	
			$list = $this->review_m->review_list($this->data['user']['mem_id'], $offset, $perpage)->result_array();

			$this->data['orders'] = $this->review_m->order_list($this->data['user']['mem_id'])->result_array();
			$this->data['list'] = $list;
			$this->data['total'] = $total_rows;
			$this->data['offset'] = $offset;
			$this->data['perpage'] = $perpage;
			$this->data['pagination'] = $pagination;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/make/review_v');
			$this->load->view('footer_v');
		}
	}
	
	public function qna_write()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			if(!isset($_SERVER['HTTP_REFERER'])) {
				$refer = '/my/make/qna';	
			}
			else {
				$refer = $_SERVER['HTTP_REFERER'];
			}
			$this->data['move'] = $refer;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/make/qna_write_v');
			$this->load->view('footer_v');
		}
	}

	public function qna_view()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$req = $this->input->get();
			if(!isset($_SERVER['HTTP_REFERER'])) {
				$refer = '/my/make/qna';	
			}
			else {
				$refer = $_SERVER['HTTP_REFERER'];
			}
			$this->data['move'] = $refer;

			if(empty($req['seq'])) {
				$this->data['msg'] = '잘못된 접근입니다.';
				$this->load->view('header_v', $this->data);
				$this->load->view('errors/invalid_seq');
				$this->load->view('footer_v');
			}
			else {
				$info = $this->qa_m->qa_detail($req['seq'])->row_array();

				if(empty($info)) {
					$this->data['msg'] = '잘못된 접근입니다.';
					$this->load->view('header_v', $this->data);
					$this->load->view('errors/invalid_seq');
					$this->load->view('footer_v');
				}
				else {
					$info['files'] = $this->common_m->file_list('qna', $req['seq'])->result_array();
					$this->data['info'] = $info;
					$this->load->view('header_v', $this->data);
					if($info['is_answer'] === 'n') {
						$this->load->view('my/make/qna_view_v');
					}
					else {
						$this->load->view('my/make/qna_view2_v');
					}
					$this->load->view('footer_v');
				}
			}
		}
	}

	public function qna()
	{
		if(empty($this->data['user'])) {
			$this->data['msg'] = '로그인이  필요합니다.';
			$this->load->view('header_v', $this->data);
			$this->load->view('errors/invalid_seq');
			$this->load->view('footer_v');
		}
		else {
			$perpage = (isset($req['perpage']) ? (int)$req['perpage'] : 10);
			$offset = (int)$this->uri->segment(4, 0);
			$total_rows = $this->qa_m->qa_list_cnt($this->data['user']['mem_id']);
			$num = $total_rows - $offset;

			$config = array();
			$config['base_url'] = '/my/make/qna/';
			$config['total_rows'] = $total_rows;
			$config['perpage'] = $perpage;
			$config['offset'] = $offset;
			$config['num_links'] = 5;
			$pagination = $this->common->pagination($config);
	
			$list = $this->qa_m->qa_list($this->data['user']['mem_id'], $offset, $perpage)->result_array();

			$this->data['category'] = $this->common_m->board_category_list('qna')->result_array();
			$this->data['list'] = $list;
			$this->data['total'] = $total_rows;
			$this->data['offset'] = $offset;
			$this->data['perpage'] = $perpage;
			$this->data['pagination'] = $pagination;
			$this->load->view('header_v', $this->data);
			$this->load->view('my/make/qna_v');
			$this->load->view('footer_v');
		}
	}
	
	public function ajaxInsertReview()
	{
		$result = array();
		$result['status'] = 'succ';
		if(empty($this->data['user'])) {
			$result['status'] = 'login';
			$result['msg'] = '로그인이  필요합니다.';
		}
		else {
			$req = $this->input->post();
			
			$where = array($this->data['user']['mem_email']);
			$member = $this->member_m->member_r($where)->row_array();
			if($member['is_block'] == 'y') {
				$result['status'] = 'fail';
				$result['msg'] = '리뷰를 작성를 작성하실 수 없습니다. 관리자에게 문의해 주세요.';
			}
			else if(empty($req['order_id']) || empty($req['cod_id'])) {
				$result['status'] = 'fail';
				$result['msg'] = '리뷰를 작성할 상품을 선택해 주세요.';
			}
			else if($req['cre_score'] <= 0 || $req['cre_score'] > 5) {
				$result['status'] = 'fail';
				$result['msg'] = '리뷰 점수를 선택해 주세요.';
			}
			else if(empty(trim($req['cre_content']))) {
				$result['status'] = 'fail';
				$result['msg'] = '리뷰 내용을 입력해 주세요.';
			}
			else {
				$val = array();
				$val['mem_id'] = $this->data['user']['mem_id'];
				$val['order_id'] = $req['order_id'];
				$val['cod_id'] = $req['cod_id'];
				$val['cre_score'] = $req['cre_score'];
				$val['cre_content'] = trim($req['cre_content']);

				$target_path = 'prod/review/' . date('Y') . '/' . date('m') . '/' . date('d') . '/';

				$files = array();	
				if(!empty($_FILES)) {
					for($i = 0; $i < count($_FILES['files']['name']); $i++) {
						if( $_FILES['files']['error'][$i] != UPLOAD_ERR_OK ) {
							$result['status'] = 'fail';
							switch( $_FILES['files']['error'][$i] ) {
								case UPLOAD_ERR_INI_SIZE:
								case UPLOAD_ERR_FORM_SIZE:
									$result['msg'] = "파일이 너무 큽니다. ($error)";
									break;
								case UPLOAD_ERR_NO_FILE:
									$result['msg'] = "파일이 첨부되지 않았습니다. ($error)";
									break;
								default:
									$result['msg'] = "파일이 제대로 업로드되지 않았습니다. ($error)";
							}
							break;
						}
						
						$fileName = $_FILES['files']['name'][$i];
						$fileinfo = pathinfo($fileName);
						$ext = $fileinfo['extension'];
						
						$_file['target'] = $target_path . exec('uuidgen') . '.' . $ext;
						$_file['source'] = $_FILES['files']['tmp_name'][$i];
						$_file['fileName'] = $fileName;
						$files[] = $_file;
					}
				}
				
				if($result['status'] == 'succ') {
					if($files > 0) {
						$errors = $this->object_storage->s3Upload($files);
						if(!empty($errors)) {
							$result['status'] = 'fail';
							$result['msg'] = implode(',', $errors) . ' 파일 업로드에 실패했습니다.';	
						}
					}
				}
				
				if($result['status'] == 'succ') {
					$this->review_m->insert_review($val, $files);
					$result['msg'] = '등록되었습니다.';	
				}
			}
		}
		echo json_encode($result);
	}
	
	public function ajaxInsertQna()
	{
		$result = array();
		$result['status'] = 'succ';
		if(empty($this->data['user'])) {
			$result['status'] = 'login';
			$result['msg'] = '로그인이  필요합니다.';
		}
		else {
			$req = $this->input->post();
			

			if(empty(trim($req['cqa_title']))) {
				$result['status'] = 'fail';
				$result['msg'] = '제목을 입력해 주세요.';
			}
			else if(empty(trim($req['cqa_content']))) {
				$result['status'] = 'fail';
				$result['msg'] = '내용을 입력해 주세요.';
			}
			else {
				$val = array();
				$val['mem_id'] = $this->data['user']['mem_id'];
				$val['cbc_id'] = 0;
				$val['cqa_title'] = trim($req['cqa_title']);
				$val['cqa_content'] = trim($req['cqa_content']);
				$cqa_id = $this->qa_m->insert_qa($val);
				
				if(isset($req['newname'])) {
					$val = array();
					for($i = 0; $i < count($req['newname']); $i++) {
						$tmp = array();
						$tmp['parent_gbn'] = 'qna';
						$tmp['parent_cd'] = $cqa_id;
						$tmp['file_no'] = $i;
						$tmp['org_filename'] = $req['orgname'][$i];
						$tmp['new_filepath'] = $req['filepath'][$i];
						$tmp['new_filename'] = $req['newname'][$i];
						$tmp['file_ext'] = $req['ext'][$i];
						$tmp['file_size'] = $req['size'][$i];
						$val[] = $tmp;
					}
					$this->common_m->insert_file($val);					
				}
				$result['status'] = 'succ';
				$result['msg'] = '등록되었습니다.';
			}
		}
		echo json_encode($result);
	}	

	public function ajaxUpdateQna()
	{
		$result = array();
		$result['status'] = 'succ';
		if(empty($this->data['user'])) {
			$result['status'] = 'login';
			$result['msg'] = '로그인이  필요합니다.';
		}
		else {
			$req = $this->input->post();
			

			if(empty(trim($req['cqa_title']))) {
				$result['status'] = 'fail';
				$result['msg'] = '제목을 입력해 주세요.';
			}
			else if(empty(trim($req['cqa_content']))) {
				$result['status'] = 'fail';
				$result['msg'] = '내용을 입력해 주세요.';
			}
			else {
				$val = array();
				$val['cqa_title'] = trim($req['cqa_title']);
				$val['cqa_content'] = trim($req['cqa_content']);
				$this->qa_m->update_qa($req['cqa_id'], $val);

				if(!empty($req['deleteFile'])) {
					$this->common_m->delete_file($req['deleteFile']);	
				}
				
				if(isset($req['newname'])) {
					$val = array();
					for($i = 0; $i < count($req['newname']); $i++) {
						if(!empty($req['file_seq'][$i])) continue;
						
						$tmp = array();
						$tmp['parent_gbn'] = 'qna';
						$tmp['parent_cd'] = $req['cqa_id'];
						$tmp['file_no'] = $i;
						$tmp['org_filename'] = $req['orgname'][$i];
						$tmp['new_filepath'] = $req['filepath'][$i];
						$tmp['new_filename'] = $req['newname'][$i];
						$tmp['file_ext'] = $req['ext'][$i];
						$tmp['file_size'] = $req['size'][$i];
						$val[] = $tmp;
					}
					$this->common_m->insert_file($val);					
				}
				$result['status'] = 'succ';
				$result['msg'] = '수정되었습니다.';
			}
		}
		echo json_encode($result);
	}	
}
