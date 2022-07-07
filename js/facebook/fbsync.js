
var fb_ready = $.noop;
var fb_uid = 0;
var accessToken = '';
var isAuthSession = false;
$(document).ready(function(){
	if (!isAuthSession){
		dimScreen('Facebook api Initialing...');
	}else{
		$("#page").show();
	}
});

window.fbAsyncInit = function() {

	FB.init({
	  appId      : FB_APPID, // App ID
	  status     : true, // check login status
	  cookie     : 1, // enable cookies to allow the server to access the session
	  oauth      : true, // enable OAuth 2.0
	  xfbml      : true  // parse XFBML
	});
	FB.Canvas.scrollTo(0,0);
	FB.Canvas.setAutoGrow();

	if (!isAuthSession){
		$("#loading_msg").html('User status checking...');
		FB.getLoginStatus(function(response) {
				console.log("response: ", response);
			if (response.status == 'connected') {
				// console.log("response: ", response);

			} else {
				// fb_redirect();
			}
		});
	}
};



