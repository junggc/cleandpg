<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH . '/third_party/PHPMailer/PHPMailerAutoload.php';

class Mailer extends PHPMailerAutoload 
{
	public function __construct() 
	{
		parent::__construct();
	}

	function mailer($fname, $fmail, $to, $subject, $content, $type=0, $file="", $cc="", $bcc="")
	{
echo 'aaaaaaa';
		if ($type != 1)
			$content = nl2br($content);
	
		$mail = new PHPMailer(); // defaults to using php "mail()"
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host = G5_SMTP; // SMTP server
		$mail->CharSet = 'UTF-8';
		$mail->From = $fmail;
		$mail->FromName = $fname;
		$mail->Subject = $subject;
		$mail->AltBody = ""; // optional, comment out and test
		$mail->msgHTML($content);
		$mail->addAddress($to);
		if ($cc)
			$mail->addCC($cc);
		if ($bcc)
			$mail->addBCC($bcc);
		//print_r2($file); exit;
		if ($file != "") {
			foreach ($file as $f) {
				$mail->addAttachment($f['path'], $f['name']);
			}
		}
		return $mail->send();
	}
	
	// 파일을 첨부함
	function attach_file($filename, $tmp_name)
	{
		// 서버에 업로드 되는 파일은 확장자를 주지 않는다. (보안 취약점)
		$dest_file = G5_DATA_PATH.'/tmp/'.str_replace('/', '_', $tmp_name);
		move_uploaded_file($tmp_name, $dest_file);
		$tmpfile = array("name" => $filename, "path" => $dest_file);
		return $tmpfile;
	}

}
// 메일 보내기 (파일 여러개 첨부 가능)
// type : text=0, html=1, text+html=2
?>