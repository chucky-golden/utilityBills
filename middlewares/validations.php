<?php
	require_once 'db.php';
    use Connect\Connection;

	// trim input data
	function trimData($data){
		$db = new Connection();

		$data = htmlspecialchars($data);
		$data = trim($data);
		$data = stripcslashes($data);

		$data = mysqli_real_escape_string($db->dbConnect, $data);

		return $data;
	}

	// making sure all fields are entered
	function empty_details($details){
		foreach ($details as $key => $value) {
			if($value == ''){
				return 'false';
			}
		}
	}
	
	// encrypt password
	function password_encrypt($pass){
		return sha1(md5(sha1(md5($pass))));
	}


?>