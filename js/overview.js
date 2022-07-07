$(document).ready(function(){
	console.log('ready overview');
	getData();
	$("#submitButton").click(submitButton)
});

function getData(){
	$.ajax({
	  	type: "POST",
	  	url: BASE_URL + "service/api.php",
	  	data: {
	  		command: "get_data"
	  	},
	  	cache: false,
	  	dataType: "json",
	  	error: function(data){
	  		console.log("error", data)
	  	},
	  	success: function(res){
	  		console.log("success")
	  		console.log(res)
	  		if(res.status == true){
	  			var str_html = "";
	  			for(var i in res.data){
	  				var row = res.data[i]
	  				str_html += "<div>"+row['username']+" => "+row['password']+"</div>"
	  			}
	  			$("#test").html(str_html);
	  		}else{
	  			// 
	  		}
	  	}
	});
}

function submitButton(){
	var username = $("#username").val()
	var password = $("#password").val()

	$.ajax({
	  	type: "POST",
	  	url: BASE_URL + "service/api.php",
	  	data: {
	  		command: "delete_data",
	  		member_id: 1,
	  		username: username,
	  		password: password
	  	},
	  	cache: false,
	  	dataType: "json",
	  	error: function(data){
	  		console.log("error", data)
	  	},
	  	success: function(res){
	  		getData();
	  	}
	});

	console.log("submitButton")
	console.log(username, password)
}

