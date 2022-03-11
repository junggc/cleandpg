<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common
{
	public function __construct() 
	{
		
	}
	
//----------------------------------------------------------------------
	public function pagination($config)
	{
		$result = '';
		if($config['total_rows'] <= 0) return $result;

		$pageNo = $config['offset']/$config['perpage'] + 1;
		$pageSize = $config['perpage'];

		$finalPage = floor(($config['total_rows'] + ($pageSize - 1)) / $pageSize);
        if($pageNo > $finalPage) $pageNo = $finalPage; // 기본 값 설정
		
		if($pageNo < 0 || $pageNo > $finalPage) $pageNo = 1; // 현재 페이지 유효성 체크

        $isNowFirst = $pageNo == 1 ? true : false; // 시작 페이지 (전체)
        $isNowFinal = $pageNo == $finalPage ? true : false; // 마지막 페이지 (전체)

        $startPage = floor(($pageNo - 1) / $config['num_links']) * $config['num_links'] + 1; // 시작 페이지 (페이징 네비 기준)
        $endPage = $startPage + $config['num_links'] - 1; // 끝 페이지 (페이징 네비 기준)

        if($endPage > $finalPage) { // [마지막 페이지 (페이징 네비 기준) > 마지막 페이지] 보다 큰 경우
        	$endPage = $finalPage;
        }

        $firstPageNo = 1; // 첫 번째 페이지 번호

		$prevPageNo = 1;
        if (!$isNowFirst) {
            $prevPageNo = (($pageNo - 1) < 1 ? 1 : ($pageNo - 1)); // 이전 페이지 번호
        }
		$nextPageNo = $finalPage;
        if (!$isNowFinal) {
            $nextPageNo = (($pageNo + 1) > $finalPage ? $finalPage : ($pageNo + 1)); // 다음 페이지 번호
        }

		$result = '<div class="pagenate">';
		if(!empty($config['base_url'])) {
			if($pageNo != $firstPageNo) {
				$result .= '<a class="first" href="' . $config['base_url'] . '"></a>';
			}
			if($pageNo != $prevPageNo) {
				$result .= '<a class="prev" href="' . $config['base_url'] . (($prevPageNo - 1) * $pageSize) . '"></a>';
			}
			for($i = $startPage; $i <= $endPage; $i++) {
				if($i == $pageNo) {
					$result .= '<a class="active">' . $i . '</a>';
				}
				else {
					$result .= '<a href="' . $config['base_url'] . (($i - 1) * $pageSize) . '">' . $i . '</a>';
				}
			}
			if($pageNo != $nextPageNo) {
				$result .= '<a class="next" href="' . $config['base_url'] . (($nextPageNo - 1) * $pageSize) . '"></a>';
			}
			if($pageNo != $finalPage) {
				$result .= '<a class="last" href="' . $config['base_url'] . (($finalPage - 1) * $pageSize) . '"></a>';
			}
			$result .= '</div>';
		}
		else {
			if($pageNo != $firstPageNo) {
				$result .= '<a class="first" href="#" onclick="javasciprt:goPage(0); return false;"></a>';
			}
			if($pageNo != $prevPageNo) {
				$result .= '<a class="prev" href="#" onclick="javasciprt:goPage('. (($prevPageNo - 1) * $pageSize) . '); return false;"></a>';
			}
			for($i = $startPage; $i <= $endPage; $i++) {
				if($i == $pageNo) {
					$result .= '<a class="active">' . $i . '</a>';
				}
				else {
					$result .= '<a href="#" onclick="javasciprt:goPage('.  (($i - 1) * $pageSize) . ');">' . $i . '</a>';
				}
			}
			if($pageNo != $nextPageNo) {
				$result .= '<a href="#" class="next" onclick="javasciprt:goPage('.  (($nextPageNo - 1) * $pageSize)  . ');"></a>';
			}
			if($pageNo != $finalPage) {
				$result .= '<a href="#" class="last" onclick="javasciprt:goPage('.  (($finalPage - 1) * $pageSize)  . ');"></a>';
			}
			$result .= '</div>';
		}
		return $result;
	}
	
	function passwordCheck($_str)
	{
		$pw = $_str;
		$num = preg_match('/[0-9]/u', $pw);
		$eng = preg_match('/[a-z]/u', $pw);
	 
		if(strlen($pw) < 6 || strlen($pw) > 15)
		{
			return false;
			exit;
		}
	 
		if(preg_match("/\s/u", $pw) == true)
		{
			return false;
			exit;
		}
	 
		if( $num == 0 || $eng == 0)
		{
			return false;
			exit;
		}
	 
		return true;
	}	
}
