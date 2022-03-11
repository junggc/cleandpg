<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cdn extends CI_Controller 
{	
	public function __construct() 
	{	
		parent::__construct();
		$this->load->library('object_storage');
	}
	
//		use Aws\S3\S3Client;
//		use Aws\S3\Exception\S3Exception;
	public function bucket_list()
	{
		$uuid = exec('uuidgen');
		echo $uuid;
		exit;
		$this->object_storage->s3Upload('aaa');
	}
}
