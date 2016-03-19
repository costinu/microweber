<?php

api_expose( 'mobilpay_up_cert' );
api_expose( 'mobilpay_up_key' );

/* upload certificate for mobilpay */
function mobilpay_up_cert( $data ) {
	if ( ! is_admin() ) {

		return;
	}

	$host = (parse_url(site_url()));

	$host_dir = false;
	if (isset($host['host'])) {
		$host_dir = $host['host'];
		$host_dir = str_ireplace('www.', '', $host_dir);
		$host_dir = str_ireplace('.', '-', $host_dir);
	}

	$target_path = media_base_path().DS;
	$target_path = media_base_path().DS.'uploaded'.DS;
	$target_path = normalize_path($target_path, 0);

	$response = array();

	if ( Input::hasFile( 'mobilpay_public_certificate' ) ) {
		$filename = Input::file('mobilpay_public_certificate')->getClientOriginalName();
		$extension = Input::file('mobilpay_public_certificate')->getClientOriginalExtension();

		if ($extension != 'cer') {
			$response = array('status' => 'error', 'message' => 'Invalid extension');
		} else {
			try {
				$file = Input::file('mobilpay_public_certificate')->move($target_path, $filename);

				$value = array('path'=>$target_path.DS.$filename, 'filename'=> $filename);

				$option = array();
				$option['option_key'] = 'mobilpay_public_certificate';
			    $option['option_value'] = json_encode($value);
			    $option['option_group'] = 'payments';
			    save_option($option);

				$response = array('status' => 'success', 'message' => 'File uploaded', 'filename' => $filename);
			} catch(Exception $e) {

				$response = array('status' => 'error', 'message' => $e->getMessage());
				// You might want to log $e->getMessage() as that will tell you why the file failed to move.
			}
		}

	} else {
		$response = array('status' => 'error', 'message' => 'No file uploaded');
	}
	//exit;
	return json_encode($response);
}

function mobilpay_up_key( $data ) {
	if ( ! is_admin() ) {

		return;
	}

	$host = (parse_url(site_url()));

	$host_dir = false;
	if (isset($host['host'])) {
		$host_dir = $host['host'];
		$host_dir = str_ireplace('www.', '', $host_dir);
		$host_dir = str_ireplace('.', '-', $host_dir);
	}

	$target_path = media_base_path().DS;
	$target_path = media_base_path().DS.'uploaded'.DS;
	$target_path = normalize_path($target_path, 0);

	$response = array();

	if ( Input::hasFile( 'mobilpay_private_key' ) ) {
		$filename = Input::file('mobilpay_private_key')->getClientOriginalName();
		$extension = Input::file('mobilpay_private_key')->getClientOriginalExtension();

		if ($extension != 'key') {
			$response = array('status' => 'error', 'message' => 'Invalid extension');
		} else {
			try {
				$file = Input::file('mobilpay_private_key')->move($target_path, $filename);

				$value = array('path'=>$target_path.DS.$filename, 'filename'=> $filename);

				$option = array();
				$option['option_key'] = 'mobilpay_private_key';
				$option['option_value'] = json_encode($value);
				$option['option_group'] = 'payments';
				save_option($option);

				$response = array('status' => 'success', 'message' => 'File uploaded', 'filename' => $filename);
			} catch(Exception $e) {

				$response = array('status' => 'error', 'message' => $e->getMessage());
				// You might want to log $e->getMessage() as that will tell you why the file failed to move.
			}
		}

	} else {
		$response = array('status' => 'error', 'message' => 'No file uploaded');
	}
	//exit;
	return json_encode($response);
}