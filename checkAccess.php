<?
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// function checkAccess($jwt){
// 	if($jwt){
// 		$key = SERCRET_KEY;
// 		try{
// 			$decoded = JWT::decode($jwt,new Key($key, ALGO)) ;
// 			$response=$decoded;
// 			$status_value = $response;
//             return $status_value;
//             echo json_encode($status_value);
//             var_dump($status_value);
            
// 		}
// 		//if token not valid
// 		catch(Exception $error){
// 			$response=['msg'=> 'Access Denied','status'=> 400, 'Data' => $error->getMessage()];
// 			if (isset($_SERVER['HTTP_COOKIE'])) {
// 				$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
// 				foreach($cookies as $cookie) {
// 					$parts = explode('=', $cookie);
// 					$name = trim($parts[0]);
// 					setcookie($name, '', time()-10);
// 					setcookie($name, '', time()-10, '/');
// 				}
// 			}
// 			header("Location: /home");
// 		}
// 	}elseif(!$jwt){
// 		if(!strpos(OMCore\OMRoute::path(), "home")){
// 			header("Location: /home");
// 		}
// 	}
// }
?>