$(document).ready(()=> {
    $("#login_btn_submit").click(function(){
        login()
    })
    $("#logout_btn").click(function(){
        logout()
    })
    // checkAccess()
    // getUser()
}) 

// function getUser(){
//     // var user_detail = user
// 	$.ajax({
// 	  	type: "POST",
// 	  	url: BASE_URL + "service/login.php",
// 	  	data: {
// 	  		command: "get_data",
//             // user_detail: user_detail,
// 	  	},
// 	  	cache: false,
// 	  	dataType: "json",
// 	  	error: function(data){
// 	  		console.log("error", data)
//             console.log(data)
// 	  	},
// 	  	success: function(res){
// 	  		console.log("success")
// 	  		console.log(res)
// 	  		if(res.status == true){
// 	  			var str_html = "";
// 	  			for(var i in res.data){
// 	  				var row = res.data[i]
// 	  				str_html += `<div class="user_box">
//                                     <img src="stocks/salad3.jpeg" alt="">
//                                     <h5>${row['username']}</h5>
//                                 </div>`
// 	  			}
// 	  			$("#user").html(str_html);
//                   return res
// 	  		}else{
// 	  			// 
// 	  		}
     
// 	  	}
// 	});
// }

function login(){
	var username = $("#username").val()
	var password = $("#password").val()
    if(username == '' || password == ''){
        alert('Both fields are required');
    }else if(password.length < 6){
        alert('Password need more than 5 charactor')
    }else{
        $.ajax({
            type: "POST",
            url: BASE_URL + "service/login.php",
            data: {
                command: "login",
                username: username,
                password: password
            },
            cache: false,
            dataType: "json",
            success: function(response){
                if(response.status == false){
                    $('#res').html("<div class='alert alert-danger'>Username or Password Invalid</div>")
                }
                else if(response.status ==  true ) {
                    $('#login_modal').hide();
                    // alert('login')
                    window.location.href = BASE_URL+"home";
                }
            }
      });
    } 

}

function logout(){
    var action = 'logout';
    $.ajax({
            type: "POST",
            url: BASE_URL + "service/login.php",
            data: {
               command : "logout",
               action : action
            },
            cache: false,
            dataType: "json",
            success: function(data){
                window.location.href = BASE_URL+"home";
            }
  
    })
}


// function checkRole(){
//     var jwt =  getCookie('jwt')
//     $.post(BASE_URL+"service/validatetoken.php",JSON.stringify({jwt:jwt}))
//     .done(function(result){
//      var check = JSON.parse(result)
//      var user = (check.isAdmin)
//      if(user == 'user'){
//         user
//      }else if(user == 'admin'){
//         user;
//      }
//     })
//     .fail(function(result){
//         console.log(result)
//     })
//      //   location.reload();
//  }

