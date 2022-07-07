$(document).ready(()=> {
    getUser()
}) 

function getUser(){
	$.ajax({
	  	type: "POST",
	  	url: BASE_URL + "service/login.php",
	  	data: {
	  		command: "get_data"
	  	},
	  	cache: false,
	  	dataType: "json",
	  	error: function(data){
	  		console.log("error", data)
            console.log(data)
	  	},
	  	success: function(res){
	  		console.log("success")
	  		console.log(res)
	  		if(res.status == true){
	  			var str_html = "";
	  			for(var i in res.data){
	  				var row = res.data[i]
	  				str_html += `<div class="user_box">
                                    <img src="stocks/salad3.jpeg" alt="">
                                    <h5>${row['username']}</h5>
                                </div>`
	  			}
	  			$("#user").html(str_html);
                  return res
	  		}else{
	  			// 
	  		}
     
	  	}
	});
}