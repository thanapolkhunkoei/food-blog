<?php

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('ROOT_DIR')) {
	$__file__ = explode( "system".DS , __FILE__ );
    define('ROOT_DIR', $__file__[0] );
	define('SYS_DIR', ROOT_DIR.'system/');
	define('TMPL_DIR', ROOT_DIR.'template_layout/');
	define('CTRL_DIR', ROOT_DIR.'controllers/');
}
require ROOT_DIR .'wcm/setting.php';
require ROOT_DIR .'system/configs/config.php';
require ROOT_DIR .'system/lib/global_lib.php';

use OMCore\OM;
use OMCore\OMDb;

function bypassLogin($username,$password){

    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL             => WEB_META_BASE_URL."login/index.php",
        CURLOPT_POST            => true,
        CURLOPT_RETURNTRANSFER  => true,
        CURLOPT_POSTFIELDS      => array(
            "cmd"       => "login",
            "username"  => $username,
            "password"  => $password
        )
    );

    curl_setopt_array($ch, $curlConfig);
    $result = json_decode(curl_exec($ch) , true);
    curl_close($ch);

    $_SESSION["OM_USER"] = $result['data'];
}

function numberFormat($data) {
    return number_format($data, 0, '.', ',');
}

function getAllCampaign(){
    $DB = OMDb::singleton();
    $all_campaign_list = array();
    $sql = "select campaign_name,campaign_id from campaign_list";
    $ds = null;
    $res = $DB->query($ds,$sql,null,0,-1,"ASSOC");
    foreach ($ds as $key => $value) {
        $all_campaign_list['campaign_'.$value['campaign_id']] = $value;
    }
    return $all_campaign_list;
}

function getAllEvent(){
    $DB = OMDb::singleton();
    $all_event_list = array();
    $sql = "select event_campaign_id,event_name,a.campaign_id,b.campaign_name from event_campaign_mapping a left join campaign_list b on a.campaign_id = b.campaign_id";
    $ds = null;
    $res = $DB->query($ds,$sql,null,0,-1,"ASSOC");
    foreach ($ds as $key => $value) {
        $all_event_list['event_'.$value['event_campaign_id']] = $value;
    }
    return $all_event_list;
}

function humanTiming($time) {

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }
    
    return "0 second";
}

function includeIfExists($file)
{
    return file_exists($file) ? include $file : false;
}

if ((!$loader = includeIfExists(__DIR__.'/../vendor/autoload.php')) && (!$loader = includeIfExists(__DIR__.'/../../../autoload.php'))) {
    echo 'You must set up the project dependencies, run the following commands:'.PHP_EOL.
        'curl -sS https://getcomposer.org/installer | php'.PHP_EOL.
        'php composer.phar install'.PHP_EOL;
    exit(1);
}



$PAGE_VAR["js"] = array();
$PAGE_VAR["css"] = array("site");

function clearOldFileAtPath($folderPath,$older_day) {
    if (file_exists($folderPath)) {
        foreach (new DirectoryIterator($folderPath) as $fileInfo) {
            if ($fileInfo->isDot()) {
            continue;
            }
            if (time() - $fileInfo->getCTime() >= $older_day*24*60*60) {
                unlink($fileInfo->getRealPath());
            }
        }
    }
}

function genNewFileName($filename) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    return uniqid().".".$ext;
}

function genAccessToken($username){
    $time = strtotime(date('Y-m-d H:i:s'));
    $characters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    $out = "";
    for($i=0;$i<5;$i++){
        $rand_num = rand(0,60);
        $alpha_out = $characters[$rand_num];
        $out = $out.$alpha_out;
    }
    $token = md5($username."_".$time."_".$out);
    return $token;
}

function generateAPIKey() {
    $DB = OMDb::singleton();

    $dt = null;
    $str_sql = "UPDATE api_key SET status = 'inactive' , modify_date = @modify_date WHERE status = 'active' ";
    $param_sql = array();
    $param_sql["modify_date"] = date("Y-m-d H:i:s");

    $res = array();
    $dt = null;
    $r = $DB->execute($str_sql,$param_sql);


    $api_key = randomAPIKey();

    $param_sql = array();
    $param_sql["api_key"] = $api_key;
    $param_sql["ip_start"] = "127.0.0.1";
    $param_sql["ip_end"] = "127.0.0.1";
    $param_sql["key_type"] = "system";
    $param_sql["key_description"] = "System";
    $param_sql["status"] = "active";
    $param_sql["create_date"] = date("Y-m-d H:i:s");
    $param_sql["modify_date"] = date("Y-m-d H:i:s");
    $DB->executeInsert("api_key",$param_sql,$content_id);

    return $api_key;
}

function randomAPIKey() {
    $api_key = base64_encode(rand(100000, 999999) . uniqid() . rand(100000, 999999) );

    $api_key = str_replace(array("=="), array(""), $api_key);

    return $api_key;
}

function checkAPIKey($api_key) {
    $DB = OMDb::singleton();
    
    $str_sql = "SELECT api_key FROM api_key WHERE api_key = @api_key and status = 'active' and key_type = 'system' ";
    
    $dt = null;
    $param = array();
    $param["api_key"] = $api_key;
    $r = $DB->query($dt,$str_sql,$param,0,-1,"ASSOC");

    if ($r <= 0) {
        return false;
    } else {
        return true;
    }
}

function getActiveAPIKey() {
    $DB = OMDb::singleton();
    
    $str_sql = "SELECT api_key FROM api_key WHERE status = 'active' and key_type = 'system' ";
    $dt = null;
    $r = $DB->query($dt,$str_sql,null,0,-1,"ASSOC");

    if ($r <= 0) {
        return null;
    } else {
        return $dt[0]["api_key"];
    }
}

function generateTransactionId() {
    $date = new DateTime();
    return (($date->format('U') * 1000) + mt_rand(0,999));
}

// function validateRefToken($ref_token){
    
//     $param = array();
//     $param["command"] = "invite_friend.validate_referrer_token";
//     $param["ref_token"] = $ref_token;
//     $output = json_decode(OM::cURL('',WEB_META_BASE_API,$param), true);
    
//     if ($output["status"] == "200") {
//         return true;
//     }else{
//         return false; 
//     }
// }

function generateEventKey() {
    $DB = OMDb::singleton();

    $check_status = false;
    // while ($check_status == false) {
        $event_key = base64_encode(randomChar(3).rand(100000, 999999) . uniqid() . rand(100000, 999999).randomChar(3) );
        $event_key = str_replace(array("=="), array(""), $event_key);
        $sql = "select event_campaign_id from event_campaign_mapping where event_key = @event_key";
        $sql_param = array();
        $sql_param['event_key'] = $event_key;
        $ds = null;
        $res = $DB->query($ds,$sql,$sql_param,0,-1,"ASSOC");
        if($res > 0){
            return false;
        }
    // }
    

    return $event_key;
}

function randomChar($size){
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $result = '';
    for ($i = 0; $i < $size; $i++){
        $result .= $characters[mt_rand(0, 61)];
    }
    return $result;
}

function generateUQID(){
    $unique_id = uniqid();
    $start_rand = genUQ(9);
    $end_rand = genUQ(10);
    $get_uq = $start_rand.$unique_id.$end_rand;
    return $get_uq;
}

function genUQ($length){
    $characters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","0","1","2","3","4","5","6","7","8","9","+","/");
    $out = "";
    for($i=0;$i<$length;$i++){
        $rand_num = rand(0,63);
        $alpha_out = $characters[$rand_num];
        $out = $out.$alpha_out;
    }
    return $out;
}

function getProspectConfig($config_key){
    $DB = OMDb::singleton();
    $sql = "select config_value from prospect_config where config_key = @config_key";
    $sql_param = array();
    $sql_param['config_key'] = $config_key;
    $ds = null;
    $res = $DB->query($ds,$sql,$sql_param,0,-1,"ASSOC");

    $val = isset($ds[0]['config_value']) ? $ds[0]['config_value'] : "";
    return $val;
}

function convertTime($time){
    $tmp_time = explode("-", $time);
    if(count($tmp_time) != 2){
        return $time;
    }
    $date = explode("/", trim($tmp_time[0]));
    if(count($date) != 3){
        return $time;
    }
    $date = $date[2]."-".$date[1]."-".$date[0];
    $time = trim($tmp_time[1]).":00";
    return $date." ".$time;
}

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function checkAccess(){
    $token = isset($_COOKIE["jwt"])? ($_COOKIE["jwt"]) : "" ;
    $url = BASE_URL.'service/login.php';
    $myvars = 'token='.$token.'&command=checkAccess';
    try{
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
        $content = curl_exec( $ch );
        curl_close($ch);
        $error = json_decode($content);
        if($error == 'error'){
            if (isset($_SERVER['HTTP_COOKIE'])) {
                $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
                foreach($cookies as $cookie) {
                    $parts = explode('=', $cookie);
                    $name = trim($parts[0]);
                    setcookie($name, '', time()-10);
                    setcookie($name, '', time()-10, '/');
                }
                header("Location:".BASE_URL."home");
            }
        }else {
            $res = json_decode($content);
            $_SESSION['user_id'] = $res->id;
            return $res;
        }
    }catch(Exception $error){
        if($error){
        echo '<script language="javascript" type="text/javascript"> 
                        alert("No token");
              </script>';
    }
    header("Location:".BASE_URL."home");
    }
}

?>