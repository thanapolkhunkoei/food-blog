<?php
	require('../system/common.php');

	use OMCore\OMDb;

	$DB = OMDb::singleton();
	
	$response = array();
	$response['status'] = false;
	$command = isset($_POST['command']) ? $_POST['command'] : "";
	// $command = "insert_data";
	if($command == "get_data"){
		$input = 1;
		$sql = "select * from member limit 2,2";
		$ds = null;
		$sql_param = array();
		$sql_param['member_id'] = $input;
		$res = $DB->query($ds, $sql, $sql_param, 0, -1, "ASSOC");
		if($res !== -1){
			// success
			$response['status'] = true;
			$response['data'] = $ds;
		}else{
			// error
			$response['error_message'] = "db_error";
		}
		// var_dump($ds);
		// var_dump($ds[0]['username']);
		// // var_dump($res);
		// exit();
	}else if($command == "insert_data"){
		$username = isset($_POST['username']) ? $_POST['username'] : "";
		$password = isset($_POST['password']) ? $_POST['password'] : "";

		$member_id = "";
		$sql_param = array();
		$sql_param['username'] = $username;
		$sql_param['password'] = $password;
		$sql_param['created_date'] = date('Y-m-d H:i:s');
		$sql_param['member_status'] = "T";
		$res = $DB->executeInsert('member', $sql_param, $member_id);
		if($res !== -1){
			// success
			$response['status'] = true;
			$response['data'] = $member_id;
		}else{
			// error
			$response['error_message'] = "db_error";
		}
	}else if($command == "update_data"){
		$member_id = isset($_POST['member_id']) ? $_POST['member_id'] : "";
		$username = isset($_POST['username']) ? $_POST['username'] : "";
		$password = isset($_POST['password']) ? $_POST['password'] : "";

		// $member_id = "";
		$sql_param = array();
		$sql_param['member_id'] = $member_id;
		$sql_param['username'] = $username;
		$sql_param['password'] = $password;
		$sql_param['created_date'] = date('Y-m-d H:i:s');
		$res = $DB->executeUpdate('member', 1, $sql_param);
		if($res !== -1){
			// success
			$response['status'] = true;
			// $response['data'] = $member_id;
		}else{
			// error
			$response['error_message'] = "db_error";
		}
	}else if($command == "delete_data"){
		$member_id = isset($_POST['member_id']) ? $_POST['member_id'] : "";

		$sql = "delete from member where member_id = @member_id";
		$sql_param = array();
		$sql_param['member_id'] = $member_id;
		$res = $DB->execute($sql, $sql_param);
		if($res !== -1){
			// success
			$response['status'] = true;
			// $response['data'] = $member_id;
			`'<svg   mt-1"  xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" onclick="editData('+row['menu_id']+')" viewBox="0 0 16 16">'+
			'<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>'+
			  '<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>'+
		  '</svg>'+`;
		}else{
			// error
			$response['error_message'] = "db_error";
		
		}
	}

	echo json_encode($response);
?>