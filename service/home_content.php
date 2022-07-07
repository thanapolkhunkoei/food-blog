<?php
	require('../system/common.php');

	use OMCore\OMDb;

	$DB = OMDb::singleton();
    
	$response = array();
	$response['status'] = false;
	$command = isset($_POST['command']) ? $_POST['command'] : "";
 
    $num_per_page = 8;
	if($command == "getlist_home_data"){
        $query = "SELECT * FROM recipe ";
        $queryCount = "SELECT COUNT(*) as num FROM recipe ";
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $start_from = ($page-1)*6;
        $limit = " LIMIT $start_from,$num_per_page";
		if(isset($_POST['search']) ? $_POST['search'] : "")
		{
			$search = $_POST['search'];
			$sql = $query."where menu_name = '$search'".$limit;
            $sql1 =  $queryCount."where menu_name = '$search'";
        }
        elseif(isset($_POST['menu_type']) ? $_POST['menu_type'] : "")
        {   
            $menu_type = $_POST['menu_type'];
            $sql = $query."where menu_type = '$menu_type'".$limit;
            $sql1 =  $queryCount."where menu_type = '$menu_type'";
        }
        else{
            $sql = $query.$limit;
            $sql1 = $queryCount;
		} 

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
	}
	echo json_encode($response);
    
?>