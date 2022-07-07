<?php
	require('../system/common.php');
	require('../php-jwt/src/BeforeValidException.php');
	require('../php-jwt/src/ExpiredException.php');
	require('../php-jwt/src/JWK.php');
	require('../php-jwt/src/JWT.php');
	require('../php-jwt/src/Key.php');
	require('../php-jwt/src/SignatureInvalidException.php');
	use Firebase\JWT\JWT;
	use Firebase\JWT\Key;

	ob_start();
	use OMCore\OMDb;
	$DB = OMDb::singleton();
	$response = array();
	$response['status'] = false;
	$command = isset($_POST['command']) ? $_POST['command'] : "";
	if($command == "get_data"){
		$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id']: '';
		$sql = "select * from user where user_id != @user_id";
		$ds = null;
		$sql_param = array();
		$sql_param['user_id'] = $user_id;
		$res = $DB->query($ds, $sql, $sql_param, 0, -1, "ASSOC");
		if($res !== -1){
			// success
			$response['status'] = true;
			$response['data'] = $ds;
		}else{
			// error
			$response['error_message'] = "db_error";
           var_dump($res);
		}
		echo json_encode($response);
	}else if($command == "login"){
		$username = isset($_POST['username']) ? $_POST['username'] : "";
		$password = isset($_POST['password']) ? md5($_POST['password']) : "";
		$sql = "select * from user where username = @username and password = @password ";
		$ds = null;
		$sql_param = array();
		$sql_param['username'] = $username;
		$sql_param['password'] = $password;
		$res = $DB->query($ds, $sql, $sql_param, 0, -1, "ASSOC");
		if($res > 0 ){
			// success
			$key = SERCRET_KEY;
			$payload = array(
				"id" => $ds[0]['user_id'],
				"user" => $ds[0]['username'],
				"isAdmin" => $ds[0]['is_admin'],
				"exp" => time()+ 3600
			);
			$response['status'] = true;
			$response['data'] = [];
			$jwt = JWT::encode($payload,$key,"HS256");
			setcookie("jwt",$jwt,time()+3600,"/");
			// $response['data']['isAdmin'] = $ds[0]['is_admin'];
			$response['data']['jwt'] = $jwt;
		}else{
			// error
			$response['error_message'] = "db_error";
           	// var_dump($ds);
			// echo "No";
		}
		echo json_encode($response);
	}else if($command == "logout") {
		if(isset($_POST['action'])){
			if (isset($_SERVER['HTTP_COOKIE'])) {
				$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
				foreach($cookies as $cookie) {
					$parts = explode('=', $cookie);
					$name = trim($parts[0]);
					setcookie($name, '', time()-10);
					setcookie($name, '', time()-10, '/');
				}
			}
		}
		echo json_encode($response);
	}else if($command == "checkAccess"){
		try{ 
			$jwt = isset($_POST['token'])?$_POST['token']:""; 
			$key = SERCRET_KEY;
			$decoded = JWT::decode($jwt,new Key($key, ALGO)) ;
			$response=$decoded;
		}
		catch(Exception $error){
			$response = 'error';
		}
		echo json_encode($response);
	}
	
?>

