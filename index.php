<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('system/common.php');
require('php-jwt/src/BeforeValidException.php');
require('php-jwt/src/ExpiredException.php');
require('php-jwt/src/JWK.php');
require('php-jwt/src/JWT.php');
require('php-jwt/src/Key.php');
require('php-jwt/src/SignatureInvalidException.php');

$user_status =  checkAccess();

$_controllerPath = ROOT_DIR ."controllers/". OMCore\OMRoute::path() . '.php';

if(isset($user_status)){
	if($user_status->isAdmin != "admin"){
		if(strpos($_controllerPath, "admin")){
			header("Location:".BASE_URL."home");
		}
	}
}elseif(!isset($user_status)){
	if(strpos($_controllerPath, "admin")){
		header("Location:".BASE_URL."home");
	}
}

// echo "config: " .WEB_INDEX_PAGE;
// echo "<br />";
// $smarty->assign("WINDOW_TITLE" ,"test naja");

if(is_file($_controllerPath)) {

	include TMPL_DIR .'core/master.tpl';

}else{
	http_response_code(404);
	OMCore\OMRoute::notFound();
	// $smarty  = new OMPage();
	// $smarty->display('404');
}

?>