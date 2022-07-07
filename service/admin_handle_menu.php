<?php
	require('../system/common.php');

	use OMCore\OMDb;

	$DB = OMDb::singleton();

	$response = array();
	$response['status'] = false;
	$command = isset($_POST['command']) ? $_POST['command'] : "";
	$num_per_page = 10;
	if($command == "getmenu_admin_data"){
		$query = "SELECT * FROM recipe ";
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $start_from = ($page-1)*10;
        $limit = " LIMIT $start_from,$num_per_page";
		$sql = $query.$limit;
		$sql1 = "SELECT COUNT(*) as num FROM recipe";

		$ds = null;
		$sql_param = array();
		$res = $DB->query($ds, $sql, $sql_param, 0, -1, "ASSOC");

		$ds1 = null;
		$sql_param1 = array();
		$res = $DB->query($ds1, $sql1, $sql_param, 0, -1, "ASSOC");

		if($res !== -1){
			// success
			$response['status'] = true;
			$response['data'] = [];
            $response['data']['list'] = $ds;
            $response['data']['page'] = $page;
            $response['data']['total'] = $ds1[0]['num'];
		}else{
			// error
			$response['error_message'] = "db_error";
		}
		echo json_encode($response);
	}else if($command == "insert_data"){
		$name = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
		$ingredients = isset($_POST['menu_ingredients']) ? $_POST['menu_ingredients'] : "";
		$method = isset($_POST['menu_method']) ? $_POST['menu_method'] : "";
		$type = isset($_POST['menu_type']) ? $_POST['menu_type'] : "";
		// $image = isset($_FILES['menu_image']['name']) ? $_FILES['menu_image']['name'] : "";

		$coutfiles = count($_FILES['menu_image']['name']);
		$upload_location = "../stocks/";
		$image =array();
		for($index = 0; $index < $coutfiles; $index++){
			if(isset($_FILES['menu_image']['name'][$index]) && $_FILES['menu_image']['name'][$index] != ''){
				$filename = $_FILES['menu_image']['name'][$index];
				$imagename = uniqid(mt_rand()).$filename;
				$ext = strtolower(pathinfo($imagename, PATHINFO_EXTENSION));
				$valid_ext = array("png","jpeg","jpg");
				if(in_array($ext, $valid_ext)){
					// File path
					$path = $upload_location.$imagename;
					// Upload file
					if(move_uploaded_file($_FILES['menu_image']['tmp_name'][$index],$path)){
					   $image[] = $imagename;
					}
			 }
			}	
		}

		$menu_id = "";
		$sql_param = array();
		$sql_param['menu_name'] = $name;
		$sql_param['menu_ingredients'] = $ingredients;
		$sql_param['menu_method'] = $method;
		$sql_param['menu_type'] = $type;
		$sql_param['menu_image'] = json_encode($image);
	
		$res = $DB->executeInsert('recipe', $sql_param,$menu_id );
		// var_dump($res);

		if($res !== -1){
			// success
			$response['status'] = true;
			$response['data'] = $menu_id;
		}else{
			// error
			$response['error_message'] = "db_error";
		}
		echo json_encode($response);
	}else if($command == "update_data"){
		$menu_id = isset($_POST['menu_id']) ? $_POST['menu_id'] : "";
		$name = isset($_POST['menu_name']) ? $_POST['menu_name'] : "";
		$ingredients = isset($_POST['menu_ingredients']) ? $_POST['menu_ingredients'] : "";
		$method = isset($_POST['menu_method']) ? $_POST['menu_method'] : "";
		$type = isset($_POST['menu_type']) ? $_POST['menu_type'] : "";
		$image = isset($_FILES['menu_image']['name']) ? $_FILES['menu_image']['name'] : "";

		$menu_id = $menu_id;
		$sql_param = array();
		// $sql_param['menu_id'] = $menu_id;
		$sql_param['menu_name'] = $name;
		$sql_param['menu_ingredients'] = $ingredients;
		$sql_param['menu_method'] = $method;
		$sql_param['menu_type'] = $type;
		$sql_param['menu_image'] = $image;
		// $sql_param['created_date'] = date('Y-m-d H:i:s');
		$res = $DB->executeUpdate('recipe', 1, $sql_param);
		if($res !== -1){
			// success
			$response['status'] = true;
			// $ext = pathinfo($filename,PATHINFO_EXTENSION);
			// $valid_ext = array('png','jpeg','jpg');
			
			// if(in_array($ext,$valid_ext)){
			// 	$path =$upload_location.$filename;

			// 	if(move_uploaded_file($_FILES['menu_image']['tmp_name'][$index],$path)){
			// 		$image[] =$path;
			// 	}
			// }
			// $response['data'] = $member_id;
		}else{
			// error
			$response['error_message'] = "db_error";
		}
		echo json_encode($response);
	}else if($command == "delete_data"){
		$menu_id = isset($_POST['menu_id']) ? $_POST['menu_id'] : "";
		$sql = "delete from recipe where menu_id = $menu_id";
		$sql_param = array();
		$sql_param['menu_id'] = $menu_id;
		$res = $DB->execute($sql, $sql_param);
		if($res !== -1){
			// success
			$response['status'] = true;
			// $response['data'] = $member_id;
		}else{
			// error
			$response['error_message'] = "db_error";
		}
		echo json_encode($response);
	}else if($command == "edit_data"){
		$menu_id = isset($_POST['menu_id']) ? $_POST['menu_id'] : "";
		$sql = "select * from recipe where menu_id = $menu_id";
		$ds = null;
		$sql_param = array();
		$sql_param['menu_id'] = $menu_id;
		$res = $DB->query($ds, $sql, $sql_param, 0, -1, "ASSOC");
		if($res !== -1){
			// success
			$response['status'] = true;
			$response['data'] = $ds;
		}else{
			// error
			$response['error_message'] = "db_error";
		}
		echo json_encode($response);
	}elseif($command == "getSearch_data"){
		$search = isset($_POST['search']) ? $_POST['search'] : "";
		$sql = "select * from recipe where menu_type = '$search'";
		$ds = null;
		$sql_param = array();
		$res = $DB->query($ds, $sql, $sql_param, 0, -1, "ASSOC");
		if($res !== -1){
			// success
			$response['status'] = true;
			$response['data'] = $ds;
		}else{
			// error
			$response['error_message'] = "db_error";
		}
		echo json_encode($response);
	}

	
?>

