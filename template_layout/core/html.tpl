<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?=$OMPage->getVar("Blog food")?></title>
	<meta name="description" content="<?=$OMPage->getVar("window_description")?>" />
	<meta name="keywords" content="<?=$OMPage->getVar("window_keywords")?>" />
	<link rel="shortcut icon" href="<?=WEB_META_BASE_URL?>image/favicon.ico" />
	<link href="<?=WEB_META_BASE_URL?>css/comp.css<?=$OMPage->merge_media("css")?>" rel="stylesheet" type="text/css" />
	<link rel="canonical" href="<?=$OMPage->omroute("current_url")?>" />
	
	<meta property="fb:app_id" content="<?=$OMPage->getVar("fb_app_id")?>"/>
	<meta property="og:site_name" content="<?=$OMPage->getVar("og_site_name")?>"/>
	<meta property="og:type" content="<?=$OMPage->getVar("og_type")?>"/>
    <meta property="og:title" content="<?=$OMPage->getVar("og_title")?>"/>
    <meta property="og:description" content="<?=$OMPage->getVar("og_description")?>"/>
    <meta property="og:url" content="<?=$OMPage->omroute("current_url")?>"/>
	<?php
		if(isset($OMPage->sharedImage) && $OMPage->sharedImage != ""){
			if(count($OMPage->sharedImage) > 1){
				foreach ($OMPage->sharedImage as $path) {
	?>
    <meta property="og:image" content="<?=$OMPage->stocks($path)?>" ref="asarray" >
	<?php
				}
			}else{
	?>
    <meta property="og:image" content="<?=$OMPage->stocks($OMPage->sharedImage[0])?>" >
	<?php
			}
		}else{
	?>
	    <meta property="og:image" content="<?=$OMPage->stocks('images/layout/logo.jpg')?>" >
	<?php
		}
	?>
	<base href="<?=WEB_META_BASE_URL?>" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/core/jquery-1.11.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Smooch&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

	<?php include $theme_dir . "body.tpl"; ?>

<script type="text/javascript">
	var LANG = '<?=LANG?>';
	var BASE_URL = '<?=WEB_META_BASE_URL?>';
	var BASE_LANG = '<?=WEB_META_BASE_LANG?>';
</script>
<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/comp.js<?=$OMPage->merge_media("js")?>"></script>
</body>
</html>
