<?php

class Fangate
{


	private static function parse_signed_request($signed_request, $secret)
	{
		list($encoded_sig, $payload) = explode('.', $signed_request, 2);
		// decode the data
		$sig = base64_url_decode($encoded_sig);
		$data = json_decode(base64_url_decode($payload), true);
		if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
			error_log('Unknown algorithm. Expected HMAC-SHA256');
			return null;
		}
		// check sig
		$expected_sig = hash_hmac('sha256', $payload, $secret, $raw = true);
		if ($sig !== $expected_sig) {
			error_log('Bad Signed JSON signature!');
			return null;
		}
		return $data; 
	}

	private static function base64_url_decode($input)
	{
		return base64_decode(strtr($input, '-_', '+/'));
	}

	public static function isFan() {

		if (isset($_POST['signed_request']) ) {
			$fb_data = parse_signed_request($_POST['signed_request'], APP_SECRET);
			//シークレットキーはアプリの基本情報に表示されてるよ
			if ($fb_data) {
				//あなたはファンですか〜？
				if( $fb_data['page']['liked'] ){
					return true;
				}
			}
		}

		return false;
	}
}

