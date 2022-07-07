<?php
mb_internal_encoding("UTF-8");

// Define WEB_META_BASE_URL
$HTTP_REFERER = isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"]:'http://' . @$_SERVER["SERVER_NAME"] . '/';
list($HTTP_PROTOCAL) = explode(':', $HTTP_REFERER);
if(empty($HTTP_PROTOCAL)) $HTTP_PROTOCAL = 'http';

define("WEB_REWRITE_BASE",  "");
define("WEB_META_BASE_URL",  $HTTP_PROTOCAL."://" . @$_SERVER["SERVER_NAME"] .WEB_REWRITE_BASE. "/");
define("BASE_API",  "http://prospect-api.orisma.alpha/");
define("WEB_META_BASE_API",  BASE_API."v1/");
define("WEB_META_BASE_API_DOC",  BASE_API."doc/");
define("WEB_APP_CALL_API",  WEB_META_BASE_URL."service/call_api.php");
define("WEB_INDEX_PAGE",  "index");
define("LANG",  "");
define("WEB_META_BASE_LANG",  "");


define("COOKIE_DOMAIN", "." . @$_SERVER["SERVER_NAME"] );
define("ENCRYPT_INIT_KEY", "13579defabc12345");
define("ENCRYPT_INIT_VECTOR", "de12fa890c79b387");
define("MONGO_HOST", "localhost");
define("MONGO_PORT", "27017");
define("MONGO_DB", "SCB15B-PROSPECT");
define("ENABLE_LANG", false);
define("UID_LIFE_TIME", time() + 10*60*1000);
define("LIMIT_EXPORT_DATA", 3);


// --------- CUSTOM FIELD TYPE ---------- //
$all_custom_field_type = array();
/*
$temp_custom_field = array();
$temp_custom_field['custom_field_type'] = "Single line";
$temp_custom_field['custom_field_value'] = "single_line";
$all_custom_field_type[] = $temp_custom_field;

$temp_custom_field['custom_field_type'] = "Paragraph Text";
$temp_custom_field['custom_field_value'] = "paragraph_text";
$all_custom_field_type[] = $temp_custom_field;

$temp_custom_field['custom_field_type'] = "Number";
$temp_custom_field['custom_field_value'] = "number";
$all_custom_field_type[] = $temp_custom_field;

$temp_custom_field['custom_field_type'] = "Drop down";
$temp_custom_field['custom_field_value'] = "dropdown";
$all_custom_field_type[] = $temp_custom_field;

$temp_custom_field['custom_field_type'] = "Checkbox";
$temp_custom_field['custom_field_value'] = "checkbox";
$all_custom_field_type[] = $temp_custom_field;

$temp_custom_field['custom_field_type'] = "Date time";
$temp_custom_field['custom_field_value'] = "datetime";
$all_custom_field_type[] = $temp_custom_field;
*/

$all_custom_field_type['single_line'] = "Short text";
$all_custom_field_type['paragraph_text'] = "Paragraph text";
$all_custom_field_type['number'] = "Number";
$all_custom_field_type['dropdown'] = "Drop down";
$all_custom_field_type['checkbox'] = "Checkbox";
$all_custom_field_type['datetime'] = "Date time";

define("ALL_CUSTOM_FIELD_TYPE", json_encode($all_custom_field_type));

$all_event = array();
$all_event['all_event'] = array("website","sms","email");
$all_event['event_mapping'] = array();
$all_event['event_mapping']['website'] = array("website"=>"");
$all_event['event_mapping']['sms'] = array("sms"=>"");
$all_event['event_mapping']['email'] = array("open_email"=>"Open email","click_email"=>"Click link");

define("ALL_EVENT_TYPE", json_encode($all_event));
// -------------------------------------- //


$FIX_CUSTOM_FIELD_CRITERIA = array();
$tmp_custom_field_criteria = array();
$tmp_custom_field_criteria['ref_id'] = "campaign_01";
$tmp_custom_field_criteria['name'] = "campaign name";
$tmp_custom_field_criteria['segment_type'] = "dropdown";
$tmp_custom_field_criteria['segment_value'] = "";
$FIX_CUSTOM_FIELD_CRITERIA['campaign_segment'][] = $tmp_custom_field_criteria;

// $tmp_custom_field_criteria = array();
// $tmp_custom_field_criteria['ref_id'] = "event_01";
// $tmp_custom_field_criteria['name'] = "campaign name";
// $tmp_custom_field_criteria['segment_type'] = "dropdown";
// $tmp_custom_field_criteria['segment_value'] = "";
// $FIX_CUSTOM_FIELD_CRITERIA['event_segment'][] = $tmp_custom_field_criteria;

$tmp_custom_field_criteria = array();
$tmp_custom_field_criteria['ref_id'] = "event_02";
$tmp_custom_field_criteria['name'] = "event name";
$tmp_custom_field_criteria['segment_type'] = "dropdown";
$tmp_custom_field_criteria['segment_value'] = "";
$FIX_CUSTOM_FIELD_CRITERIA['event_segment'][] = $tmp_custom_field_criteria;

$tmp_custom_field_criteria = array();
$tmp_custom_field_criteria['ref_id'] = "event_04";
$tmp_custom_field_criteria['name'] = "event date";
$tmp_custom_field_criteria['segment_type'] = "datetime";
$tmp_custom_field_criteria['segment_value'] = "";
$FIX_CUSTOM_FIELD_CRITERIA['event_segment'][] = $tmp_custom_field_criteria;


$tmp_custom_field_criteria = array();
$tmp_custom_field_criteria['ref_id'] = "score_01";
$tmp_custom_field_criteria['name'] = "score specify";
$tmp_custom_field_criteria['segment_type'] = "number";
$tmp_custom_field_criteria['segment_value'] = "";
$FIX_CUSTOM_FIELD_CRITERIA['score_segment'][] = $tmp_custom_field_criteria;

$tmp_custom_field_criteria = array();
$tmp_custom_field_criteria['ref_id'] = "score_02";
$tmp_custom_field_criteria['name'] = "score summary";
$tmp_custom_field_criteria['segment_type'] = "number";
$tmp_custom_field_criteria['segment_value'] = "";
$FIX_CUSTOM_FIELD_CRITERIA['score_segment'][] = $tmp_custom_field_criteria;

define('FIX_CUSTOM_FIELD_CRITERIA',json_encode($FIX_CUSTOM_FIELD_CRITERIA));

$ALL_FIXED_FIELD = array("campaign_01","event_02","event_04","score_01","score_02");
define('ALL_FIXED_FIELD',json_encode($ALL_FIXED_FIELD));

define('NO_EMAIL_FIELD_TEXT',"UNKNOWN");

define('LIMIT_ITEM',10);
define('BASE_URL','http://test.alpha/');
define('SERCRET_KEY','yonko');
define('ALGO','HS256');
define('COOKIE',isset($_COOKIE['jwt']) ? $_COOKIE['jwt'] : "");

?>