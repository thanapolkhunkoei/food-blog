<?php
	var_dump("overview");

	$PAGE_VAR["css"][] = "overview";
	$PAGE_VAR["js"][] = "overview";

	// $res = numberFormat(100000);

?>

<script type="text/javascript">
	var limit_item = <?=LIMIT_ITEM;?>
</script>

<div id="test" style="height: 100px;">XXXXX</div>



<input id="username" placeholder="username"></input>
<input id="password" placeholder="password"></input>
<button id="submitButton">Submit</button>