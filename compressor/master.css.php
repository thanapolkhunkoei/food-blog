<?php
header("Content-type: text/css");
 $root_dir = realpath("../");

// readfile($root_dir.'/css/site.css');

if( isset($_GET['f'])){
	$files = explode(',', $_GET['f']);
	foreach ($files as $key ) {
		// var_dump($key);
		readfile($root_dir.'/css/'.$key.'.css');
	}
}
?>