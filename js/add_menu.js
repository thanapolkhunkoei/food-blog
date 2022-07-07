$(document).ready(function() {
	getmenu_admin_data(page);
	$("#addMenu").click(addMenu)
	$('#uploadImg').click(function(e){
		e.preventDefault()
		$('#files')[0].click()
	})
	$("#menu-toggle").click(function(e) {
		e.preventDefault();
		$("#wrapper").toggleClass("toggled");
	});	
	$("#header>.menu-button").click(function() {
		$(".side_menu").toggleClass("open");
		$(".copyright").toggleClass("show");
	});
	$(".side_menu, #top-bar, #content-wrapper").click(function(e) {
		$(".side_menu").removeClass("open");
		$(".copyright").removeClass("show");
	});
	
	let upload2= new UploadImg()
	upload2.DragAndDrop()
});

var upload_file = [];

var page = 1;
$num_per_page = 10;

function getmenu_admin_data(page){
	$.ajax({
	  	type: "POST",
	  	url: BASE_URL + "service/admin_handle_menu.php",
	  	data: {
	  		command: "getmenu_admin_data",
			page: page,
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
				  no = res.data.page
				  n = (no-1)*10;
				  for(var i in res.data.list){
                    var row = res.data.list[i];
					var img = row['menu_image']
					var image = JSON.parse(img)
					n++
                    str_html +=  '<tr>'+
								 	`<th scope="row">${n}</th>`+
								 	`<td scope="row"><img class="image_show" src="${BASE_URL}stocks/${image[1]}" /></td>`+
									 '<td class="row_type">'+row['menu_type']+'</td>'+
									'<td>'+row['menu_name']+'</td>'+
								 	'<td>'+
									'<div class="d-flex ms-4 gap-3">'+
										
									  	'<svg onclick="remove_menu('+row['menu_id']+')" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">'+
										  	'<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>'+
									  	'</svg>'+
								 	'</div>'+
								 	'</td>'+
								 '</tr>'
	  			}
	  			$("#menu_list").html(str_html);
				var num = res.data.total
				totalpage = Math.ceil(num/$num_per_page)
				var paginationhtml = ''; 
			    paginationhtml = `<div onclick="back_page(${no})"  class="btn" class="btn-pagination"> < </div>`;
				for(var i=1; i<=totalpage; i++){
				   paginationhtml += 
				   `<button onclick="getmenu_admin_data(${i})" href='home?page=${i}'class="btn fw-bold">${i}</button>`
				}
			    paginationhtml += `<div onclick="next_page(${no})" class="btn" class="btn-pagination"> > </div>`
			  $("#paginate").html(paginationhtml);
	  		}else{
	  			// 
	  		}
	  	}
	});
}

function next_page(page){
    if(page != totalpage){
        // $(".number-pagination").removeClass('active-pagination')
        page++
        getmenu_admin_data(page)
        // $("#page"+page).addClass('active-pagination')
    }
}

function back_page(page){
    if(page != 1){
        // $(".number-pagination").removeClass('active-pagination')
        page--
		getmenu_admin_data(page)
        // $("#page"+page).addClass('active-pagination')
    }
}

function current_page(c_page){
    $(".number-pagination").removeClass('active-pagination')
    page = c_page;
	getmenu_admin_data()
    $("#page"+page).addClass('active-pagination')
}

function getEditMenu(menu_id) {
	var menu_id = menu_id
	$.ajax({
		type: "POST",
		url: BASE_URL + "service/admin_handle_menu.php",
		data: {
			command: "findOne_data",
			menu_id: menu_id,
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
					str_html +=   
                                    `<h1>${menu_id}</h1>
									<p>${row['menu_type']}</p>
									`
									
	  			}
	  			$("#editShow").html(str_html);
	  		}else{
	  			// 
	  		}

		}
  });
}

function updateMenu(){
	// var menu_id = $("#menu_id").val()
	// var menu_name = $("#menu_name").val()
	// var menu_ingredients = $("#menu_ingredients").val()
    // var menu_method =$("#menu_method").val()
	// var menu_type = $("#menu_type").val() 
	// var menu_image = $('#menu_image')[0].files[0];
	// var form = new FormData();
	// form.append("command", "update_data");
	// form.append("menu_id", menu_id);
	// form.append("menu_name", menu_name);
	// form.append("menu_method", menu_method);
	// form.append("menu_ingredients", menu_ingredients);
	// form.append("menu_type", menu_type);
	// form.append("menu_image", menu_image);
	// $.ajax({
	//   	type: "POST",
	//   	url: BASE_URL + "service/menu.php",
	//   	data: form,
	//   	cache: false,
	//   	dataType: "json",
	// 	processData: false,
	// 	contentType: false,
	//   	error: function(data){
	//   		console.log("error", data)
	//   	},
	//   	success: function(res){
	// 		// console.log(res)
	// 			// 
	//   	}
	// });
	// setTimeout(function(){ location.reload(); }, 100);
}

function editData(id) {
	var uid = id
	$.ajax({
		type: "POST",
		url: BASE_URL + "service/admin_handle_menu.php",
		data: {
			command: "edit_data",
			menu_id: uid,
		},
		cache: false,
		dataType: "json",
		error: function(data){
			console.log("error", data)
		},
		success: function(res){
			console.log("success");
			console.log(res);
			if(res.status == true){
				var row = res.data[0]
				var images = row.menu_image
				// console.log(row.menu_image)
				var str_html = "";
				for(var i in images){
                    rows = images[i];
					// row = JSON.parse(rows)
					console.log(rows)
					// var img = row['menu_image']
					// var image = JSON.parse(row)
                    str_html += `<div class="img-container d-flex justify-content-center position-relative">
										<img onclick="remove_img(${images.indexOf(i)})" src="${BASE_URL + `image/${row}`}" alt="">
										<span class="position-absolute">
											x
										</span>
								</div>`;
					
				}
			    // var src = BASE_URL + `image/${row.menu_image}`
				$('#hidden').val(`${row.menu_id}`)
				$("#menu_type").val(`${row.menu_type}`);
				$("#menu_name").val(`${row.menu_name}`);
				$("#menu_ingredients").val(`${row.menu_ingredients}`);
				$("#menu_method").val(`${row.menu_method}`);
				$("#editModal").modal('show');
				$('#files').html(str_html)
				// console.log(str_html)
			}else{
				// 
			}
		}
	})
}


function remove_menu(menu_id) {
	var menu_id = menu_id
	$.ajax({
		type: "POST",
		url: BASE_URL + "service/admin_handle_menu.php",
		data: {
			command: "delete_data",
			menu_id: menu_id,
		},
		cache: false,
		dataType: "json",
		error: function(data){
			console.log("error", data)
		},
		success: function(res){
			getmenu_admin_data()
		}
  });
 
}

function addMenu(){
	var menu_name = $("#menu_name").val()
	var menu_ingredients = $("#menu_ingredients").val()
    var menu_method =$("#menu_method").val()
	var menu_type = $("#menu_type").val() 
	var menu_img = $('#files')[0].files
	if(menu_img.length >0){
		var total_menu_image = $('#files')[0].files
	}else if(upload_file.length >0){
		var total_menu_image = upload_file
	}
	// console.log(total_menu_image)

	var form = new FormData();
	for(var index=0;index<total_menu_image.length;index++){
		if(index<3){
			form.append("menu_image[]", menu_image = total_menu_image[index]);
			console.log(menu_image)
		}else{
			alert(`Don't upload images more than 3`)
			return ;
		}
	}

	form.append("command", "insert_data");
	form.append("menu_name", menu_name);
	form.append("menu_method", menu_method);
	form.append("menu_ingredients", menu_ingredients);
	form.append("menu_type", menu_type);
	// form.append("menu_image[]", total_menu_image);
	

	console.log(form)
		
	$.ajax({
	  	type: "POST",
	  	url: BASE_URL + "service/admin_handle_menu.php",
	  	data: form,
	  	cache: false,
	  	dataType: "json",
		processData: false,
		contentType: false,
	  	error: function(data){
	  		console.log("error", data)
	  	},
	  	success: function(res){
			  alert('Upload success')
			
	  	}
	});
	$('#input_form')[0].reset();
	$('#img_box').html(' ')
	// setTimeout(function(){ location.reload(); }, 100);
}


function  img_select(){
	let upload1= new UploadImg()
    upload1.img_select()
}

function remove_img(index){
	let upload1= new UploadImg(index)
    upload1.remove_img()
}

