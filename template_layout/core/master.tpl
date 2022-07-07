<?php

	$OMPage = new OMCore\OMPage();

	ob_start();
    require $_controllerPath;
    $HTML_CONTENT = ob_get_contents();
    ob_end_clean();

	$theme_dir = "default";
    if(isset($theme)){
    	$theme_dir = TMPL_DIR . $theme ."/";
    }else{
    	$theme_dir = TMPL_DIR . $theme_dir ."/";
    }

include TMPL_DIR . 'core/html.tpl';
