<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . '/third_party/aws/aws-autoloader.php';

class Object_storage
{
	public function s3Upload($files)
	{
		$param = array(
				'endpoint' => OBJ_URL,
				'version' => 'latest',
				'region' => 'kr-standard',
				'credentials' => array(
					'key' => OBJ_ACCESS_KEY,
					'secret'  => OBJ_SECRET_KEY,
				  )
			);
		$s3 = Aws\S3\S3Client::factory($param);  
		
		$errors = array();
		foreach($files as $row) {
			$result = $s3->putObject([
				'Bucket' => OBJ_BUCKET,
				'Key' => $row['target'],
				'SourceFile' => $row['source'],
			]);

			$meta = $result['@metadata'];
			if(empty($meta)) {
				$errors[] = $row['fileName'];
			}
			else if($meta['statusCode'] != '200') {
				$errors[] = $row['fileName'];
			}
		}
		
		return $errors;
	}
}
