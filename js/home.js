 $(document).ready(() =>{
    getlist_home_data(page);
    $("#page1").addClass("active-pagination")
    $("#search_menu_btn").click(function(){
        getlist_home_data();
        $(".search").val('')
    })
 });
var page = 1;
var totalpage = 0;
$num_per_page = 8;


function getlist_home_data(page,menu_type){
    var search = $(".search").val()
    if(menu_type == undefined){
        var menu_type = ''
    }
	$.ajax({
	  	type: "POST",
	  	url: BASE_URL + "service/home_content.php",
	  	data: {
	  		command: "getlist_home_data",
            search : search,
            page : page,
            menu_type: menu_type,
	  	},
	  	cache: false,
	  	dataType: "json",
	  	error: function(data){
	  		console.log("error", data)
	  	},
	  	success: function(res){
	  		// console.log("success")
	  		// console.log(res)
            no = res.data.page
	  		if(res.status == true){
	  			var str_html = "";
                if(res.data.total >0){
                    for(var i in res.data.list){
                        var row = res.data.list[i]
                        var img = row['menu_image']
                        var image = JSON.parse(img)
                                str_html += '<div class="menu_card card rounded " data-bs-toggle="modal" data-bs-target="#menu_modal'+row['menu_id']+'">'+
                                                '<div class="card-body p-0">'+
                                                    '<div>'+
                                                        `<img src="${BASE_URL}stocks/${image[0]}" class="content_img rounded card-img-top img-fluid mb-2" alt="...">`+
                                                    '</div>'+
                                                '<div class="d-flex flex-column justify-content-between m-3">'+
                                                '<p class="card-menu-type text-success">'+row['menu_type']+'</p>'+
                                                '<p class="card-menu-title text-secondary">'+row['menu_name']+'</p>'+
                                                '<button type="button" class="view_more text-decoration-none" >View more..</button>'+
                                                '</div>'+
                                            '</div>'+
                                                    //  '<!-- Modal -->'
                                                    '<div class="card_modal modal fade pt-2" id="menu_modal'+row['menu_id']+'" tabindex="-1" aria-hidden="true">'+
                                                        '<div class="modal-dialog modal-xl" id="card_detail">'+
                                                          '<div class="modal-content">'+
                                                            '<div class="popup_detail modal-body d-flex justify-content-between">'+
                                                            '<div class="d-flex justify-content-center align-items-center ms-4">'+
                                                            `<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                                                                <div class="container-fluid carousel-inner">
                                                                  <div class="carousel-item active" data-bs-interval="3000">
                                                                    <img id="img_show_card" class="rounded card-img-top img-fluid" src="${BASE_URL}stocks/${image[0]}" alt="">
                                                                  </div>
                                                                  <div class="carousel-item" data-bs-interval="3000">
                                                                    <img id="img_show_card" class="rounded card-img-top img-fluid" src="${BASE_URL}stocks/${image[1]}" alt="">
                                                                  </div>
                                                                  <div class="carousel-item" data-bs-interval="3000">
                                                                    <img id="img_show_card" class="rounded card-img-top img-fluid" src="${BASE_URL}stocks/${image[2]}" alt="">
                                                                  </div>
                                                                </div>
                                                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                                                                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                  <span class="visually-hidden">Previous</span>
                                                                </button>
                                                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                                                                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                  <span class="visually-hidden">Next</span>
                                                                </button>
                                                              </div>`+
                                                            // '<img class="rounded card-img-top img-fluid" src="image/'+row['menu_image']+'" alt="">'+
                                                        '</div>'+
                                                            
                                                        '<div class="ingredient_box" >'+
                                                                '<h2 class="fw-bold text-success">'+row['menu_name']+'</h2>'+
                                                                '<h4 class="text-primary">Ingredients</h4>'+
                                                                '<p>'+row['menu_ingredients']+'</p>'+
                                                            '</div>'+
                                                        '</div>'+
                                                            
                                                        '<div class="mx-4" >'+
                                                                '<h4 class="text-primary">Method</h4>'+
                                                                '<p>'+row['menu_method']+'</p>'+
                                                        '</div>'+

                                                        '<div class="modal-footer">'+
                                                              '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>'+
                                                          '</div>'+
                                                          '</div>'+
                                                      '</div>'+
                                                      '</div>'+
                                                  '</div>'
                        }
                $('#no_item').html('')
                }else if(res.data.total == 0){
                $('#no_item').html('<div style="height: 300px;" class="d-flex text-center justify-content-center align-items-center"><h1>No item</h1></div>')
                }
	  			$("#menu_list_show").html(str_html);
                  var num = res.data.total
                  totalpage = Math.ceil(num/$num_per_page)
                  var paginationhtml = ''; 
                  if(totalpage != 0){
                      paginationhtml = `<div onclick="back_page(${no},menu_type='${menu_type}')"  class="btn" class="btn-pagination"> < </div>`;
                  }
                  for(var i=1; i<=totalpage; i++){
                     paginationhtml += 
                     `<button onclick="getlist_home_data(${i},menu_type='${menu_type}')" href='home?page=${i}'class="btn fw-bold">${i}</button>`
                  }
                  if(totalpage != 0){

                      paginationhtml += `<div onclick="next_page(${no},menu_type='${menu_type}')" class="btn" class="btn-pagination"> > </div>`
                  }
                $("#paginate").html(paginationhtml);
	  		}
	  	}
	});
}


function next_page(page,menu_type){
    if(page != totalpage){
        // $(".number-pagination").removeClass('active-pagination')
        page++
        getlist_home_data(page,menu_type)
        // $("#page"+page).addClass('active-pagination')
    }
}

function back_page(page,menu_type){
    if(page != 1){
        // $(".number-pagination").removeClass('active-pagination')
        page--
        getlist_home_data(page,menu_type)
        // $("#page"+page).addClass('active-pagination')
    }
}







