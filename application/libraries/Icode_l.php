<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/third_party/icode/config.php';
require_once APPPATH . '/third_party/icode/component.php';

define('SOCKET_HOST', $socket_host);
define('SOCKET_PORT', $socket_port);
define('ICODE_KEY', $icode_key);
define('CALL_BACK', '16616417');

class Icode_l extends SMS 
{
	public function __construct() 
	{
//		parent::__construct();
	}
	
	public function sms_send($tel_list, $data)
	{
		$res = [];
		$res['result'] = true;
		$res['result_msg'] = '';
		$res['result_data'] = [];
		
		$this->SMS_con(SOCKET_HOST, SOCKET_PORT, ICODE_KEY);
		$result = $this->Add($tel_list, CALL_BACK, $data, '', '');
		
		if ( $result )
		{
  			$result = $this->Send();

			if ( $result )
			{
				$success_cnt = 0;
				$failure_cnt = 0;
				$result_list = [];
				
				foreach( $this->Result as $row ) 
				{
					list($phone, $msg) = explode(':', $row);
					$result_msg = '';
					$result_msg = $row;
					if ( 'Error' === substr($msg, 0, 5) )
					{
						/*$code = substr($msg, 6, 2);
						$result_msg .= $phone . ' 발송 오류(' . $code . '): ';
						
						switch ( $code ) 
						{	
							case '23':	// 23: 데이터 오류, 발송날짜 오류, 발신번호 미등록
								$result_msg .= '데이터를 다시 확인해 주시기 바랍니다.';
								break;

							case '85':	// 85: 발송번호 미등록
								$result_msg .= '등록되지 않는 발송번호입니다.';
								break;

							case '87':	// 87: 인증 실패
								$result_msg .= '(정액제-계약확인)인증 받지 못하였습니다.';
								break;

							case '88':	// 88: 연동 모듈 발송 불가
								$result_msg .= '연동 모듈 사용이 불가합니다. 아이코드로 문의해 주시기 바랍니다.';
								break;

							case '96':	// 96: 토큰 검사 실패
								$result_msg .= '사용할 수 없는 토큰키입니다.';
								break;

							case '97':	// 97: 잔여코인 부족
								$result_msg .= '잔여코인이 부족합니다.';
								break;

							case '98':	// 98: 사용기간 만료
								$result_msg .= '사용기간이 만료되었습니다.';
								break;

							case '99':	// 99: 인증 실패
								$result_msg .= '서비스 사용이 불가합니다. 아이코드로 문의해 주시기 바랍니다.';
								break;

							default:	// 미 확인 오류
								$result_msg .= '알 수 없는 오류로 발송에 실패하였습니다.';
								break;
						}*/
						
						$failure_cnt++;	
					}
					else
					{
						/*$code = substr($msg, 0, 2);
						$result_msg .= $phone . '로 ';
						
						switch ( $code ) 
						{	
							case '17':	// 17: 접수(발송)대기 처리. 지연해소 시 발송됨
								$result_msg .= '접수(발송)대기 처리 되었습니다. (' . $code . ')';
								break;

							default:	// 00: 발송 완료
								$result_msg .= '발송 되었습니다. (' . $code . ')';
								break;
						}*/
						
						$success_cnt++;
					}

					$result_list[] = $result_msg;
				}
				
				$this->Init();
				
				$res['result_data']['success_cnt'] = $success_cnt;
				$res['result_data']['failure_cnt'] = $failure_cnt;
				$res['result_data']['result_list'] = $result_list;
			}
			else
			{
				$res['result'] = false;
				$res['result_msg'] = '문자 발송에 실패하였습니다.';
			}
		}
		else
		{
			$res['result'] = false;
			$res['result_msg'] = '패킷 생성에 실패하였습니다.';
		}
		
		return $res;
	}
}
