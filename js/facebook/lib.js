function fb_redirect(){
	$("#loading_msg").html('Redirect to login...');
	window.top.location.href = (fblogin_url);
// alert(fblogin_url);
}


function postToWallUI(msgTxt){
	var msgObj = {
		method: 'feed',
		message: msgTxt.txt,
		link:fb_var.tab_page,
		name: msgTxt.name,
		picture: fb_var.share_url+msgTxt.pic,
		description: msgTxt.desc
	};

	FB.ui(msgObj, function(response) {
	    if (response.post_id) {
		return true;
	    } else {
		return false;
	    }
  	});
}


function checkUserLogin() {
	$("#loading_msg").html('Permission checking ...');
	FB.api('/me',  function(response) {
		if (!response || response.error) {
			fb_redirect();
		} else {
			dimRemove();
			fb_me = response;
			updateGameCenter(fb_me);
		}
	});
}
